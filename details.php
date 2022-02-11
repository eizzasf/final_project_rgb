<?php
include_once("db_conn.php");
include "login.inc.php";
if(!isset($_SESSION['sessionid'])){
     echo "<script>
    redirect();
          function redirect(){
              alert('Please login');
              location.replace('index.php');
          }
    </script>";
 }

if (isset($_GET['submit'])){
  if($_GET['submit'] == "rental_list"){
    if (!empty($email)){
      $equip_id = $_GET['equip_id'];
      $equip_qty = "1";
      $check = "SELECT * FROM `tbl_user` WHERE sessionid = '$email";
      $stmt = $conn->prepare($check);
      $stmt->execute();
      $number_of_rows = $stmt->fetchColumn();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $rows = $stmt->fetchAll();
      } else {
      $rent = "INSERT INTO `rental_list`(`email`,`equip_id`,`equip_qty`) VALUES ('$email','$equip_id','$equip_qty')";
      try { $conn->exec($rent);
        echo "<script>alert('Added')</script>"; } 
      catch (PDOException $e) {
        echo "<script>alert('failed')</script>";
      }
    }
   }
  }

//to display equipments details
$equip_id = $_GET['equip_id'];
$sqlquery= "SELECT * FROM `equipments` WHERE equip_id = $equip_id";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<html lang="en">
<head>
<title>RGB Camera Rental</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../rgb/style.css">
    <link rel="stylesheet" href="../lib/w3.css">
    <script src="Js/script.js"></script>
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
        <li><a href="customerpage.php" class=" w3-padding-large w3-mobile w3-text-black w3-hover-text-white" >PRODUCT LIST</a></li>
        <li><a href="rental_list.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">RENTAL LIST</a></li>
        <li><a href="payment.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">PAYMENT</a></li>
        <li><a href="#logout" class="active w3-black w3-padding-large w3-mobile w3-text-white w3-hover-text-black w3-border-blue" 
        name="logout" id="logout" onclick="logout()"> LOGOUT</a></li>
    </ul>
    </nav>
<!---First section-->
<div class="w3-card-2" style="width: 100%;">

    <div class="w3-main w3-content w3-padding w3-white w3-center" style="width: 100%;">
      <br><br>
    
      <label class="w3-xlarge w3-center" style="background-color:darkgreen; padding: 1%; color:floralwhite;">PRODUCT DETAILS</label>
    <br><br><br>
        <div class="w3-container w3-center" style="width: 100%;">
            <img class="w3-image w3-animate-zoom w3-small" src="../rgb/pict/<?php echo $equip_id?>.png">
     
            <?php
                $rental_list = "rental_list";
                foreach ($rows as $product)
                {
                    $equip_id = $product['equip_id'];
                    $brand = $product['brand'];
                    $type = $product['type'];
                    $price = $product['price'];
                    $status = $product['status'];
                    $description = $product['description'];
                }
            echo "<div class='w3-center w3-large w3-container w3-white w3-margin w3-justify' style='width: 100%';>
           <br><br><p><b>ID:</b> $equip_id</p><p><b>Brand:</b> $brand</p>
           <p><b>Type:</b>  $type</p><p><b>Price/day:</b> RM$price</p><br>
           <br><p><b>Description:</b><br> $description</p><br><br>
           <p><b>$status</b></p><br>";
           echo "<p><a href='details.php?equip_id=$equip_id&submit=$rental_list' class='w3-btn w3-black w3-round'>Rent</a><p><br></div>"
           
           //<input type='button' class='w3-button w3-blue w3-round' id='button_id' value='Rent' onClick='rent($equip_id);'</div>"
          ?>
            </div>
          </div>
      </div>
     <!--footer-->
     <br>
   <div class="w3-container w3-whitesmoke w3-center" style="width: 100%;">
     <center><img style="width: 20%;" src="pic/logoRGB2.jpg" alt="whatsapp"></center>
        <p style="text-align: center; color: grey; padding-top: 2%">
        © Copyright 2021 by Norizzati Sofi. Matric No. 263870 | RGB Colours Production</p>
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
