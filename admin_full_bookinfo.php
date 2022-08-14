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
    $isbn = $_GET['isbn'];
    $sql = "SELECT * FROM book WHERE isbn = '${isbn}'";
    $result = mysqli_query($db,$sql);
    $book = $result->fetch_assoc();
    $title = $book['title'];
    $author = $book['author'];
    $publisher = $book['publisher'];
    $genre = $book['genre'];
?>

<!DOCTYPE html>
<html>

<head>
         <link href = "CSS/admin_full_book_info.css" rel = "stylesheet">
         <title><?=$title?></title>
        <?php include 'admin_navbar.php';?>
        <link href = "style.css" rel = "stylesheet">
    </head>
    <body>
        <section class="account">
             <!--  <p class="p">Book Information</p>
                <p class="p">Edit Information</p> -->
            <div class="dp">
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

            <div class="top">
                <div class="edit">
                    <a href="admin_change_book_cover.php?isbn=<?=$isbn?>">Change book Cover</a>
                    <a href="admin_edit_book_info.php?isbn=<?=$isbn?>">Edit Book Information</a>
                </div>
                <!-- <p class="p">Book Information</p> -->
                <div class="top_infos" style="width:55%;">
                 <div class="information">
                    <p>ISBN: <?=$isbn?></p>
                </div>
                <div class="information">
                    <p>Title: <?=$title?></p>
                </div>
                <div class="information">
                    <p>Author: <?=$author?></p>
                </div>
                <div class="information">
                    <p>publisher: <?=$publisher?></p>
                </div>
                <div class="information">
                    <p>genre: <?=$genre?></p>
                </div>
            </div>
             <!-- NEED WORKING HERE  -->
              <!-- <p class="p">Available in</p> -->
                <div class="top_infos" style="overflow: auto; width:30%;">
                    <div class='information'>
                        <p style="
                        border-radius: 15px;
                        text-align: center;
                        font-weight: bold;
                        border: 2px solid black;
                        margin-bottom: 15px;

                          ">AvailAble In</p>
                    </div>
             <?php
                $sql = "SELECT name FROM branch";
                $branch = mysqli_query($db, $sql);
                while($row = $branch->fetch_assoc())
                {
                    $branchName = $row['name'];
                    $sql = "SELECT no_of_copies FROM keeps WHERE branch_name = '$branchName' AND book_isbn = '$isbn'";
                    $result2 = mysqli_query($db,$sql);
                    $copy_in = 0;

                    if($result2->num_rows>0)
                    {
                        $copy = $result2->fetch_assoc();
                        $copy_in= $copy['no_of_copies'];
                    }
                    echo "<div class='information'>
                        <p>$branchName: $copy_in</p>
                    </div>";
                }

             ?>
				
	                <
                </div>
              <!-- NEED WORKING HERE  -->

            <div class="bottom">
                    <div class="right_content">
                        <h2>All Borrowing of '<?=$title?>'</h2>
                        <div class="scroll">
    
                            <?php

                                $sql = "SELECT * FROM loans WHERE book_isbn = '$isbn' ORDER BY return_date";
                                $result =  mysqli_query($db, $sql);
                                if ($result->num_rows > 0) 
                                 {
                                    echo "
                                        <div class='row' style='margin-top: 25px; font-weight: bold; border: 2px solid black;'>
                                            <div class='element' ><p>Username</p></div>
                                             <div class='element' ><p>Branch Name</p></div>
                                             <div class='element' ><p>Borrow date</p></div>
                                            <div class='element' ><p>Return date</p></div>
                                            <div class='element' ><p>Fee</p></div>
                                        </div>
                                    ";
                                    while($row = $result->fetch_assoc())
                                    {
                                        $username = $row['member_username'];
                                        $borrow_date = $row['borrow_date'];
                                        $return_date = $row['return_date'];
                                        $fee = $row['fee'];
                                        $branchName = $row['branch_name'];

                                       

                                          
                                        echo "
                                            <div class='row'>
                                                <a href = 'admin_full_userinfo.php?username=$username'>
                                                <div class='element' ><p>$username</p></div></a>
                                                 <div class='element' ><p>$branchName</p></div>
                                                 <div class='element' ><p>$borrow_date</p></div>
                                                <div class='element' ><p>$return_date</p></div>
                                                <div class='element' ><p>$fee</p></div>
                                            </div>
                                        "; 
                                    }
                                }
                                // else
                                // {
                                //     echo "<p style = 'text-align:center; padding:20px;  '>YOU HAVE NO BOOK TO READ NOW</p>";
                                // }


                            ?>
                        </div>
                    </div>
            </div>

            </div>
              
        </section>
    </body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>