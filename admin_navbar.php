<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin_nav.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<header>
    <a class="logo" href=""><img src="images/logo.svg" alt="logo"></a>
    <nav>
        <?php
        $loggen_in = false;
        if(isset($_SESSION['admin_username']))
        {
            $loggen_in = true;
            $username = $_SESSION['admin_username'];
            echo "<div class = 'dropdown' >
                    <div class='usernameHead'> 
                         <a href = 'admin_portal.php'><div class = 'txt'>
                            <p>$username<p>
                         </div></a>
                         <img src = 'images/avater.png' hight = '55' width = '55'>
                    </div>
                     <div class='dropdown-content'style = ' width:200px; margin-left: 570px'>
                        <a href='admin_portal.php'>Admin Panel</a>
                        <a href='admin_profile.php'>Account Settings</a>
                        <a href='logout.php'>Logout</a>
                      </div>
                </div>

                <ul class='bottom-nav'>
                     <li class='menu'><a href='admin_portal.php'>Admin Portal</a></li>
                     <li class='menu'><a href='admin_booklist.php'>All Books</a></li>
                     <li class='menu'><a href='admin_memberlist.php'>All members</a></li>
                     <li class='menu'><a href='admin_borrowlist.php'>Manage Borrows</a></li>
                     <li class='menu'><a href='admin_addborrow.php'>Add Borrow</a></li>
                     <li class='menu'><a href='admin_addbook.php'>Add Book</a></li>

                </ul>
                ";
        }
        else
        {
            echo "
            <ul class='top-nav' style = 'margin-left: 170px'>
                <li class='top-nav' id='button'><a id='registration' href='user_login.php'> Go User Mode</a></li>        
             </ul>
            ";
        }
        ?> 
        
    </nav>
    </header>
</html> 
