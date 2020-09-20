<?php
header("Content-type:text/html; charset=utf-8");
$servername="localhost";
$username="root";
$password="password";
$dbname="SmartPark";
$myurl="http://47.93.148.239/Temp/";

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()){
	die("connect faild:".mysqli_connect_error());
}
echo mysqli_query($con,"set names utf8");

$sql="SELECT * FROM users WHERE tel='".$_POST["tel"]."' and password='".$_POST["password"]."'";

$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)==0){
	echo "wrong tel or password!"."<br>";
	mysqli_close($con);
	exit();
}
while($row=mysqli_fetch_array($result)){
	//fomat=YYYY-MM-DD HH:MM:SS
	$endTime=date("Y-m-d H:i:s");
	$sql="UPDATE parkinfo SET endtime='".$endTime."' WHERE licenseplate='".$row[3]."' and endtime IS NULL";
	echo $sql."<br>";
	
	if(mysqli_query($con,$sql)){
		echo $endTime." Your car is being transported by a robot. Please wait a moment."."<br>";
		mysqli_close($con);
		exit();
	}
	else{
		echo "Sign In ERROR ".$sql."<br>";
		mysqli_close($con);
		exit();
	}
}
mysqli_close($con);
?>
