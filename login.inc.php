<?php
session_start();
include('db_conn.php');
 if(isset($_POST['email']) && isset($_POST['passwd'])){
     $email = $_POST['email'];
     $pw = $_POST['passwd'];
     $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND passwd = '$passwd'";
     $result = mysqli_query($conn, $sql);
     if(mysqli_num_rows($result)){
         $row = $result->fetch_assoc();
         switch($row['authority']){
             case 1:
                    $_SESSION['authority']=$row['authority'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['passwd'] = $row['passwd'];
                    echo  $_SESSION['authority'];
                    echo "<script>
                    myfunction();
                    function myfunction(){
                        location.replace('customerpage.php');
                    }</script>";
                    break;
             case 2:
                    $_SESSION['authority']=$row['authority'];
                    $_SESSION['email'] = $row['email'];
                    echo "<script>
                    myfunction();
                    function myfunction(){
                        location.replace('adminpage.php');
                    }</script>";
                    break;
             default:
                    break;
         }

     }
 }
 ?>