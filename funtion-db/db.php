<?php 

$dsn = "mysql:host=localhost;charser=utf8;dbname=invoice2";
$pdo = new PDO($dsn,'root',"");
date_default_timezone_set("Asia/Taipei");
session_start();

//呼叫函式
// $rows = all('invoice');
// foreach ($rows as $value){
//     echo $value["number"]." - ".$value["expend"] . "<br>";
// }
function all($table){
    $sql  = "select * from `$table`";
    global $pdo;
    $rows = $pdo->query($sql)->fetchAll();
    return $rows;
}
function find($table,$id){
    $sql = "select * from `$table` where `id` = '$id'";
    global $pdo;
    $rows = $pdo->query($sql)->fetch();
    if(empty($rows)){
        return "無符合資料的內容";
    }
    return $rows;
}
$rows = find('invoice','4');
if(is_array($rows)){
    echo $rows["number"];
    echo "<br>";
    echo $rows["expend"];
}else{
    echo $rows;
}

// 直接執行的函式 不需要return
function to($url){
    header("location:".$url);
}


?>

