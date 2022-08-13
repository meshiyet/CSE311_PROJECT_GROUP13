<?php 
   include("connection.php");
     session_start();
     if(isset($_SESSION['admin_username']))
     {
        header("location: admin_portal.php");
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
        $sql = "SELECT password FROM admin WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        if ($result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();
            // if(password_verify($password,$user['password'])) /*USE HASS CHECK*/
            if($password == $user['password'])  /*USE PLAIN STRING CHECK*/
            {
                $_SESSION['admin_username'] = $username;
                header("location: admin_portal.php");
                 // $error = "LOGGED IN";
            }
            else
                
            {
                $usernameValue = $username;
                $passwordValue = $password;
                $error = "Wrong Password";
            }
        } 
        else 
        {
            $usernameValue = $username;
            $passwordValue = $password;
            $error = "$username is not an admin";
        }    
     }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="CSS/admin_login.css">
  <?php
  include('admin_navbar.php');
   ?>
</head>
<body>
  <div class="gap"></div>
<!-- partial:index.partial.html -->
<div class="login-page">
  <div class="form">
    <div class="heading">
      <h1>Admin Login</h1>
    </div>
    <form class="login-form" action = "" method = "POST" >

      <input type="text" name = "username" value='<?=$usernameValue?>' required  placeholder="username"/>
      <input type="password" name = "password" value='<?=$passwordValue?>'required placeholder="password"/>
      <button type="submit">login</button>
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
  include('admin_footer.html');
   ?>
</footer>
</body>
</html>
