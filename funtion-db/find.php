<?php 

$dsn = "mysql:host=localhost;charser=utf8;dbname=invoice2";
$pdo = new PDO($dsn,'root',"");
date_default_timezone_set("Asia/Taipei");
session_start();

$table="invoice";
$row=find($table,3);
//find找到資料後,直接更新資料;
$row['code']="XX";
save($table,$row);

$row=find($table,["year"=>'2020','code'=>'ZG']);
//find找到資料後,直接更新資料(陣列方式);
$row['code']="CB";
$row['number']="12332122";


function find($table,$arg){
    $sql = "select * from `$table`";
    global $pdo;
//判斷arg是不是陣列走不同的sql
    if(is_array($arg)){
        $tmp=[];
        foreach($arg as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }else{
        $sql = $sql . "where `id`='$arg'";
    }
    // echo $sql;
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}


function save($table,$arg){
    global $pdo;
    if(isset($arg['id'])){
        //update
        $sql = "update $table ";
        foreach ($arg as $key => $value){
            if($key != 'id'){
            $tmp[] = sprintf("`%s`='%s'",$key,$value);
            }
        }
        $sql = "update $table set " . implode(',', $tmp ) . " where `id`='" . $arg['id']."'";
        echo $sql;
         return $pdo->exec($sql);
    }else{
        //insert
        $sql = "insert into $table" . "(`".implode("`,`",array_keys($arg)) ."`) values ". "('".implode("','",$arg) ."')";
        echo $sql;
        return $pdo->exec($sql);
    
    }
}

?>