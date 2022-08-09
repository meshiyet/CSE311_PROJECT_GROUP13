<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Dhaka Library</title>
    </head>
    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <body>
        <div class="container">
            <div class="banner">
                    <div class="banner-content">
                        <div class="search">
                            <input type="text" class="searchTerm" placeholder="Search for books by ISBN, title, or author">
                            <button href="#" type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
            </div>
            
            <div class="featured">
                <div class="featured-content">
                    <h1>Featured books</h1>
                    <div class="featured-items">
                        <div class="book-container">
                            <img class="cover" src="">
                            <h3 class="title">book 1</h3>
                            <p class="author">author</p>
                            <br>
                            <p class="availability">available in: branch 1, branch 2, branch 3</p>
                        </div>
                        <div class="book-container">
                            <img class="cover" src="">
                            <h3 class="title">book 2</h3>
                            <p class="author">author</p>
                            <br>
                            <p class="availability">available in: branch 1, branch 2, branch 3</p>
                        </div>
                        <div class="book-container">
                            <img class="cover" src="">
                            <h3 class="title">book 3</h3>
                            <p class="author">author</p>
                            <br>
                            <p class="availability">available in: branch 1, branch 2, branch 3</p>
                        </div>
                        <div class="book-container">
                            <img class="cover" src="">
                            <h3 class="title">book 4</h3>
                            <p class="author">author</p>
                            <br>
                            <p class="availability">available in: branch 1, branch 2, branch 3</p>
                        </div>
                        <!-- <div class="book-container">
                            <img class="cover" src="">
                            <h3 class="title">book 5</h3>
                            <p class="author"></p>
                            <p class="availability"></p>
                        </div> -->
                    </div>
                </div>      
            </div>
        </div>
    </body>
    <footer>
        <!-- <?php include 'footer.html';?> -->
    </footer>
</html>

<style>

.container{
    display: flex;
    flex-direction: column;
    position: relative;
    justify-content: center;
    background-color: lemonchiffon;
    font-family: 'Roboto', sans-serif;
    /* min-height: 100vh; */
}

.banner{
    margin: 0 10%;
    padding: 0;
    height: 15rem;
    /* width: 100%; */
    background-color: gray;
    background-image: url("images/landing_background.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;

}

.banner-content{
        background-color: white;
        border-radius: 10px;
        height: 50%;
        width: 50%;
        display: flex;
        flex-direction: row;
        justify-content: center;
}

.search {
  width: 75%;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.searchTerm {
  width: 100%;
  border: 2px solid gray;
  border-right: none;
  padding: 10px;
  height: 50px;
  outline: none;
  color: black;
}

.searchTerm:focus{
  color: black;
}

.searchButton {
  width: 50px;
  height: 50px;
  border: 1px solid plum;
  background: plum;
  text-align: center;
  color: #fff;
  cursor: pointer;
  font-size: 20px;
}
.featured{
    margin: 2rem 10%;
    justify-content: left;
}

.featured-content{
    background-color: white;
    height: auto;
}

h1{
    padding-bottom: 1rem;
}

.featured-items{
    /* display: flex;
    flex-direction: row;
    justify-content: space-around;
    flex-wrap: nowrap; */
    height: 20rem;
    display: grid;
    grid-template: 1fr / repeat(4, 1fr);
}

.book-container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: pink;
    padding: 0 15%;
    border: 2px magenta solid;
    font-family: "Roboto", sans-serif;
    font-size: 14px;
}

.cover{
    height: 13rem;
    width: 10rem;
    background-color: grey;
    margin-bottom: 1rem;
}

.title{
    text-align: center;
}

.author{
    text-align: center;
    color: darkslategrey;
    font-weight: bold;
    font-style: italic;
}

.availibility{
    text-align: center;
    font-size: xx-small;
}
</style>