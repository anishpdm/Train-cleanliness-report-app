<?php
session_start();
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
$tbl_name="users"; // Table name
$name=$_SESSION['name'];

require('firstimport.php');

mysqli_select_db($conn,"$db_name") or die("cannot select db");
$Uid=$_SESSION['id'];
$result=mysqli_query($conn,"SELECT * FROM $tbl_name WHERE id=$Uid ");
$row=mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html>
<head>
	<title> Profile </title>
	<link rel="shortcut icon" href="images/favicon.png"></link>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	</link>
	<link href="css/Default.css" rel="stylesheet">
	</link>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script>
		$(document).ready(function()
		{
			//alert($(window).width());
			var x=(($(window).width())-1024)/2;
			//alert(x);
			$('.wrap').css("left",x+"px");
		});

	</script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/man.js"></script>
	
</head>

<body>
	
	<div class="wrap">
		<!-- Header -->
		<div class="header">
			<div style="float:left;width:150px;">

			</div>		
			<div>
			<div style="float:right; font-size:20px;margin-top:20px;">
			<?php
			 if(isset($_SESSION['name']))
			 {
			 echo "Welcome,".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
			 }
			 else
			 {
				$_SESSION['error']=15;
				//echo "fgfggy".$_SESSION['error'];
				header("location:login1.php");
			 } 
			 ?>
			</div>
			<div id="heading">
				<a href="index.php">Indian Railways</a>
			</div>
			</div>
		</div>
		<!-- Navigation bar -->
		<div class="navbar navbar-inverse" >
			<div class="navbar-inner">
				<div class="container" >
				<a class="brand" href="index.php" >HOME</a>
				<a class="brand" href="train.php" >FIND TRAIN</a>
				<a class="brand" href="reservation.php">RESERVATION</a>
				<a class="brand" href="profile.php">PROFILE</a>
				<a class="brand" href="viewhistory.php">BOOKING HISTORY</a>
				
                <a class="brand" href="giveComplaints.php"> Give a Complaint</a>

            </div>
			</div>
		</div>
		
		
			
		
        <div class="container">
    <div class="row">
        <div class="col col-sm-2">


        </div>

        <div class="col col-sm-8 col-12">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td></td>
                        <td>
                            <h4> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td> Image </td>
                        <td>
                            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                    <tr>
                        <td>Complaint</td>
                        <td> <textarea name="data" id="" cols="50" rows="10" class="form-control">

                        </textarea> </td>
                    </tr>
                    <tr>
                        <td> Select a PNR </td>
                        <td>


                        <?php

$Uid=$_SESSION['id'];

 $sql = "SELECT `id`, `Uid`, `pnr`, `uname`, `Tnumber`, `class`, `doj`, `DOB`, `fromstn`, `tostn`, `Name`, `Age`, `sex`, `Status`
 FROM `booking` WHERE `Uid`=$Uid and doj=CURDATE()" ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<select name='pnr' class='form-control' >";
  while($row = $result->fetch_assoc()) {
   $pnr= $row["pnr"];
   echo "<option value='$pnr'> $pnr  </option>";
  }
  echo "</select>";

} else {
  echo "<script> alert('NO VALID PNR Found to register a complaint')  </script>";
  echo "<script> window.location.href='viewhistory.php'  </script>";

}


?>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><button class="btn btn-success" name="but" type="submit">SEND</button></td>
                    </tr>





                </table>
                </form>

        </div>


        <div class="col col-sm-2">


        </div>


    </div>

</div>

</body>

</html>

<?php


include './firstimport.php';
if (isset($_POST["but"])) {

    $_SESSION['data'] = $_POST["data"];
    $_SESSION['pnr'] = $_POST["pnr"];


    $mysqli = new mysqli("localhost", "anish", "anish", "railres");


    $target_dir = "images/";
    $target_file = $target_dir . rand(999, 9999) . basename($_FILES["fileToUpload"]["name"]);
    // $Image = $connection->real_escape_string($target_file);
    $testage = $mysqli->real_escape_string($target_file);

    $_SESSION['ImgPath'] = $testage;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }


    $otpdata = str_shuffle(substr("0123456789", 0, 8));
    $_SESSION['otp'] = $otpdata;
    echo $otpdata;

    // $name = $_SESSION['name'];
    // $phone = $_SESSION['Phone'];


    // $message = "Dear $name, $otpdata is the OTP for REPORTING the complaint. Thank You";
    // $messageTosend = str_replace(" ", "%20", $message);

    // file_get_contents("http://logixspace.com/smspack/messaging.php?userid=8825272497&password=E5GI12IX58&msg=$messageTosend&phone=$phone");


    echo "<form method='POST'> <table class='table'> ";
    echo " <tr> <td>   </td>  <td>  <p class='text-danger'> OTP has been send to your phone number  </p> </td> </tr> ";

    echo " <tr> <td>  Enter OTP </td>  <td><input type='text' class='form-control' name='otp' />   </td> </tr> ";
    echo " <tr> <td>   </td>  <td> <Button type='submit' class='btn btn-success' name='otpsub'>  SUBMIT  </Button>   </td> </tr> ";

    echo " </table> </form>";


    // $senderId = $_SESSION['userid'];

    // $sqlInsert = "INSERT INTO `MedQualityReport`( `UserId`,
    //  `Pic`, `Place`, `Status`, `ReportedDate`, `Description`)
    //  VALUES ($senderId,'$testage','$pres','Processing',now(),'$data') ";
    // $res1 = $mysqli->query($sqlInsert);

    // if ($res1 === TRUE) {
    //     echo "<script> alert('Complaint Hasbeen sent to the Authorities')   </script>";
    // } else {
    //     echo $connection->error;
    // }
}




if (isset($_POST['otpsub'])) {
    $mysqli = new mysqli("localhost", "anish", "anish", "railres");
    $otp = $_POST['otp'];
    $sessOtp = $_SESSION['otp'];
    if ($sessOtp == $otp) {
        $senderId=$_SESSION['id'];


        $data = $_SESSION['data'];

        $ImgPath = $_SESSION['ImgPath'];
        $PnrValue=$_SESSION['pnr'];

        $sqlInsert = "INSERT INTO `QualityReport`(
         `UserId`, `PNR`, `Pic`, `Status`, `ReportedDate`, 
         `Description`) VALUES ($senderId,'$PnrValue',
         '$ImgPath',0,now(),'$data') ";
        $res1 = $mysqli->query($sqlInsert);

        if ($res1 === TRUE) {
            echo "<script> alert('Complaint Hasbeen sent to the Authorities')   </script>";
        } else {
            echo $mysqli->error;
        }
    } else {
        echo "<script> alert('Invalid OTP')   </script>";
    }
}




?>