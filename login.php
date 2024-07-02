<?php
session_start(); // Start session for storing user authentication status

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login_type'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "patient"; // Assuming your database name is 'patient'

    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_type = $_POST['login_type'];

    // Determine the table based on the login type
    $table = ($login_type === 'patient') ? 'patient' : 'doctor';

    // Retrieve user information from the database based on email
    $sql = "SELECT * FROM `$table` WHERE `email`='$email'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        $_SESSION['user_id'] = $row['id'];

        // Verify password
        if(password_verify($password, $hashedPassword)) {
            // Authentication successful
            $_SESSION['email'] = $email; // Store user email in session for future reference
            $_SESSION['login_type'] = $login_type; // Store login type in session
            
            // Redirect to the respective dashboard based on the login type
            if ($login_type === 'patient') {
                header("Location: Dashboard.php"); // Redirect to patient dashboard
            } else {
                header("Location: Doctor.php"); // Redirect to doctor dashboard
            }
            exit();
        } else {
            $error_message = "Incorrect email or password"; // Display error message
        }
    } else {
        $error_message = "User not found"; // Display error message
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
    <title>Login</title>
</head>
<body>
    <header class="header">

        <h1>QUICK SLOT</h1>
        <button class="loginbtn" onclick="window.location.href='index.php'">Sign-Up</button>

</header>

<div class="container logincontainer">
    
    <img src="./Images/login.png" alt="Password Icon" class="passwordicon">
    <h1>LOGIN</h1>
    <?php if(isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="" method="post">
        <br>
        <input type="email" name="email" id="email" required placeholder="Enter Email" class="inputlogin"><br>
        <br>
        <input type="password" name="password" id="password" required placeholder="Enter Password"><br>
        <br>
        <button type="submit" class="btn" name="login_type" value="patient">Login as Patient</button>
        <button type="submit" class="btn" name="login_type" value="doctor" >Login as Doctor</button>
    </form>
</div>
</body>
</html>
