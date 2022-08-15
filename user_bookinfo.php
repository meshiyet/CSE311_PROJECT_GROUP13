<?php
    session_start();
    include("connection.php");
    if(!isset($_SESSION['username']))
    {
       $_SESSION = array();
       session_unset();
       session_destroy();
       header("location: user_login.php");
    }
    $username = $_SESSION['username'];
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
         <link href = "CSS/user_full_bookinfo.css" rel = "stylesheet">
         <title><?=$title?></title>
        <?php include 'navbar.php';?>
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
                   <a href="">Add to Wish List</a>
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
                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '$isbn'";
                $branch = mysqli_query($db, $sql);
                while($row = $branch->fetch_assoc())
                {
                    $branchName = $row['branch_name'];
                    echo "<div class='information'>
                        <p>$branchName</p>
                    </div>";
                }

             ?>
				
                </div>

            <div class="bottom">
                    <div class="right_content">
                        <h2>Reviews</h2>
                        
                        <div class="scroll">
    
                            <?php
                                $sql = "SELECT * FROM review WHERE isbn = '$isbn' ORDER BY created DESC";
                                $result =  mysqli_query($db, $sql);
                                if ($result->num_rows > 0) 
                                 {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $reviewre_username = $row['username'];
                                        $review_text = $row['review_text'];
                                        $created = $row['created'];
                                        $date = explode(" ",$created);
                                        $date = $date[0];
                                        echo "
                                            <div class='review'>
                                                    
                                                  <div class = 'username'>
                                                  <p>$reviewre_username [ $date ]</p>";
                                                  if($reviewre_username == $username)
                                                    echo "
                                                        <a href = 'do_thing.php?todo=remove_review&who=user&isbn=$isbn&username=$reviewre_username&created=$created'>
                                                            <p style ='
                                                                background-color: white;
                                                                font-size: 15px;
                                                                padding: .5%;
                                                            ' 
                                                            >Remove review</p>
                                                        </a>
                                                    ";
                                                  echo"</div>
                                                <div  class = 'review_text'> <p>$review_text</p></div>
                                            </div>
                                        "; 
                                    }
                                }
                            ?>
                        </div>
                        <div class="add">
                          <a href="user_add_review.php?isbn=<?=$isbn?>">  <p>+  Add Your review</p></a>
                        </div>
                    </div>
            </div>

            </div>
              
        </section>
    </body>
<footer>
    <?php include 'footer.html';?>
</footer>
</html>