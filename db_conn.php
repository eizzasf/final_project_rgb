<?php
$servername = "localhost";
$username = "root";
$passwd = "";
$dbname = "rgb";

try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname" , $username, $passwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
?>