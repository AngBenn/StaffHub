$(document).ready(function(){
    $('#addCourseForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = {
            'name': $('#name').val(),
            'description': $('#description').val(),
            'class': $('#class').val(),
            'addCourse': 1 // Set a flag to identify this request
        };

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '../actions/add_course_action.php', 
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Display success SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Course added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '../admin/courses.php'; // Redirect to events page
                    });
                } else {
                    // Display error SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Adding Course failed. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});
