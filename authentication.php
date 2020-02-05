<?php
include "db_connect.php";
if(isset($_GET['list_id'])) {

    $list_id = $_GET['list_id'];
    echo $list_id;
    $sql_list = "SELECT * FROM shopping_list WHERE id=$list_id";
    $stm = $conn->prepare($sql_list);
    $stm->execute();
    $data = $stm->fetch();
}

$list_id = $data->id;
echo $list_id;
    if (!empty($_COOKIE['pass' . $list_id])) {
        $list_id = $_GET['list_id'];
        header("Location: shopping_list.php?list_id=$list_id");

    } else {
        //ako go pogodi pass da mu se prikaza products na taa lista
        if (isset($_POST['submit'])) {
            echo "vlez 1";
            $list_id = $data->id;
            $pass = $_POST['password'];
            if (!empty($pass)) {
                if ($data->secret != md5($pass)) {
                    setcookie('pass'.$list_id, md5($pass));//vo COOKIE PASSWORD cuvam pass a imeto mi e soodvetno napass za sekoja lista
                    echo $list_id;
                     header("Location: shopping_list.php?id= $list_id");
                } else {
                    // echo "necini pas";
                    header("Location: index.php");
                }
            }

        }
    }

?>
<html>
<head>
    <title>Avtenticiraj</title>
</head>
<body>
    <form method="post" action="authentication.php?list_id=<?=$list_id?>">
        <input type="text" name="password">
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>