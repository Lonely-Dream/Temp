<?php
$servername="localhost";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connect faild:".$conn->connect_error);
}

$sql="INSERT INTO users (tel,password,licenseplate) VALUES ('".$_POST["tel"]."','".$_POST["password"]."','".$_POST["licenseplate"]."')";
echo "SQL:".$sql."<br>";
if($conn->query($sql)===TRUE){
	echo "registration success!"."<br>";
}
else{
	echo "registration failed!".$conn->error."<br>";
}

$sql="SELECT * FROM users";
if($result=$conn->query($sql)){
	else $result."<br>";
}
else{
	else $result."  ERROR"."<br>";
}


$conn->close();
?>