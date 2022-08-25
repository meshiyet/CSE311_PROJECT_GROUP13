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
elseif($to_do == "remove_loan")
{
	$isbn = $_GET['isbn'];
	$username = $_GET['username'];
	$sql = "DELETE FROM loans WHERE book_isbn = '$isbn' AND member_username = '$username'";
	if(mysqli_query($db,$sql))
	{
		header("location: ".$_GET['from'].".php");
	}
	else
	{
		echo"Something went Wrong";
	}
}
elseif($to_do == "extend_loan")
{
	$isbn = $_GET['isbn'];
	$username = $_GET['username'];
	$extentation = $_GET['time'];

	$sql = "SELECT * FROM loans WHERE member_username = '$username' AND book_isbn = '$isbn'";
	$result = mysqli_query($db,$sql);
	$result = $result->fetch_assoc();
	$new_date_strToTime = strtotime($result['return_date']." +1 week");
	
	$new_date = date("Y-m-d", $new_date_strToTime);

	$day_difference = (int) ($new_date_strToTime- strtotime($result['borrow_date']))/(60*60*24);

	$amount = $day_difference*10;

	$sql = "UPDATE loans

		SET return_date = '$new_date', fee = $amount

		WHERE book_isbn = '$isbn' AND member_username = '$username'
	";
	if(mysqli_query($db,$sql))
	{
		header("location: ".$_GET['from'].".php");
	}
	else
	{
		echo"Something went Wrong";
	}

}
elseif($to_do == "edit_loan")
{
	$isbn = $_GET['isbn'];
	$username = $_GET['username'];
	$extentation = $_GET['date'];

	$sql = "SELECT * FROM loans WHERE member_username = '$username' AND book_isbn = '$isbn'";
	$result = mysqli_query($db,$sql);
	$result = $result->fetch_assoc();

	$new_date_strToTime = strtotime($extentation);

	
	$new_date = date("Y-m-d", $new_date_strToTime);

	$day_difference = (int) ($new_date_strToTime- strtotime($result['borrow_date']))/(60*60*24);

	$amount = $day_difference*10;

	$sql = "UPDATE loans

		SET return_date = '$new_date', fee = $amount

		WHERE book_isbn = '$isbn' AND member_username = '$username'
	";
	if(mysqli_query($db,$sql))
	{
		header("location: ".$_GET['from'].".php");
	}
	else
	{
		echo"Something went Wrong";
	}

}
?>