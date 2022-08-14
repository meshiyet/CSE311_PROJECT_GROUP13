<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<header>
    <a class="logo" href="index.php"><img src="images/logo.svg" alt="logo"></a>
    <nav>
        <?php
        // session_start(); this causes error on the top
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            echo "<div class = 'dropdown' >
                    <div class='usernameHead'> 
                         <a href = 'user_profile.php'><div class = 'txt' >
                            <p>$username<p>
                         </div></a>";

                         // echo"<img src = 'images/avater.png' hight = '55' width = '55'>";

                         /**************************************************************/

                        $result = $db->query("SELECT photo FROM member WHERE username = '$username'"); 
                         if($result->num_rows > 0)
                         { 
                                $row = $result->fetch_assoc();
                                if($row['photo'] != NULL)
                                {
                                    $img = base64_encode($row['photo']);
                                    echo "<img src='data:image/jpg;charset=utf8;base64,$img'  height='200' width='200'/>";
                                }
                                 else
                                { 
                                   echo "<img src='images/avater.png' height='200' width='200'>";
                                }
                                
                        }
                        else
                        { 
                           echo "<img src='images/avater.png' height='200' width='200'>";
                        }

                         /**************************************************************/ 
              
                        echo" </div>
                     <div class='dropdown-content'style = ' width:200px; margin-left: 230px'>
                        <a href='user_profile.php'>My Account</a>
                        <a href='user_info_update.php'>Edit Information</a>
                        <a href='user_upload_image.php'>Change Photo</a>
                        <a href='logout.php'>Logout</a>
                      </div>
                </div>
                ";
        }
        else
        {
            echo "
            <ul class='top-nav' style = 'margin-left: 170px'>
                <li class='top-nav' id='login'><a href='user_login.php'>Login</a></li>
                <li class='top-nav' id='button'><a id='registration' href='user_register.php'>Become a member</a></li>        
             </ul>
            ";
        }
        ?>
        
        <ul class="bottom-nav">
            <li class="menu"><a href="index.php">Search</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="services.php">Using the library</a>
                    <a class="dropdown-item" href="services.php">Membership</a>
                    <a class="dropdown-item" href="services.php">Borrowing and returns</a>
                </div>
            </li>
            <li class="menu"><a href="locations.php">Hours & Locations</a></li>
            <li class="menu"><a href="about.php">About</a></li>
        </ul>
    </nav>
    </header>
</html> 
