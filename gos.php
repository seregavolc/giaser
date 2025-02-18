<?php
include("temp/bd.php");

$sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category and zayvki.status = 'Решена' order by id_zayavki desc limit 4";
$result = mysqli_query($mysql, $sql);
$s = '';

foreach($result as $row){
    $s .= '
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

echo $s;
?>