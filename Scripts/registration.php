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



CREATE TABLE USER(firstName VARCHAR(15), 
                  middleName VARCHAR(15), 
                  lastName VARCHAR(15),
                  email VARCHAR(30),
                  phone VARCHAR(15),
                  address VARCHAR(100),
                  dob DATE,
                  gender VARCHAR(10),
                  username VARCHAR(15),
                  password VARCHAR(15)
                  );


                   // $sql = "
                 // INSERT INTO members(username, firstName, middleName, lastName, email, phone, address, dob, gender, password) 
                 // VALUES('$username', '$firstName','$middleName', '$lastName', '$email', '$phone', '$address', '$dob', '$gender', '$password')
                 // ";
                 // if(!mysqli_query($db,$sql))
                 // {
                 //    $errorMassege = "Something went wrong!!";
                 // }
                 // else
                 // {
                 //    $errorMassege = "Registration Complete!";
                 // }




                 INSERT INTO members(username, firstName, middleName, lastName, email, phone, address, dob, gender, password) VALUES('$username', '$$firstName','$middleName', '$lastName', '$email', '$phone', '$address', '$dob', '$gender', '$password1')








                 INSERT INTO members(username, firstName, middleName, lastName, email, phone, address, dob, gender, password) 
VALUES('$username', '$firstName','$middleName', '$lastName', '$email', '$phone', '$address', '$dob', '$gender', '$password');