<?php
echo "今天是 " . date("Y/m/d") . "<br>";
$params="upload/1.png";
	$cmd="python3 predict.py ";
	
	$output=exec($cmd.$params);
	echo $output;

?>