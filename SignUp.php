<?php
$servername="localhost";
$username="root";
$password="caizhenhui!";
$dbname="SmartPark";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connect faild:".$conn->connect_error);
}

//Find out if you are already registered
$sql="SELECT * FROM users";
if($result=$conn->query($sql)){
	while($row=mysqli_fetch_array($result)){
		if($row[3]===$_POST["licenseplate"]){
			//The license plate has been registered.
			echo "<script>alert('The license plate has been registered!')</script>";
			header("Location:http://167.179.110.241/Temp/SignUp.html");
			$conn->close();
			exit();
		}
	}
}

//registered
$sql="INSERT INTO users (tel,password,licenseplate) VALUES ('".$_POST["tel"]."','".$_POST["password"]."','".$_POST["licenseplate"]."')";
echo "SQL:".$sql."<br>";
$conn->query("set names utf8");
if($conn->query($sql)===TRUE){
	echo "Registration success!"."<br>";
}
else{
	echo "Registration failed!".$conn->error."<br>";
}

$sql="SELECT * FROM users";
if($result=$conn->query($sql)){
	while($row=mysqli_fetch_array($result)){
		echo "<tr><td> {$row[0]}</td> ".
			"<td>{$row[1]} </td> ".
			"<td>{$row[2]} </td> ".
			"<td>{$row[3]} </td> ".
			"<td>{$row[4]} </td> ".
			"</tr>";
	}
}
else{
	echo $result."  ERROR"."<br>";
}


$conn->close();
?>