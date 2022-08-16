<?php
   include("connection.php");
    session_start(); 
    $welcomeText = "";
    if(isset($_SESSION['username']))
    {
        
    } 

?>

<!DOCTYPE html>
<html>
    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <head></head>
    <body>
    <!-- <h2>homepage</h2>
    <h1 style="
    margin: 15% auto;
    text-align: center;
    
    "><?=$welcomeText?></h1> -->
    <?php include 'landing.php';?>

    </body>
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>