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
         header("location: admin_login.php");
    }
?>

<!DOCTYPE html>
<html>
    <link href = "CSS/userProfile.css" rel = "stylesheet">
    <body>
  <?php include 'admin_navbar.php';?>
    
    <head>
        <link href = "style.css" rel = "stylesheet">
    </head>
    <body>
        <section class="account">
            <div class="left">
                <div class="dp">
                    <img src="images/avater.png" height="200" width="200">
                </div>
                 <div class="information">
                    <p>Username: <?=$username?></p>
                </div>
                <div class="information">
                    <p><?=$firstName. " " . $middleName . " " . $lastName?></p>
                </div>
                <div class="information">
                    <p>Email: <?=$email?></p>
                </div>
                <div class="information">
                    <p>Phone: <?=$phone?></p>
                </div>
                 <div class="information">
                    <p>Address: <?=$address?></p>
                </div>
                 <div class="information">
                    <p>Date Of Birth: <?=$dob?></p>
                </div>
                 <div class="information">
                    <p>Gender: <?=$gender?></p>
                </div>
                  <form action="" method="POST">
                    <input style="
                        padding: 1%;
                        margin-left: 45%;
                        text-align: center;
                    " type="submit" name="logout" value="LOGOUT">
                     </form>
            </div>
            <div class="right">
                <div>
                    <h1 style="
                    padding: 10%;

                    text-align: center;
                    margin: 20% auto;
                    font-family: Roboto, sans-serif;
                    " >Admin Portal Page conflicts with Header and footer<br>This Page need complete redesign</h1>
                </div>
            </div>
        </section>
    </body>
    
    <footer>
        <?php include ('admin_footer.html');?>
    </footer>
</html>