<?php
if($_FILES["file"]["error"]>0){
	echo "Error:".$_FILES["file"]["error"]."<br/>";
}
else{
	echo "Upload:".$_FILES["file"]["name"]."<br/>";
	echo "Size:".$_FILES["file"]["size"]."<br/>";
	echo "Stored in:".$_FILES["file"]["tmp_name"]."<br/>";
	echo $_FILES["file"]["tmp_name"]."<br/>";
	echo "/var/www/html/Temp/upload/".$_FILES["file"]["name"]."<br/>";
	
	if(file_exists($_FILES["file"]["tmp_name"])){
		echo "exist"."<br/>";
	}
	else{
		echo "not exit"."<br/>";
	}
	if(is_dir("/var/www/html/Temp/upload/")){
		echo "dir"."<br/>";
	}
	else{
		echo "not dir"."<br/>";
	}
	if(rename($_FILES["file"]["tmp_name"],"/var/www/html/Temp/upload/".$_FILES["file"]["name"])){
		echo "True"."<br/>";
	}
	else {
		echo "move faild"."<br/>";
	}
	
	$params="upload/".$_FILES["file"]["name"];
	$cmd="python3 predict.py ";
	echo $cmd.$params."<br/>";
	$ret=exec($cmd.$params." 2>&1",$output,$var);
	echo "ret:".$ret."<br/>";
	var_dump($output);
	echo "<br/>";
	echo "var:".$var."<br/>";
	
}
?>