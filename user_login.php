<?php 

    include("connection.php");
     session_start();
     if(isset($_SESSION['username']))
     {
        header("location: user_profile.php");
     }
     $_SESSION = array();
     session_unset();
     session_destroy();
     $usernameValue = "";
     $passwordValue = "";
     $error = "";
     if($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT password FROM member WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        if ($result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();
            if(password_verify($password,$user['password']))
            {
                $_SESSION['username'] = $username;
                header("location: user_profile.php");
            }
            else
                
            {
                $usernameValue = $username;
                $passwordValue = $password;
                $error = "Incorrect Password";
            }
        } 
        else 
        {
            $usernameValue = $username;
            $passwordValue = $password;
            $error = "Username is not registered!";
        }    
     }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Member Login</title>
  <link rel="stylesheet" href="CSS/login2.css">
  <?php
  include('navbar.php');
   ?>
</head>
<body>
  <div class="gap"></div>
<!-- partial:index.partial.html -->
<div class="login-page">
  <div class="form">
    <div class="heading">
      <h1>Member Login</h1>
    </div>
    <form class="login-form" action = "" method = "POST" >

      <input type="text" name = "username" value='<?=$usernameValue?>' required  placeholder="username"/>
      <input type="password" name = "password" value='<?=$passwordValue?>'required placeholder="password"/>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="user_register.php">Create an account</a></p>
      <div style = "
               color:#cc0000;
               font-family: Roboto, sans-serif;
               margin: 3% auto;
               text-align: center;
               font-size: 20px;
               "><?=$error?></div>
         </div>
    </form>
  </div>
</div>
<!-- partial -->
<footer>
  <?php
  include('footer.html');
   ?>
</footer>
</body>
</html>
