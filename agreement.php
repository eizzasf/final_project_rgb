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
<div class="w3-card-2" style="width: 100%;"></div>

<div class="w3-main w3-content w3-padding w3-white w3-center" style="width: 100%;">
  <br><br>
  <label class="w3-xlarge w3-left" style="background-color: black; padding: 1%; color:floralwhite;">EQUIPMENT RENTAL AGREEMENT</label>
    <br><br><br>
        <div class="w3-container w3-center w3-padding-top-64" style="width: 100%;">
            <center>
                <img class="w3-xlarge" src="pic/logoRGB2.jpg" alt="logo">
            </center>
            <p><br>Company Registration no.: PG00XX <br></p><br>
            <div class="w3-justify w3-border w3-padding">
            <p><b>Rental Terms and Conditions.</b>
            <br><br>1. The renter shall keep and maintain the rent equipment during the terms of the rental at his own cost and expense. He shall keep it equipment in a good state of repair, normal wear and tear excepted.
            <br><br>2. The renter shall pay the owner full compensation for replacements and/or repair of any equipment which is not returned because it is lost or stolen any equipment which is damaged and in need of repair to put it into the same conditions it was in at the time of rental, normal wear or tear excepted. The owner’s invoice for replacement or repair is conclusive as to the amount of rental shall pay under this paragraph for repairs or replacements
            <br><br>3. The renter shall not remove their equipment from the address of the renter or the location shown here in as the place of use of the equipment without prior written approval of the owner.
            <br><br>4. The equipment shall be delivered to renter and returned to owner at the renter’s risk, costs and expense. If a periodic rent is charged by owner, the rental charges are billed to the renter for each period of portions of the period from the time the equipment is delivered to renter until it's return. If the term rental rate is charged by the owner, rental charges are billed to the renter for the full term even if the equipment is returned before the end of the term. If the equipment is not returned during or at the end of the term, then the rental charges shall continue a full-term basis for any additional terms or portions thereof until the equipment is returned.
            <br><br>5. No allowance will be made for any rented equipment or portion thereof which is claimed not to have been used. Acceptance of returned equipment by owner does not constitute a waiver of any direct owner has under the rental agreement. 
            <br><br>6. The renter shall allow owner to enter end this premises where the rent equipment is stored or used at all reasonable times to locate an inspect the state and conditions of the rent equipment. If the renter is in default of any of the terms and conditions of this agreement, the owner and his agents at the renters risk, cost an expense may at any time enter the renters premises where the rented equipment is stored or used at all time and recover the rental equipment.
            <br><br>7. The renter shall not pledge or encumber the rented equipment in anyway. The owner may terminate this agreement immediately open the failure of renter to make rental payments when due or open renters feeling for protections from creditors in any court of content jurisdictions.
            <br><br>8. The owner makes no warranty of any kind regarding the rented equipment, except that owner shall replaced the equipment with identical or similar equipment if the equipment fails to operate in accordance with the manufacturer’s specifications and operations instructions. Such replacements shall be made as soon as practicable after renter returns the non-conforming equipment.
            <br><br>9. Rental indemnifies in holds owner harmless or all injuries or damages of any kind of repossessions and for all consequential and special damages for any claimed breach of warranty.
            <br><br>10. The renter shall pay all reasonable attorney and other fees the expense and costs incurred by owner importations its rights under this rental agreement and for any actions taken only to play any amount you the owner under this printer agreements.
            <br><br>11. These terms are accepted by the renter upon delivery of this terms to the renter or the agents or other representatives of renter.
            </p>
            </div>
        </div>
      </div>
     <!--footer-->
     <br><br><br>
   <div class="w3-container w3-whitesmoke w3-center" style="width: 100%;">
     
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
