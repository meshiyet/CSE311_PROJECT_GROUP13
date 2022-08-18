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

    $username = $_SESSION['admin_username'];
    $sql = "SELECT branch_name FROM admin WHERE username = '${username}'";
    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();
    $this_branch = $row["branch_name"];

    $number_of_member = mysqli_num_rows( mysqli_query($db, "SELECT username FROM member"));
    $number_of_book = mysqli_num_rows( mysqli_query($db, "SELECT isbn FROM book"));
    $number_of_borrow = mysqli_num_rows( mysqli_query($db, "SELECT book_isbn FROM loans"));
    $number_of_keeps = mysqli_num_rows( mysqli_query($db, "SELECT book_isbn FROM keeps WHERE branch_name = '$this_branch'" ));
    $number_of_expeired = mysqli_num_rows( mysqli_query($db, "SELECT book_isbn FROM loans WHERE branch_name = '$this_branch' AND return_date < NOW()"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="CSS/admin_portal.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
<style>

.the_digit p{
    font-family: "Raleway";
    font-size: 60px;
}

</style>>
</head>
<body>
    <section class="main">
        <h1>With great power comes great responsibility</h1>
        <a href="admin_memberlist.php">
            <div class="button">
                <h2>All Members</h2>
                <p>Currently there are</p> 
                <div class="the_digit">
                    <p><?=$number_of_member?></p>
                </div>
                
                <p>registered members in Dhaka Library</p>
            </div>
        </a>
        <a href="admin_booklist.php">
         <div class="button">
            <h2>All Books</h2>
            <p>Currently there are</p>
            <div class="the_digit">
                <p><?=$number_of_book?></p>
            </div>
            
            <p>books available in Dhaka Library</p>
        </div>
    </a>
     </a>
     <a href="admin_available_books.php">
        <div class="button">
            <h2>Available Books</h2>
            <p>Currently there are</p> 
             <div class="the_digit">
                    <p><?=$number_of_keeps?></p>
                </div>
             <p>books available in <?=$this_branch?> branch</p>
        </div>
    </a>
    <a href="admin_borrowlist.php">
        <div class="button">
            <h2>See Borrow List</h2>
            <p>Currently there are</p>
            <div class="the_digit">
                <p><?=$number_of_borrow?></p>
            </div>

           
             <p>borrows from <?=$this_branch?> branch</p>
        </div>
    </a>
    <a href="admin_expired_borrowlist.php">
        <div class="button">
            <h2>Expired Borrows</h2>
            <p>Currently there are</p>
             <div class="the_digit">
                    <p><?=$number_of_expeired?></p>
                </div>
             <p>expired borrows in <?=$this_branch?> branch</p>
        </div>
   
     <a href="admin_addbook.php">
        <div class="button">
            <h2>Add New Book</h2>
            <p>Add a existing book</p>
             <div class="the_digit">
                    <p>+</p>
                </div>
            <p> or add a new book </p>
        </div>
    </a>
</section>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>