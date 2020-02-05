<?php
echo $_GET['id_product'];
include "db_connect.php";
$id_product=$_GET['id_product'];
$list_id=$_GET['id_list'];



$sql_add="SELECT * FROM products WHERE id=$id_product";
$stmt=$conn->prepare($sql_add);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($rows as $row){
    if($row->is_bought == 0){
        $sql_add="UPDATE products  SET is_bought=1 WHERE id=$id_product";
        $stmt=$conn->prepare($sql_add);
        $stmt->execute();
        header("Location: shopping_list.php?list_id=$list_id");
    }
    else{
        $sql_add="UPDATE products  SET is_bought=0 WHERE id=$id_product";
        $stmt=$conn->prepare($sql_add);
        $stmt->execute();
        header("Location: shopping_list.php?list_id=$list_id");    }
}

?>
