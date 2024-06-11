<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "patient";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get appointment ID (SlotID), doctor ID, and patient ID from AJAX request
$appointmentId = $_POST['appointment_id'];
$doctorId = $_POST['doctor_id'];
$patientId = $_POST['patient_id'];

// Retrieve the current start and end time
$currentTimesQuery = "SELECT StartTime, EndTime FROM appointmentslots WHERE SlotID = $appointmentId";
$result = $conn->query($currentTimesQuery);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $startTime = $row["StartTime"];
    $endTime = $row["EndTime"];
    
    // Check if start and end time are the same
    if ($startTime == $endTime) {
        // If start and end time are the same, remove the slot
        $deleteQuery = "DELETE FROM appointmentslots WHERE SlotID = $appointmentId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "No Slot Available!";
        } else {
            echo "Error: Unable to remove slot.";
        }
    } else {
        // Update appointment time in the database
        $updateQuery = "UPDATE appointmentslots SET StartTime = ADDTIME(StartTime, '00:30:00') WHERE SlotID = $appointmentId";
        if ($conn->query($updateQuery) === TRUE) {
            // Retrieve the updated appointment time
            $updatedTimeQuery = "SELECT StartTime, EndTime FROM appointmentslots WHERE SlotID = $appointmentId";
            $result = $conn->query($updatedTimeQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                $startTimeSetting = $row["StartTime"];
                $startTimeTimestamp = strtotime($startTimeSetting);
                $startTimeTimestamp -= 1800;
                $startTime = date("H:i:s", $startTimeTimestamp);

                $startTimeTimestamp = strtotime($startTime);
                $endTimeTimestamp = $startTimeTimestamp + 1800;
                $endTime = date("H:i:s", $endTimeTimestamp);
                $updateQuery = "UPDATE appointmentslots SET StartTime = ADDTIME(StartTime, '00:30:00') WHERE SlotID = $appointmentId";
                
                // Insert the booking into AppointmentBooked table
                $insertQuery = "INSERT INTO AppointmentBooked (DoctorID, PatientID, SlotStartTime, SlotEndTime, BookingDate, BookingStatus, CreatedTimestamp, UpdatedTimestamp) VALUES ($doctorId, $patientId, '$startTime', '$endTime', CURDATE(), 'Confirmed', NOW(), NOW())";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "Appointment booked successfully from $startTime to $endTime!";
                } else {
                    echo "Error: Unable to save booking information.";
                }
            } else {
                echo "Error: Unable to retrieve updated appointment time.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Error: Unable to retrieve current appointment time.";
}

// Close connection
$conn->close();
?>
