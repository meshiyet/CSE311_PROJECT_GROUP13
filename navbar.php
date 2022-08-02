<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<header>
    <a class="logo" href="index.php"><img src="images/logo.svg" alt="logo"></a>
    <nav>
        <?php
       include("connection.php");
        session_start();
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            echo "<div class='usernameHead'> <a href = 'user_profile.php'>$username</a> </div>";
        }
        else
        {
            echo "
            <ul class='top-nav'>
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
