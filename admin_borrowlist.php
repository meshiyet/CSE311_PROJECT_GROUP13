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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Borrowing</title>
    <link href="CSS/booklist.css" rel="stylesheet">
    <?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <h1>All Borrows</h1>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
                <div class="element"><p>ISBN</p></div>
                <div class="element"><p>Username</p></div>
                <div class="element"><p>Taken From</p></div>
                <div class="element"><p>Borrow Date</p></div>
                <div class="element"><p>Return Date</p></div>
                <div class="element"><p>Payable Amount</p></div>
                
            </div>
            <?php  
                $sql = "SELECT * FROM loans ORDER BY branch_name";
                $result = mysqli_query($db, $sql);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc())
                    {
                        $branch_name = $row['branch_name'];
                        $isbn = $row["book_isbn"];
                        $username =$row['member_username'];
                        $borrow_date = $row['borrow_date'];
                        $return_date = $row['return_date'];
                        $fee = $row['fee'];
                       
                        // $result2 = mysqli_query($db, $sql);
                        // $num_of_copy = 0 ;
                        // if($result2->num_rows > 0)
                        // {
                        //     $row2 = $result2->fetch_assoc();
                        //     $num_of_copy = $row2['no_of_copies'];

                        
                       // if($num_of_copy>0){
                        echo "
                                 <div class='row'>
                                    <div class='element'><p>$isbn</p></div>
                                    <div class='element'><p>$username</p></div>
                                    <div class='element'><p>$branch_name</p></div>
                                    <div class='element'><p>$borrow_date</p></div>
                                    <div class='element'><p>$return_date</p></div>
                                    <div class='element'><p>$fee</p></div>
                                </div>
                        ";
                    }


                   }
               

            ?>

        </div>
        
    </section>
</body>
<footer>
    <?php include('admin_footer.html'); ?>
</footer>
</html>