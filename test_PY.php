<?php
echo "今天是 " . date("Y/m/d") . "<br>";
$params="/var/www/html/Temp/upload/1.png";
$cmd="python3 predict.py ";
$output=exec($cmd.$params);
echo $output;

?>