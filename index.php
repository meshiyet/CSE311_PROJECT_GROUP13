<?php
   include("connection.php");
    session_start(); 
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

//$name = "TAHMID";

?>

<!DOCTYPE html>
<html>
    <?php include 'head.php';?> 
    <body>
    <?php include 'menu.php';?>
    <?php include 'footer.php';?>

    <h2>homepage</h2>
    <h1>Welcome <?=$user['name']?></h1>
    </body>
</html>