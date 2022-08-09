<?php
$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "identification_card";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo " Joining unsuccessful 😔";
}
$id = 100;
$check = "SELECT * FROM idc WHERE id = '$id'";
$rs = mysqli_query($conn, $check);
$data = mysqli_num_rows($rs);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neonderthaw&display=swap" rel="stylesheet">
    <title>IdCard</title>
    <style>
        

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3" style="background-color:black ;">
                <?php

                $query = "SELECT * FROM idc WHERE id = '101'";
                $result = mysqli_query($conn, $query);

                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <img src="./image/<?php echo $data['image']; ?>" alt="">
                <?php
                }
                ?>
            </div>
            <div class="col-sm-9">
                <div class="col-sm-6" style="background-color:red ;">
                    <?php

                    $query = "SELECT * FROM idc WHERE id = '101'";
                    $result = mysqli_query($conn, $query);

                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                       <p><b>First Name: </b><?php echo $data['firstname']; ?>
                       <p><b>ID: </b><?php echo $data['id']; ?></p>
                       <b> Last Name: </b><?php echo $data['lastname']; ?></p>
                       <p><b>Phone: </b><?php echo $data['phone']; ?></p>
                       <p><b><?php echo $data['dpt']; ?></b></p>
                       <p><b>Blood Gr. : </b><?php echo $data['bg']; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
</body>

</html>