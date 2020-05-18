<?php  

$dsn = "mysql:host=localhost;charser=utf8;dbname=invoice2";
$pdo = new PDO($dsn,'root',"");
date_default_timezone_set("Asia/Taipei");
session_start();

//1-查詢全部
function all($table,...$condition){
    global $pdo;
    $sql = "select * from $table ";

    if(isset($condition[0]) && is_array($condition[0])){
        $tmp=[];
        foreach($condition[0] as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }
    if(isset($condition[1])){
        $sql = $sql . $condition[1];
    }

     return $pdo->query($sql)->fetchAll();
}

//2-查詢單筆
function find($table,$arg){
    $sql = "select * from `$table`";
    global $pdo;
    if(is_array($arg)){
        $tmp=[];
        foreach($arg as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }else{
        $sql = $sql . "where `id`='$arg'";
    }
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

//3-刪除資料
function del($table,$arg){
    global $pdo;
    $sql = "delete from $table ";
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

//4-新增或更新資料
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

//5-
function nums($table,...$condition){
    global $pdo;
    $sql = "select count(*) from $table ";
    if(isset($condition[0]) && is_array($condition[0])){
        $tmp=[];
        foreach($condition[0] as $key => $value){
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }
    if(isset($condition[1])){
        $sql = $sql . $condition[1];
    }
     return $pdo->query($sql)->fetchColumn();
}

//6-頁面導向
function to($url){
    header("location:".$url);
}

//7-
function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}



?>