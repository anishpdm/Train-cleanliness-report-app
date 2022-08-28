<?php

include './user_navbar.php';
?>
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
                        <td> Prescription </td>
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
                        <td>Medical Store / Place </td>
                        <td>
                            <input class="form-control" type="text" name="pres">
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

include('functions.php');

include './db.php';
if (isset($_POST["but"])) {

    $_SESSION['data'] = $_POST["data"];
    $_SESSION['pres'] = $_POST['pres'];

    $mysqli = new mysqli("localhost", "root", "", "MedicineReportApp");


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
    //echo $otpdata;

    $name = $_SESSION['name'];
    $phone = $_SESSION['Phone'];


    $message = "Dear $name, $otpdata is the OTP for REPORTING the complaint. Thank You";
    $messageTosend = str_replace(" ", "%20", $message);

    file_get_contents("http://logixspace.com/smspack/messaging.php?userid=8825272497&password=E5GI12IX58&msg=$messageTosend&phone=$phone");


    echo "<form method='POST'> <table class='table'> ";
    echo " <tr> <td>   </td>  <td>  <p class='text-danger'> OTP has been send to your phone number  </p> </td> </tr> ";

    echo " <tr> <td>  Enter OTP </td>  <td><input type='text' class='form-control' name='otp' />   </td> </tr> ";
    echo " <tr> <td>   </td>  <td> <Button type='submit' class='btn btn-success' name='otpsub'>  SUBMIT  </Button>   </td> </tr> ";

    echo " </table> </form>";


    $senderId = $_SESSION['userid'];

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
    $mysqli = new mysqli("localhost", "root", "", "MedicineReportApp");

    $otp = $_POST['otp'];
    $sessOtp = $_SESSION['otp'];
    if ($sessOtp == $otp) {
        $senderId = $_SESSION['userid'];

        $data = $_SESSION['data'];
        $pres = $_SESSION['pres'];
        $ImgPath = $_SESSION['ImgPath'];

        $sqlInsert = "INSERT INTO `MedQualityReport`( `UserId`,
     `Pic`, `Place`, `Status`, `ReportedDate`, `Description`)
     VALUES ($senderId,'$ImgPath','$pres','Processing',now(),'$data') ";
        $res1 = $mysqli->query($sqlInsert);

        if ($res1 === TRUE) {
            echo "<script> alert('Complaint Hasbeen sent to the Authorities')   </script>";
        } else {
            echo $connection->error;
        }
    } else {
        echo "<script> alert('Invalid OTP')   </script>";
    }
}




?>
