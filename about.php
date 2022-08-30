<?php 
    include("connection.php");
    session_start();
 ?>
<html>
    <body>
        <?php 
        include ("navbar.php");
        ?>
        <div class="container">             
            <div class="top-part">
                <h1>About</h1>
                <div class="content">
                    <h2>This is something we all do together! &#10024;</h2>
                    <br>
                    <p>Guided by our mission of literacy and learning and our dedication to patron-focused services and programs, Dhaka Library is a destination space for information, technology, community building, social connection and fun.</p>
                    <br>
                    <p>Currently spanning three branches in the city centre and more to come, Dhaka Library is your ticket away from the hustle and bustle and into the world of books!</p>
                </div>
            </div>
            <div class="bottom-part">
                <h3>Developed by &#128296;</h3>
                <div class="content-grid">
                    <div class="dev">
                        <img class="profile" src="images/tahmid.jpg">
                        <h3 class="name">Md Tahmid Ahmed Rakib</h3>
                    </div>
                    <div class="dev">
                        <img class="profile" src="images/mashiyat.jpg">
                        <h3 class="name">Mashiyat Nayeem</h3>
                    </div>
                    <div class="dev">
                        <img class="profile" src="images/nourin.jpg">
                        <h3 class="name">Fahmida Akter Nourin </h3>
                    </div>
                </div>
            </div>
        <div style="height:100px;"></div>
    </body>

    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>

<style>
    html {
    box-sizing: border-box;
    /* margin-top: 120px; */
    min-height: 100vh;
  }
  
*, *:before, *:after {
    box-sizing: inherit;
  }
.container{
    display: flex;
    flex-direction: column;
    position: relative;
    justify-content: center;
    background-color: white;
    font-family: 'Roboto', sans-serif;
    /* min-height: 100vh; */
}

.top-part, .bottom-part{
    margin: 1.5rem 10%;
    justify-content: left;
}

.content{
    background-color: white;
    height: auto;
}

.content-grid{
    height: 20rem;
    width: auto;
    display: grid;
    grid-template: 1fr / repeat(3, 1fr);
}

.dev{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 10%;
    /* border: 2px magenta solid;
    background-color: pink; */
    font-family: "Roboto", sans-serif;
    font-size: 14px;
}

h1{
    padding-bottom: 2rem;
}

h2{
    padding-bottom: 0.5rem;
}

.hours, .contact{
    font-weight: bold;
    padding-top: 1rem;
    padding-bottom: 0.5rem;
}
  li {
    float: left;
    padding-left: 1rem;
  }
  
  .profile{
    height: 15rem;
    width: 15rem;
    background-color: grey;
    margin-bottom: 1rem;
}

.name{
    text-align: center;
}
</style>