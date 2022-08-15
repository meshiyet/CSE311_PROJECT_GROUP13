<?php 
include("connection.php");
$isbn = $_GET['isbn'];
$username = $_GET['username'];
$review_text = $_GET['text'];
$sql = "DELETE FROM review 
	WHERE
	username = '$username' AND
	isbn = '$isbn' AND
	review_text = '$review_text'
	";
	 $result =  mysqli_query($db, $sql);
	 header("location: user_bookinfo.php?isbn=$isbn");
?>