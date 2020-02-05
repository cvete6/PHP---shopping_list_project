<?php
include "db_connect.php";
//list all list from baza
$currentFavorites=[];
if (empty($_GET['all']) && isset($_POST['addFavorite'])){
    //go dodavam id vo cookie[favorites]
    if (isset($_COOKIE['favorites'])) {//ako ima ness vo cookie da go zemime
       $currentFavorites = $_COOKIE['favorites'];//kako lista ni gi cuva dosegasnite fav list id
    }

    $id_list=$_POST['id_list'];
    array_push($currentFavorites,$id_list);//na listat so fav dodadi go novio
    echo 'tekonata niza e:'; print_r($currentFavorites); echo "<br />";

    setcookie('favorites',serialize($currentFavorites),time() + 60 * 60 * 24 * 30);

    //da gi listam site listi koi so id vo cookie['favorites']
    print_r($currentFavorites);

    for ($i=0; $i<sizeof($currentFavorites)-1; $i++){
        $generator.=$currentFavorites[$i].',';
    }
    $nount=sizeof($currentFavorites);
    $generator.=$nount;
    echo 'listat e: '.$generator;
    $sql = "SELECT * FROM shopping_list WHERE id IN $generator";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
  //  $rows='';

}else {
    $sql = "SELECT * FROM shopping_list";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
}
?>

<html>
<head>
    <title>Shopping list</title>
</head>
<body>
<h2><a href="index.php?all=true"> Show all shopping-list</a></h2>
<h2><a href="add_shopping_list.php"> ADD shopping-list</a></h2>

<table>

    <th>Sopping list</th>
    <th>Add to favorite</th>
            <?php foreach ($rows as $data): ?>
                <tr>
                    <td><a href="authentication.php?list_id=<?=$data->id?>"> <?=$data->list_name ?></a></td>
                    <td>
                        <form action="index.php" method="post">
                           <input type="hidden" name="id_list" value="<?=$data->id?>">
                           <input type="submit" name="addFavorite" value="Add to fav">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>

</table>
</body>
</html>