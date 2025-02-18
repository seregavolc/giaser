<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 
 if(!empty($_GET["drop"])){
    $i = $_GET["drop"];
    $sql = "DELETE FROM `zayvki` WHERE id_category = $i";
    $result = mysqli_query($mysql, $sql);
    $sql = "DELETE FROM `category` WHERE id_category = $i";
    $result = mysqli_query($mysql, $sql);
    header("location: category.php");
 }

 if(!empty($_POST["cat"])){
    $cat = $_POST["cat"];
    $sql = "INSERT INTO `category`(`namec`) VALUES ('$cat')";
    $result = mysqli_query($mysql, $sql);
    header("location: category.php");
 }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">
            <h3 class="text-center mt-4 mb-4">Категории</h3>
            <button type="button" class="btn btn-success bss" data-bs-toggle="modal" data-bs-target="#zamodal">
                Добавить категорию
            </button>
        </div>
        <div class="col-lg-4"></div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Категория</th>
                    <th scope="col">Опции</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($mysql, $sql);
                    if(!empty($result)){
                        foreach($result as $row){
                            echo '
                                <tr>
                                    <td>'.$row["namec"].'</td>
                                    <td><a class="btn" href="category.php?drop='.$row["id_category"].'" role="button"><img class="drop" src="img/drop.png" alt="удалить"></a></td>
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
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Название категории</span>
                <input type="text" class="form-control" name="cat">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Добавить</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </form>
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