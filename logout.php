<?php
session_start();
    $_SESSION['email']=null;
    $_SESSION['passwd']=null;
     echo "<script>
      redirect();
            function redirect(){
                location.replace('./index.php');
            }
      </script>";
?>
