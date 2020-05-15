<?php

include_once "base.php";

$row = q("select * from invoice where id = '3' ");
print_r($row);
echo "<br>";
echo $row[0]["number"];

function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

//新增也可以使用這個函式
$row = q("insert into invoice values(null,'CG','99999999','1','99','2020')");


?>