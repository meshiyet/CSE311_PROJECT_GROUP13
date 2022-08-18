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


    $keyword_value = "";
    $sql = "SELECT * FROM member ORDER BY username";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $keyword = $_POST['keyword'];
        $keyword_value = $keyword;
        if($keyword !== "")
        {
            $sql =  "
            SELECT * FROM member 
            WHERE 
                username LIKE '%$keyword%' OR
                first_name LIKE '%$keyword%'OR
                middle_name LIKE '%$keyword%'OR
                last_name LIKE '%$keyword%'OR
                dob LIKE '%$keyword%'OR
                gender LIKE '%$keyword%'OR
                phone LIKE '%$keyword%'OR
                email LIKE '%$keyword%'OR
                address LIKE '%$keyword%'";
         
        }  
    } 

    $result = mysqli_query($db,$sql);
   
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member List</title>
    <link href="CSS/memberlist.css" rel="stylesheet">
    <?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <div class="search_box">
            <form action="" method="POST">
                <input type="text" list= 'username_list' name="keyword" value="<?=$keyword_value?>" placeholder="search by keywords">
                 <datalist id='username_list'>"
                    <?php
                        $sql2 = "SELECT * FROM member ORDER BY username";
                        $result2 = mysqli_query($db, $sql);
                        if ($result2->num_rows > 0) 
                        {
                            while($row = $result2->fetch_assoc())
                            {
                                $username = $row['username'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $gender = $row['gender'];
                                $str = $username." | ".$firstName." ".$middleName." ".$lastName." | ".$phone." | ".$email." | ".$genger;
                                echo "<option value='$username'>$str</option>";
                            }
                        }?>
                </datalist>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
                <div class="element"><p>Username</p></div>
                <div class="element"><p>Email</p></div>
                <div class="element"><p>Phone</p></div>
                <div class="element"><p>Current Borrow</p></div>
                <div class="element"><p> Due Payment</p></div>
                
            </div>

            <?php  
                
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc())
                    {
                        $user = $row;
                        $username = $row["username"];
                        $firstName = $row["first_name"];
                        $email = $row["email"];
                        $phone = $row["phone"];
                        $address = $row["address"];
                        $dob = $user ["dob"];
                        $gender = $user["gender"];

                        $sql = "SELECT COUNT(book_isbn) as copy FROM loans WHERE member_username = '$username'";
                        $book = mysqli_query($db, $sql);
                        $number_of_book = 0;
                        if($book->num_rows>0)
                        {
                            $book = $book->fetch_assoc();
                            $number_of_book = $book['copy'];
                        }
                        $sql = "SELECT SUM(fee) as sum FROM loans WHERE member_username = '$username'";
                        $book = mysqli_query($db, $sql);
                        $due_money = 0;
                        if($book->num_rows > 0)
                        {
                            $book = $book->fetch_assoc();
                            if($book['sum']>0)
                                $due_money = $book['sum'];
                        }
                        echo "
                           <a href = 'admin_full_userinfo.php?username=$username'> 
                           <div class='row'>
                                <div class='element'><p>$username</p></div>
                                <div class='element'><p>$email</p></div>
                                <div class='element'><p>$phone</p></div>
                                <div class='element'><p>$number_of_book</p></div>
                                <div class='element'><p>$due_money</p></div>
                            </div>
                            </a>
                        ";


                    }
                } 

            ?>

        </div>
        
    </section>
</body>
<footer>
    <?php include('admin_footer.html'); ?>
</footer>
</html>