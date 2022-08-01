<?php
include './user_navbar.php';


?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col col-12 col-sm-1">


        </div>

        <div class="col col-12 col-sm-10">
            <form action="" method="post">



                <?php
              
                $senderId = $_SESSION['userid'];

                include './dbcon.php';
                $sql = "
SELECT `Id`, `UserId`, `Pic`, `Place`, `Status`, `ReportedDate`, `Description` FROM `MedQualityReport` WHERE `UserId`=$senderId
";
                $res = $connection->query($sql);

                if ($res->num_rows > 0) {

                    echo "<table class='table table-borderless table-striped'>
   <tr class='table-primary'>
   <td>  Complaints </td>
   <td>  Posted Date </td>
   <td>  Current Status </td>

   </tr>

    ";

                    while ($row = $res->fetch_assoc()) {

                        $Complaints = $row["Description"];
                        $PostedDate = $row["ReportedDate"];

                        $Status = $row["Status"];
                        $Id = $row["Id"];


                        echo "
       <tr>
           <td>$Complaints</td>


           <td> $PostedDate </td>


           <td> $Status</td>





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

        <div class="col col-12 col-sm-1">


        </div>
    </div>
</div>


</body>

</html>
