<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <br><br><br>
    <div class="container">

        <div class="row">
            <div class="col col-sm-2"></div>

            <div class="col col-sm-8">

                <form action="" method="post">



                    <table class="table table-borderless table-striped">
                        <?php


                        include './dbcon.php';

                        $qid = (int) $_GET['qid'];


                        $sql = "SELECT `Id`, `UserId`, `PNR`, `Pic`, `Status`, `ReportedDate`, `Description`, `Remarks` FROM `QualityReport` WHERE `Id`= $qid";
                        $res = $connection->query($sql);

                        if ($res->num_rows > 0) {

                            while ($row = $res->fetch_assoc()) {


                                $PNR = $row["PNR"];

                                $Description = $row["Description"];

                                echo "<tr> <td>  </td>  <td> <input type='hidden' value='$qid' name='qid' />  </td> </tr>";
                                echo "<tr> <td> PNR </td>  <td> $PNR  </td> </tr>";
                                echo "<tr> <td> Complaint </td>  <td> $Description  </td> </tr>";

                                echo "<tr> <td>  Current Status </td>  <td> <textarea class='form-control' name='ans'   cols='30' rows='10'></textarea>  </td> </tr>";



                                echo "<tr> <td>   </td>  <td> <button type='submit' class='btn btn-success' name='sub'>  SUBMIT </td> </tr>";
                            }
                        }




                        ?>





                    </table>
                </form>
            </div>

            <div class="col col-sm-2"></div>


        </div>
    </div>
</body>

</html>

<?php
include './dbcon.php';

if (isset($_POST['sub'])) {
    $qid = $_POST['qid'];

    $ans = $_POST['ans'];



    echo $sql = "UPDATE `QualityReport` SET `Remarks`='$ans' WHERE `Id`=$qid";


    $result = $connection->query($sql);

    if ($result === TRUE) {
        echo "<script> alert('Successfully Updated the Complaint Status') </script>";

        echo "<script>window.close();</script>";
    }
}

?>