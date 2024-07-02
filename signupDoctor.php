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
    $doctorcategory = $_POST['doctorcategory'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check if all fields are filled
    if ($name && $gender && $age && $doctorcategory && $email && $phone && $password && $confirmpassword && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if passwords match
        if ($password !== $confirmpassword) {
            echo "Passwords do not match";
            exit(); // Stop execution if passwords don't match
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists in the database
        $checkEmailQuery = "SELECT * FROM doctor WHERE email='$email'";
        $result = mysqli_query($con, $checkEmailQuery);
        if(mysqli_num_rows($result) > 0) {
            echo "Email already exists";
            exit(); // Stop execution if email exists
        }

        // Insert data into the database
        $sql = "INSERT INTO `doctor` (`id`, `name`, `gender`, `age`, `doctorcategory`, `email`, `phone`, `password`, `dt`) 
                VALUES (NULL, '$name', '$gender', '$age', '$doctorcategory', '$email', '$phone', '$hashedPassword', current_timestamp())";

        if(mysqli_query($con, $sql)) {
            echo "Account Created and inserted successfully";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Please enter correct values for all fields";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" type="image/x-icon" href="./Images/logo.png" />
    <title>Welcome to Quick Slot</title>
</head>

<body>
    <header class="header">
        <h1>QUICK SLOT</h1>
        <button class="loginbtn" onclick="window.location.href='login.php'">LOG-IN</button>
    </header>

    <div class="section">
        <div class="heroimg">
            <img src="./Images/doc2.png" alt="">
        </div>

        <div class="container">
            <h1>Sign Up</h1>
            <div class="navigationbtn">
                <button class="btns" onclick="window.location.href='index.php'">PATIENT</button>
                <button class="btns" onclick="window.location.href='signupDoctor.php'" style="background-color: grey;">DOCTOR</button>
            </div>

            <form action="" method="post">
                <input type="text" name="name" id="name" placeholder="Enter your name" style="padding: 2px">
                <input type="date" name="age" id="age" value="Enter your age" style="padding: 2px">
                <input type="text" name="gender" id="gender" placeholder="Enter your gender" style="padding: 2px">

                <select name="doctorcategory" id="doctorCategory" class="input" style="padding: 2px">
                    <option value="" disabled selected>Select Specialization</option>
                    <option value="General Physician">General Physician</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Endocrinologist">Endocrinologist</option>
                </select>

                <input type="text" name="phone" id="phone" placeholder="Enter your phone no" style="padding: 2px">
                <input type="email" name="email" id="email" placeholder="Enter your Email" style="padding: 2px">
                <input type="password" name="password" id="password" placeholder="Password" style="padding: 2px">
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" style="padding: 2px">
                <button class="btn" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
