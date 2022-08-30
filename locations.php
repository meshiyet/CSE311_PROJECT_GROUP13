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
                <h1>Hours & Locations</h1>
                <div class="content">
                    <h2>Banani</h2>
                    <?php
                        $sql = "SELECT address FROM branch WHERE name = 'Banani'";
                        $address = mysqli_query($db, $sql);
                        while($row = $address->fetch_assoc())
                        {
                            $branchAddress = $row['address'];
                            echo "<div class='information'>
                            <p>$branchAddress</p>
                            </div>";
                        }
                    ?>
                    <p class="contact">Contact &#128222;</p>
                    <?php
                        $sql = "SELECT phone FROM branch_phone WHERE branch_name = 'Banani'";
                        $phone = mysqli_query($db, $sql);
                        while($row = $phone->fetch_assoc())
                        {
                            $branchPhone = $row['phone'];
                            echo "<div class='phone'>
                            <p>+88$branchPhone</p>
                            </div>";
                        }
                    ?>
                    <p class="hours">Hours:<p>
                        <li>Sunday: 8am-10pm</li>
                        <br>
                        <li>Friday: 8am-11pm</li>
                        <br>
                        <li>Saturday: 8am-10pm</li>
                        <br>
                </div>     
            </div>
            <div class="middle-part" id = 'middle'>
                <div class="content">
                <h2>Bashundhara</h2>
                    <?php
                        $sql = "SELECT address FROM branch WHERE name = 'Basundhara'";
                        $address = mysqli_query($db, $sql);
                        while($row = $address->fetch_assoc())
                        {
                            $branchAddress = $row['address'];
                            echo "<div class='information'>
                            <p>+88$branchAddress</p>
                            </div>";
                        }
                    ?>
                    <p class="contact">Contact &#128222;</p>
                    <?php
                        $sql = "SELECT phone FROM branch_phone WHERE branch_name = 'Basundhara'";
                        $phone = mysqli_query($db, $sql);
                        while($row = $phone->fetch_assoc())
                        {
                            $branchPhone = $row['phone'];
                            echo "<div class='phone'>
                            <p>+88$branchPhone</p>
                            </div>";
                        }
                    ?>
                    <p class="hours">Hours:<p>
                        <li>Wednesday: 8am-10pm</li>
                        <br>
                        <li>Friday: 8am-11pm</li>
                        <br>
                        <li>Saturday: 8am-10pm</li>
                        <br>
                </div>      
            </div>
            <div class="bottom-part" id = "bottom">
                <div class="content">
                <h2>Dhanmondi</h2>
                    <?php
                        $sql = "SELECT address FROM branch WHERE name = 'Dhanmondi'";
                        $address = mysqli_query($db, $sql);
                        while($row = $address->fetch_assoc())
                        {
                            $branchAddress = $row['address'];
                            echo "<div class='information'>
                            <p>$branchAddress</p>
                            </div>";
                        }
                    ?>
                    <p class="contact">Contact &#128222;</p>
                    <?php
                        $sql = "SELECT phone FROM branch_phone WHERE branch_name = 'Dhanmondi'";
                        $phone = mysqli_query($db, $sql);
                        while($row = $phone->fetch_assoc())
                        {
                            $branchPhone = $row['phone'];
                            echo "<div class='phone'>
                            <p>+88$branchPhone</p>
                            </div>";
                        }
                    ?>
                    <p class="hours">Hours:<p>
                        <li>Tuesday: 8am-10pm</li>
                        <br>
                        <li>Friday: 8am-11pm</li>
                        <br>
                        <li>Saturday: 8am-10pm</li>
                        <br>
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

.top-part, .middle-part, .bottom-part{
    margin: 1.5rem 10%;
    justify-content: left;
}

.content{
    background-color: white;
    height: auto;
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
  
</style>