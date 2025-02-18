<?php
 include("temp/bd.php");
 $login = $_POST["login"];
 $sql = "SELECT * FROM `users` WHERE login = '$login'";
 $result = mysqli_query($mysql, $sql);
 $result = mysqli_fetch_assoc($result);
 if ($result) {
    echo "no";
 }
 else {
    echo "yes";
 }
?>