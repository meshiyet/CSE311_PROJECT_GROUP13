<?php
   include("connection.php");
    session_start();
    $firstName = "";
    $middleName = "";
    $lastName = "";
    $email = "";
    $phone = "";
    $address = "";
    $dob = "";
    $gender = "";
    $username = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT *FROM member WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = $result->fetch_assoc();
        $firstName = $user['first_name'];
        $middleName = $user['middle_name'];
        $lastName = $user['last_name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $dob = $user['dob'];
        $gender = $user['gender'];
        $username = $user['username'];
    }
    else
    {
         header("location: user_login.php");
    }
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html> 
    <head>
         <link href = "CSS/userProfile.css" rel = "stylesheet">
         <title><?=$username?></title>
        <?php include 'navbar.php';?>
        <link href = "style.css" rel = "stylesheet">
    </head>
    <body>
        <section class="account">
            <div class="left">
                <div class="dp">

                    <!-- Image -->
                    <?php    
                        $result = $db->query("SELECT photo FROM member WHERE username = '$username'"); 
                         if($result->num_rows > 0)
                         { 
                                $row = $result->fetch_assoc();
                                if($row['photo'] != NULL)
                                {
                                    $img = base64_encode($row['photo']);
                                    echo "<img src='data:image/jpg;charset=utf8;base64,$img'  height='200' width='200'/>";
                                }
                                 else
                                { 
                                   echo "<img src='images/avater.png' height='200' width='200'>";
                                }
                                
                        }
                        else
                        { 
                           echo "<img src='images/avater.png' height='200' width='200'>";
                        }
                    ?>
                    <!-- Image -->

                </div>
                 <div class="information">
                    <p>Username: <?=$username?></p>
                </div>
                <div class="information">
                    <p>Name: <?=$firstName. " " . $middleName . " " . $lastName?></p>
                </div>
                <div class="information">
                    <p>Email: <?=$email?></p>
                </div>
                <div class="information">
                    <p>Phone: <?=$phone?></p>
                </div>
                 <div class="information">
                    <p>Address: <?=$address?></p>
                </div>
                 <div class="information">
                    <p>Date Of Birth: <?=$dob?></p>
                </div>
                 <div class="information">
                    <p>Gender: <?=$gender?></p>
                </div>
            </div>
            <div class="right">
                <div>
                    <div class="right_content">
                        <h2>My Borrowing</h2>
                        <div class="scroll">
    
                            <?php

                                $sql = "SELECT * FROM loans WHERE member_username = '$username' ORDER BY return_date";
                                $result =  mysqli_query($db, $sql);
                                if ($result->num_rows > 0) 
                                 {
                                    echo "
                                        <div class='row' style='margin-top: 25px; font-weight: bold; border: 2px solid black;'>
                                            <div class='element' ><p>ISBN</p></div>
                                            <div class='element' ><p>Title</p></div>
                                             <div class='element' ><p>Branch Name</p></div>
                                            <div class='element' ><p>Return date</p></div>
                                            <div class='element' ><p>Fee</p></div>
                                        </div>
                                    ";
                                    while($row = $result->fetch_assoc())
                                    {
                                        $isbn = $row['book_isbn'];
                                        $return_date = $row['return_date'];
                                        $fee = $row['fee'];
                                        $branchName = $row['branch_name'];

                                        $sql2 = "SELECT title FROM book WHERE isbn = '$isbn'";
                                        $result2 = mysqli_query($db,$sql2);
                                        $row2 = $result2->fetch_assoc();
                                        $title = $row2['title'];
                                        if(strlen($title)>11)
                                            $title =  substr($row2['title'], 0, 11)."..";

                                          
                                        echo "
                                            <div class='row'>
                                                <div class='element' ><p>$isbn</p></div>
                                                <a href ='user_bookinfo.php?isbn=$isbn'>
                                                <div class='element' ><p>$title</p></div></a>
                                                 <div class='element' ><p>$branchName</p></div>
                                                <div class='element' ><p>$return_date</p></div>
                                                <div class='element' ><p>$fee</p></div>
                                            </div>
                                        "; 
                                    }
                                }
                                else
                                {
                                    echo "<p style = 'text-align:center; padding:20px;  '>YOU HAVE NO BOOK TO READ NOW</p>";
                                }


                            ?>
                        </div>
                    </div>
                    <div class="right_content">
                         <h2>My Wishlist</h2>
                         <div class="scroll">
                        </div>
                    </div>
            </div>
        </section>
    </body>
    
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>