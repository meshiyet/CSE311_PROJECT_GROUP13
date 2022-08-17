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
    $keyword_value = "";
    $sql = "SELECT * FROM loans WHERE branch_name = '$this_branch' ORDER BY member_username";
    
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['keyword'] !== "")
    {
        $keyword_value = $keyword = $_POST['keyword'];

        $sql = "SELECT * FROM loans WHERE (branch_name = '$this_branch') AND 
        (
            book_isbn LIKE '%$keyword%' OR
            member_username LIKE '%$keyword%' OR
            borrow_date LIKE '%$keyword%' OR
            return_date LIKE '%$keyword%'
        )
        ORDER BY member_username
        ";
    }
   
    $borrows = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Borrowing</title>
    <!-- <link href="CSS/booklist.css" rel="stylesheet"> -->
    <link href="CSS/admin_borrowlist.css" rel="stylesheet">

    <?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <h1>All Borrows</h1>
              <div class="search_box">
            <form action="" method="POST">
                <input type="text" list= 'username_list' name="keyword" value="<?=$keyword_value?>" placeholder="Search Borrow">
                 <datalist id='username_list'>"
                    <?php
                        $sql2 = "SELECT * FROM loans";
                        $result2 = mysqli_query($db, $sql2);
                        while($row = $result2->fetch_assoc())
                        {
                            $isbn2 = $row['book_isbn']; 
                            $member_username = $row['member_username'];
                            $borrow_date = $row['borrow_date'];
                            $return_date = $row['return_date'];
                            $fee = $row['fee'];
                            $str = $isbn2." | ".$member_username." | ".$borrow_date." | ".$return_date." | ".$fee;
                            echo "<option value='$isbn2'>$str</option>";
                        }
                        ?>
                </datalist>
                <button name="search" type="submit">Search</button>
            </form>
        </div>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
            <div class = 'row_info' >
                <div class="element"><p>ISBN</p></div>
                <div class="element"><p>Username</p></div>
                <div class="element"><p>Borrow Date</p></div>
                <div class="element"><p>Return Date</p></div>
                <div class="element"><p>Fee</p></div>
                <div class="action_box"><p>Action</p></div>
                </div>
            </div>
            <?php  
                // $sql = "SELECT * FROM loans WHERE branch_name = '$this_branch'";
                // $result = mysqli_query($db, $sql);
                if ($borrows->num_rows > 0) 
                {
                    while($row = $borrows->fetch_assoc())
                    {
                        $branch_name = $row['branch_name'];
                        $isbn = $row["book_isbn"];
                        $username =$row['member_username'];
                        $borrow_date = $row['borrow_date'];
                        $return_date = $row['return_date'];
                        $fee = $row['fee'];
                       
                        echo "
                                 <div class='row'>
                                         <div class = 'row_info'>
                                            <div class='element'><p>$isbn</p></div>
                                            <div class='element'><p>$username</p></div>
                                            <div class='element'><p>$borrow_date</p></div>
                                            <div class='element'><p>$return_date</p></div>
                                            <div class='element'><p>$fee</p></div> 
                                        </div> ";
                            
                                        //**********************
                                    echo "

                                        <div class = 'action_box'>
                                            
                                            <a href = 'do_thing.php?todo=edit_loan&isbn=$isbn&username=$username'>
                                                <div class = 'edit' style = 'width:32%; margin-left:0;'>
                                                <p>Edit Return Date</p>
                                                <img src = 'images/edit_icon.png' hight = '20' width = '20'>
                                                </div>
                                            </a>
                                            <a href = 'do_thing.php?todo=extend_loan&isbn=$isbn&username=$username'>
                                                <div class = 'edit'>
                                                <p>Extend 1 Week</p>
                                                <img src = 'images/plus_icon.png' hight = '20' width = '20'>
                                                </div>
                                            </a>
                                            <a href = 'do_thing.php?todo=remove_loan&isbn=$isbn&username=$username'>
                                                <div class = 'edit' style = 'width:20%;'>
                                                <p>Returned</p>
                                                <img src = 'images/okay_icon.png' hight = '20' width = '20'>
                                                </div>
                                            </a>

                                        </div>
                                    ";
                                        //**********************

                                echo"</div>
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