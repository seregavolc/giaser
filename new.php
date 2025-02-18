<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 $id = $_SESSION["id_user"];
 $sql = "SELECT * FROM category";
 $result = mysqli_query($mysql, $sql);

 if(!empty($_POST["name"])){
    $name = $_POST["name"];
    $opis = $_POST["opis"];
    $category = $_POST["category"];
    if($_FILES["file"]["size"] >= (10 * 1024 * 1024)){
        header("location: new.php?erf=файл привышает допустимый размер");
        exit();
    }

    if(($_FILES["file"]['type'] != "image/jpeg") and ($_FILES["file"]['type'] != "image/jpg") and ($_FILES["file"]['type'] != "image/png") and ($_FILES["file"]['type'] != "image/bmp")){
        header("location: new.php?erf=файл неподходит по формату");
        exit();
    }

    $dir = "img/";
    $f = $dir.$_FILES["file"]["size"] * rand(1, 999).".png";
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $f)){
        $datas = date("Y-m-d H:i:s", time());
        $id = $_SESSION["id_user"];
        $sql = "INSERT INTO `zayvki`(`name`, `opis`, `id_category`, `id_user`, `fotodo`, `status`, `datas`) VALUES ('$name','$opis','$category','$id','$f','Новая','$datas')";
        $res = mysqli_query($mysql, $sql);
        if($res){
            header("location: lk.php");
        }
    }
    else{
        header("location: new.php?erf=произошла ошибка");
        exit();
    }
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="text-center col-lg-4">
            <h3 class="text-center mt-4">Новая заявка</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="text-start mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" required class="form-control" id="name" name="name">
                </div>
                <div class="text-start mb-3">
                    <label for="opis" class="form-label">Описание</label>
                    <input type="text" required class="form-control" id="opis" name="opis">
                </div>
                <div class="text-start mb-3">
                    <label for="category" class="form-label">Категория</label>
                    <select id="category" class="form-select" name="category">
                        <?php
                            foreach($result as $row){
                                echo ' <option value="'.$row["id_category"].'">'.$row["namec"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 text-start"><span class="text-danger"> <?php if(!empty($_GET["erf"])){echo $_GET["erf"];} ?></span>
                    <label for="file" class="form-label">Фото, демонстрирующее проблему</label>
                    <input class="form-control" required type="file" id="file" name="file">
                </div>
                <button type="submit" id="btn" class="btn btn-primary">Отправить</button>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>