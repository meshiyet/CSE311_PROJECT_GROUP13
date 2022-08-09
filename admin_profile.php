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
    $branchName = "";
    $startDate = "";
    if(isset($_SESSION['admin_username']))
    {
        $username = $_SESSION['admin_username'];    
        $sql = "
        SELECT username, first_name, middle_name, last_name, email, phone, address, dob, gender, start_date, branch_name  
        FROM admin
        WHERE username = '${username}'
        ";

        $result = mysqli_query($db,$sql);
        $user = $result->fetch_assoc();

        $firstName = $user['first_name'];
        $middleName = $user['middle_name'];
        $lastName = $user['last_name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $dob = (string)$user['dob'];
        $gender = $user['gender'];
        $branchName = $user['branch_name'];
        $startDate = (string) $user['start_date'];
        $username = $user['username'];
    }
    else
    {
       $_SESSION = array();
       session_unset();
       session_destroy();
       header("location: admin_login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
         <link href = "CSS/userProfile.css" rel = "stylesheet">
         <title><?=$username?></title>
        <?php include 'admin_navbar.php';?>
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
                    <p>Branch: <?=$branchName?></p>
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
            </div>
            <div class="right">
                <div>
                    <h1 style="
                    padding: 10%;

                    text-align: center;
                    margin: 20% auto;
                    font-family: Roboto, sans-serif;
                    " >Admin Portal Page conflicts with Header and footer<br>This Page is Same as Member Profile and needs complete redesign</h1>
                </div>
            </div>
        </section>
    </body>
    
    <footer>
        <?php include ('admin_footer.html');?>
    </footer>
</html>