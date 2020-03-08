<?php
$servername="localhost";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connect faild:".$conn->connect_error);
}

$sql="SELECT * FROM users WHERE tel='".$_POST["tel"]."' and password='"..$_POST["password"]."'";
$result=$conn->query($sql);
if($conn->num_rows()===0){
	echo "wrong tel or password!"."<br>";
	$conn->close();
	exit();
}
while($row=mysqli_fetch_array($result)){
	$sql="SELECT * FROM parkinfo WHERE licenseplate='".$row[3]."'";
	$result2=$conn->query($sql);
	if(!$result2){
		echo "Sign In ERROR ".$sql."<br>";
		$conn->close();
		exit()
	}
	while($row2=mysqli_fetch_array($result2)){
		if($row2[2]===NULL){
			//get it;
			//fomat=YYYY-MM-DD HH:MM:SS
			$endTime=date("Y-m-d H:i:s");
			$sql="UPDATE parkinfo SET endtime='".$endTime."' WHERE licenseplate='".$row2[0]."'";
			if($conn->query($sql)===TRUE){
				echo "Your car is being transported by a robot. Please wait a moment."."<br>";
			}
			else{
				echo "Sign In ERROR ".$sql."<br>";
			}
		}
	}
}
$conn->close();
?>