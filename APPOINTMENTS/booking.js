function bookAppointment(doctorId, appointmentId, patientId) {
  if (confirm("Are you sure you want to book this appointment?")) {
    console.log("Patient ID:", patientId);
    // Send AJAX request to update appointment time
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Appointment booked successfully
          var response = xhr.responseText;
          alert(response); // Display the response (success message with appointment time)
        } else {
          // Error occurred
          alert("Error: " + xhr.responseText);
        }
      }
    };
    xhr.open("POST", "update_appointment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("doctor_id=" + doctorId + "&appointment_id=" + appointmentId + "&patient_id=" + patientId);
  }
}
