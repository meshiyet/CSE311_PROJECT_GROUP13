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
        <h1>All Registered Members</h1>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
                <div class="element"><p>Username</p></div>
                <div class="element"><p>Name</p></div>
                <div class="element"><p>Email</p></div>
                <div class="element"><p>Phone</p></div>
                <div class="element"><p>Address</p></div>
                <div class="element"><p>DoB</p></div>
                 <div class="element"><p>Gender</p></div>
                
            </div>
            <?php 

                $sql = "SELECT * FROM member ORDER BY username";
                $result = mysqli_query($db, $sql);
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

                        echo "
                             <div class='row'>
                                <div class='element'><p>$username</p></div>
                                <div class='element'><p>$firstName</p></div>
                                <div class='element'><p>$email</p></div>
                                <div class='element'><p>$phone</p></div>
                                <div class='element'><p>$address</p></div>
                                <div class='element'><p>$dob</p></div>
                                <div class='element'><p>$gender</p></div>
                            </div>


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