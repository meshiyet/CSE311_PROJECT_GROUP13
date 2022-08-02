<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <nav>
        <?php include 'navbar.html';?>
    </nav> 
    <body>
        <div class="flex-container">
            <div class="banner">
                <h1>Landing page in development</h1>
            </div>
        </div>
    </body>
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>

<style>
   
    .flex-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 10%;
    margin-right: 10%;
    background-color: gray;
    font-family: 'Roboto', sans-serif;
}

    .banner {
        margin: 0;
        padding: 0;
        max-width: max-content;
        background-image: url('images/landing_background.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .content {
        align-items: flex-start;
    }

</style>