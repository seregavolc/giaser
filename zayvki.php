<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category";
 $result = mysqli_query($mysql, $sql);

 if(!empty($_GET["drop"])){
    $i = $_GET["drop"];
    $sql = "DELETE FROM `zayvki` WHERE id_zayavki = $i";
    $result = mysqli_query($mysql, $sql);
    header("location: zayvki.php");
 }

 if(!empty($_POST["text"])){
    $text = $_POST["text"];
    $id = $_POST["za"];
    $dat = date("Y-m-d H:i:s");
    $sql = "UPDATE `zayvki` SET `status`='Отменена',`datae`='$dat',`otkaz`='$text' WHERE id_zayavki = $id";
    $result = mysqli_query($mysql, $sql);
    if($result){
        header("location: zayvki.php");
    }
 }

 if(!empty($_FILES["file"])){
    $dir = "img/";
    $za = $_POST["za"];
    $f = $dir.$_FILES["file"]["size"] * rand(1, 999).".png";
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $f)){
        $datae = date("Y-m-d H:i:s", time());
        $id = $_SESSION["id_user"];
        $sql = "UPDATE `zayvki` SET `fotoposle`='$f',`status`='Решена',`datae`='$datae' WHERE id_zayavki = $za";
        $res = mysqli_query($mysql, $sql);
        if($res){
            header("location: zayvki.php");
        }
    }
    else{
        exit();
    }
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">
            <h3 class="text-center mt-4 mb-4">Заявки</h3>
        </div>
        <div class="col-lg-4"></div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Временная метка</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Опции</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($result)){
                        foreach($result as $row){
                            echo '
                                <tr>
                                    <td>'.$row["datas"].'</td>
                                    <td>'.$row["name"].'</td>
                                    <td>'.$row["opis"].'</td>
                                    <td>'.$row["namec"].'</td>
                                    <td>'.$row["status"].'</td>';
                                    if($row["status"] == "Новая"){
                                        echo '<td class="par">
                                        <input type="hidden" class="form-control zas" value="'.$row["id_zayavki"].'" id="zas" name="zas">
                                            <button type="button" class="btn bss" data-bs-toggle="modal" data-bs-target="#yesmodal">
                                                <img class="drop" src="img/yes.png" alt="выполнить">
                                            </button>
                                            <button type="button" class="btn bss" data-bs-toggle="modal" data-bs-target="#zamodal">
                                                <img class="drop" src="img/drop.png" alt="удалить">
                                            </button>
                                        </td>';
                                    }
                                    else{
                                        echo "<td></td>";
                                    }
                               echo '</tr>
                            ';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="zamodal" tabindex="-1" aria-labelledby="zamodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтвердите отмену заявки</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <input type="hidden" class="form-control za" value="" id="za" name="za">
        <div class="mb-3">
            <label for="text" class="form-label">Причина отказа</label>
            <textarea class="form-control" required id="text" rows="3" name="text"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Удалить</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $(".bss").click(function(){
            $(".za").val($(this).parent(".par").children(".zas").val());
        })
    })
</script>

<div class="modal fade" id="yesmodal" tabindex="-1" aria-labelledby="yesmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтвердите выполнение</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control za" value="" id="za" name="za">
        <input class="form-control" required type="file" id="file" name="file">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Подтвердить</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $(".bss").click(function(){
            $(".za").val($(this).parent(".par").children(".zas").val());
        })
    })
</script>