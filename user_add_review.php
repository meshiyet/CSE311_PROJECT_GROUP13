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

     if($_SERVER['REQUEST_METHOD'] == 'POST')
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
         <link href = "CSS/user_add_review.css" rel = "stylesheet">
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
                </div>
                <!-- <p class="p">Book Information</p> -->
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
                

          
            <div class="right_content">      
                <h2>Write Your Review Here</h2>
                <form action="" method="POST">
                <div class="textField">
                    <input type="text" name="review_text">
                </div>
                <button>Add Review</button>
            </form>
            </div>
           

            </div>
              
        </section>
    </body>
<footer>
    <?php include 'footer.html';?>
</footer>
</html>