<?php
$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "identification_card";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo " Joining unsuccessful 😔";
}

$fn = $_POST["fn"];
$ln = $_POST["ln"];
$ph = $_POST["ph"];
$dp = $_POST["dpt"];
$bg = $_POST["bg"];
$id = $_POST["id"];
$image = $_FILES['image']['name'];
$temp = $_FILES['image']['tmp_name'];
$folder = "./image/" . $image;
list($width, $height) = getimagesize($temp);
$src = imagecreatefromstring(file_get_contents($temp));
$dst = imagecreatetruecolor(150, 150);
imagecopyresampled($dst, $src, 0, 0, 0, 0, 150, 150, $width, $height);
imagedestroy($src);
imagejpeg($dst, $temp); // adjust format as needed
imagedestroy($dst);


$check = "SELECT * FROM idc WHERE id = '$_POST[id]'";
$rs = mysqli_query($conn, $check);
$data = mysqli_num_rows($rs);
if ($data >= 1) {
    echo "Id Already Exists<br/>";
} else {
    $query = "INSERT INTO idc (firstname, lastname, phone,dpt,bg,image,id) VALUES ('$fn','$ln','$ph','$dp','$bg','$image','$id')";
    if (move_uploaded_file($temp, $folder)) {
        // echo "Image uploaded successfully!";
    } else {
        echo "Failed to upload image!";
    }
    $run = mysqli_query($conn, $query);
    // if ($run) {
    //     echo "Thanks for Joining";
    // } else {
    //     echo "Fill each detail or Server might be off.Plz notify admin";
    // }
}

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
    <title>IdCard</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poiret+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap');
    
    b{
        font-family: 'Black Ops One', cursive;
    }
</style>
</head>

<body >
    
    <div class="container text-center border" onclick="window.print()" style="width:340px;height:auto;background-image:url('idb.jpg');padding:20px;-webkit-print-color-adjust: exact;background-repeat:no-repeat">
    <?php
  
  $query = "SELECT * FROM idc WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
 
  while ($data = mysqli_fetch_assoc($result)) {
  ?>
      <img src="./image/<?php echo $data['image']; ?>">
      <p> <b style="  font-family: 'Poiret One', cursive;"><?php echo $data['firstname']; ?> <?php echo $data['lastname']; ?></b></p>
      <p> <b>ID : </b> <?php echo $data['id']; ?></p>
      <p> <b>PHONE : </b><?php echo $data['phone']; ?></p>
      <p><b>DEPARTMENT : </b> <?php echo $data['dpt']; ?></p>
      <p><b>BLOOD GPOUP : </b> <?php echo $data['bg']; ?></p>

 
  <?php
  }
  ?>
    </div>

</body>

</html>