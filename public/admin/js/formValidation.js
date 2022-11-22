$(document).ready(function () {
    $('#userForm').submit(function () {
       
        $('.error').remove();
        let name = $('#inputName').val();
        let email = $('#inputEmail').val();
        let password = $('#inputPassword').val();

        if (name.length < 1) {
            $('#inputName').after('<span class="error text-danger">Please enter your name</span>');
            return false;
        }
        if (email.length < 1) {
            $('#inputEmail').after('<span class="error text-danger">Please enter your Email</span>');
            return false;
        }
        if (password.length < 8) {
            $('#inputPassword').after('<span class="error text-danger">Password must be at least 8 characters long</span>');
            return false;
        }
    });
});