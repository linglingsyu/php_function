<style>

body{
    font-family:"Consolas";
}
</style>

請輸入您要列印的星星行數:
<form action="?">
<input type="number" name="row">
</form>
<?php 
if(isset($_GET["row"])){
$x = $_GET["row"];
// for ($i = 0; $i < 5 ;$i++){
//     $rand = rand(5,20);
//       stars($rand);
// }

stars($x);

}
function stars($x){
    for ($i = 0; $i < $x; $i++) {
        for ($j = 0; $j < $x * 2 - 1; $j++) {
            //if ($j == $x+$i-1 || $j == $x-$i-1) {
            if ($j <= $x + $i - 1 && $j >= $x - $i - 1) {
                echo "*";
            } else {
                echo "&nbsp;";
            }
        }
        echo "<br>";
    }
}




?>