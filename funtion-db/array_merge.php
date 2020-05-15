<?php

$a = ["AA", "BB"];
$b = ["CC", "DD"];

$c = array_merge($a, $b);

echo "<pre>";
print_r($c);
echo "</pre>";

echo "<hr>";
echo "<hr>";
function am($a, ...$b)
{
    if (is_array($a)) {
        $arr = $a;
    } else {
        echo "not an array";
        exit();
    }
    if (isset($b)) {
        if (!is_array($b)) {
            exit();
        }
        foreach ($b as $item) {
            foreach ($item as $i) {
                $arr[] = $i;
            }
        }
        /*
        ...$b是將我們給的參數第二個之後整合成一個陣列
        $b foreach 出來的item 也是一個陣列
        所以要再foreach一次item拿他的值
        */
    }
    return $arr;
}
$c = ["你", "好", "啊"];
$d = ["自", "己", "寫"];
$my = am($a, $b,$c,$d);
echo "<pre>";
print_r($my);
echo "</pre>";