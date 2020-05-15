<?php 
include_once "base.php";
/**
 *  更新資料
 * 
 * update table set xx='aa',yy='bb',zz='cc'
 * update table set xx='aa',yy='bb',zz='cc' where xx='aa' && yy='bb'
 * update table set xx='aa',yy='bb',zz='cc' where id="?"
 *  
 */

$row = find('invoice',5);
$row['code'] = "ZA";
$row['expend'] = '5000';

update('invoice',$row);
function update($table,$arg){
    global $pdo;
    $sql = "update $table ";
    foreach ($arg as $key => $value){
        if($key != 'id'){
        $tmp[] = sprintf("`%s`='%s'",$key,$value);
    }
    }
    $sql = "update $table set " . implode(',', $tmp ) . " where `id`='" . $arg['id']."'";
    // echo $sql;
     return $pdo->exec($sql);
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