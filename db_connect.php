<?php
$hostname='localhost';
$dbname='sys';
$user='cvete';
$password='cvete';

try{
    $conn=new PDO("mysql:host=$hostname;dbname=$dbname",$user,$password);
}catch (PDOException $exception){
    echo 'Error connect '. $exception->getMessage();
}
?>