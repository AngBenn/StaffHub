document.getElementById('registerForm').addEventListener('submit', function (event) {
    
var firstName = document.getElementById('firstName').value;
var lastName = document.getElementById('lastName').value;
var Role = document.getElementById('familyRole').value;
var phoneNumber = document.getElementById('phoneNumber').value;
var email = document.getElementById('email').value;
var password = document.getElementById('password').value;
var confirmPassword = document.getElementById('confirmPassword').value;

// Regular expressions for validation
var nameRegex = /^[a-zA-Z\s]*$/;
var phoneNumberRegex = /^\d{10}$/;
var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
var passwordRegex = /^.{10,}$/;

// Validate first name
if (!nameRegex.test(firstName)) {
    alert('Please enter a valid first name.');
    event.preventDefault();
    return;
}

// Validate last name

if (!nameRegex.test(lastName)) {
    alert('Please enter a valid last name.');
    event.preventDefault();
    return;
}



// Validate family role
if (Role === '0') {
    alert('Please select a family role.');
    event.preventDefault();
    return;
}



// Validate phone number
if (!phoneNumberRegex.test(phoneNumber)) {
    alert('Please enter a valid phone number in the format xxx-xxx-xxxx.');
    event.preventDefault();
    return;
}

// Validate email
if (!emailRegex.test(email)) {
    alert('Please enter a valid email address.');
    event.preventDefault();
    return;
}

// Validate password
if (!passwordRegex.test(password)) {
    alert('Password must be at least 10 characters long.');
    event.preventDefault();
    return;
}

// Confirm password
if (password !== confirmPassword) {
    alert('Passwords do not match.');
    event.preventDefault();
    return;
}
});
