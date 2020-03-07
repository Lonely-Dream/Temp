<?php
echo "今天是 " . date("Y/m/d") . "<br>";
$params="par1";
$cmd="python3 test_PHP.py"
$output=exec($cmd." ".$params);
dump($output);

?>