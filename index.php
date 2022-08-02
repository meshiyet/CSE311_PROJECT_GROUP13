<?php
   include("connection.php");
    session_start(); 
    $welcomeText = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT firstName, middleName, lastName  FROM members WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        $welcomeText = "Welcome " . $user['firstName']." " . $user['middleName'] . " " . $user['lastName'];
    } 

?>

<!DOCTYPE html>
<html>
    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <head></head>
    <body>
    <h2>homepage</h2>
    <h1 style="
    margin: 15% auto;
    text-align: center;
    
    "><?=$welcomeText?></h1>

    </body>
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>