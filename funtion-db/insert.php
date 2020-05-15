<?php
include_once "base.php";


/**
 * 新增資料
 * 
 * insert into `table` (`field1`,`field2`,`field3`) values ('value1','value2','valye3');
 * 
 */

$data = [
    "code"=>"BB",
    "number"=>"45611321",
    "period"=>1,
    "expend"=>1000,
    "year"=>"2021"
];

$table ="invoice";
echo insert($table,$data);


function insert($table,$arg){
    global $pdo;
    // $sql = "insert into ";
    // $str1="(`".implode("`,`",array_keys($arg)) ."`)";
    // echo  $str1 . "<br>";
    // $str2="('".implode("','",$arg) ."')";
    // echo  $str2 . "<br>";
    // $sql =  $sql . $table .$str1 . " values " . $str2;
    $sql = "insert into $table" . "(`".implode("`,`",array_keys($arg)) ."`) values ". "('".implode("','",$arg) ."')";
    return $pdo->exec($sql);

}




?>