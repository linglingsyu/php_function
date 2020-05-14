<?php
include "base.php";

/*

 * select * from $table
 * select * from $table where ??? = 'xxx';
 * select * from $table where ??? = 'xxx' && ??? = 'xxx' ....;
 * select * from $table where ??? = 'xxx' || ??? = 'xxx' ....;
 * select * from $table where ??? = 'xxx' && ??? = 'xxx' .... order by ???;
 * select * from $table order by ???;
 * select * from where ??? limit;
 * select * from $table ,(sub query) where ??? limit;
 * 
 * all($table,...$cindition)
 * $table => 資料表名
 * $condition[0] => where 條件句
 * $condition[1] => order by , limit , group by 條件句
 * $condition[2] => fetch類別 

sprintf() 函數把格式化的字符串寫入一個變數中。
sprintf(format,arg1,arg2,arg++)
參數	描述
format	必需。轉換格式。
arg1	必需。規定插到 format 字符串中第一個 % 符號處的參數。
arg2	可選。規定插到 format 字符串中第二個 % 符號處的參數。
arg++	可選。規定插到 format 字符串中第三、四等等 % 符號處的參數。

格式:
%d - 數字
%s - 字串
*/ 

//自訂可變參數function

function all($table,...$condition){
    global $pdo;
    $sql = "select * from $table ";

    //第二個參數 加入where的條件句
    if(isset($condition[0]) && is_array($condition[0])){
        //判斷帶入的條件是否存在以及是不是陣列 
        $tmp=[];
        foreach($condition[0] as $key => $value){
           // $tmp = $tmp . "`".$key."`='". $value . "'" . " && ";
            $tmp[] = sprintf("`%s` = '%s'",$key,$value);
        }
       $sql = $sql . "where" . implode(" && ",$tmp);
    }

    //第三個參數 不管它丟什麼型態(但丟陣列會報錯,我們自己使用要知道是要丟字串)
    //如果有就執行~沒有就算了
    if(isset($condition[1])){
        $sql = $sql . $condition[1];
    }

     return $pdo->query($sql)->fetchAll();
}

$rows = (all("invoice"));
foreach($rows as $row){
    echo $row['id'] . " - ";
    echo $row['code'] . " - ";
    echo $row['number'] . " - ";
    echo $row['period'] . " - ";
    echo $row['expend'];
    echo "<hr>";
}
echo "<p>有帶第二參數</p>";
$rows = all("invoice",["period"=>"2","year"=>"2020"]);
foreach($rows as $row){
    echo $row['id'] . " - ";
    echo $row['code'] . " - ";
    echo $row['number'] . " - ";
    echo $row['period'] . " - ";
    echo $row['expend'];
    echo "<hr>";
}

echo "<p>有帶第三個參數</p>";
$rows = all("invoice",["year"=>"2020"]," order by id desc");
foreach($rows as $row){
    echo $row['id'] . " - ";
    echo $row['code'] . " - ";
    echo $row['number'] . " - ";
    echo $row['period'] . " - ";
    echo $row['expend'];
    echo "<hr>";
}

echo "<p>不帶條件參數(但第二個條件還是要給.不然繼續不會執行下面 可以帶[]或'')</p>";
$rows = all("invoice",""," order by id desc");
foreach($rows as $row){
    echo $row['id'] . " - ";
    echo $row['code'] . " - ";
    echo $row['number'] . " - ";
    echo $row['period'] . " - ";
    echo $row['expend'];
    echo "<hr>";
}

