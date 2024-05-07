    <!-- signup page -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="signup.css">
        <title>Welcome to Quick Slot</title>
    </head>
    <body>
        <header class="header">

        <h1>QUICK SLOT</h1>

        <button class="loginbtn" onclick="window.location.href='login.php'">LOG-IN</button>

        <!-- <ul>
            <li>Home</li>
            <li>Doctors</li>
            <li>Review</li>
            <li>Contact</li>
            <li><a href="./Navigations/About.html">About us</a></li>
        </ul>

        <input type="text" placeholder="Search" class="search"> -->

    </header>

    <div class="section">

        <div class="heroimg">
            
                    <img src="./Images/doc2.png" alt="">
        </div>
        
        
        
        

        <div class="container">
                    <!-- <img src="./Images/doctor.png" alt=""> -->

            
            <!-- <h3>QuickSlot Sign-up Page</h3> -->
            
            <h1>Sign Up</h1>
            <div class="navigationbtn">
                <!-- <button class="btns"><a href="index.php">LOGIN</a></button> -->
                <button class="btns" onclick="window.location.href='index.php'" style="background-color: grey;">PATIENT</button>
                <!-- doctor ka php page banao -->
                <button class="btns" onclick="window.location.href='signupDoctor.php'">DOCTOR</button>
            </div>
        

            
<?php
session_start(); // Start session for storing user authentication status

if(isset($_POST['name'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "patient"; // Assuming your database name is 'patient'

    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if ($name && $gender && $age && $email && $phone && $password && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists in the database
        $check_query = "SELECT * FROM patient WHERE email='$email'";
        $result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists. Please choose a different email.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Proceed with insertion
            $sql = "INSERT INTO `patient`.`patient` (`name`, `age`, `gender`, `email`, `phone`, `password`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$hashedPassword', current_timestamp())";

            if(mysqli_query($con, $sql)) {
                echo "Account created and inserted successfully";
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    } else {
        echo "Please enter correct values";
    }

    mysqli_close($con);
}
?>



        <form action="" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="text" name="phone" id="phone" placeholder="Enter your phone no">
            <input type="email" name="email" id="email" placeholder="Enter your Email">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
            <!-- <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Describe in detail what are you facing ."></textarea> -->
            <button class="btn" type="submit">Submit</button>
        </form>

        </div>
    </div>

    <script src="script.js"></script>
    </body>
    </html>
