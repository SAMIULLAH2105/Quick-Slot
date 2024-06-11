<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: rgb(11, 11, 42);
            color: white;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        header h1 {
            margin: 0;
        }

        header img {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            height: 40px; /* Adjust height as needed */
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="date"],
        input[type="text"],
        input[type="time"],
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        .mode-selection label{
            display: inline-block;
            margin-right: 20px;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>QUICKSLOT</h1>
        
        <img src="logo.png" alt="Doctor Info Logo">
    </header>

    <h2>Create Opening Slots</h2>
    <form action="" method="post">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time_start">Start Time:</label>
        <input type="time" id="time_start" name="time_start" required>

        <label for="time_end">End Time:</label>
        <input type="time" id="time_end" name="time_end" required>

        <label for="max_patients">Maximum Number of Patients:</label>
        <input type="number" id="max_patients" name="max_patients" required>
        
        
        <label for="Place">Place:</label>
        <input type="text" id="Place" name="Place" required placeholder="Hospital Name / Online">

        <div class="mode-selection">
            <label >Mode of Consultation: </label><br>
            <input type="radio" id="physical" name="mode" value="physical">
            <label for="physical">Physical</label>
            <input type="radio" id="online" name="mode" value="online">
            <label for="online">Online</label>
        </div>

        <button type="submit">Create Slot</button>
    </form>


<?php
session_start();
$userid = $_SESSION['user_id'];

// $row['id']=$_GET['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to MySQL database
    $servername = "localhost"; // Change this to your server name
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $database = "patient"; // Change this to your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve values from the form
    $date = $_POST['date'];
    $start_time = $_POST['time_start'];
    $end_time = $_POST['time_end'];
    $max_patients = $_POST['max_patients'];
    $place = $_POST['Place'];
    $mode = $_POST['mode'];

    // Prepare and execute SQL statement to insert data into the table
    $sql = "INSERT INTO  `appointmentslots`(SlotID, DoctorID, Date, StartTime, EndTime, MaxPatients, Place, Mode) VALUES (NULL, '$userid', '$date', '$start_time', '$end_time', '$max_patients', '$place', '$mode')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>
