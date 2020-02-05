<?php
include "db_connect.php";
//za daden e mail da nema dve listi so isto ime
//creator list_name
$sql_shopping_list="SELECT * FROM shopping_list";
$stm = $conn->prepare($sql_shopping_list);
$stm->execute();
$rows = $stm->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['create'])) {
    $email=$_POST['creator'];
    $list_name=$_POST['list_name'];
    $pass=$_POST['password'];
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $numm=0;
        foreach ($rows as $data) {
            if ($data->creator == $email && $data->list_name==$list_name) {
                echo "ne mozi da se kreira ";
                $numm++;
            }
        }
        if($numm==0) {
            //kreiraj nov shopping list
            $sql = "INSERT INTO shopping_list(id,list_name,creator,secret) VALUES(NULL,:name,:email,:pass)";
            $stm = $conn->prepare($sql);
            $stm->execute([':name' => $list_name, ':email' => $email, ':pass' => md5($pass)]);
            header("Location: index.php");
        }
        else{
            echo "vnesi nova email";
        }
    }

}
?>
<html>
<body>

    <form action="add_shopping_list.php" method="post">
        <p>Email:</p><input name="creator" type="email">
        <p>List_name:</p><input type="text" name="list_name">
        <p>Pass:</p><input type="password" name="password">

        <input type="submit" name="create" value="Create New List">
    </form>
</body>
</html>
