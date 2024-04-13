//SweetAlert 
const params = new URLSearchParams(window.location.search);
const msg = params.get("msg");

if (msg == "success"){
    Swal.fire({
        title: 'Recording Time Successful',
        text: 'Have a nice day!',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../admin/time.php'; // Redirect to time page
    });
}else if (msg=="failed"){
    Swal.fire({
        title: 'Recording Time failed',
        text: 'Form submission failed!',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => { 
        window.location.href = '../admin/time.php'; // Redirect to time page
    }); 
}