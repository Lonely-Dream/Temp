<?php
$servername="localhost";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()){
	die("connect faild:".mysqli_connect_error());
}

$sql="SELECT * FROM users WHERE tel='".$_POST["tel"]."' and password='".$_POST["password"]."'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)==0){
	echo "wrong tel or password!"."<br>";
	mysqli_close($con);
	exit();
}
while($row=mysqli_fetch_array($result)){
	$sql="SELECT * FROM parkinfo WHERE licenseplate='".$row[3]."'";
	$result2=mysqli_query($con,$sql);
	if(!$result2){
		echo "Sign In ERROR ".$sql."<br>";
		mysqli_close($con);
		exit();
	}
	while($row2=mysqli_fetch_array($result2)){
		if($row2[2]===NULL){
			//get it;
			//fomat=YYYY-MM-DD HH:MM:SS
			$endTime=date("Y-m-d H:i:s");
			$sql="UPDATE parkinfo SET endtime='".$endTime."' WHERE licenseplate='".$row2[0]."'";
			if(mysqli_query($con,$sql)){
				echo "Your car is being transported by a robot. Please wait a moment."."<br>";
			}
			else{
				echo "Sign In ERROR ".$sql."<br>";
			}
		}
	}
}
mysqli_close($con);
?>