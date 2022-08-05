<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: admin_login.php");
    // exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include('admin_navbar.php')?>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    
        <a href="#" class="btn btn-warning">My Profile</a>
        <a href="admin_memberlist.php" class="btn btn-warning">Member List</a>
        <a href="#" class="btn btn-warning">Borrower List</a>
   
    <hr>
    <hr>
    
         <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="admin_logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    
</body>
<footer>
     <?php include('admin_footer.html') ?>
</footer>
</html>