<?php
    session_start();
    include("connection.php");
    if(!isset($_SESSION['admin_username']))
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add New Book</title>
    <link href="CSS/addbook.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
</head>
<body>
    <section class="main">
        <h1>Add New Book</h1>
        <div class="addform">
            
        </div>
    </section>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>