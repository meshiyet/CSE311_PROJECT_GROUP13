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
    $author = "";
    $title= "";
    $genre= "";
    $publisher= "";
    $sql = "SELECT title, author, genre, publisher FROM book WHERE isbn = '$isbn'";
    $result = mysqli_query($db, $sql);
    if($result->num_rows>0)
    {
        $book = $result->fetch_assoc();
        $author = $book['author'];
        $title = $book['title'];
        $genre = $book['genre'];
        $publisher = $book['publisher'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $publisher = $_POST['publisher'];

        $sql = "UPDATE book 
            SET
                title = '$title',
                author = '$author',
                genre = '$genre',
                publisher = '$publisher'
            WHERE isbn = '$isbn'
        ";
        if(mysqli_query($db,$sql))
        {
            header("location: admin_full_bookinfo.php?isbn=$isbn");
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book List</title>
    <link href="CSS/addbook.css" rel="stylesheet">
    <?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <div class='newBook'>


            <form action='' method='POST'>
                <div style="height: 100px; "></div>
                <div class='input' style="height: 50px;">
                    <p class='label'>ISBN: <?=$isbn?></p>
                </div>
                <div class='input'>
                    <p class='label'>Book Title</p>
                    <input class='inputbox'  type='text' name='title' value='<?=$title?>' required>
                </div>
                <div class='input'>
                    <p class='label'>Book Author</p>
                    <input class='inputbox'  type='text' name='author' value='<?=$author?>' required>
                </div>
                <div class='input' style='height: 60px;'>
                    <p class='label'>Book Genre</p>
                    <select class='label'  name='genre' id='genre'>
                        <option value='Novel'><?=$genre?></option>
                        <option value='Novel'>Novel</option>
                        <option value='Drama'>Drama</option>
                        <option value='Fantasy'>Fantasy</option>
                        <option value='Thriller'>Thriller</option>
                        <option value='Science fiction'>Science fiction</option>
                        <option value='Historical fiction'>Historical fiction</option>
                        <option value='Romance'>Romance</option>
                        <option value='Horror'>Horror</option>
                        <option value='Biography'>Biography</option>
                        <option value='Non fiction'>Non fiction</option>
                        <option value='Poetry'>Poetry</option>
                        <option value='Children-s literature'>Children's literature</option>
                    </select>
                </div>
                <div class='input'>
                    <p class='label'>Publisher</p>
                    <input class='inputbox'  type='text' name='publisher' value='<?=$publisher?>' required>
                </div>

                <button class='inputButton' name = 'addNewBook' type='submit'>Update Information</button>

            </form>
        </div>
    </section>
</body>
<footer>
	<?php include('admin_footer.html'); ?>
</footer>
</html>