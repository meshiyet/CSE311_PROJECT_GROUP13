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
    $errorMassege = "";
    $username = $_SESSION['admin_username'];
    $sql = "SELECT branch_name FROM admin WHERE username = '${username}'";
    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();
    $this_branch = $row["branch_name"];

     $no_of_month = array("January" => "01","February" => "02", "March" => "03", 
                "April" => "04", "May" => "05", "June" => "06",
                "July" => "07", "August" => "08", "September" => "09",
                "October" => "10", "November" => "11", "December" => "12"
            );

     $to_do = "add_borrow";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["add_mode"]))
        {
            $to_do = "add_borrow";
        }
        elseif(isset($_POST["return_mode"]))
        {
            $to_do = "return_borrow";
        }
         elseif(isset($_POST["edit_mode"]))
        {
            $to_do = "edit_borrow";
        }
        elseif(isset($_POST["addBorrow"]))
        {
            $isbn = $_POST['isbn'];
            $username = $_POST['username'];
            
            $borrow_day = $_POST['borrow_day'];
            $borrow_month = $_POST['borrow_month'];
            $borrow_year = $_POST['borrow_year'];

            $return_day = $_POST['return_day'];
            $return_month = $_POST['return_month'];
            $return_year = $_POST['return_year'];

            $borrow_date = $borrow_year."-".$no_of_month[$borrow_month]."-".$borrow_day;
            $return_date = $return_year."-".$no_of_month[$return_month]."-".$return_day;

            $sql = "SELECT branch_name FROM loans WHERE member_username = '${username}' AND book_isbn = '${isbn}'";
            $result = mysqli_query($db, $sql);
            
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $branchName = $row['branch_name'];
                $errorMassege = "This user already taken this book from $branchName branch";
            }
            else
            {

                // NEED TO WORK ON FEE CALCULATION HERE

                $sql = "INSERT INTO loans(branch_name, book_isbn, member_username, borrow_date,return_date, fee)
                VALUES('$this_branch', '$isbn', '$username', '$borrow_date', '$return_date', 100)
                ";
                if(mysqli_query($db, $sql))
                {
                     $sql = "
                    UPDATE keeps
                        SET 
                        no_of_copies = no_of_copies - 1
                    WHERE
                        book_isbn = '$isbn' AND branch_name = '${this_branch}'
                        ";
                    if(mysqli_query($db, $sql))
                     {
                         $errorMassege = "Borrow Successfull";
                     }
                }
                else
                {
                    $errorMassege = "Something went Wrong";
                }
            }
            $to_do = "add_borrow";

        }
        elseif(isset($_POST["returnBorrow"]))
        {
            $username = $_POST['username'];
            $isbn =$_POST['isbn'];

             $sql = "SELECT branch_name FROM loans WHERE member_username = '${username}' AND book_isbn = '${isbn}'";
            $result = mysqli_query($db, $sql);
            
            if($result->num_rows > 0)
            {
                $sql = "DELETE FROM loans WHERE member_username = '$username' AND book_isbn = '$isbn'";
                if(mysqli_query($db, $sql))
                {
                     $sql = "
                    UPDATE keeps
                        SET 
                        no_of_copies = no_of_copies + 1
                    WHERE
                        book_isbn = '$isbn' AND branch_name = '${this_branch}'
                        ";
                    if(mysqli_query($db, $sql))
                     {
                        $errorMassege = "Return Successfull";  
                     }
                     else
                     {
                         $errorMassege = "Something went Wrong";
                     }
                 }
            }
            else
            {
                $errorMassege = "Invalid input";
                
            }

            $to_do = "return_borrow";
           
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Borrow List</title>
    <link href="CSS/admin_borrowlist.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
</head>
<body>

    <section class="main">
        <div class="buttons">
            <form action="" method="POST">
            <button name="add_mode">Add Borrow</button>
            <button name="return_mode">Return Borrow</button>
            <button name="edit_mode">Edit One Borrow</button>
        </form>
        </div>
        <div class="dynamic">
            <!--  -->
            <?php
                if($to_do == "add_borrow")
                {
                    echo "
                        <div class='add_borrow'>
                           <div style='height: 50px;'></div>
                            <form action='' method='POST'>
                                <div class='input'>
                                        <p class='label'>Member Username</p>
                                        <input list= 'username_list' class='inputbox'  type='text' name='username' required>
                                            <datalist id='username_list'>";
                                            $sql = "SELECT username FROM member ORDER BY username";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $username = $row['username'];
                                                    echo "<option value='$username'>";
                                                }
                                            }
                                            echo"</datalist>
                                    </div>
                                <div class='input'>
                                    <p class='label'>Book ISBN Username</p>
                                    <input list= 'book_list' class='inputbox'  type='text' name='username' required>
                                        <datalist id='book_list'>";
                                           $sql = "SELECT isbn FROM book ORDER BY isbn";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $isbn2 = $row['isbn']; // named 2 to avoid any conflict
                                                    echo "<option value='$isbn2'>";
                                                }
                                            }

                                      echo"  </datalist>
                                </div>
                            <div class='dateBox'>
                                <!-- ADDD BORROW DATE -->
                                <div class='date'>
                                     <p class='label'>Borrow Date</p>
                                      <select name='borrow_day' id='day'>
                                      ";
                                        for($i = 1; $i<=31; $i++)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }
                                   echo" </select>
                                     <select name='borrow_month' id='month'>";
                                      $months = array("January" => 31, "February" => 28, "March" => 31, "April" =>30, "May" =>31, "June"=>30, "July"=>31, "August"=>31, "September"=>30, "October"=>31, "November"=>30, "December"=>31);
                                        foreach ($months as $key => $value) {
                                        
                                             echo "<option value='$key'>$key</option>";
                                        }
                                   echo" </select>
                                     <select name='borrow_year' id='year'>";
                                       for($i = 2022; $i>=1980; $i--)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }
                                    echo"</select>
                                   
                                </div>
                                <!-- ADDD BORROW DATE -->
                                <!-- ADDD RETURN DATE -->
                                <div class='date' style='margin-left: 15%;'>
                                     <p class='label'>Return Date</p>
                                      <select name='return_day' id='day'>";
                                   
                                        for($i = 1; $i<=31; $i++)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }

                                            
                                    echo"  
                                    </select>
                                     <select name='return_month' id='month'>";
                                        foreach ($months as $key => $value) {
                                        
                                             echo "<option value='$key'>$key</option>";
                                        }
                                   echo" </select>
                                     <select name='return_year' id='year'>";
                                       for($i = 2022; $i>=1980; $i--)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }
                                  echo"  </select>
                                   
                                </div>
                            <!-- ADDD RETURN DATE -->
                        </div>
                                <div class='error'>
                                    <p>$errorMassege</p>
                                </div>
                                <button class='inputButton' name = 'addBorrow' type='submit'>Add Borrow</button>
                            
                            </form>
                       </div>
                    ";
                } 
                elseif($to_do == "return_borrow")
                {
                    echo "
                           <div class = 'return_borrow'>
                             <div style='height: 100px;'></div>
                            <form action='' method='POST'>
                                <div class='input'>
                                        <p class='label'>Member Username</p>
                                        <input list= 'username_list' class='inputbox'  type='text' name='username' required>
                                            <datalist id='username_list'>";
                                            $sql = "SELECT username FROM member ORDER BY username";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $username = $row['username'];
                                                    echo "<option value='$username'>";
                                                }
                                            }
                                            echo"</datalist>
                                    </div>
                                <div class='input'>
                                    <p class='label'>Book ISBN Username</p>
                                    <input list= 'book_list' class='inputbox'  type='text' name='username' required>
                                        <datalist id='book_list'>";
                                           $sql = "SELECT isbn FROM book ORDER BY isbn";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $isbn2 = $row['isbn']; // named 2 to avoid any conflict
                                                    echo "<option value='$isbn2'>";
                                                }
                                            }

                                      echo"  </datalist>
                                </div>
                                 <div class='error'>
                                        <p>$errorMassege</p>
                                    </div>

                                    <button class='inputButton' name = 'returnBorrow' type='submit'>Return Borrow</button>
                                
                                </form>
                          </div>
                    ";
                }
                elseif($to_do = "edit_borrow")
                {
                    echo "
                        <div class='add_borrow'>
                           <div style='height: 50px;'></div>
                            <form action='' method='POST'>
                                <div class='input'>
                                        <p class='label'>Member Username</p>
                                        <input list= 'username_list' class='inputbox'  type='text' name='username' required>
                                            <datalist id='username_list'>";
                                            $sql = "SELECT username FROM member ORDER BY username";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $username = $row['username'];
                                                    echo "<option value='$username'>";
                                                }
                                            }
                                            echo"</datalist>
                                    </div>
                                <div class='input'>
                                    <p class='label'>Book ISBN Username</p>
                                    <input list= 'book_list' class='inputbox'  type='text' name='username' required>
                                        <datalist id='book_list'>";
                                           $sql = "SELECT isbn FROM book ORDER BY isbn";
                                            $result = mysqli_query($db, $sql);
                                             if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $isbn2 = $row['isbn']; // named 2 to avoid any conflict
                                                    echo "<option value='$isbn2'>";
                                                }
                                            }

                                      echo"  </datalist>
                                </div>
                            <div class='dateBox'>
                                <!-- ADDD BORROW DATE -->
                                <div class='date'>
                                     <p class='label'> Change Borrow Date</p>
                                      <select name='borrow_day' id='day'>
                                      ";
                                        for($i = 1; $i<=31; $i++)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }
                                   echo" </select>
                                     <select name='borrow_month' id='month'>";
                                      $months = array("January" => 31, "February" => 28, "March" => 31, "April" =>30, "May" =>31, "June"=>30, "July"=>31, "August"=>31, "September"=>30, "October"=>31, "November"=>30, "December"=>31);
                                        foreach ($months as $key => $value) {
                                        
                                             echo "<option value='$key'>$key</option>";
                                        }
                                   echo" </select>
                                     <select name='borrow_year' id='year'>";
                                       for($i = 2022; $i>=1980; $i--)
                                        {
                                            echo "<option value=$i>$i</option>";
                                        }
                                    echo"</select>
                                   
                                </div>
                                <!-- ADDD BORROW DATE -->
                        </div>
                                <div class='error'>
                                    <p>$errorMassege</p>
                                </div>
                                <button class='inputButton' name = 'editBorrow' type='submit'>Edit Borrow</button>
                            
                            </form>
                       </div>
                    ";
                }
            ?>
          <!--  -->
        </div>
    </section>
</body>
<footer>
    <?php include 'admin_footer.html';?>
</footer>
</html>