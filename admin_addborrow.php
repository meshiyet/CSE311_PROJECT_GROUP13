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

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addBorrow"]))
    {
        
        $isbn = $_POST['isbn'];
        $username = $_POST['username'];

        $borrow_date = $_POST['borrow_date'];
        $return_date = $_POST['return_date'];
        
        $return_str_to_time = strtotime($return_date);
        $borrow_str_to_time = strtotime($borrow_date);

        $day = ($return_str_to_time - $borrow_str_to_time)/(60*60*24);

        $amount = $day * 10;

        $sql = "SELECT branch_name FROM loans WHERE member_username = '${username}' AND book_isbn = '${isbn}'";
        $result = mysqli_query($db, $sql);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $branchName = $row['branch_name'];
            $errorMassege = "$username has already taken this book from $branchName branch";
        }
        else
        {
            $sql = "SELECT username FROM member WHERE username = '$username'";
            $member = mysqli_query($db, $sql);

            $sql = "SELECT book_isbn FROM keeps WHERE book_isbn = '$isbn' AND no_of_copies > 0";
            $book = mysqli_query($db, $sql);

            $both_ok = $member->num_rows > 0 && $book->num_rows > 0;
            if($both_ok)
            {
                $sql = "INSERT INTO loans(branch_name, book_isbn, member_username, borrow_date,return_date, fee)
                    VALUES('$this_branch', '$isbn', '$username', '$borrow_date', '$return_date', $amount)
                    ";

                $sql2 = "
                   UPDATE keeps
                   SET 
                   no_of_copies = no_of_copies - 1
                   WHERE
                   book_isbn = '$isbn' AND branch_name = '${this_branch}'
                   ";

                if(mysqli_query($db, $sql) && mysqli_query($db, $sql2))
                {  
                   
                     $errorMassege = "Borrow Successfull";
                }
                else
                {
                    $errorMassege = "Unexpected Error Occured! ";
                }
               

            }
            else
            {
                if($member->num_rows == 0)
                    $errorMassege .= " Member not found! ";
                if($book->num_rows == 0)
                    $errorMassege .= "book is not available! ";

            }

        }
}   
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Borrow List</title>
    <link href="CSS/admin_addborrow.css" rel="stylesheet">
    <?php include 'admin_navbar.php';?>
</head>
<body>

    <section class="main">
      <h2>Add Borrow</h2>
      <div style='height: 150px;'></div>
      <form action='' method='POST'>
        <div class='input'>
            <p class='label'>Member Username</p>
            <input list= 'username_list' class='inputbox'  type='text' name='username' required>
            <datalist id='username_list'>";
               <?php 
               $sql = "SELECT * FROM member ORDER BY username";
               $result = mysqli_query($db, $sql);
               if ($result->num_rows > 0) 
               {
                while($row = $result->fetch_assoc())
                {
                    $username = $row['username'];
                    $firstName = $row['first_name'];
                    $middleName = $row['middle_name'];
                    $lastName = $row['last_name'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    $gender = $row['gender'];
                    $str = $firstName." ".$middleName." ".$lastName." | ".$phone." | ".$email." | ".$genger;
                    echo "<option value='$username'>$str</option>";
                }
            }
            ?>
        </datalist>
    </div>
    <div class='input'>
        <p class='label'>Book ISBN</p>
        <input list= 'book_list' class='inputbox'  type='text' name='isbn' required>
        <datalist id='book_list'>";

    <?php
          $sql = "SELECT * FROM book ORDER BY isbn";
          $result = mysqli_query($db, $sql);
          if ($result->num_rows > 0) 
          {
            while($row = $result->fetch_assoc())
            {
                $isbn2 = $row['isbn']; // named 2 to avoid any conflict
                $title2 = $row['title'];
                $author2 = $row['author'];
                $genre = $row['genre'];
                $publisher = $row['publisher'];
                $str = $title2." | ".$author2." | ".$genre." | ".$publisher;
                echo "<option value='$isbn2'>$str</option>";
            }
        }
    ?>
        </datalist>
    </div>
            <div class='dateBox'>
                <!-- ADDD BORROW DATE -->
                <div class='date' style="margin-left: 15%;">
                    <p class='label'>Borrow Date</p>
                    <select name='borrow_date'>
                      <?php 
                      $today = (string) date("Y-m-d",strtotime("now"));
                      $str = (string) date("d-F-Y",strtotime("now"));
                      echo "<option value = '$today' >$str</option>";

                      $today = (string) date("Y-m-d",strtotime("now + 1 day"));
                      $str = (string) date("d-F-Y",strtotime("now + 1 day"));
                      echo "<option value = '$today' >$str</option>"; 
                      ?>
                  </select>
              </div>

              <div class='date' style ="margin-left: 15%;">
                 <p class='label'>Return Date</p>
                 <select name='return_date'>
                  <?php 
                  $today = (string) date("Y-m-d",strtotime("now + 7 day"));
                  $str = (string) date("d-F-Y",strtotime("now + 7 day"));
                  echo "<option value = '$today' >$str</option>";
                  for($i = 0; $i<21; $i++)
                  {
                      $today = (string) date("Y-m-d",strtotime("now + $i day"));
                      $str = (string) date("d-F-Y",strtotime("now + $i day"));
                      echo "<option value = '$today' >$str</option>";
                  } 
                  ?>
              </select>
          </div>
      </div>
        <div class='error'>
            <p><?=$errorMassege?></p>
        </div>
        <div class="the_button">
            <button class='inputButton' name = 'addBorrow' type='submit'>Add Borrow</button>
        </div>   
    </form>
</section>
    </body>
    <footer>
        <?php include 'admin_footer.html';?>
    </footer>
    </html>