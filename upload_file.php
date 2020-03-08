<?php
header("Content-type:text/html; charset=utf-8");
if($_FILES["file"]["error"]>0){
	echo "Error:".$_FILES["file"]["error"]."<br/>";
}
else{
	echo "Upload:".$_FILES["file"]["name"]."<br/>";
	echo "Size:".$_FILES["file"]["size"]."<br/>";
	echo "Stored in:".$_FILES["file"]["tmp_name"]."<br/>";
	echo $_FILES["file"]["tmp_name"]."<br/>";
	echo "/var/www/html/Temp/upload/".$_FILES["file"]["name"]."<br/>";
	if(file_exists("upload/".$_FILES["file"]["name"])){
		echo "File already exists."."<br/>";
		if(unlink("upload/".$_FILES["file"]["name"])){
			echo "unlink: True"."<br/>";
		}
		else{
			echo "unlink: False"."<br/>";
		}
	}

	if(file_exists($_FILES["file"]["tmp_name"])){
		echo "exist"."<br/>";
		if(is_dir("upload/")){
			echo "Directory exists"."<br/>";
		}
		else{
			echo "not dir"."<br/>";
		}
	}
	else{
		echo "not exit"."<br/>";
	}
	
	if(rename($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"])){
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
	$resultFile=fopen("result.txt","r");
	echo fgets($resultFile)."<br/>";
	
	fclose($resultFile);
}
?>