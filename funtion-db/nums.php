<?php

/*
 *計算筆數  把all的function CO過來 *加上count fetchALL改成fetchColumn就好XD
 * select count(*) from table where xx='yy' && zz='aa';
 * select count(*) from table;
 * select count(*) from table broup by;
 * 
 */


$total = nums('invoice');
echo "<hr>";
echo $total;

echo "<hr>";
$total = nums('invoice',["period"=>1]);
echo "<hr>";
echo $total;


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

?>