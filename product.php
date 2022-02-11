<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('./index.php')</script>";
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

include_once("../rgb/db_conn.php");
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="../rgb/style.css">
    <link rel="stylesheet" href="../lib/w3.css">
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
        <li><a href="adminpage.php" class=" w3-padding-large w3-mobile w3-text-black w3-hover-text-white" >ADD PRODUCT</a></li>
        <li><a href="product.php" class="w3-padding-large w3-mobile w3-text-black w3-hover-text-white">PRODUCT LIST</a></li>
        <li><a href="#logout" class="active w3-black w3-padding-large w3-mobile w3-text-white w3-hover-text-black w3-border-blue" 
        name="logout" id="logout" onclick="logout()"> LOGOUT</a></li>
    </ul>
    </nav>
     <div class="w3-container w3-light-grey w3-padding-64 w3-center">
          <div class="w3-container w3-white" style="width: 80vw; margin-left: 10%; padding: 50px">
            <div class="w3-container w3-margin form-container-reg w3-center"> 
            <label class="w3-xlarge w3-black w3-padding">PRODUCT LIST</label>
            <br><br><br>
        </div>
        <div>
            <!--img src="../rgb/pic/nikon1.jpg" style="width: 15vw">-->
     <div class="w3-grid-template">
       <?php 
        foreach ($rows as $product) {
        $equip_id = $product['equip_id'];
        $brand = $product['brand'];
        $type = $product['type'];
        $price = $product['price'];
        $status = $product['status'];
        $description = $product['description'];

             echo "<div class='w3-center w3-padding-small w3-medium'  style='height:100%;width:100%; max-width:600px'>";

             echo "<div class='w3-padding'><img class='w3-image' style='weight: 150%; height: 20vh'
             src=../rgb/pict/$equip_id.png" . " onerror=this.onerror=null;this.src='../rgb/pic/noIMG.jpg'" . " '>
             </div>";
            echo "<div class='w3-container w3-center-align w3-text-grey'><br>";
            echo "<p><b>ID:</b> $equip_id</p>";
            echo "<p><b></b>  $brand</p>";
            echo "<p><b></b>  $type</p>";
            echo "<p>price/day: RM$price</p>";
            echo "<p><b> $status</b></p><br>";
            echo "</div>";
            echo "</div>";
           } ?>
         </div>
     </div>
<BR></BR>
     <?php 
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 5;
    } else {
        $num = $pageno * 5 - 4;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "product.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
     </div>



   
<!--footer--></div>
<div>
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