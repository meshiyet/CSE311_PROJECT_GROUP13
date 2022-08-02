<?php
   include("connection.php");
    session_start(); 
    $firstName = "";
    $middleName = "";
    $lastName = "";
    $email = "";
    $phone = "";
    $address = "";
    $dob = "";
    $gender = "";
    $username = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT username, firstName, middleName, lastName, email, phone, address, dob, gender  FROM members WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        $firstName = $user['firstName'];
        $middleName = $user['middleName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $dob = $user['dob'];
        $gender = $user['gender'];
        $username = $user['username'];
    }
    else
    {
         header("location: user_login.php");
    }
    // if(isset($_SERVER["REQUEST_METHOD"]) == "POST")
    // {
 
    //     session_unset();
    //     session_destroy();
    // } 
?>

<!DOCTYPE html>
<html>
<<<<<<< HEAD
    <link href = "CSS/userProfile.css" rel = "stylesheet">
    <?php include 'head.php';?> 
    <body>
    <?php include 'menu.php';?>
  <?php include 'navbar.php';?>
    <section class="account">
        <div class="left">
            <div class="dp">
                <img src="images/avater.webp" height="200" width="200">
            </div>
            <a href="user_info_update.php">Edit Information</a>
             <div class="information">
                <h2>Username: <?=$username?></h2>
            </div>
            <div class="information">
                <h2><?=$firstName. " " . $middleName . " " . $lastName?></h2>
            </div>
            <div class="information">
                <h2>Email: <?=$email?></h2>
            </div>
            <div class="information">
                <h2>Phone: <?=$phone?></h2>
            </div>
             <div class="information">
                <h2>Address: <?=$address?></h2>
            </div>
             <div class="information">
                <h2>Date Of Birth: <?=$dob?></h2>
            </div>
             <div class="information">
                <h2>Gender: <?=$gender?></h2>
            </div>
              <form action="" method="POST">
                <input style="
                    margin-left: 45%;
                    text-align: center;
                " type="submit" name="logout" value="LOGOUT">
                 </form>
        </div>
        <div class="right">
        </div>
    </section>
    </body>
      <?php include 'footer.php';?>
    <head>
        <link href = "style.css" rel = "stylesheet">
    </head>

    <nav>
        
    </nav>  
    <body>
    <h2>homepage</h2>
    <form action="" method="POST">
        <input style="
    margin-left: 45%;
    text-align: center;
    
    " type="submit" name="logout" value="LOGOUT">
    </form>
    <h1 style="
    margin: 15% auto;
    text-align: center;
    
    "><?=$welcomeText?></h1>
    
    </body>
    
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>