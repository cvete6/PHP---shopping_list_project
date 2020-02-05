<?php
echo $_GET['id_product'];
include "db_connect.php";
$id_product=$_GET['id_product'];
$list_id=$_GET['id_list'];

//ako e kliknato +1 zgolemi vo baza quantity za 1
$sql_add="UPDATE products  SET quantity=quantity+1 WHERE id=$id_product";
$stmt=$conn->prepare($sql_add);
$stmt->execute();

header("Location: shopping_list.php?list_id=$list_id");


?>
