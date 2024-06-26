const params = new URLSearchParams(window.location.search);
const msg = params.get("msg");

if (msg == "success"){
    Swal.fire({
        title: 'Evaluation Successful',
        text: 'Thank you for your feedback!',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../admin/events.php'; // Redirect to evaluations page
    });
}else if (msg=="failed"){
    Swal.fire({
        title: 'Evaluation failed',
        text: 'Form submission failed!',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../admin/events.php'; // Redirect to evaluations page
    });
} 