<?php
echo "今天是 " . date("Y/m/d") . "<br>";
$params="par1";
$cmd="python3 test_PHP.py"
echo "$cmd"." "."$params";
$output=exec("python3 test_PHP.py par1");
dump($output);

?>