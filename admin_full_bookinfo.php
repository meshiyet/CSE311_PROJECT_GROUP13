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
	<title><?=$_GET['isbn']?></title>
	 <?php include 'admin_navbar.php';?>
</head>
<body>
<h2
	style= "
	font-size: 30px;
	text-align: center;
	padding-top: 10%;
	"
	>
		This Page will show full information of a book to the admin when admin clicks a row for sdpecific book
	</h2>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>