<?php 

/**
 * 刪除資料
 * delete from table where id = "";
 * delete from table where xx='aa' && yy='bb'
 * 
 */
// del('invoice',['id'=>2]);
include_once "base.php";
del('invoice',2);
function del($table,$arg){
    global $pdo;
    $sql = "delete from $table ";
    //判斷$arg不是id就是陣列
    if(is_array($arg)){
        $tmp=[];
        foreach($arg as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }else{
        $sql = $sql . "where `id`='$arg'";
    }
    echo $sql;
     return $pdo->exec($sql);
}


?>