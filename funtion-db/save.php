<?php

include_once "base.php";

$data=[
    "code"=>"FG",
    "number"=>"98182327",
    "period"=>4,
    "expend"=>70,
    "year"=>"2020"
];
//新增資料
//save('invoice',$data);  

//更新資料
$row=find("invoice",6);
$row['code']="GG";
$row['period']="4";
$row['number'] = '98179818';
save('invoice',$row);

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

function find($table,$id){
    $sql = "select * from `$table` where `id` = '$id'";
    global $pdo;
    $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(empty($rows)){
        return "無符合資料的內容";
    }
    return $rows;
}


?>