<?php
    session_start();
    include("connection.php");
    $loggen_in = false;
    if(isset($_SESSION['username']))
    {
       $loggen_in = true;
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
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review']))
    {
        $review_text = $_POST['review_text'];
        $sql = "INSERT INTO review (username,isbn,created, review_text)
        VALUES('$username','$isbn' ,NOW(), '$review_text')
        ";
        if(mysqli_query($db, $sql))
        {
            header("location: user_bookinfo.php?isbn=$isbn");
        }
    }


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
                <div class="wishlist">
                   <div class="icon">
                       <?php 
                       if($loggen_in)
                       {
                            $sql = "SELECT * FROM wishlist WHERE isbn = '$isbn' AND username = '$username'";
                            $wish = mysqli_query($db,$sql);
                            $wish_mode = false;
                            if($wish->num_rows>0)
                            {
                                $wish_mode = true;
                            }

                            if($wish_mode)
                            {
                                echo "
                                 <a href = 'do_thing.php?todo=removeWish&isbn=$isbn&username=$username&from=bookinfo'>
                                <div class = 'listed'></div></a>";
                            }
                            else
                            {
                                echo "<a href = 'do_thing.php?todo=addWish&isbn=$isbn&username=$username&from=bookinfo'>
                                <div class = 'not_listed'></div></a>";
                            }
                       }
                       ?>

                   </div>
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
                    $sql = "SELECT * FROM review WHERE isbn = '$isbn' ORDER BY review_id DESC";
                    $result =  mysqli_query($db, $sql);
                    if ($result->num_rows > 0) 
                     {
                        while($row = $result->fetch_assoc())
                        {
                            $review_id = $row['review_id'];
                            $reviewre_username = $row['username'];
                            $review_text = $row['review_text'];
                            $created = $row['created'];
                            $date = explode(" ",$created);
                            $date = $date[0];
                            echo "
                                <div class='review'>
                                        
                                      <div class = 'username'>
                                      <p>$reviewre_username [ $date ]</p>";
                                      if($loggen_in && $reviewre_username == $username)
                                       {
                                         echo "
                                            <a href = 'do_thing.php?todo=remove_review&who=user&isbn=$isbn&id=$review_id'>
                                                <p style =
                                                '
                                                    background-color: white;
                                                    font-size: 15px;
                                                    padding: .5%;
                                                ' 
                                                >Remove review</p>
                                            </a>
                                        ";
                                       }
                                      echo"</div>
                                    <div  class = 'review_text'> <p>$review_text</p></div>
                                </div>
                            "; 
                        }
                    }
                ?>
            </div>
            <div class = 'scroll review_form' id = 'review_form'>
                <form action="" method="POST">
                    <input type="text" name="review_text" placeholder="Write Review">
                    <button class="ok" style="margin-left:32%;" name="review" type="submit">Submit Review</button>
                    <button class="cancel" type="button" onclick="closeForm()">Cancel</button>
                </form> 
           </div>
            <?php
                if($loggen_in)
                   {
                   echo"<div class='add'>
                  <button onclick='openForm()'> +Add Review</button>
                </div>";
                   } 
             ?>
            </div>
    </div>

            </div>
              
        </section>
    </body>
<footer>
    <?php include 'footer.html';?>
</footer>
</html>
<script>
    function openForm() {
      document.getElementById("review_form").style.display = 'block';

  }
  function closeForm() {
      document.getElementById("review_form").style.display = 'none';
  }
</script>
<!-- <a href='user_add_review.php?isbn=$isbn'>  <p>+  Add Your review</p></a> -->