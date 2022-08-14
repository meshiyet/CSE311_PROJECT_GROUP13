<?php
include('connection.php');
session_start();
if(!isset($_SESSION['admin_username']))
{
	header('location: admin_login.php');
}
$isbn = $_GET['isbn'];
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
				
				$sql = "UPDATE `book` SET `cover` = '$imgContent' WHERE `book`.`isbn` = '$isbn';";
	            $insert = $db->query($sql); 

	            if($insert){ 
	            	$status = 'success'; 
	            	$statusMsg = "Cover Change successfully."; 
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
	<link href="CSS/admin_book_cover_change.css" rel="stylesheet">
	
</head>
<body>
	<?php include('admin_navbar.php')?>
	<div class="full">
	<div class="current">
		<?php    
	        $result = $db->query("SELECT cover FROM book WHERE isbn = '$isbn'"); 
	         if($result->num_rows > 0)
	         { 
	                $row = $result->fetch_assoc();
	                if($row['cover'] != NULL)
	                {
	                    $img = base64_encode($row['cover']);
	                    echo "<img src='data:image/jpg;charset=utf8;base64,$img'  height='600' width='375'/>";
	                }
	                 else
	                { 
	                   echo "<img src='images/default_book.jpg' height='600' width='375'>";
	                }
	                
	        }
	        else
	        { 
	           echo "<img src='images/avater.png' height='600' width='375'>";
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
		<div class="text">
		<p>Upload 1.6:1 Ratio cover for better result</p>
	</div>
	</div>
</div>
	
</body>
<?php include ('admin_footer.html')?>
</html>