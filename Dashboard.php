<?php
session_start();
$userid = $_SESSION['user_id'];


function calculateAge($dob) {
    $dob = new DateTime($dob);
    $now = new DateTime();
    $interval = $now->diff($dob);
    return $interval->y; // Return years from the interval
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "patient"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/x-icon" href="./Images/logo.png" />
    <title>Quick Slot</title>
    
  </head>

<body>

    
    <nav>
      <div class="headerlogodiv">
            <img src="./Images/logo.png" alt="logo" class="headerlogo " onclick="window.location.href='dashboard.php'">

            <h1 >QUICK SLOT</h1>

            <img id="myImage" alt="not found" style="cursor:pointer">

      </div>

      <ul>
        <li><a href="Dashboard.php">Home</a></li>
        <li><a href="#AboutUs">About Us</a></li>
        <li><a href="#review">Reviews</a></li>
        <li><a href="#footer">Contact</a></li>
        <li><a href="./login.php">log Out</a></li>
      </ul>
      
       <div class="personalDetail" style="display:flex; justify-content:center;align-items:center; ">

          <?php 
            $sql1 = "SELECT name FROM patient WHERE id = $userid";
            $result = $conn->query($sql1);

            if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                echo "MR/MS: " .  strtoupper($row["name"]);
              }
            }
          ?>
          <img src="./Images/account.png" alt="" style="width:35px;filter: invert(100%); margin-left:5px" >

       </div>

    </nav>

    
    <!-- Menu hided this is for mobile devices -->
    <div id="menuonclick" style="display:none;  ">
        <ul>
          <li><a href="Dashboard.php">Home</a></li>
         <li><a href="#AboutUs">About Us</a></li>
         <li><a href="#review">Reviews</a></li>
         <li><a href="#footer">Contact</a></li>
        </ul>
      </div>



<?php

$sql = "SELECT d.name AS doctor_name, d.email AS doctor_email, d.doctorcategory, d.phone,
                ab.BookingID AS BookingID, ab.SlotStartTime, ab.SlotEndTime
        FROM appointmentbooked ab
        JOIN doctor d ON ab.DoctorID = d.id
        WHERE ab.PatientID = $userid";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Render the data
        $doctor_phone = $row["phone"];
        $country_code = "+92";
        $full_phone_number = $country_code . substr($doctor_phone, 1);
?>

        <div class='doctor-appointment-container'>
            <form method="post" action="">
                <input type="hidden" name="booking_id" value="<?php echo $row["BookingID"]; ?>">
                
                <p><strong>BookingID:</strong>  <?php echo ucfirst($row["BookingID"]); ?></p>
                <br>
                <div class='doctor-profile'>
                    <h2>Doctor Profile</h2>
                    <p><strong>Name:</strong> Dr. <?php echo ucfirst($row["doctor_name"]); ?></p>
                    <p><strong>Category:</strong> <?php echo $row["doctorcategory"]; ?></p>
                    <p><strong>Email:</strong> <?php echo $row["doctor_email"]; ?></p>
                </div>
                <div class='appointment-details'>
                    <p><strong>Appintment Time:</strong> <?php echo $row["SlotStartTime"] , " - ", $row["SlotEndTime"]; ?></p>
                    <!-- Button for video call  and cancellation-->

                    <button type="submit" name="cancel" class="btn" onclick="return confirm('Are you sure you want to cancel this appointment?');"> &#10006</button>
                     
                    <button class="videoCallBtn"><a href="whatsapp://send?phone=<?php echo $full_phone_number; ?>">Contact</a></button>
                </div>
            </form>
        </div>

<?php
    }
} else {
    echo "";
}

