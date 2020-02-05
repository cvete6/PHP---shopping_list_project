<?php
include "db_connect.php";

$id_list=$_GET["list_id"];

$sql_products="SELECT * FROM products WHERE shopping_list_id=$id_list  ORDER BY is_urgent=1 desc ";
$stm=$conn->prepare($sql_products);
$stm->execute();
$rows=$stm->fetchAll(PDO::FETCH_OBJ);

?>
<html>
<head>

</head>
<body>
<table >
    <th>product_name</th>
    <th>quantity</th>
    <th>dodaj</th>
    <th>odzemi</th>
    <th>is_bought</th>

    <?php foreach ($rows as $data):?>
        <tr>
            <?php if($data->is_urgent == 1) :?>
                <td style="font-weight: bold"><a href="bought.php?id_product=<?=$data->id?>&&id_list=<?=$data->shopping_list_id?>"> <?=$data->product_name?> </a></td>
                <td><?=$data->quantity?></td>
                <td><a href="dodadi.php?id_product=<?=$data->id?>&&id_list=<?=$data->shopping_list_id?>"> +1 </a></td>
                <td><a href="odzemi.php?id_product=<?=$data->id?>&&id_list=<?=$data->shopping_list_id?>"> -1 </a></td>
                <td><?=$data->is_bought?></td>

            <?php elseif($data->is_urgent == 0 && $data->is_bought == 0): ?>
                <td style="font-weight: lighter"><?=$data->product_name?></td>
                <td><?=$data->quantity?></td>
                <td><a href="dodadi.php?id_product=<?=$data->id?>&&id_list=<?=$data->shopping_list_id?>"> +1 </a></td>
                <td><a href="odzemi.php?id_product=<?=$data->id?>&&id_list=<?=$data->shopping_list_id?>"> -1 </a></td>
                <td><?=$data->is_bought?></td>

            <?php else: ?>
                <td style="text-decoration: line-through"><?=$data->product_name?></td>
                <td><?=$data->quantity?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach;?>
</table>
<h1>ADD NEW PRODUCT IN THIS SHOPPING LIST</h1>
<form action="new_product.php" method="post">
    <input type="hidden" name="shoppingListId" value="<?=$_GET['id']?>">
    <div>
        <label for="productName">Product Name</label>
        <input type="text" name="productName" required>
    </div>
    <div>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" required>
    </div>
    <div>
        <label for="urgent">Urgent</label>
        <input type="checkbox" name="urgent">
    </div>
    <div>
        <input type="submit" name="submit" value="Add">
    </div>
</form>
</body>
</html>