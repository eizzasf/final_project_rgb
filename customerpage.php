<?php
include_once("../rgb/db_conn.php");
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
      $rent = "INSERT INTO `rental_list`(`email`,`equip_id`,`equip_qty`) VALUES ('$email','$equip_id','$equip_qty')";
      try 
      {
        $conn->exec($rent);
        echo "<script>alert('Added')</script>";
      } 
      catch (PDOException $e) {
        echo "<script>alert('failed')</script>";
      }
      }
    }
  }

$results_per_page = 5;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}


$sqlproduct = "SELECT * FROM equipments ORDER BY equip_id";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
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
        <li><a href="agreement.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">AGREEMENT</a></li>
        <li><a href="rental_list.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">RENTAL LIST</a></li>
        <li><a href="payment.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">PAYMENT</a></li>
        <li><a href="#logout" class="active w3-black w3-padding-large w3-mobile w3-text-white w3-hover-text-black w3-border-blue" 
        name="logout" id="logout" onclick="logout()"> LOGOUT</a></li>
    </ul>
    </nav>

    <!---First section-->
  <div class="w3-main w3-padding w3-center" style="background-color: #FFF; width: 100%;">
    <label class="w3-xxlarge" style=" font-weight: bold">PRODUCT LIST</label>
    <br>
    <label class="w3-small">*please read the policy before make the payment</label>
    <br><br><br><br><br>
    <div class="w3-grid-template" style="width: 100%;">
       <?php 
        $rental_list = "rental_list";
        foreach ($rows as $product) {
        $equip_id = $product['equip_id'];
        $brand = $product['brand'];
        $type = $product['type'];
        $price = $product['price'];
        $status = $product['status'];
        $description = $product['description'];

             echo "<div class=' w3-container w3-margin' style='width: 80%; height: auto'>";

             echo "<a href='details.php?equip_id=$equip_id'>
             <img class='w3-image' style='width:100%; height:50%' 
             src=../rgb/pict/$equip_id.png" . " onerror=this.onerror=null;this.src='../rgb/pic/noIMG.jpg'" . " '>";
             
            echo "<div class='w3-container w3-center w3-center-align w3-text-grey' style='width:100%; height: auto'><br>";
            echo "<p><b>ID:</b> $equip_id</p>";
            echo "<p><b></b>  $brand</p>";
            echo "<p><b></b>  $type</p>";
            echo "<p>price/day: RM$price</p>";
            echo "<p><b> $status</b></p><br>";
            echo "<p><a href='customerpage.php?equip_id=$equip_id&submit=$rental_list' class='w3-btn w3-black w3-round'>Rent</a><p><br>";
            echo "</div>";
            echo "</div>";
           } ?>
         </div>
     <br>
     <?php 
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 5;
    } else {
        $num = $pageno * 5 - 4;
    }
    echo "<div class='w3-container w3-row w3-xlarge' style='width:100%; height: auto; font-weight:bold'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "customerpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo "&nbsp[ " . $pageno . " ]";
    echo "</center>";
    echo "</div>";
    ?>
    <br>
    </div>

<br><br><br><br><br>
 <!--footer-->
 <center><img src="pic/logoRGB2.jpg" alt="whatsapp" style="width: 20vw; height: auto"></center>
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