// Handle cancel action
if(isset($_POST['booking_id'])){
    $booking_id_to_delete = $_POST['booking_id'];
    // Execute delete query
    $deleteQuery = "DELETE FROM appointmentbooked WHERE BookingID = '$booking_id_to_delete'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>











    <div class="mainhead">
      <h2>How can we help you today?</h2>
    </div>

    <div class="section1 ">

  

      <div class="container1">
          <a href="./APPOINTMENTS/videoConsultation.php">
          <div class="overlay">
            Video Consultation
          </div>
           </a>
      </div>

    <div class="container2">
        
      <div class="part1">
        <a href="./APPOINTMENTS/physicalConsultation.php">
          <div class="overlay">
            Physical Consultation
          </div>
          </a>
      </div>


        <div class="part2">
          <a href="./APPOINTMENTS/labortary.php">
          <div class="overlay">
            Labortary
          </div>



          </a>
        </div>

      </div>
    </div>
<!-- Getting id which was defined in session -->


    <div class="mainhead">
      <h2>PRECAUTIONS</h2>
    </div>


    


    <div class="main-content" id="mainContent">
  <div class="container" id="itemsContainer">
    <div class="item" id="fever" data-info="Highly contagious respiratory illness caused by a virus. 
    Precautions: Wash hands frequently, wear a mask, social distance.">Fever</div>

    <div class="item" id="heartAttack" data-info="Sudden loss of blood flow to a part of the heart. 
    Precautions: Seek immediate medical attention, CPR training can be helpful.">Heart Attack</div>

    <div class="item" id="pregnancy" data-info="State of carrying or developing one or more embryos inside the body. 
    Precautions: Prenatal care, healthy diet, exercise.">Pregnancy</div>

    <div class="item" id="highBloodPressure" data-info="Consistently high blood pressure over a prolonged period. 
    Precautions: Maintain healthy weight, reduce salt intake, exercise regularly.">High Blood Pressure</div>

    <div class="item" id="breathlessness" data-info="Difficulty in breathing. 
    Precautions: Seek medical attention immediately, identify and avoid triggers.">Breathlessness</div>

    <div class="item" id="diarrhea" data-info="Loose, watery stools that occur frequently. 
    Precautions: Proper hydration, avoid contaminated food/water, maintain hygiene.">Diarrhea</div>

    <div class="item" id="gastritis" data-info="Inflammation of the lining of the stomach. 
    Precautions: Eat smaller meals, avoid irritants like spicy food, stress management.">Gastritis</div>

    <div class="item" id="migraine" data-info="Severe headache, often accompanied by nausea and sensitivity to light or sound. 
    Precautions: Identify and avoid triggers, manage stress, pain medication.">Migraine</div>

    <div class="item" id="typhoidFever" data-info="Bacterial infection causing fever, fatigue, and intestinal problems. 
    Precautions: Clean water and sanitation, vaccination available.">Typhoid Fever</div>

    <div class="item" id="anxietyDepression" data-info="Mental health conditions characterized by feelings of worry, sadness, or a combination of both. 
    Precautions: Seek professional help, healthy lifestyle, relaxation techniques.">Anxiety/Depression</div>

    <div class="item" id="hepatitis" data-info="Acute viral infection of the liver causing flu-like symptoms and jaundice. 
    Precautions: Avoid contaminated food/water, vaccination available in some regions.">Hepatitis</div>

    <div class="item" id="pneumonia" data-info="Bacterial infection causing inflammation of the lungs. 
    Precautions: Vaccination recommended, maintain good hygiene, avoid crowded places.">Pneumonia</div>
  </div>
</div>

<div class="data-popup" id="dataPopup"></div>


<script>
const itemsContainer = document.getElementById('itemsContainer');
const dataPopup = document.getElementById('dataPopup');

itemsContainer.addEventListener('click', function(event) {
  console.log("Clicked..");
  if (event.target && event.target.classList.contains('item')) {
    const data = event.target.getAttribute('data-info');
    dataPopup.textContent = data; // Set the content of the popup

    // Show the popup and add the blur effect
    dataPopup.style.display = 'block';
    document.body.classList.add('blurred'); // Apply blur filter to the entire body
  }
});

// Optionally, add a click event listener to the popup to close it
dataPopup.addEventListener('click', function() {
  dataPopup.style.display = 'none';
  document.body.classList.remove('blurred'); // Remove blur filter
});
</script>






<div class="section3" id="review">
    <h2>Doctor Review Form</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="doctor_name">Doctor Name :</label>
            <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Enter Doctor Name">
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Write your review here..."></textarea>
        </div>
        <button type="submit" class="submitbtn" style="display: block; margin: 10px auto; background-color: #4CAF50; color: white; border: 2px solid #4CAF50; border-radius: 5px; padding: 10px 20px;">Submit Review</button>


    </form>
</div>


<?php
// Assuming you have already established a database connection earlier in your script

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if all required fields are present in the $_POST array
  if(isset($_POST['doctor_name'], $_POST['rating'], $_POST['comment'])) {
      // Retrieve form data
      $doctor_name = $_POST['doctor_name'];
      $rating = $_POST['rating'];
      $comment = $_POST['comment'];

      // Prepare SQL statement to insert data into the reviews table
      $sql = "INSERT INTO reviews (doctor_name, rating, comment) VALUES ('$doctor_name', '$rating', '$comment')";

      if ($conn->query($sql) === TRUE) {
          echo "Review submitted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  } else {
      // If any required field is missing, display an error message
      echo "";
  }
}


$reviewFetching = "SELECT doctor_name, rating, comment FROM reviews";
$result = $conn->query($reviewFetching);

if ($result->num_rows > 0) {
    echo "<h2>Reviews</h2>";
    echo "<table>";
    echo "<tr><th>Doctor</th><th>Rating</th><th>Comment</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['doctor_name'] . "</td>"; // Changed 'doc_name' to 'doctor_name'
        echo "<td>" . $row['rating'] . "</td>";
        echo "<td>" . $row['comment'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No booked appointments found.</p>";
}

?>




<div id="AboutUs">
    <div style="max-width: 960px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 36px; ;">About Us</h2>
        <p >QuickSlot is your premier destination for streamlined healthcare services. Our platform connects patients with experienced healthcare professionals through innovative technology, ensuring convenient access to quality medical care.</p>
        <p >With QuickSlot, you can schedule both video and physical consultations with trusted doctors, making healthcare more accessible and efficient. Our platform also provides comprehensive information about laboratory test places, allowing you to book appointments and access your test results conveniently.</p>
        <p >We understand the importance of preventive healthcare, which is why QuickSlot offers valuable resources and information on precautions for various viruses and diseases. Stay informed and take proactive steps to safeguard your health and well-being with QuickSlot.</p>
    </div>
</div>



    <footer>
      <div class="footer-content" id="footer">
          <h3>Contact Us</h3>
          <p>Email: example@example.com</p>
          <p>Phone: 123-456-7890</p>
      </div>
      <div class="footer-content">
          <h3>Follow Us</h3>
          <ul>
              <li><a href="https://www.facebook.com/">Facebook</a></li>
              <li><a href="https://www.twitter.com/">Twitter</a></li>
              <li><a href="https://www.instagram.com/">Instagram</a></li>
          </ul>
      </div>
      <div class="footer-content">
          <h3>Company Info</h3>
          <p><a href="./Navigations/About.html">About Us</a></p>
          <p>Careers</p>
          <p>Terms of Service</p>
      </div>
  </footer>
  



    <script src="script.js"></script>
  </body>
</html>
