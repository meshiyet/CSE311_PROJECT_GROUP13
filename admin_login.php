<?php 
    include("connection.php");
     // session_start();
     if(isset($_SESSION['username']))
     {
        header("location: admin_portal.php");
     }
     $usernameValue = "";
     $passwordValue = "";
     $error = "";
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
                header("location: admin_portal.php");
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
