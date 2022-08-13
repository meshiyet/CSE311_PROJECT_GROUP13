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
    	<div class="heading">
    		<p>All About '<?=$title?>'</p>
    	</div>
        <section class="account">
            <div class="top">
                <div class="dp">
                    <img src="images/book_cover.jpg" height="200" width="200">
                </div>
                <div class="top_infos">
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
             <?php
             	$sql = "SELECT no_of_copies FROM keeps WHERE branch_name = 'Banani' AND book_isbn = '$isbn'";
             	$result2 = mysqli_query($db,$sql);
             	$copy_in_Banani = 0;
             	if($result2->num_rows>0)
             	{
					$copy = $result2->fetch_assoc();
             		$copy_in_Banani = $copy['no_of_copies'];
             	}
             	

             	$sql = "SELECT no_of_copies FROM keeps WHERE branch_name = 'Dhanmondi' AND book_isbn = '$isbn'";
             	$result2 = mysqli_query($db,$sql);
             	$copy_in_Dhanmondi = 0;
             	if($result2->num_rows>0)
             	{
             		$copy = $result2->fetch_assoc();
             		$copy_in_Dhanmondi= $copy['no_of_copies'];
             	}
             	
             	
             	$sql = "SELECT no_of_copies FROM keeps WHERE branch_name = 'Basundhara' AND book_isbn = '$isbn'";
             	$result2 = mysqli_query($db,$sql);
             	$copy_in_Basundhara = 0;

             	if($result2->num_rows>0)
             	{
             		$copy = $result2->fetch_assoc();
             		$copy_in_Basundhara = $copy['no_of_copies'];
             	}
             	
             	



             ?>
				
                <div class="top_infos">
                 <div class="information">
                    <h3>Availability<h3>
                </div>
	                <div class="information">
	                    <p>Banani: <?=$copy_in_Banani?></p>
	                </div>
	                <div class="information">
	                    <p>Dhanmondi: <?=$copy_in_Dhanmondi?></p>
	                </div>
	                <div class="information">
	                    <p>Basundhara: <?=$copy_in_Basundhara?></p>
	                </div>
                </div>
              <!-- NEED WORKING HERE  -->
            </div>
            <div class="bottom">
                <div>
                    <div class="right_content">
                        <h2>All Borrowing of <?=$title?></h2>
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
        </section>
    </body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>