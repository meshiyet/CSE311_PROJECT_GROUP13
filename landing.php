<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <body>
        <div class="flex-container">
            <div class="banner">
                <h1>Landing page in development</h1>
            </div>
            <div class="featured">
                <h1>Featured books</h1>
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
    flex-direction: column;
    /* justify-content: center; */
    align-items: center;
    margin-left: 10%;
    margin-right: 10%;
    background-color: gray;
    font-family: 'Roboto', sans-serif;
}

    .banner {
        margin: 0;
        padding: 0;
        max-width: 100%;
        max-height: 100%;
        background-image: url('images/landing_background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* position: relative; */
    }

    .featured {
        align-content: flex-start;
    }


</style>