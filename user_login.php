<html>
    <?php include 'head.php';?>
    <nav>
        <?php include 'menu.php';?>
    </nav> 
    <head>
         <link href = 'CSS/login.css' rel='stylesheet'>
    </head>
    <body>
        <?php include 'footer.php';?>
         <section class = 'loginPanel'>
            <h1>Login To Your Account</h1>
            <div class = 'form' >
            <form>
                <h4> Enter Username</h4>
                <input class = "textField" type = 'text' id = 'username' name = 'username' required ><br>
                 <h4> Enter Password</h4>
                <input class = "textField"  type = 'text' id = 'password' name = 'password' required ><br>
                <input class = 'loginButton' type = 'submit' id = 'submit' value = 'Login' >
            </form>
         </div>
            <h3>Login Usign Accounts</h3>
        </section>
    </body>
</html>