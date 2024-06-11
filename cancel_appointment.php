<?php
session_start();

$userid = $_SESSION['user_id'];


$servername = "localhost"; // Your MySQL server name
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "patient"; // Your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM appointmentbooked WHERE PatientID = $userid ";

if ($conn->query($sql) === TRUE) {
    echo "Appointment cancelled successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
