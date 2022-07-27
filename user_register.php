<html>
    <?php include 'head.php';?>
    <nav>
        <?php include 'menu.php';?>
    </nav> 
    <head>
         <link href = 'CSS/registration.css' rel='stylesheet'>
    </head>
    <body>
        <?php include 'footer.php';?>
         <section class = 'loginPanel'>
            <h1>Create New Account</h1>
            <div class = 'form' >
            <form action="Scripts/registration.php" method="POST" >
                <h4> Enter Name</h4>
                <input class = "textField" type = 'text' id = 'name' name = 'name' required ><br>
                <h4> Enter Username</h4>
                <input class = "textField" type = 'text' id = 'username' name = 'username' required ><br>
                 <h4> Enter Password</h4>
                <input class = "textField"  type = 'text' id = 'password' name = 'password' required ><br>
                <input class = 'loginButton' type = 'submit' id = 'submit' value = 'Login' >
            </form>
         </div>
            <h3>Login Using Socials</h3>
        </section>
    </body>
</html>