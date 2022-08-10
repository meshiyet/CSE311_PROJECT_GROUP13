<html>
    <?php
     session_start();
     if(isset($_SESSION['username']))
     {
        header("location: user_profile.php");
     }
        include("connection.php");
        $firstNameValue = "";
        $middleNameValue = "";
        $lastNameValue = "";
        $emailValue = "";
        $phoneValue = "";
        $addressValue = "";
        $dayValue = "Day";
        $monthValue = "Month";
        $yearValue = "Year";
        $genderValue = "Select";
        $usernameValue = "";
        $password1Value = "";
        $password2Value = "";
        $errorMassege = "";
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $day = (string)$_POST['day'];
            $month = $_POST['month'];
            $year = (string)$_POST['year'];
            $gender = $_POST['gender'];
            $username = $_POST['username'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            $no_of_month = array("
                January" => "1","February" => "2", "March" => "3", 
                "April" => "4", "May" => "5", "June" => "6",
                "July" => 7, "August" => 8, "September" => 9,
                "October" => "10", "November" => "11", "December" => "12"
            );
            $dob = $year."-".$no_of_month[$month]."-".$day;

            $sql = " SELECT username FROM member WHERE username = '${username}'";
            $result_in_member = mysqli_query($db,$sql);
            $sql = " SELECT username FROM admin WHERE username = '${username}'";
            $result_in_admin = mysqli_query($db,$sql);
            $found = mysqli_num_rows($result_in_member) + mysqli_num_rows($result_in_admin);
            /*Found is greater than zero when any member or admin is using the username*/

            if($found > 0)
            {
                $errorMassege = "this username is not available!\n";
                $firstNameValue = $firstName;
                $middleNameValue = $middleName;
                $lastNameValue = $lastName;
                $emailValue = $email;
                $phoneValue = $phone;
                $addressValue = $address;
                $dayValue =  $day;
                $monthValue = $month;
                $yearValue = $year;
                $genderValue = $gender;
                $usernameValue = $username;
                $password1Value = $password1;
                $password2Value = $password2;
            }
            elseif($password2 !== $password1)
            {
                $errorMassege = "Both Password not matched\n";
                $firstNameValue = $firstName;
                $middleNameValue = $middleName;
                $lastNameValue = $lastName;
                $emailValue = $email;
                $phoneValue = $phone;
                $addressValue = $address;
                $dayValue =  $day;
                $monthValue = $month;
                $yearValue = $year;
                $genderValue = $gender;
                $usernameValue = $username;
                $password1Value = $password1;
                $password2Value = $password2;
            }

            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $errorMassege = "Invalid email format";
                $firstNameValue = $firstName;
                $middleNameValue = $middleName;
                $lastNameValue = $lastName;
                $emailValue = $email;
                $phoneValue = $phone;
                $addressValue = $address;
                $dayValue =  $day;
                $monthValue = $month;
                $yearValue = $year;
                $genderValue = $gender;
                $usernameValue = $username;
                $password1Value = $password1;
                $password2Value = $password2;
              
            }
            else if($day == "Day" || $month == "Month" || $year == "Year" || $gender == "Select")
            {
                $errorMassege = "Select Date of birth and Gender correctly!\n";
                $firstNameValue = $firstName;
                $middleNameValue = $middleName;
                $lastNameValue = $lastName;
                $emailValue = $email;
                $phoneValue = $phone;
                $addressValue = $address;
                $dayValue =  $day;
                $monthValue = $month;
                $yearValue = $year;
                $genderValue = $gender;
                $usernameValue = $username;
                $password1Value = $password1;
                $password2Value = $password2;
            }
           else
            {
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                $sql ="INSERT INTO member(username, first_name, middle_name, last_name, email, phone, address, dob, gender, password) 
                       VALUES('$username', '$firstName','$middleName', '$lastName', '$email', '$phone', '$address', '$dob', '$gender', '$hashed_password')"; 
                 if(mysqli_query($db,$sql))
                 {
                    $errorMassege = "Registration Complete";
                 }
                 else
                 {
                    $errorMassege = " Oh no ! Something went Wrong.";
                 }
            }

        }
    ?>
    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <head>
         <link href = 'CSS/registration.css' rel='stylesheet'>
    </head>
    <body>
      
        <!-- FORM  START-->
         <section class = 'loginPanel'>
             <div class = 'top'>
                <h1>Become a member<h1>
            </div>
            <form action="" method="POST">
                <div class="gap"></div>
            <!-- NAME START-->
            <div class = 'threeElement'>
                <div class = 'eachOFTheree'>
                    <label>First Name</label><br>
                    <input type="text" name = 'firstName' value = '<?=$firstNameValue?>' required>
                </div>
                 <div class = 'eachOFTheree'>
                    <label>Middle Name</label><br>
                    <input type="text" name = 'middleName' value = '<?=$middleNameValue?>'>
                </div>
                 <div class = 'eachOFTheree'>
                    <label>Last Name</label><br>
                    <input type="text" name = 'lastName' value = '<?=$lastNameValue?>' required>
                </div>
            </div>
             <!-- NAME END -->
             <div class="gap"></div>
             <div class = 'threeElement'>
                <div class = 'eachOFTheree' >
                    <label>Email</label><br>
                    <input type="text" name = 'email' value = '<?=$emailValue?>' required>
                </div>
                <div class = 'eachOFTheree' >
                     <label>Phone No.</label><br>
                    <input type="text" name = 'phone' value = '<?=$phoneValue?>' required>
                </div>
                <!-- ADDRESS -->

                 <div class = 'eachOFTheree'>
                     <label>Address</label><br>
                    <input type="text" name = 'address' value = '<?=$addressValue?>' required>
                </div>
                <!-- ADDRESS -->


                <div class="gap"></div>

            <div class= 'threeElement'>    

                <div class = 'eachOFTheree'>
                     <label for="month">Date of Birth</label><br>
                      <select name="day" id="day">
                        <option value='<?=$dayValue?>'> <?=(string)$dayValue?> </option>
                       <?php
                            for($i = 1; $i<=31; $i++)
                            {
                                echo "<option value=$i>$i</option>";
                            }
                        ?>
                    </select>
                     <select name="month" id="month">
                        <option value='<?=$monthValue?>'><?=$monthValue?></option>
                       <?php
                            $day_of = 31;
                            $months = array("January" => 31, "February" => 28, "March" => 31, "April" =>30, "May" =>31, "June"=>30, "July"=>31, "August"=>31, "September"=>30, "October"=>31, "November"=>30, "December"=>31);
                            foreach ($months as $key => $value) {
                            
                                 echo "<option value='$key'>$key</option>";
                            }
                        ?>
                    </select>
                     <select name="year" id="year">
                        <option value="<?=$yearValue?>"><?=$yearValue?></option>
                       <?php
                            for($i = 2022; $i>=1980; $i--)
                            {
                                echo "<option value=$i>$i</option>";
                            }
                        ?>
                    </select>
                   
                </div>
                <!-- DOB -->
                <div class = 'eachOFTheree'>
                    <label for="gender">Gender</label><br>
                    </select>
                     <select name="gender" id="gender">
                        <option value="<?=$genderValue?>"><?=$genderValue?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="hidden">Hidden</option>
                    </select>
                </div>  

                 <!-- <div class = 'eachOFTheree'>
                    <label for="month">Select Gender</label><br>
                    </select>
                     <select name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="hidden">Hidden</option>
                       
                    </select>
                </div>  -->
                
            </div> 
            <div class="gap"></div>

            <!-- USERNAME PASSWORD -->
            <div class = 'threeElement'>
                <div class = 'eachOFTheree' >
                    <label>Choose Username</label><br>
                    <input type="text" name = 'username' value = '<?=$usernameValue?>' minlength="5" maxlength="15" placeholder ="will be used later to login" required>
                </div>
                <div class = 'eachOFTheree' >
                     <label>Password</label><br>
                    <input type="password" name = 'password1' value = '<?=$password1Value?>' minlength="5" maxlength="15" required>
                </div>
                 <div class = 'eachOFTheree'>
                     <label>Confirm Password</label><br>
                    <input type="password" name = 'password2'minlength="5" value = '<?=$password2Value?>' maxlength="15"  required>
                </div> 
            </div>     
            <!-- USERNAME PASSWORD -->

            <div class='error'>
                <p><?=$errorMassege?></p>
            </div>
            <input class= 'loginButton' type="submit" name="submit" value="Register">
         </form>
           <!-- FORM  END-->
        </section>
    </body>

    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>