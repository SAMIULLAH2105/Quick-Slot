// script.js

document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('form');

  form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission by default

      var name = document.getElementById('name').value.trim();
      var age = document.getElementById('age').value.trim();
      var gender = document.getElementById('gender').value.trim();
      var phone = document.getElementById('phone').value.trim();
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirmpassword').value;

      // Regular expressions
      var emailRegex = /\S+@\S+\.\S+/;
      var phoneRegex = /^\d{11}$/; // Matches exactly 11 digits for phone number
      var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/; // Password must be at least 6 characters, contain at least one digit, one lowercase and one uppercase letter

      // Simple validation
      if (name === '' || age === '' || gender === '' || phone === '' || email === '' || password === '' || confirmPassword === '') {
          alert('All fields are required');
          return;
      }

      if (!emailRegex.test(email)) {
          alert('Please enter a valid email address');
          return;
      }

      if (!phoneRegex.test(phone)) {
          alert('Please enter a valid 11-digit phone number');
          return;
      }

      if (!passwordRegex.test(password)) {
          alert('Password must be at least 6 characters long and contain at least one digit, one lowercase letter, and one uppercase letter');
          return;
      }

      if (password !== confirmPassword) {
          alert('Passwords do not match');
          return;
      }

      // If all validations pass, submit the form
      form.submit();
  });
});
