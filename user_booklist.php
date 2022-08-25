<?php
    session_start();
    include("connection.php");
    $loggen_in = false;
    if(isset($_SESSION['username']))
    {
       $loggen_in = true;
    }
    $username = $_SESSION['username'];

    $authorValue = "";
    $genreValue = "";
    $publisherValue = "";

    $sql = "SELECT * FROM book WHERE 1 = 1";

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter']))
    { 

        $authorValue=   $author = $_POST['author'];
        $genreValue = $genre = $_POST['genre'];
        $publisherValue = $publisher = $_POST['publisher'];

        if($author !== "All" && $author !== "" )
            $sql .= " AND author = '$author'";

        if($genre !== "All" && $genre !== "")
            $sql .= " AND genre = '$genre'";

        if($publisher !== "All" && $publisher !== "")
            $sql .= " AND publisher = '$publisher'";
        
    }

    $book = mysqli_query($db,$sql);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book List</title>
	<link href="CSS/user_booklist.css" rel="stylesheet">
	<?php include('navbar.php'); ?>
</head>
<body>
    <section class="main">
        <div class="search_box">
            <div class="filter">
             <form action="" method="POST">
                <p>Author</p>
                <select name="author">
                    <option value="<?=$authorValue?>"><?=$authorValue?></option>
                    <option value="All">All</option>
                    <?php

                        $sql = "SELECT author, genre, publisher FROM book";
                        $result = mysqli_query($db,$sql);
                        $authors;
                        $genres;
                        $publishers;
                        while($row = $result->fetch_assoc())
                        {
                            $authors[$row['author']] = 1;
                            $genres[$row['genre']] = 1;
                            $publishers[$row['publisher']] = 1;
                            
                        }
                        foreach($authors as $key => $v)
                        {
                            echo "<option value = '$key'>$key</option>";
                        }
                    ?>
                </select>

                <p>Genre</p>
                <select name="genre">
                    <option value="<?=$genreValue?>"><?=$genreValue?></option>
                    <option value="All">All</option>
                    <?php
                        foreach($genres as $key => $v)
                        {
                            echo "<option value = '$key'>$key</option>";
                        }
                        
                    ?>
                </select>

                 <p>Publisher</p>
                <select name="publisher">
                    <option value="<?=$publisherValue?>"><?=$publisherValue?></option>
                    <option value="All">All</option>
                    <?php

                        foreach($publishers as $key => $v)
                        {
                            echo "<option value = '$key'>$key</option>";
                        }
                        
                    ?>
                </select>

                <button type="submit" name="filter">Filter</button>
            </form>
        </div>
    </div>

        <div class="listbox">
            <?php  
              
                if ($book->num_rows > 0) 
                {
                    while($row = $book->fetch_assoc())
                    {
                        $isbn = $row["isbn"];
                        $title = $row["title"];
                        $author = $row["author"];
                        $genre = $row["genre"];
                        $publisher = $row["publisher"];
                        $has_img = false;
                        if($row['cover']!== NULL)
                            $has_img = true;
                        $img = base64_encode($row['cover']);

                        $sql = "SELECT * FROM wishlist WHERE isbn = '$isbn' AND username = '$username'";
                        $wish = mysqli_query($db,$sql);
                        $wish_listed = false;
                        if($wish->num_rows>0)
                        {
                            $wish_listed = true;
                        }

                        echo "
                            <a href = 'user_bookinfo.php?isbn=$isbn'>  
                            <div class='row'>
                               
                                    <div class='cover'>";
                                        if($has_img){
                                            echo "<img src='data:image/jpg;charset=utf8;base64,$img'  height='160' width='100'/>"; 
                                        }
                                        else
                                        {
                                            echo "<img src='images/default_book.jpg' height='160' width='100'>";
                                        }
                                
                                        echo"
                                   </div>
                                   <div class = 'cover info'>
                                        <div class='element'><p>$title</p></div>
                                        <div class='element'><p>$author</p></div>
                                        <div class='element'><p>$genre</p></div>
                                        <div class='element'><p>$publisher</p></div>";

                            

                                 if($loggen_in)
                                 {
                                    if(!$wish_listed)
                                    {
                                        echo"<div class='element'>
                                                <a href = 'do_thing.php?todo=addWish&isbn=$isbn&username=$username&from=booklist'>
                                                    <div class ='addwish'></div>
                                                 </a>
                                            </div>";

                                    }
                                    else
                                    {
                                        echo"<div class='element'>
                                                <a href = 'do_thing.php?todo=removeWish&isbn=$isbn&username=$username&from=booklist'>
                                                    <div class ='removeWish'></div>
                                              </a>
                                            </div>";
                                    }
                                 }


                                    echo"</div>
                                     
                                </div>
                                </a> ";
                    }
                } 

            ?>

        </div>
        
    </section>
</body>
<footer>
	<?php include('footer.html'); ?>
</footer>
</html>