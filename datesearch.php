<?php
include './admin_navbar.php';


?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col col-12 col-sm-2">


        </div>

        <div class='col col-12 col-sm-8'>
            <form action="" method="post">

                <table class="table">
                    <tr>
                        <td>Select Date</td>
                        <td> <input type="date" name="mydate" id=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><Button class='btn btn-success' type='submit' name='searchbtn'> SEARCH</Button> </td>
                    </tr>
                </table>


            </form>
        </div>

        <div class="col col-12 col-sm-2">


        </div>
    </div>
</div>


</body>

</html>




<?php
include './dbcon.php';
if (isset($_POST['searchbtn'])) {
    $date = $_POST['mydate'];

    echo " <form  method='post'>";





    $sql = "
SELECT m.`Id`, u.Name,u.Address,u.Phone, `Pic`, `Place`, `Status`, `ReportedDate`, `Description` FROM `MedQualityReport`m JOIN Users u on u.Id=m.UserId WHERE DATE_FORMAT(ReportedDate,'%Y-%m-%d')='$date'
";
    $res = $connection->query($sql);

    if ($res->num_rows > 0) {

        echo "<table class='table table-borderless table-striped'>
   <tr class='table-primary'>
   <td>  PRESCRIPTION </td>
   <td>  NAME </td>
   <td>  Address </td>
   <td>  Details </td>
   <td>  ReportDate </td>
   <td>  Current Status </td>

   <td>  Action </td>
   </tr>
    
    ";

        while ($row = $res->fetch_assoc()) {

            $Id = $row['Id'];
            $name = $row['Name'];
            $Address = $row['Address'];
            $prof_pic_link = $row['Pic'];

            $Details = $row["Description"];
            $ReportDate = $row["ReportedDate"];

            $CurrentStatus = $row["Status"];
            if ($FoundStatus == 0) {
                $Fstatus = "Not Found";
            } else {
                $Fstatus = " Found";
            }
            echo "
       <tr>
<td> <img src='./$prof_pic_link'   height='400px' width='400px' </td>           <td>$name</td>
    
      
           <td>$Address</td>
    
           <td> $Details</td>
 
           <td>$ReportDate</td>
           <td> $CurrentStatus </td>
        

           <td>  <a class='btn btn-warning' href='missingupdate.php?qid=$Id' target='_blank'> Update Status  </a> </> </td>
    
       </tr>
      ";
        }

        echo " </table>";
    } else {
        echo "<script> alert('No Complaints available')   </script>";
    }
}





if (isset($_POST['approvebtn'])) {

    $CompanyId = $_POST['approvebtn'];
    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "training";
    $connection = new mysqli($server_name, $db_username, $db_password, $db_name);
    $sql = "UPDATE `company` SET `flag`=1 WHERE `id`=$CompanyId";
    $res = $connection->query($sql);

    if ($res === TRUE) {
        echo "<script>
    alert('Updated Succesfully')
</script>";
        echo "<script>
    window.location.href = 'company_approval.php'
</script>";
    } else {
        echo "Error in Updation";
    }
}

?>