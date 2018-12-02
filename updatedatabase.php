<?php

    session_start();
    if (array_key_exists("content", $_POST)) {

        include("connection.php");

        $query = "UPDATE `users` SET `diary` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        mysqli_query($link, $query);

    }
      if (array_key_exists("content1", $_POST)) {
        include("connection.php");
        $query1 = "UPDATE `users` SET `html` = '".mysqli_real_escape_string($link, $_POST['content1'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        mysqli_query($link, $query1);
      }

      if (array_key_exists("content2", $_POST)) {
        include("connection.php");
        $query2 = "UPDATE `users` SET `css` = '".mysqli_real_escape_string($link, $_POST['content2'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        mysqli_query($link, $query2);
      }

      if (array_key_exists("content3", $_POST)) {
        include("connection.php");
        $query3 = "UPDATE `users` SET `js` = '".mysqli_real_escape_string($link, $_POST['content3'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        mysqli_query($link, $query3);
      }

?>
