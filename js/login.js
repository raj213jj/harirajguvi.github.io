$(document).ready(function() {
    $('#login-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            username: $('input[name="userName"]').val(), // assuming your email input is for the username
            password: $('input[name="password"]').val()
        };

        // Send AJAX request to the server
        $.ajax({
            type: 'POST',
            url: 'http://localhost/profile/php/login.php', // Replace with your actual server endpoint
            dataType: 'json',
            data: formData,
            success: function(response) {
                // Handle the response from the server
                console.log(response);

                // You can redirect or perform other actions based on the response
                if (response.success) {
                    alert("login successful");
                    window.location.replace("profile.html"); // Redirect to the profile page
                } else {
                    alert(response.message); // Display an error message
                }
            },
            error: function(error) {
                // Handle errors
                console.error(error);
            },
        });
    });
});