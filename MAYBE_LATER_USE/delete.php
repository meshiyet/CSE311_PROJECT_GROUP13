 <?php $sql = "INSERT INTO loans(branch_name, book_isbn, member_username, borrow_date,return_date, fee)
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
                       else
                       {