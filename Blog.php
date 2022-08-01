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
                <table class="table">
                    <tr>
                        <td> Question</td>
                        <td> <textarea class='form-control' name="medname" required> </textarea> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><Button class='btn btn-success' type='submit' name='searchbtn'> ADD</Button> </td>
                    </tr>
                </table>

            </form>





            <form action="" method="post">



                <?php

                $senderId = $_SESSION['userid'];

                include './dbcon.php';
                $sql = "
SELECT bq.`Id`, `Question`, u.Name, `AddedDate` FROM `BlogQuery` bq JOIN Users u on u.Id=bq.`UserId` WHERE 1";
                $res = $connection->query($sql);

                if ($res->num_rows > 0) {

                    echo "<table class='table table-borderless table-striped'>
   <tr class='table-primary'>
   <td>  Question </td>
   <td>  Posted User </td>
   <td>  Posted Date </td>
     <td>  Action  </td>
   </tr>

    ";

                    while ($row = $res->fetch_assoc()) {

                        $Question = $row["Question"];
                        $PostedDate = $row["AddedDate"];

                        $Name = $row["Name"];
                        $Id = $row["Id"];


                        echo "
       <tr>
           <td>$Question</td>


           <td> $Name </td>


           <td> $PostedDate</td>


     <td> <a href='addComment.php?id=$Id' target='_blank'>  Comment  </a>    </td>


       </tr>
      ";
                    }

                    echo " </table>";
                } else {
                    echo "<script> alert('No new blog details available')   </script>";
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
include './dbcon.php';
if (isset($_POST['searchbtn'])) {
    $Question = $_POST['medname'];


    $senderId = $_SESSION['userid'];




    $sql = "
INSERT INTO `BlogQuery`( `Question`, `UserId`, `AddedDate`) VALUES ('$Question',$senderId ,now() )
";
    $res = $connection->query($sql);

    if ($res === true) {

        echo " <script>  alert('Your Question Added')  </script> ";
        echo " <script> window.location.href='Blog.php'  </script> ";
    } else {
        echo "<script> alert('Error Occured ')   </script>";
    }
}
?>
