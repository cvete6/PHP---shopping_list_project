<?php

if(isset($_POST['submit'])){
    //da ja najdam sumata na teksto
    $text=$_POST['text'];
    $string='';
    for($i=0; $i< strlen($text); $i++){
        if($text[$i]=='$') {
            while ($text[$i] == '$' || $text[$i] == '.' || is_numeric($text[$i])) {
                echo $text[$i];
                $string .= $text[$i];//!!!!!!!!! vnimavaj ne gi sobiraj gi KONKATENIRAS !!!!!!!!
                $i++;
            }
        }
    }
    //lista explode so $
    $sum=0;
    $suma=explode('$',$string);
    for($j=0; $j<count($suma); $j++){
        $sum+=$suma[$j];
    }
    echo "Sumata e: ".$sum;
}
?>
<html>
<head>
    <title>Proccess data</title>
</head>
<body>
    <form method="post" action="proccessdata.php">
        <textarea type="text" name="text"></textarea>
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>
