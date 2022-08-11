<?php
    session_start();
    include("connection.php");

    ?>

<div class = 'return_borrow'>
     <div style='height: 100px;'></div>
    <form action='' method='POST'>
        <div class='input'>
            <p class='label'>Member Username</p>
            <input list= 'username_list' class='inputbox'  type='text' name='username' required>
                <datalist id="username_list">
                  <option style="color:red;" value="Chrome"> HAHA</option>
                </datalist>
        </div>
        </form>
  </div>
