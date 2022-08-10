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
    $username = $_SESSION["admin_username"];
    $isbn = "";
    $title;
    $author;
    $genre;
    $publisher;
    $num_of_copy;
    $exists = false;
    $to_do = "search_book";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['search']))
        {
             $isbn = $_POST['isbn'];
             $sql = "SELECT * FROM book WHERE isbn = '${isbn}'";
             $result = mysqli_query($db,$sql);
             if($result->num_rows > 0)
             {
                $book = $result->fetch_assoc();
                $title = $book['title'];
                $author = $book['author'];
                $genre = $book['genre'];
                $publisher = $book['publisher'];
                $exists = true;
                $to_do = "add_this_book";
             }
             else
             {
                $to_do = "add_new_book";
             }
        }
        elseif(isset($_POST['addNewBook']))
        {
            $isbn = $_POST['isbn'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $publisher = $_POST['publisher'];
            $sql = "INSERT INTO book(isbn, title, author, genre,publisher)
            VALUES('$isbn', '$title', '$author', '$genre', '$publisher')
            ";
            if(mysqli_query($db, $sql))
            {
                $to_do = "add_this_book";
            } 
            else
            {
                $to_do = "WRONG";
            }
        }
        elseif(isset($_POST['addThisBook']))
        {
            $isbn = $_POST['isbn'];
            $copy_to_add = $_POST['numOfCopy'];
            $username = $_SESSION['admin_username'];

            $sql = "SELECT branch_name FROM admin WHERE username = '${username}'";
            $result = mysqli_query($db, $sql);
            
            $row = $result->fetch_assoc();
            $this_branch = $row["branch_name"];

            $sql = "SELECT no_of_copies FROM keeps WHERE book_isbn = '$isbn' AND branch_name = '${this_branch}'";
            $result = mysqli_query($db, $sql);

            $num_of_copy = 0;
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $num_of_copy = $row['no_of_copies'];
                $num_of_copy = $num_of_copy + $copy_to_add;
                $sql = "
                    UPDATE keeps
                        SET 
                        no_of_copies = $num_of_copy
                    WHERE
                        book_isbn = '$isbn' AND branch_name = '${this_branch}'
                        ";
                if(mysqli_query($db, $sql))
                 {
                    header("location: admin_booklist.php");
                 }

            }
            else
            {
                echo "\nEKHANE AMI";
                $sql = "
                INSERT INTO keeps(branch_name, book_isbn, no_of_copies)
                VALUES
                ('$this_branch', '$isbn', $copy_to_add)
                ";
                 if(mysqli_query($db, $sql))
                 {
                    header("location: admin_booklist.php");
                 }
            }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Book</title>
    <link href="CSS/addbook.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
</head>
<body>
    <section class="main">
        <h1>Add New Book</h1>
        <div class="addform">
           <?php
                if($to_do == "search_book")
                {
                    echo "
                         <div class='search'>
                            <form action='' method='POST'>
                                <div class='input'>
                                    <p class='label'>Enter ISBN</p>
                                    <input class='inputbox' type='text' name='isbn' required>
                                </div>
                                <button class='inputButton' name = 'search' type='submit'>Search Book</button>
                            </form>
                        </div>
                    ";
                }
                elseif($to_do == "add_this_book")
                {
                    echo "
                        <div class='addThisBook'>
                        <form action='' method='POST'>
                            <input class='hidden'  type='text' name='isbn' value = '$isbn' required>
                            <p class='label'>ISBN: $isbn</p>     
                            <p class='label'>Book Title: $title</p>
                            <p class='label'>Author: $author</p>
                            <p class='label'>Genre: $genre</p>
                            <p class='label'>Publisher: $publisher</p>
                            
                                <div class='input'>
                                    <p class='label'>Enter Number of copies to add</p>
                                    <input class='inputbox' type='number' name='numOfCopy' required>
                                </div>
                                <button class='inputButton' name = 'addThisBook' type='submit'>Add This Book </button>
                            </form>
                       </div>
                    ";
                }
                elseif($to_doc = "add_new_book")
                {
                    echo "
                        <div class='newBook'>
                            <p class='pp'>This book is not registered in the database, please add informations about this book
                            </p>
                            <form action='' method='POST'>
                                <div class='input'>
                                <input class='hidden'  type='text' name='isbn' value = '$isbn' required>
                                <p class='label'>ISBN: $isbn</p>
                                </div>
                                <div class='input'>
                                    <p class='label'>Book Title</p>
                                    <input class='inputbox'  type='text' name='title' required>
                                </div>
                                <div class='input'>
                                    <p class='label'>Book Author</p>
                                    <input class='inputbox'  type='text' name='author' required>
                                </div>
                                 <div class='input' style='height: 60px;'>
                                    <p class='label'>Book Genre</p>
                                     <select class='label'  name='genre' id='genre'>
                                        <option value='Novel'>Novel</option>
                                        <option value='Drama'>Drama</option>
                                     </select>
                                </div>
                                 <div class='input'>
                                    <p class='label'>Publisher</p>
                                    <input class='inputbox'  type='text' name='publisher' required>
                                </div>
                            
                                <button class='inputButton' name = 'addNewBook' type='submit'>Add New Book </button>
                            
                            </form>
                        </div>
                    ";
                }
                else
                {
                    echo " <h1>Oh no! Something went Wrong</h1>";
                }
                
            ?>

        </div>
    </section>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>