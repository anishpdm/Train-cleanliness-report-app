<?php
include './admin_navbar.php';


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
                include './dbcon.php';
                $sql = "
SELECT `Id`, `Name`, `Address`, `Phone`, `Email` FROM `Users` WHERE 1";
                $res = $connection->query($sql);

                if ($res->num_rows > 0) {

                    echo "<table class='table table-borderless table-striped'>
   <tr class='table-primary'>
   <td>  Name </td>
   <td>  Address </td>
   <td>  Phone </td>

   </tr>
    
    ";

                    while ($row = $res->fetch_assoc()) {

                        $Name = $row["Name"];
                        $Address = $row["Address"];

                        $Phone = $row["Phone"];



                        echo "
       <tr>

           <td>$Name</td>
    
      
           <td> $Address</td>
        
           <td>$Phone</td>
        
 
           
          

    
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