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
    $number_of_member = mysqli_num_rows( mysqli_query($db, "SELECT username FROM member"));
    $number_of_book = mysqli_num_rows( mysqli_query($db, "SELECT isbn FROM book"));
    $number_of_borrow = 0;//mysqli_num_rows( mysqli_query($db, "SELECT isbn FROM loans"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="CSS/admin_portal.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
</head>
<body>
    <section class="main">
        <h1>With great power comes great responsibility</h1>
        <a href="admin_memberlist.php"><div class="button">
            <h2>See All Members</h2>
            <p>Currently there are <?=$number_of_member?> registered members in Dhaka Library</p>
        </div></a>
      <a href="admin_booklist.php">  <div class="button">
            <h2>See All Books</h2>
            <p>Currently there are <?=$number_of_book?>  books available in Dhaka Library</p>
        </div></a>
        <a href="admin_borrowlist.php"><div class="button">
            <h2>See Borrow List</h2>
             <p>Currently there are <?=$number_of_borrow?> borrows to show</p>
        </div></a>
        <a href="admin_addbook.php"><div class="button">
            <h2>Add New Book</h2>
             <p>Add new book </p>
        </div></a>
    </section>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>