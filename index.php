<?php
   include("connection.php");
    session_start(); 
    $welcomeText = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT name, username, password FROM USER WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        $welcomeText = "Welcome " . $user['name'];
    }
?>

<!DOCTYPE html>
<html>
    <link href = "style.css" rel = "stylesheet">
    <?php include 'head.php';?> 
    <body>
    <?php include 'menu.php';?>
    <?php include 'footer.php';?>
    <h2>homepage</h2>
    <h1 style="
    margin: 15% auto;
    text-align: center;
    
    "><?=$welcomeText?></h1>

    </body>
</html>