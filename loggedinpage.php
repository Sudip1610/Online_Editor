<?php

    session_start();
    //$diaryContent="";

    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

        $_SESSION['id'] = $_COOKIE['id'];

    }

    if (array_key_exists("id", $_SESSION)) {

      include("connection.php");

      $query = "SELECT diary FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $diaryContent = $row['diary'];

      $query = "SELECT html FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $htmlContent = $row['html'];

      $query = "SELECT css FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $cssContent = $row['css'];

      $query = "SELECT js FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $jsContent = $row['js'];



    } else {

        header("Location: index.php");

    }

	include("header.php");

?>
<nav class="navbar navbar-light bg-faded navbar-fixed-top">


  <a class="navbar-brand" href="#">Secret Diary</a>

    <div class="pull-xs-right">
      <a href ='index.php?logout=1'>
        <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>

</nav>



    <div class="container-fluid" id="containerLoggedInPage">

        <textarea  id="diary" class="form-control" placeholder="Your Diary"><?php echo $diaryContent; ?></textarea>
        <textarea rows="20" id="html" class="panel form-control" placeholder="Html here"><?php echo $htmlContent; ?></textarea>

            <textarea rows="20" id="css" class="panel form-control" placeholder="Css here"><?php echo $cssContent; ?></textarea>

            <textarea rows="20" id="js" class="panel form-control" placeholder="Javascript here"><?php echo $jsContent; ?></textarea>

            <iframe id="outputPanel" class="panel" height="495"></iframe>

    </div>

<?php

    include("footer.php");
?>
