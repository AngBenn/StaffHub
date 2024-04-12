    
    
    
    // Functions to redirect to home pageetc.
    function redirectToHome() {
        window.location.href = '../view/welcome.php';
    }
    
    
    function redirectToDashboard(){
        window.location.href='../admin/dashboard.php';
    }
    
    
    
    function redirectToEvaluations(){
        window.location.href = '../admin/evaluations.php';
    }
    function redirectToTime(){
        window.location.href = '../admin/clocking.php';
    }
    function redirectToProfile(){
        window.location.href = '../admin/profile.php';
    }
    function logout() {
        // Implement logout functionality to redirect to the login page
        window.location.href = '../login/logout_view.php'; 
    }

     // Toggle menu function
     function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("closed");
    }