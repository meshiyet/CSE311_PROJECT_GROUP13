<?php
    session_start();
    include("connection.php");
    if(!isset($_SESSION['username']))
    {
        header("location: admin_login.php");
    }
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
            <p>Currently there are 50 registered members to show</p>
        </div></a>
      <a href="admin_booklist.php">  <div class="button">
            <h2>See All Books</h2>
            <p>Currently there are 50 books to show</p>
        </div></a>
        <a href="admin_borrowlist.php"><div class="button">
            <h2>See Borrow List</h2>
             <p>Currently there are 50 borrows to show</p>
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