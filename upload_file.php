<?php
header("Content-type:text/html; charset=utf-8");
if($_FILES["file"]["error"]>0){
	echo "Error:".$_FILES["file"]["error"]."<br/>";
}
else{
	//echo "Upload:".$_FILES["file"]["name"]."<br/>";
	//echo "Size:".$_FILES["file"]["size"]."<br/>";
	//echo "Stored in:".$_FILES["file"]["tmp_name"]."<br/>";
	//echo $_FILES["file"]["tmp_name"]."<br/>";
	//echo "upload/".$_FILES["file"]["name"]."<br/>";
	if(file_exists("upload/".$_FILES["file"]["name"])){
		//echo "File already exists."."<br/>";
		if(unlink("upload/".$_FILES["file"]["name"])){
			//echo "unlink: True"."<br/>";
		}
		else{
			//echo "unlink: False"."<br/>";
		}
	}

	if(file_exists($_FILES["file"]["tmp_name"])){
		//echo "exist"."<br/>";
		if(is_dir("upload/")){
			//echo "Directory exists"."<br/>";
		}
		else{
			//echo "not dir"."<br/>";
		}
	}
	else{
		//echo "not exit"."<br/>";
	}
	
	if(rename($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"])){
		//echo "True"."<br/>";
	}
	else {
		//echo "move faild"."<br/>";
	}
	
	$params="upload/".$_FILES["file"]["name"];
	$cmd="python3 predict.py ";
	//echo $cmd.$params."<br/>";
	$ret=exec($cmd.$params." 2>&1",$output,$var);
	echo "License Plate:".$ret."<br/>";
	//var_dump($output);
	//echo "<br/>";
	//echo "var:".$var."<br/>";
	
	//search LP
	$servername="localhost";
	$username="root";
	$password="caizhenhui!";
	$dbname="SmartPark";
	
	$con = mysqli_connect($servername,$username,$password,$dbname);
	if(mysqli_connect_errno()){
		die("connect faild:".mysqli_connect_error());
	}
	
	$sql="SELECT * FROM users WHERE licenseplate='".$output[0]."'";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)==0){
		//empty
		//jump to signUp
		echo "<script>alert('No relevant information found for this vehicle, please register for an account!')</script>";
		mysqli_free_result($result);
		mysqli_close($con);
		header("Location:http://167.179.110.241/Temp/SignUp.html");
		exit();
	}
	
	//parking
	//fomat=YYYY-MM-DD HH:MM:SS
	$startTime=date("Y-m-d H:i:S");
	
	$sql="INSERT INTO parkinfo (licenseplate,starttime) VALUES ('".$output[0]."',".$startTime.")";
	mysqli_query($con,"set names utf8");
	$result=mysqli_query($con,$sql);
	if(!$result){
		echo "Registration failed!".$sql."<br>";
		//mysqli_free_result($result);
		mysqli_close($con); 
		exit();
	}
	echo $startTime."Your vehicle has entered the parking lot. <br>";
	
	//mysqli_free_result($result);
	mysqli_close($con); 
}
?>