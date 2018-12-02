<!DOCTYPE html>

<html>
<head>
    <title>NETTUTS > Sign up</title>

</head>
<body>
    <!-- start header div -->
    <?php include("header.php"); ?>
    <div class="container" id="homePageContainer">
        <!-- start PHP code -->
        <?php
        include("connection.php");
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($link,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($link,$_GET['hash']); // Set hash variable

    $search = mysqli_query($link,"SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
    $match  = mysqli_num_rows($search);
    

    if($match > 0){
        // We have a match, activate the account
        mysqli_query($link,"UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
        echo '<div class="btn btn-success">Your account has been activated, you can now login</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="alert alert-danger" role="alert">The url is either invalid or you already have activated your account.</div>';
    }

}
else{
    // Invalid approach
    echo '<div class="alert alert-danger" role="alert">Invalid approach, please use the link that has been send to your email.</div>';
}


        ?>
        <!-- stop PHP Code -->

    </div>
    <!-- end wrap div -->
      <?php include("header.php"); ?>
</body>
</html>
