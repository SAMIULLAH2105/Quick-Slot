<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Physical Consultation</title>
    <style>
        /* CSS styling for doctor profile */
/* CSS styling for doctor-appointment-container */

*{
    margin: 0;
    padding: 0;
}
.header {
  /* background-color: rgb(27, 19, 83); */
  background-color: rgb(11, 11, 42);
  position:sticky;
  top:1px;
  color: rgb(255, 255, 255);
  min-height: 10vh;
  /* width: 100%; */
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0px 150px;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  margin-bottom:20px;
}
.btn {
  /* position: absolute; */
  /* right: 40px; */
  background-color: #4CAF50; /* Green background */
  border: none;
  color: white; /* White text */
  padding: 15px 20px; /* Padding */
  margin-bottom:20px;
  text-align: center; /* Center text */
  text-decoration: none; /* Remove underline */
  display: inline-block; /* Display as inline-block */
  font-size: 16px; /* Font size */
  border-radius: 5px; /* Rounded corners */
  cursor: pointer; /* Cursor on hover */
  transition: background-color 0.3s; /* Smooth transition */
  width:200px;
}
.btn a{
    text-decoration:none;
    color:#fff;
}
.loginbtn:hover {
  background-color: #45a049; /* Darker green on hover */
}
.mainhead{
    text-align:center;
}
body{
    
    background-color: #a3b9dada;
  }
.doctor-appointment-container {
    
    background-color: #f9f9f9;
    padding: 20px;
    /* margin:50px */
    margin-bottom: 20px;
    margin-left: 10%;
    margin-right: 10%;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    display: flex;
    
    justify-content: space-between;
    
}

/* CSS styling for doctor profile */
.doctor-profile {
    flex: 1;
    padding-right: 20px;
}

.doctor-profile h2 {
    color: #333;
    margin-top: 0;
}

.doctor-profile p {
    margin: 5px 0;
}

/* CSS styling for appointment details */
.appointment-details {
    flex: 1;
    padding-left: 20px;
}

.appointment-details h2 {
    color: #333;
    margin-top: 0;
}

.appointment-details p {
    margin: 5px 0;
}

/* Style for horizontal rule */
hr {
    margin: 20px 0;
    border: none;
    border-top: 1px solid #ccc;
}
form{
    /* background-color:red; */
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
}
#input{
    width:50%;
    height:40px;
    border-radius:8px;
    border:2px solid black
}
#searchbtn{
    width:100px;
    height:40px;
    margin-left:5px;
    background:gray;
    color:black;
    font-weight:bolder;
    
    border-radius:8px;
}


    </style>
</head>
<body>

<header class="header">
    <h1>QUICK SLOT</h1>
</header>

<form method="GET" action="">
    <input type="text" name="search_query" placeholder="Search by category or name" id="input">
    <button type="submit" id="searchbtn">Search</button>
</form>
    
<!-- <h1 class="mainhead">APPOINTMENT</h1> -->
    
<?php

function calculateAge($dob) {
    $dob = new DateTime($dob);
    $now = new DateTime();
    $interval = $now->diff($dob);
    return $interval->y; // Return years from the interval
}
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

// Check if a search query is submitted
if(isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    // Modify SQL query to include search conditions
    $sql = "SELECT d.name AS doctor_name, d.gender, d.age, d.doctorcategory, d.email AS doctor_email, d.phone AS doctor_phone,
               a.Date, a.StartTime, a.EndTime, a.MaxPatients, a.Place, a.Mode
            FROM doctor d
            JOIN appointmentslots a ON d.id = a.DoctorID
            WHERE (d.name LIKE '%$search_query%' OR d.doctorcategory LIKE '%$search_query%') AND a.Mode = 'physical'";
} else {
    // Default SQL query if no search query is provided
    $sql = "SELECT d.name AS doctor_name, d.gender, d.age, d.doctorcategory, d.email AS doctor_email, d.phone AS doctor_phone,
               a.Date, a.StartTime, a.EndTime, a.MaxPatients, a.Place, a.Mode
            FROM doctor d
            JOIN appointmentslots a ON d.id = a.DoctorID
            WHERE a.Mode = 'physical'";
}



// Execute SQL query
$result = $conn->query($sql);

// Check if there are any available appointments
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $age = calculateAge($row["age"]);
?>
        <div class='doctor-appointment-container'>
            <div class='doctor-profile'>
                <h2>Doctor Profile</h2>
                <p><strong>Name:</strong> Dr. <?php echo ucfirst($row["doctor_name"]); ?></p>
                <p><strong>Gender:</strong> <?php echo $row["gender"]; ?></p>
                
                <p><strong>Age:</strong> <?php echo $age; ?></p>
                <p><strong>Category:</strong> <?php echo $row["doctorcategory"]; ?></p>
                <p><strong>Email:</strong> <?php echo $row["doctor_email"]; ?></p>
            </div>
            <div class='appointment-details'>
                <h2>Appointment Details</h2>
                <p><strong>Date:</strong> <?php echo $row["Date"]; ?></p>
                <p><strong>Availabe :</strong> <?php echo $row["StartTime"] , " - ",$row["EndTime"]; ?></p>
                <p><strong>Max Patients:</strong> <?php echo $row["MaxPatients"]; ?></p>
                <p><strong>Mode:</strong> <?php echo $row["Mode"]; ?></p>
            </div>

            <div>
                <button class="btn" >Book Appointment</button>
                <br>

                <?php
                $doctor_phone = $row["doctor_phone"]; // Example phone number

                // Prepending country code
                $country_code = "+92";
                $full_phone_number = $country_code . substr($doctor_phone, 1);
                ?>
                <button class="btn"><a href="whatsapp://send?phone=<?php echo $full_phone_number; ?>">Video Call</a></button>
            </div>
        </div>
<?php
    }
} else {
    echo "No available appointments";
}

// Close connection
$conn->close();
?>

</body>
</html>