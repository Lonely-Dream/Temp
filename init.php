<?php
$servername="localhost";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connect faild:".$conn->connect_error);
}

$sql = "CREATE TABLE users(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tel VARCHAR(11) NOT NULL,
password VARCHAR(16) NOT NULL,
facedata MEDIUMBLOB
)";
if($conn->query($sql)===TRUE){
	echo "TABLE users created successfully!"."<br>";
}
else{
	echo "TABLE created faild!".$conn->error."<br>";
}

$sql = "CREATE TABLE parkinfo(
licenseplate VARCHAR(7) NOT NULL,
starttime DATETIME NOT NULL,
endtime DATETIME NOT NULL
)";
if($conn->query($sql)===TRUE){
	echo "TABLE parkinfo created successfully!"."<br>";
}
else{
	echo "TABLE created faild!".$conn->error."<br>";
}

$sql = "CREATE TABLE car(
tel VARCHAR(11) NOT NULL,
licenseplate VARCHAR(7) NOT NULL
)";
if($conn->query($sql)===TRUE){
	echo "TABLE car created successfully!"."<br>";
}
else{
	echo "TABLE created faild!".$conn->error."<br>";
}

$conn->close();
?>