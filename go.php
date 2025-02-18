<?php
include("temp/bd.php");

 $sql = "SELECT * FROM zayvki, category WHERE zayvki.id_category = category.id_category and zayvki.status = 'Решена'";
 $result = mysqli_query($mysql, $sql);
 $i = 0;
 if($result) {
    foreach($result as $row){
        $i++;
    }
}
echo $i;


?>