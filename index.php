<?php 
    include("connection.php");
    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Dhaka Library</title>


    
        
        <link rel="stylesheet" href="CSS/index.css">
         <link href="CSS/landing2.css" rel="stylesheet">
  </head>
  <body>
        <?php include("navbar.php");?>

<!--  -->
<div class="banner">
       
</div>
<!--  -->

<div class="middle">
      <h1>Featured books</h1>
</div>

        <section class="ftco-section" style=" width: 80%; margin: 0 auto;">
            
<!--  -->
<!--  -->

            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="featured-carousel owl-carousel">
                            
                            <!-- Repeats -->
                            <?php 
                                $sql = "SELECT * FROM book";
                                $result = mysqli_query($db,$sql);
                                while($book = $result->fetch_assoc())
                                {   


                                    echo "<div class='item' style = 'width :550px;'>  ";

                                    $img = base64_encode($book['cover']);
                                    $isbn = $book['isbn'];
                                    $title = $book['title'];
                                    $author = $book['author'];
                                    

                                    echo"
                                        <a href = 'user_bookinfo.php?isbn=$isbn'>
                                                <div class='book' style ='margin-left:0;'>
                                                    <div class = 'cover' > 
                                                        <img src='data:image/jpg;charset=utf8;base64,$img'  height='240' width='150'/>
                                                    </div>
                                                <div class = 'bottom'>
                                                <h3 class='title'>$title</h3>
                                                <p class='author'>$author</p>
                                                <br>
                                                <p class='availability'>Available in: </p>";
                                   $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '$isbn'";
                                  $branch = mysqli_query($db, $sql);
                                  while($row = $branch->fetch_assoc())
                                  {
                                      $branchName = $row['branch_name'];
                                      echo "<div class='information'>
                                          <p>$branchName</p>
                                      </div>";
                                  }
                                                
                                            echo"   </div>
                                                </div>
                                            </a>";

                                        if($book = $result->fetch_assoc())
                                        {
                                                    $img = base64_encode($book['cover']);
                                                    $isbn = $book['isbn'];
                                                    $title = $book['title'];
                                                    $author = $book['author'];
                                                    

                                                    echo"
                                                        <a href = 'user_bookinfo.php?isbn=$isbn'>
                                                                <div class='book' style ='margin-left:0;'>
                                                                    <div class = 'cover' > 
                                                                        <img src='data:image/jpg;charset=utf8;base64,$img'  height='240' width='150'/>
                                                                    </div>
                                                                <div class = 'bottom'>
                                                                <h3 class='title'>$title</h3>
                                                            <p class='author'>$author</p>
                                                            <br>
                                                            <p class='availability'>Available in: </p>";
                                                   $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '$isbn'";
                                                  $branch = mysqli_query($db, $sql);
                                                  while($row = $branch->fetch_assoc())
                                                  {
                                                      $branchName = $row['branch_name'];
                                                      echo "<div class='information'>
                                                          <p>$branchName</p>
                                                      </div>";
                                                  }
                                                                
                                                            echo"   </div>
                                                                </div>
                                                        </a>";
                                        }
                                    echo"   </div>";
                                     
                                }
                            ?>



                            <!-- Repeats -->
                            <!-- <div class='item'  style='border:2px solid aqua;'>
                                <div class='book'></div>
                            </div> -->
                            <!-- Repeats -->

                        
                    
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <?php include("footer.html");?>
</html>