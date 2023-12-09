$(document).ready(function() {
    $('#register-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            firstName: $('input[name="firstName"]').val(),
            lastName: $('input[name="lastName"]').val(),
            userName: $('input[name="userName"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
            confirmPassword: $('input[name="confirmPassword"]').val()
        };
        //console.log(formData);
        // Send AJAX request to the server
        $.ajax({
            type: 'POST',
            url: 'http://localhost/profile/php/register.php', // Replace with your actual server endpoint
            data: formData,
            dataType: 'json',
            success: function(response){
                if(response.success){
                    //$('#result').html("Registration successful");
                    alert("registration Succesfull");
                    window.location.replace("index.html");
                } else {
                  alert(response.message);
                }
              },
              error:function(error){
                console.error(error);
                alert("An error occurred during registration");
              }
        });
    });
});