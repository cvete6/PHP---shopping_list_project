<?php
echo $_GET['id_product'];
include "db_connect.php";
$id_product=$_GET['id_product'];
$list_id=$_GET['id_list'];
$sql_odzemi="SELECT * FROM products WHERE id=$id_product";
$stmt=$conn->prepare($sql_odzemi);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($rows as $row){
    if($row->quantity > 1){
        $sql_odz="UPDATE products  SET quantity=quantity-1 WHERE id=$id_product";
        $stmt=$conn->prepare($sql_odz);
        $stmt->execute();
        header("Location: shopping_list.php?list_id=$list_id");

    }
    else{
        header("Location: shopping_list.php?list_id=$list_id");
    }
}

?>
