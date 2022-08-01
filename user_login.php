<?php 
    include("connection.php");
     session_start();
     if($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT password FROM members WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
            if($user['password'] == $password)
            {
                $_SESSION['username'] = $username;
                header("location: user_profile.php");
                $error = "You Are Logged In";
            }
            else
                
            {
                $usernameValue = $username;
                $passwordValue = $password;
                $error = "Incorrect Username or Password";
            }
        } 
        else 
        {
            $usernameValue = $username;
            $passwordValue = $password;
            $error = "Incorrect Username or Password";
        }    
     }
    
?>


<html>
    <?php include 'head.php';?>
    <nav>
        <?php include 'menu.php';?>
    </nav> 
    <head>
         <link href = 'CSS/login.css' rel='stylesheet'>
    </head>
    <body>
        
         <section class = 'loginPanel'>
            <?php 
            // $usernameValue = "";
            // $passwordValue = "";
             ?>
            <h1>Login To Your Account</h1>
            <div class = 'form' >
            <form action="" method="POST">
                <h4> Enter Username</h4>
                <input class = "textField" type = 'text' id = 'username' name = 'username' value='<?=$usernameValue?>' required ><br>
                 <h4> Enter Password</h4>
                <input class = "textField"  type = 'text' id = 'password' name = 'password' value='<?=$passwordValue?>'required ><br>
                <input class = 'loginButton' type = 'submit' id = 'submit' value = 'Login' >
            </form>
             <div style = "
               color:#cc0000;
               margin: 4% auto;
               text-align: center;
               font-size: 20px;
               "><?=$error; ?></div>
         </div>
            <h3>Login Using Socials</h3>
        </section>
    </body>
    <?php include 'footer.php';?>
</html>