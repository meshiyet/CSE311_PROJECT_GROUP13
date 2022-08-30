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
    $error = "";
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
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $admin_username = $_SESSION['admin_username'];
            $sql = "SELECT password FROM admin WHERE username = '$admin_username'";
            $admin = mysqli_query($db,$sql);
            $admin = $admin ->fetch_assoc();
            $oldPassword = $_POST['old'];
            $password1 = $_POST['new1'];
            $password2 = $_POST['new2'];
            if(password_verify($oldPassword, $admin["password"]) && $password1 == $password2)
            {
                $password1 = password_hash($password2, PASSWORD_DEFAULT);
                $sql = "UPDATE admin
                SET password = '$password1'
                WHERE username = '$admin_username'
                ";
                if(mysqli_query($db,$sql))
                {
                    $error = "Password Change Successfull!";
                }
                else
                {
                     $error = "Something went wrong! ";
                }
            }
            else
            {
                $error = "Something went wrong! ";
            }
        }
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
                <div class="change_pass">
                    <form action="" method="POST">
                        <input type="password" name="old" placeholder="Current Password">
                         <input type="password" name="new1" placeholder="New Password">
                          <input type="password" name="new2" placeholder="Confirm New Password"><br>
                          <div style = "
                           color:#cc0000;
                           font-family: Roboto, sans-serif;
                           margin: 3% auto;
                           text-align: center;
                           font-size: 20px;
                           "><?=$error?>
                               
                   </div>
                          <button type="submit" >Change Password</button>
                    </form>
                   
                </div>
            </div>
        </section>
    </body>
    
    <footer>
        <?php include ('admin_footer.html');?>
    </footer>
</html>