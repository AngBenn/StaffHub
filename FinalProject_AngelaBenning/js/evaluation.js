const teacherSelect = document.getElementById('teacher');
const courseSelect = document.getElementById('course');
const evaluationForm = document.getElementById('evaluationForm');

teacherSelect.addEventListener('change', toggleEvaluationForm);
courseSelect.addEventListener('change', toggleEvaluationForm);


//SweetAlert 
const params = new URLSearchParams(window.location.search);
const msg = params.get("msg");

if (msg == "success"){
    Swal.fire({
        title: 'Evaluation Successful',
        text: 'Thank you for your feedback!',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../admin/evaluations.php'; // Redirect to evaluations page
    });
}else if (msg=="failed"){
    Swal.fire({
        title: 'Evaluation failed',
        text: 'Form submission failed!',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../admin/evaluations.php'; // Redirect to evaluations page
    });
}

function toggleEvaluationForm() {
    if (teacherSelect.value && courseSelect.value) {
        evaluationForm.classList.add('show');
    } else {
        evaluationForm.classList.remove('show');
    }
}


//AJAX request for dropdown menu
$(document).ready(function () {
    $('#class').change(function () {
        var selectedClass = $(this).val();

        // Make AJAX request to fetch courses for the selected class
        $.ajax({
            url: '../actions/fetch_courses.php',
            type: 'GET',
            data: { class: selectedClass },
            dataType: 'json',
            success: function (response) {
                // Clear the current options in the course dropdown
                $('#course').empty();

                // Add the default option
                $('#course').append('<option value="">Choose Course</option>');

                // Add fetched courses to the course dropdown
                $.each(response, function (index, course) {
                    $('#course').append('<option value="' + course + '">' + course + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching courses:', error);
            }
        });
    });
});



   

    // Add event listener to the select element
    teacherSelect.addEventListener('change', function() {
        // Get the selected option
        const selectedOption = teacherSelect.options[teacherSelect.selectedIndex];
        
        // Get the teacher ID from the selected option's value attribute
        const teacherId = selectedOption.value;

        // Set the value of the hidden input field to the selected teacher's ID
        document.getElementById('teacherId').value = teacherId;
    });




