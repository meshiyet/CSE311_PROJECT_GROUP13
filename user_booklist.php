<?php
    session_start();
    include("connection.php");
    $loggen_in = false;
    if(isset($_SESSION['username']))
    {
       $loggen_in = true;
    }
    $username = $_SESSION['username'];


    $keyword_value = "";
    $sql = "SELECT * FROM book ORDER BY isbn";
    $book = mysqli_query($db, $sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $keyword = $_POST['keyword'];
        $keyword_value = $keyword;
        if($keyword !== "")
        {
            $sql =  "SELECT * FROM book 
            WHERE 
                isbn LIKE '%$keyword%' OR
                title LIKE '%$keyword%'OR
                author LIKE '%$keyword%'OR
                genre LIKE '%$keyword%'OR
                publisher LIKE '%$keyword%'
            ";
         $book = mysqli_query($db,$sql);
        }  
    }

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
            <form action="" method="POST">
                <input type="text" list= 'username_list' name="keyword" value="<?=$keyword_value?>" placeholder="search by keywords">
                 <datalist id='username_list'>"
                    <?php
                        $sql2 = "SELECT * FROM book ORDER BY isbn";
                        $result2 = mysqli_query($db, $sql2);
                        if ($result2->num_rows > 0) 
                        {
                            while($row = $result2->fetch_assoc())
                            {
                                $isbn2 = $row['isbn']; 
                                $title2 = $row['title'];
                                $author2 = $row['author'];
                                $genre = $row['genre'];
                                $publisher = $row['publisher'];
                                $str = $title2." | ".$author2." | ".$genre." | ".$publisher;
                                echo "<option value='$isbn2'>$str</option>";
                            }
                        }?>
                </datalist>
                <button type="submit">Search</button>
            </form>
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
                                   <div class = 'info'>
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