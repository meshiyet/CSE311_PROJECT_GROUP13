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
                    <label for = 'username'> Enter Username</label><br>
                    <input type = 'text' id = 'username' name = 'username' required ><br>
                    <label for = 'password'>Enter Password</label><br>
                    <input type = 'text' id = 'password' name = 'password' required ><br>
                    <input type = 'submit' id = 'password' value = 'Login' >
                </form>
         </div>
            <h3>Login Usign Accounts</h3>
        </section>
    </body>
</html>


<!-- 
<form>
                <label for = 'username'> Enter Username</label>
                <input type = 'text' id = 'username' name = 'username' required ><br>
                <label for = 'password'>Enter Password</label>
                <input type = 'text' id = 'password' name = 'password' required >
            </form>
 -->