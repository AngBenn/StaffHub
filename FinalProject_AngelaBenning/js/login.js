document.getElementById('loginForm').addEventListener('submit', function(event) {
    
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Regular expression for email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordRegex = /^.{10,}$/;

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

    
   // If all validations pass, the form will be submitted
   //redirectToHome()
});
//function redirectToHome() {
   // window.location.href = "../admin/welcome_admin.php";
//  }