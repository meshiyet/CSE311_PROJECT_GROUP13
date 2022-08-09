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
        $sql = "SELECT username, first_name, middle_name, last_name, email, phone, address, dob, gender  FROM member WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = $result->fetch_assoc();
        $firstName = $user['first_name'];
        $middleName = $user['middle_name'];
        $lastName = $user['last_name'];
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
?>

<!DOCTYPE html>
<html> 
    <head>
         <link href = "CSS/userProfile.css" rel = "stylesheet">
         <title><?=$username?></title>
        <?php include 'navbar.php';?>
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
                    <p>Name: <?=$firstName. " " . $middleName . " " . $lastName?></p>
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
                  <!-- <form action="" method="POST">
                    <input style="
                        padding: 1%;
                        margin-left: 45%;
                        text-align: center;
                    " type="submit" name="logout" value="LOGOUT">
                     </form> -->
            </div>
            <div class="right">
                <div>
                    <div class="right_content">
                        <h2>My Borrowing</h2>
                        <div class="scroll">
                        </div>
                    </div>
                    <div class="right_content">
                         <h2>My Wishlist</h2>
                         <div class="scroll">
                        </div>
                    </div>
            </div>
        </section>
    </body>
    
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>