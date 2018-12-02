<?php
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\project\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\project\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\project\PHPMailer-master\src\SMTP.php';
*/
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

    //session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {

        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";

        session_destroy();

    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

        header("Location: loggedinpage.php");

    }

    if (array_key_exists("submit", $_POST)) {

        include("connection.php");

        if (!$_POST['email']) {

            $error .= "An email address is required<br>";

        }

        if (!$_POST['password']) {

            $error .= "A password is required<br>";

        }

        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;

        } else {

            if ($_POST['signUp'] == '1') {

                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                  /*My second commit*/
                  $hash = md5( rand(0,1000) );

                    $query = "INSERT INTO `users` (`email`, `password`,`hash`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."','$hash')";



/*                    $to      = $_POST['email'];
$subject = 'Signup | Verification'; // Give the email a subject
$message = '

Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.


Please click this link to activate your account:
http://localhost/project/loggedinpage.php?email='.$email.'&hash='.$hash.'

'; // Our message above including the link

$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers);
*/

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {
                      $email=$_POST['email'];
                      $mail = new PHPMailer;
                      $mail->isSMTP();
                      $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                      $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                      $mail->Port = 587; // TLS only
                      $mail->SMTPSecure = 'tls'; // ssl is depracated
                      $mail->SMTPAuth = true;
                      $mail->Username = "ghoshsudip084@gmail.com";
                      $mail->Password = "crisis3 maxpayne3";
                      $mail->setFrom('from@example.com', 'Mailer');
                      $mail->addAddress($_POST['email'], 'Joe User');
                      $mail->Subject = 'Signup || Verification';
                      $mail->msgHTML("Thanks for signing up!
                      Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.


                      Please click this link to activate your account:
                      http://localhost/project/Verify.php?email=$email&hash=$hash
"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                      $mail->AltBody = 'HTML messaging not supported';
                      // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

                      if(!$mail->send()){
                          echo "Mailer Error: " . $mail->ErrorInfo;
                      }else
                      {
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                        $id = mysqli_insert_id($link);

                        mysqli_query($link, $query);

                        $_SESSION['id'] = $id;

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $id, time() + 60*60*24*365);

                        }

                      /*  header("Location: loggedinpage.php");8=*/
                        $error = "<p>Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.</p>";
                    }
                  }

                }

            } else {

                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

                    $result = mysqli_query($link, $query);

                    $row = mysqli_fetch_array($result);

                    if (isset($row)) {

                        $hashedPassword = md5(md5($row['id']).$_POST['password']);

                        if ($hashedPassword == $row['password'] && $row['active']==1) {
                           session_start();
                            $_SESSION['id'] = $row['id'];

                            if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24*365);

                            }

                            header("Location: loggedinpage.php");

                        } else {

                            $error = "That email/password combination could not be found.";

                        }

                    } else {

                        $error = "That email/password combination could not be found.";

                    }

                }

        }


    }


?>

<?php include("header.php"); ?>

      <div class="container" id="homePageContainer">

    <h1>Secret Diary</h1>

          <p><strong>Store your thoughts permanently and securely.</strong></p>

          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

} ?></div>

<form method="post" id = "signUpForm">

    <p>Interested? Sign up now.</p>

    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Your Email">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="password" name="password" placeholder="Password">

    </fieldset>

    <div class="checkbox">

        <label>

        <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

        </label>

    </div>

    <fieldset class="form-group">

        <input type="hidden" name="signUp" value="1">

        <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">

    </fieldset>

    <p><a class="toggleForms">Log in</a></p>

</form>

<form method="post" id = "logInForm">

    <p>Log in using your username and password.</p>

    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Your Email">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control"type="password" name="password" placeholder="Password">

    </fieldset>

    <div class="checkbox">

        <label>

            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

        </label>

    </div>

        <input type="hidden" name="signUp" value="0">

    <fieldset class="form-group">

        <input class="btn btn-success" type="submit" name="submit" value="Log In!">

    </fieldset>

    <p><a class="toggleForms">Sign up</a></p>

</form>

      </div>

<?php include("footer.php"); ?>
