<?php 
include("connection.php");
$to_do = $_GET['todo'];
$who = $_GET['who'];
if($to_do == "remove_review")
{
	$isbn = $_GET['isbn'];
	$username = $_GET['username'];
	$created = $_GET['created'];
	$sql = "DELETE FROM review 
	WHERE
	username = '$username' AND
	isbn = '$isbn' AND
	created = '$created'
	";
	 mysqli_query($db, $sql);
	 if($who == "admin")
	 {
	 	header("location: admin_full_bookinfo.php?isbn=$isbn");
	 }
	 elseif($who== "user")
	 {
	 	header("location: user_bookinfo.php?isbn=$isbn");
	 }
	 
}
elseif($to_do == "addWish")
{
	$username = $_GET['username'];
	$isbn = $_GET['isbn'];
	$from = $_GET['from'];
	$sql = "INSERT INTO wishlist(isbn,username)
			VALUES('$isbn', '$username')
	";
	mysqli_query($db,$sql);
	
	if($from == "bookinfo")
	{
		header("location: user_bookinfo.php?isbn=$isbn");
	}
	elseif($from == "booklist")
	{
		header("location: user_booklist.php");
	}
}
elseif($to_do == "removeWish")
{
	$username = $_GET['username'];
	$isbn = $_GET['isbn'];
	$from = $_GET['from'];
	$sql = "DELETE FROM wishlist WHERE isbn = '$isbn' AND username = '$username'
	";
	mysqli_query($db,$sql);
	
	if($from == "bookinfo")
	{
		header("location: user_bookinfo.php?isbn=$isbn");
	}
	elseif($from == "booklist")
	{
		header("location: user_booklist.php");
	}
}
?>