<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 if(!empty($_POST["login"])){
    $login = $_POST["login"];
    $password = $_POST["pass1"];
    $email = $_POST["email"];
    $fio = $_POST["fio"];
    $sql = "INSERT INTO `users`(`fio`, `login`, `email`, `pass`, `id_role`) VALUES ('$fio','$login','$email','$password', 1)";
    $result = mysqli_query($mysql, $sql);
    if($result){
        header("location: vizit.php");
    }
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h3 class="text-center mt-4 mb-4">Регистрация</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="fio" class="form-label">ФИО</label>
                    <input type="text" required class="form-control" id="fio" name="fio">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин </label><span class="text-danger errorl"> </span>
                    <input type="text" required class="form-control" id="login" name="login">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" required class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pass1" class="form-label">Пароль</label><span class="text-danger error"></span>
                    <input type="password" required class="form-control" id="pass1" name="pass1">
                </div>
                <div class="mb-3">
                    <label for="pass2" class="form-label">Поворите пароль</label><span class="text-danger error"></span>
                    <input type="password" required class="form-control" id="pass2" name="pass2">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" required class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Согласие на обработку персональных данных</label>
                </div>
                <button type="submit" id="btn" disabled class="btn btn-primary">Зарегистрироваться</button>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#pass2").change(function(){
            if($("#pass1").val() == $("#pass2").val()){
                $("#btn").removeAttr("disabled");
                $(".error").html(" ");
            }
            else{
                $("#btn").attr("disabled", "disabled");
                $(".error").html(" Пароли не совпадают");
            }
        })

        $("#login").change(function(){
            var login = $(this).val();
            $.ajax({
                type: "post",
                url: "reg.php",
                data: ({login: login}),
                success: function (response) {
                    if(response == "no"){
                        $("#btn").attr("disabled", "disabled");
                        $(".errorl").html(" Логин занят");
                    }
                    else{
                        $("#btn").removeAttr("disabled");
                        $(".errorl").html(" ");
                    }
                }
            });
        })
    })
</script>