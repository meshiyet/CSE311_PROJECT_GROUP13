<?php
    $db = mysqli_connect("localhost", "root", "", "MyDatabase");
    if(!$db)
    {
        die("<h1>Database not connected\n". "<br>" . mysqli_error($db) . "<h1>");
    }
    else
    {
        echo ("<h1>Database Connected11<h1>");
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    //echo $username . " " . $password;
    //$sql = "INSERT INTO USER(name, username, password) VALUES('$name', '$username','$password')";
    $sql = "SELECT name, username, password FROM USER WHERE username = '${username}'";
    $result = mysqli_query($db,$sql);
    
    // if($result["password"] == $password)
    // {
    //     echo "<h1>WELCOME ${result["name"]}</h1>";
    // }
    // else
    // {
    //     echo "<h1>WRONG PASSWORD</h1>";
    // }
    $user = "";
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            $user = $row;
        }
    } else 
    {
      echo "0 results";
    }

    if($user['password'] == $password)
    {
        echo "<h1>WELCOME ${user["name"]}</h1>";
    }
    else
    {
        echo "<h1>WRONG PASSWORD</h1>";
    }
?>