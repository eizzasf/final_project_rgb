<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('./index.php')</script>";
}

if (isset($_POST["submit"])) {
  include_once("../rgb/db_conn.php");
  $equip_id= $_POST["equip_id"];
  $brand = $_POST["brand"];
  $type = $_POST["type"];
  $price = $_POST["price"];
  $status = $_POST["status"];

  $sqlregister = "INSERT INTO `equipments`(`equip_id`, `brand`, `type`, `price`, `status` ) 
  VALUES  ('$equip_id', '$brand', '$type', '$price', '$status')";
  try {
      $conn->exec($sqlregister);
      if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
          uploadImage($equip_id);
      }
      echo "<script>alert('Success Added!')</script>";
      echo "<script>window.location.replace('product.php')</script>";
  } catch (PDOException $e) {
      echo "<script>alert('Failed')</script>";
      echo "<script>window.location.replace('adminpage.php')</script>";
  }
}

function uploadImage($equip_id)
{
    $target_dir = "../rgb/pict/";
    $target_file = $target_dir . $equip_id . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="design.css">
    <script src="../rgb/script.js"></script>


    <title>RGB Camera Rental</title>
</head>
<body>

    <!-- Navigation -->
<nav>
  <input type="checkbox" id="check">
  <label for="check" class="checkbtn">
  <i class="fas fa-bars"></i>
  </label>
    <img src="..\rgb\pic\logoRGB2.jpg" alt="Logo RGB" class="logo" style="position: relative;"></img>
    
    <ul>
        <li><a href="adminpage.php" class=" w3-padding-large w3-mobile w3-text-black w3-hover-text-white" > ADD PRODUCT</a></li>
        <li><a href="product.php" class="w3-padding-large w3-mobile w3-text-black  w3-hover-text-white"> PRODUCT LIST</a></li>
        <li><a href="#product" class="w3-padding-large w3-mobile w3-text-black  w3-hover-text-white">PRODUCT</a></li>
        <li><a href="#packages" class="w3-padding-large w3-mobile w3-text-black  w3-hover-text-white">PACKAGES</a></li>
        <li><a href="#policy" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white "> POLICY</a></li>
        <li><a href="#logout" class="active w3-black w3-padding-large w3-mobile w3-text-white w3-hover-text-black w3-border-blue" 
        name="logout" id="logout" onclick="logout()"> LOGOUT</a></li>
    </ul>
    </nav>

    <!---First section-->
  <div class="w3-container w3-light-grey w3-padding-64 w3-center">
    
  
    <div class="w3-container w3-white" style="width: 80vw; margin-left: 10%; padding: 50px">
        <div class="w3-container w3-margin form-container-reg w3-center">
            <div class="w3-card"></div>    
            <label class=" w3-black w3-padding" style="font-size: 125%;">ADD NEW PRODUCT</label>
            <br><br><br>
        </div>
            <form class="w3-container formco" name="NewEquipment" action="adminpage.php" method="post" enctype="multipart/form-data">
                <form class="w3-container w3-padding" name="newEquip" action="adminpage.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
              <p>
                <div class="w3-container w3-border w3-padding-16">
                    <img class="w3-image w3-round w3-margin" src="../rgb/pic/item.png" style="width:15%; max-width:250px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                </div>
                </p>
                <br><br>
                <p>
                <div class="w3-container w3-padding-48 w3-center">
                    <label>PRODUCT ID: &nbsp;&nbsp;</label><br>
                    <input class="w3-input w3-border w3-round w3-center" style="width: 50%; " name="equip_id" id="equip_id" type="text" required>
                </p><br>
                    <label>BRAND: </label><br>
                    <input class="w3-input w3-border w3-round w3-center" style="width: 50%; " name="brand" id="brand" type="text" required>
                <br><br>
                <p>
                    <label>TYPE: (Ex: Camera/Drone) &nbsp;&nbsp;</label><br>
                    <input class="w3-input w3-border w3-round w3-center" style="width: 50%; " name="type" id="type" type="text" required>
                </p><br>
                <p>
                    <label>PRICE/day:&nbsp;&nbsp;</label><br>
                    <input class="w3-input w3-border w3-round" style="width: 50%;" name="price" id="price" type="text" required>
                </p><br>
                <p>
                    <label>STATUS: &nbsp;&nbsp;</label><br>
                    <select class="w3-border w3-round w3-padding" style="width: 50%; padding-left: 25px" name="status" id="status" required>
                    <option value="*" disabled selected></option>
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                        <option value="Coming soon">Coming Soon</option>
                    </select><br>
                </div>
                <br><br>
                <div class="row w3-center" style="padding-left: 35%;">
                    <input class="w3-input w3-border w3-block w3-black w3-round w3-center" style="width: 50%;" type="submit" name="submit" value="Submit">
                </div><br>
            </form>
            </form>
            </div>
        </div>

      <!--footer-->
      <center><img src="pic/logoRGB2.jpg" alt="whatsapp" style="width: 20vw; height: auto"></center>
      <p style="text-align: center; color: grey; padding-top: 2%">© Copyright 2021 by Norizzati Sofi. Matric No. 263870 | RGB Colours Production</p>
  </div>
  
 <!--top button-->
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<script>
      function logout(){
           location.replace('logout.php');
      }
  </script>
    
</body>
</html>