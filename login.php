<?php
session_start();

$uname=$_POST['user'];
$pass=$_POST['psd'];

require('firstimport.php');

$tbl_name="users"; // Table name

mysqli_select_db($conn,"$db_name")or die("cannot select DB");


// $sql="SELECT * FROM $tbl_name WHERE email='$uname' and password='$pass'";
// echo "$sql";



$sql = "SELECT * FROM $tbl_name WHERE email='$uname' and password='$pass'";
$result = $connectionnew->query($sql);

if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {
     $id=$row["id"];

	 $_SESSION['name'] = $uname; // Make it so the username can be called by $_SESSION['name']    //
	 echo " ....   LOGIN  ....";
	 $_SESSION['id']=$id;

	 header("location:index.php"); 
  }
} else {
	echo " .... LOGIN TRY  ....";
	$_SESSION['error'] = "1";
	header("location:login1.php"); //
}





//$row=mysql_fetch_array($result);

//echo "\n\n ..nam..".$row['f_name']."\n\n ..pass..".$row['password'];




?>

	