<?php
    $db = mysqli_connect("localhost", "root", "", "MyDatabase");
    if(!$db)
    {
        die("<h1>Database not connected\n". "<br>" . mysqli_error($db) . "<h1>");
    }
    else
    {
        echo ("<h1>Database Connected<h1>");
    }

    // $sql = "CREATE TABLE USER(name VARCHAR(30), username VARCHAR(12), password VARCHAR(16))";
    // if(!mysqli_query($db,$sql))
    // {
    //     echo ("<h1>TABLE EXISTS<h1>");
    // }
    // else
    // {
    //      echo ("<h1>TABLE CREATED<h1>");
    // }
    $name  = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO USER(name, username, password) VALUES('$name', '$username','$password')";


    if(!mysqli_query($db,$sql))
    {
        echo ("<h1>TABLE EXISTS<h1>");
    }
    else
    {
         echo ("<h1>Registration Complete<h1>");
    }
?>