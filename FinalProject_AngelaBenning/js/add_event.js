$(document).ready(function(){
    $('#addCourseForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = {
            'name': $('#name').val(),
            'date': $('#date').val(),
            'location': $('#location').val(),
            'addEvent': 1 // Set a flag to identify this request
        };

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '../actions/add_event_action.php', 
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Display success SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '../admin/events.php'; // Redirect to events page
                    });
                } else {
                    // Display error SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Adding Event failed. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});
