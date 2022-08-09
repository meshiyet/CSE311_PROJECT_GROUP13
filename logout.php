<?php
    session_start();
    if(isset($_SESSION['admin_username']))
    {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("location: admin_login.php");
       
    }
    else
    {

        $_SESSION = array();
        session_unset();
        session_destroy();
        header("location: user_login.php");
    }    
?>