<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 if(!empty($_POST["login"])){
    $login = $_POST["login"];
    $password = $_POST["pass1"];
    $sql = "SELECT * FROM `users` WHERE login = '$login' and pass = '$password'";
    $result = mysqli_query($mysql, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION["id_user"] = $row["id_user"];
        $_SESSION["id_role"] = $row["id_role"];
        if($_SESSION["id_role"] == 1){
            header("location: lk.php");
        }
        else{
            header("location: zayvki.php");
        }
    }else{
        header("location: vizit.php?error=логин или пароль введены неверно");
    }
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="text-center col-lg-4">
            <h3 class="text-center mt-4">Вход</h3>
            <span class="text-danger mt-2 mb-4"><?php if(!empty($_GET["error"])){ echo $_GET["error"]; } ?></span>
            <form action="" method="post">
                <div class="text-start mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" required class="form-control" id="login" name="login">
                </div>
                <div class="text-start mb-3">
                    <label for="pass1" class="form-label">Пароль</label>
                    <input type="password" required class="form-control" id="pass1" name="pass1">
                </div>
                <button type="submit" id="btn" class="btn btn-primary">Войти</button>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>