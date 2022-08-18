 SELECT * FROM member WHERE 
            username LIKE '%$keyword%' OR
            first_name LIKE '%$keyword%'OR
            middle_name LIKE '%$keyword%'OR
            last_name LIKE '%$keyword%'OR
            dob LIKE '%$keyword%'OR
            gender LIKE '%$keyword%'OR
            email LIKE '%$keyword%'OR
            address LIKE '%$keyword%'OR
            first_name LIKE '%$keyword%'

<?php
             $result;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $keyword = $_POST['keyword'];
        $keyword_value = $keyword;
        $sql = "SELECT * FROM member WHERE username = '$keyword'";
        $result = mysqli_query($db, $sql);
    }
    else
    {
        $sql = "SELECT * FROM member ORDER BY username";
        $result = mysqli_query($db, $sql);
    }

<input type = 'text' name = 'todo' value = 'edit_borrow'>
<input type = 'text' name = 'todo' value = 'edit_borrow'>
<input type = 'text' name = 'todo' value = 'edit_borrow'>


                                                <div class = 'edit' style = 'width:10%; margin-left:0; overflow: auto;'>
                                                <p>Edit Return Date</p>
                                                <img src = 'images/edit_icon.png' hight = '20' width = '20'>