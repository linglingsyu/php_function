<?php  

$dsn = "mysql:host=localhost;charser=utf8;dbname=invoice2";
$pdo = new PDO($dsn,'root',"");
date_default_timezone_set("Asia/Taipei");
session_start();

?>