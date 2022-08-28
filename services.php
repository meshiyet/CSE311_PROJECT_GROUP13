<?php 
    include("connection.php");
    session_start();
 ?>
<html>
    <head>

        
    </head> 
    
    <body>
        <?php 
        include ("navbar.php");
        ?>
        <div class="container">            
            <div class="top-part">
                <div class="content">
                    <h1>Using the Library</h1>
                    <p>Anyone can visit Dhaka Library in person or online and browse the available collections. To access all the services, you need a membership.</p>
                    <br>
                    <p>The website enables registered members to browse the collection, add books to ther wishlist, and view the status of their borrowed books. Once registered, the member will receive a call to collect their library card from their local branch.</p>
                </div>      
            </div>
            <div class="middle-part">
                <div class="content">
                    <h1>Membership</h1>
                    <p>Your library card gives you access to all existing and future branches of Dhaka Library. In addition to borrowing books, you can add books to your wishlist, use the library computers for school, work or fun and participate in any events hosted by the library.</p>
                    <br>
                    <p>You can obtain a library card by registering to become a member in person or online and then collecting the card from your local branch.</p>
                    <br>
                    <ul class='services'>
                    <li id='member-button'><a id='member-registration' href='user_register.php'>Become a member online</a></li>        
                    </ul>
                    <br>
                    <span>Eligibility</span>
                    <br>
                    <p>Anyone over 13 is eligible for membership and a free library card.</p>
                    <br>
                    <span>Expiry</span>
                    <br>
                    <p>Your membership will expire if you remain inactive for 2 years.</p>
                    <br>
                    <span>Lost Library Cards</span>
                    <br>
                    <p>If you lose your card or you suspect that it has been stolen, report the missing card immediately.</p>
                </div>      
            </div>
            <div class="bottom-part">
                <div class="content">
                    <h1>Borrowing and Returns</h1>
                    <p>Dhaka Library offers thousands of books to borrow from any of its locations.  All you need is your library card for access!</p>
                    <br>
                    <span>How many books may I borrow and for how long?</span>
                    <br>
                    <p>You may borrow upto 15 books at any given time. Each book is lent for a three week period. If you need more time, you can renew the book(s) up to five times as long as no one else is waiting for them. If you miss a due date – eligible items will automatically renew on or shortly after their due date but a late fee will be charged.</p>
                    <br>
                    <span>Returning Items</span>
                    <br>
                    <p>Books should be returned to the branch they were borrowed from. Any book returned within the due date can be dropped off to the returns pile and will be checked in within the same day. Books returned to returns pile after the library is closed will be back-dated to the previous day’s date as long as they are in the first collection of materials prior to 8 AM. Books returned past its initial due date will be checked in immediately and the late fee will be collected.</p>
                    <br>
                    <span>Renewing items</span>
                    <p>Need more time to finish that book? We understand. You can extend the time you have on most books by renewing them.
                    </p>
                    <br>
                    <p>All eligible book(s) you have checked out can be renewed on or shortly before its due date. You are able to extend your loan period up to 5 times as long as there are no other holds on the material.</p>
                    <br>
                    <p>To renew, call or visit your local library during business hours. Be sure to have your library card and the info about the book(s) you wish too renew.</p>
                    <br>
                    <p>No late fees are applicable on renewals
                    </p>
                    <br>
                    <span>Lost or Damaged</span>
                    <br>
                    <p>Library materials that are lost or remain unreturned after the due date are automatically billed to your account.</p>
                    <br>
                    <p>You may also be charged for items that are damaged during your loan period.</p>
                </div>      
            </div>
        </div>
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
    padding-bottom: 1rem;
}

span{
    font-weight: bold;
}

.services {
    list-style-type: none;
    font-family: "Roboto", sans-serif;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: white;
}

  li {
    float: left;
  }
  
  li a {
    display: block;
    color: black;
    text-align: center;
    font-weight: bold;
    /* padding: 14px 20px; */
    text-decoration: none;
  }

#member-registration {
    border-radius: 10px;
    background-color: plum;
  }

  #member-button a:hover {
    background-color: rgb(255, 255, 115);
    text-decoration: none;
  }
</style>