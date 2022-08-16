<?php
    include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/landing.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Dhaka Library</title>
    </head>
    <nav>
        <!-- <?php include ("navbar.php");?> -->
    </nav> 
    <body>
        <div class="container">
            <div class="banner">
                    <div class="banner-content">
                        <div class="search">
                                <input type="text" class="searchTerm" name="search" placeholder="Search for books by ISBN, title, author or genre">
                                <button href="#" type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                        </div>
                    </div>
            </div>
            
            <div class="featured">
                <div class="featured-content">
                    <h1>Featured books</h1>
                    <div class="featured-items">
                        <div class="book-container">
                            <img class="cover" src="images/cover_thebelljar.jpg">
                            <h3 class="title">The Bell Jar</h3>
                            <p class="author">Sylvia Plath</p>
                            <br>
                            <p class="availability">Available in: </p>
                            <?php
                                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '0061148512'";
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
                        <div class="book-container">
                            <img class="cover" src="images/cover_beforethecoffeegetscold.jpg">
                            <h3 class="title">Before the Coffee Gets Cold</h3>
                            <p class="author">Toshikazu Kawaguchi</p>
                            <br>
                            <p class="availability">Available in: </p>
                            <?php
                                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '1529029589'";
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
                        <div class="book-container">
                            <img class="cover" src="images/cover_themidnightlibrary.jpg">
                            <h3 class="title">The Midnight Library</h3>
                            <p class="author">Matt Haig</p>
                            <br>
                            <p class="availability">Available in: </p>
                            <?php
                                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '0525559477'";
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
                        <div class="book-container">
                            <img class="cover" src="images/cover_theparisapartment.jpg">
                            <h3 class="title">The Paris Apartment</h3>
                            <p class="author">Lucy Foley</p>
                            <br>
                            <p class="availability">Available in: </p>
                            <?php
                                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '0063003058'";
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
                        <div class="book-container">
                            <img class="cover" src="images/cover_normalpeople.jpg">
                            <h3 class="title">Normal People</h3>
                            <p class="author">Sally Rooney</p>
                            <br>
                            <p class="availability">Available in: </p>
                            <?php
                                $sql = "SELECT branch_name FROM keeps WHERE no_of_copies>0 AND book_isbn = '1984822187'";
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
                    </div>
                </div>      
            </div>
        </div>
    </body>
    <footer>
        <!-- <?php include ("footer.html");?> -->
    </footer>
</html>
