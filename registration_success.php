<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="CSS/registration_success.css" rel="stylesheet">
	 <nav>
        <?php include 'navbar.php';?>
    </nav> 
	<title>Registration Complete</title>
</head>
<body>
<div class="main">
	<div class="top">
		<p>Congratulations! Your Registration is Complete!</p>
	</div>
	<div class="image">
		<img src="images/done.png" height="200" width="200">
	</div>
	<div class="login">
		<a href="user_upload_image.php"><p>Upload Profile Picture</p></a>
	</div>
	<a
		style = "
		text-align: center;
		font-size: 25px;
		font-family: 'Roboto', sans-serif;
		color: black;
		"
	href="user_profile.php"><p>skip</p></a>
</div>
</body>
<footer>
         <?php include 'footer.html';?>
    </footer>
</html>