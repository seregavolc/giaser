<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 if(!empty($_GET["drop"])){
    $i = $_GET["drop"];
    $sql = "DELETE FROM `zayvki` WHERE id_zayavki = $i";
    $result = mysqli_query($mysql, $sql);
    header("location: lk.php");
 }

 if(!empty($_POST["fil"])){
    $fil = $_POST["fil"];
    $id = $_SESSION["id_user"];
    $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category AND zayvki.id_user = $id and zayvki.status = '$fil' order by datas desc";
    $result = mysqli_query($mysql, $sql);
 }
 else{
    $id = $_SESSION["id_user"];
    $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category AND zayvki.id_user = $id order by datas desc";
    $result = mysqli_query($mysql, $sql);
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">
            <h3 class="text-center mt-4 mb-4">Личный кабинет</h3>
            <a class="btn btn-primary mb-4" href="new.php" role="button">Новая заявка</a>

            <form action="" method="post" class="mt-3 mb-4">
                <div class="input-group">
                    <select class="form-select" id="fil" name="fil">
                        <option selected>Выберите...</option>
                        <option value="Новая">Новая</option>
                        <option value="Отменена">Отменена</option>
                        <option value="Решена">Решена</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Применить</button>
                </div>
            </form>
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
                                        echo '<td>
                                            <button value="'.$row["id_zayavki"].'" type="button" class="btn bss" data-bs-toggle="modal" data-bs-target="#zamodal">
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
        <p>Вы действительно хотите удалить заявку?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger bee" href="lk.php?drop=" role="button">Удалить</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $(".bss").click(function(){
            $(".bee").attr("href", "lk.php?drop=" + $(".bss").val());
        })
    })
</script>