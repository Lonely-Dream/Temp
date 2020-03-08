<?php
$servername="167.179.110.241";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn){
	die("connect faild:".$conn->connect_error);
}
$sql = "CREATE TABLE users(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tel VACHAR(11) NOT NULL,
password VACHAR(16) NOT NULL,
facedata MEDIUMBLOB,
)";
if($conn->query($sql)===TRUE){
	echo "TABLE users created successfully!";
	$sql="INSERT INTO users"
}
else{
	echo "TABLE created faild!".$conn->error;
}

$conn->close();
?>