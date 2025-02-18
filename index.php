<?php
 include("temp/header.php");
 include("temp/nav.php");
 include("temp/bd.php");

 $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category and zayvki.status = 'Решена'";
 $result = mysqli_query($mysql, $sql);
 $i = 0;
 if($result) {
    foreach($result as $row){
        $i++;
    }
}

 $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category and zayvki.status = 'Решена' limit 4";
 $result = mysqli_query($mysql, $sql);
?>

<div class="container mb-5">
    <h3 class="text-center mt-3 mb-4">Количество решенных заявок: <?= $i?></h3>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
            if($result) {
                foreach($result as $row){
                    echo '
                        <div class="col">
                            <div class="card h-100">
                                <input type="hidden" class="form-control fotoposle" value="'.$row["fotoposle"].'">
                                <input type="hidden" class="form-control fotodo" value="'.$row["fotodo"].'">
                                <img src="'.$row["fotoposle"].'" class="card-img-top ims" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row["datae"].'</h5>
                                    <p class="card-text">'.$row["name"].'</p>
                                    <p class="card-text">'.$row["namec"].'</p>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
        ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".ims").mousemove(function(){
            $(this).attr("src", $(this).parent(".card").children('.fotodo').val());
        })

        $(".ims").mouseout(function(){
            $(this).attr("src", $(this).parent(".card").children('.fotoposle').val());
        })
    })
</script>