<?php
include('connection.php');
session_start();
if(!isset($_SESSION['username']))
{
	header('location: user_login.php');
}
$username = $_SESSION['username'];
$status = $statusMsg = ''; 

if(isset($_POST["submit"]))
{ 
	$status = 'error'; 
	if(!empty($_FILES["image"]["name"]))
	{ 
		$fileName = basename($_FILES["image"]["name"]); 
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

		$allowTypes = array('jpg','png','jpeg','gif'); 
		if(in_array($fileType, $allowTypes))
		{ 
			$image = $_FILES['image']['tmp_name']; 
			$imgContent = addslashes(file_get_contents($image)); 
				
				$sql = "UPDATE `member` SET `photo` = '$imgContent' WHERE `member`.`username` = '$username';";
	            $insert = $db->query($sql); 

	            if($insert){ 
	            	$status = 'success'; 
	            	$statusMsg = "Photo uploaded successfully."; 
	            }else{ 
	            	$statusMsg = "Photo upload failed, please try again."; 
	            }  
	        }
	        else
	        { 
	        	$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
	        } 
	    }
	    else{ 
	    	$statusMsg = 'Please select an image file to upload.'; 
	    } 
	} 

	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Profile Photo</title>
	<link href="CSS/user_upload_image.css" rel="stylesheet">
	
</head>
<body>
	<?php include('navbar.php')?>
	<div class="full">
	<div class="current">
		<?php    
	        $result = $db->query("SELECT photo FROM member WHERE username = '$username'"); 
	         if($result->num_rows > 0)
	         { 
	                $row = $result->fetch_assoc();
	                if($row['photo'] != NULL)
	                {
	                    $img = base64_encode($row['photo']);
	                    echo "<img src='data:image/jpg;charset=utf8;base64,$img'  height='500' width='500'/>";
	                }
	                 else
	                { 
	                   echo "<img src='images/avater.png' height='300' width='300'>";
	                }
	                
	        }
	        else
	        { 
	           echo "<img src='images/avater.png' height='300' width='300'>";
	        }
	    ?>
</div>

<div class="upload">
	
	<div style="margin-top: 25%;" ></div>
	<div class="card">

		<form action="" method="post" enctype="multipart/form-data">
			    <input type="file" name="image">
			    <button type="submit" name="submit">Upload</button>
			</form>
		</div>
			<div class="error">
			<p><?=$statusMsg?></p>
		</div>
	</div>
</div>
	<div class="text">
		<p>Your Current Profile Picture Looks like this. Choose square image to get better result</p>
	</div>
</body>
<?php include ('footer.html')?>
</html>