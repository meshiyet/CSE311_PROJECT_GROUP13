<?php 
	$database_name = "MyDatabase";
	$db = mysqli_connect("localhost", "root", "", $database_name);
    if(!$db)
    {
        die("<h1>Database not connected\n". "<br>" . mysqli_error($db) . "<h1>");
    }
    else
    {
      //    echo ("<h1>Database Connected11<h1>");
    }
?>