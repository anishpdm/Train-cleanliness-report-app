<?php
include './admin_navbar.php';


?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col col-12 col-sm-2">


        </div>

        <div class="col col-12 col-sm-8">
            <form action="" method="post">



                <?php
                include './dbcon.php';
                $sql = "
                SELECT q.Id,u.f_name, q.`PNR`, q.`Pic`, q.`Status`, q.`ReportedDate`, q.`Description`, q.`Remarks` FROM `QualityReport` q join users u on u.id=q.UserId  order by q.ReportedDate desc 
";
                $res = $connection->query($sql);

                if ($res->num_rows > 0) {

                    echo "<table class='table table-borderless table-striped'>
   <tr class='table-primary'>
   <td>  NAME </td>
   <td>  PNR </td>
   <td>  PIC </td>
   <td>  Action </td>
   </tr>
    
    ";

                    while ($row = $res->fetch_assoc()) {

                     $Id = $row["Id"];
                        $name = $row["f_name"];
                        $PNR = $row["PNR"];
                        $prof_pic_link = $row["Pic"];

                        $Details = $row["Description"];
                        $ReportDate = $row["ReportedDate"];

                      
                        echo "
                        <td>$name</td>
                        <td>$PNR</td>


<td> <img src='./$prof_pic_link'   height='400px' width='400px' </td>
    
      
           
        
           <td>  <a class='btn btn-warning' href='missingupdate.php?qid=$Id' target='_blank'> Update Status  </a> </> </td>
    
       </tr>
      ";
                    }

                    echo " </table>";
                } else {
                    echo "<script> alert('No new Company details available')   </script>";
                }

                ?>
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
        echo "<script> alert('Updated Succesfully')   </script>";
        echo "<script> window.location.href='company_approval.php'   </script>";
    } else {
        echo "Error in Updation";
    }
}

?>