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
$statusValue = "All";
$username = $_SESSION['admin_username'];
$sql = "SELECT branch_name FROM admin WHERE username = '${username}'";
$result = mysqli_query($db, $sql);
$row = $result->fetch_assoc();
$this_branch = $row["branch_name"];
$keyword_value = "";
$sql = "SELECT * FROM loans WHERE branch_name = '$this_branch' ORDER BY member_username";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $keyword_value = $keyword = $_POST['keyword'];
    $statusValue = $status = $_POST['status'];

        $sql = "SELECT * FROM loans WHERE (branch_name = '$this_branch') ";
        if($keyword !== "")
        {
            $sql .=  "AND 
        (
        book_isbn LIKE '%$keyword%' OR
        member_username LIKE '%$keyword%' OR
        borrow_date LIKE '%$keyword%' OR
        return_date LIKE '%$keyword%'
        ) ";
        }
        if($status == "Valid")
        {
            $sql .= " AND return_date >= NOW() ";
        }
        elseif($status == "Expired")
        {
            $sql .= " AND return_date < NOW() ";
        }

    
    $sql .= "ORDER BY member_username";
}

$borrows = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Borrows</title>
    <!-- <link href="CSS/booklist.css" rel="stylesheet"> -->
    <link href="CSS/admin_borrowlist.css" rel="stylesheet">

    <?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <div class="search_box">
            <form action="" method="POST">
                <label>Keyword</label>
                <input type="text" list= 'username_list' name="keyword" value="<?=$keyword_value?>" placeholder="Search Borrow">
                <datalist id='username_list'>"
                    <?php
                    $sql2 = "SELECT * FROM loans";
                    $result2 = mysqli_query($db, $sql2);
                    while($row = $result2->fetch_assoc())
                    {
                        $isbn2 = $row['book_isbn']; 
                        $member_username = $row['member_username'];
                        $borrow_date = $row['borrow_date'];
                        $return_date = $row['return_date'];
                        $fee = $row['fee'];
                        $str = $isbn2." | ".$member_username." | ".$borrow_date." | ".$return_date." | ".$fee;
                        echo "<option value='$isbn2'>$str</option>";
                    }
                    ?>
                </datalist>
                <label>Status</label>
                <select name="status">
                    <option><?=$statusValue?></option>
                    <option value="All">All</option>
                    <option value="Expired">Expired</option>
                    <option value="Valid">Valid</option>
                <select>

                <button name="search" type="submit">Search</button>
            </form>
        </div>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
            <div class = 'row_info' >
                <div class="element"><p>ISBN</p></div>
                <div class="element"><p>Username</p></div>
                <div class="element"><p>Borrow Date</p></div>
                <div class="element"><p>Return Date</p></div>
                <div class="element"><p>Fee</p></div>
                <div class="action_box"><p>Action</p></div>
            </div>
        </div>
        <?php  
                // $sql = "SELECT * FROM loans WHERE branch_name = '$this_branch'";
                // $result = mysqli_query($db, $sql);
        $form_no = 0;
        if ($borrows->num_rows > 0) 
        {
            
            while($row = $borrows->fetch_assoc())
            {
                $form_no += 1;
                $branch_name = $row['branch_name'];
                $isbn = $row["book_isbn"];
                $username =$row['member_username'];
                $borrow_date = $row['borrow_date'];
                $return_date = $row['return_date'];
                $fee = $row['fee'];
                $error = "";
                if(strtotime("now")>strtotime($return_date)) {
                     $error = "style = 'border:2px solid red; padding-top: 11git px;'";
                 }

                echo "
                <div class='row' $error>
                    <div class = 'row_info'>
                        <div class='element'><p>$isbn</p></div>
                        <div class='element'><p>$username</p></div>
                        <div class='element'><p>$borrow_date</p></div>
                        <div class='element'><p>$return_date</p></div>
                        <div class='element'><p>$fee</p>
                    </div> 
                </div> ";

                                        //**********************
                echo "

                <div class = 'action_box'>

                    <div class = 'manual_edit'>
                    ";
                                                  //**********************
                        echo"
                        <button   class='open-button' onclick='openForm($form_no)'>Edit Date
                        <img src = 'images/edit_icon.png' hight = '20' width = '20'>
                        </button>
                        <div class='form-popup' id='$form_no'>
                             <form action='do_thing.php' method = 'GET' class='form-container'>
                             <div class = 'hidden'>
                                <input type = 'text' name = 'todo' value = 'edit_loan'>
                                <input type = 'text' name = 'from' value = 'admin_borrowlist'>
                                <input type = 'text' name = 'isbn' value = '$isbn'>
                                <input type = 'text' name = 'username' value = '$username'>
                            </div>
                            <select name = 'date'>";

                        $today = (string) date("Y-m-d",strtotime($return_date));
                        $str = (string) date("d-F",strtotime($return_date));
                        echo "<option value = '$today' >$str</option>";
                        
                        for($i = 0; $i<10; $i++)
                        {
                          $today = (string) date("Y-m-d",strtotime("now + $i day"));
                          $str = (string) date("d-F",strtotime("now + $i day"));
                          echo "<option value = '$today' >$str</option>";
                        }
                        echo"
                                </select>
                             <button type='submit' class='edit_button'>Edit</button>
                             <button type='button' class='cancel_button' onclick='closeForm($form_no)'>Close</button>
                         </form>
                  </div>
              </div>
                      ";

                  echo"  

                  <a href = 'do_thing.php?todo=extend_loan&isbn=$isbn&username=$username&from=admin_borrowlist'>
                      <div class = 'edit'>
                          <p>Extend 1 Week</p>
                          <img src = 'images/plus_icon.png' hight = '20' width = '20'>
                      </div>
                  </a>
                  <a href = 'do_thing.php?todo=remove_loan&isbn=$isbn&username=$username&from=admin_borrowlist'>
                      <div class = 'edit' style = 'width:18%;'>
                          <p>Returned</p>
                          <img src = 'images/okay_icon.png' hight = '20' width = '20'>
                      </div>
                  </a>

                  </div>
                  ";
                                        //**********************

              echo"</div>
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
<script>
    function openForm(form_no) {
      document.getElementById(form_no).style.display = 'inline-block';

  }
  function closeForm(form_no) {
      document.getElementById(form_no).style.display = 'none';
  }
</script>