var alertTimeOut = 5000;

$('document').ready(function () {
    login();
});

function login() {

    // name validation
    var nameregex = /^[a-zA-Z ]+$/;

    $.validator.addMethod("validname", function (value, element) {
        return this.optional(element) || nameregex.test(value);
    });

    // valid email pattern
    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    $.validator.addMethod("validemail", function (value, element) {
        return this.optional(element) || eregex.test(value);
    });

    /* validation */
    $("#form").validate({
        rules: {
            password: {
                required: true,
                minlength: 4,
                maxlength: 15
            },
            username: {
                required: true,
                validname: true // rule for accepts only alphabets with space
            },
        },
        messages: {
            password: {
                required: "Please Enter Password",
                minlength: "Password at least have 8 characters"
            },
            username: {
                required: "Please Enter User Name",
                validname: "Name must contain only alphabets and space",
                minlength: "Your Name is Too Short"
            }
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: submitForm
    });
    /* validation */

    function submitForm() {
        $("#btn-login").click(function (e) {

            action = "#form";

            var username = $(action).find("input[name='username']").val();
            var password = $(action).find("input[name='password']").val();

            console.log(username);
            console.log(password);

            $.ajax({
                cache: false,
                timeout: 5000,
                dataType: 'json',
                type: 'POST',
                url: BASE_URL + "controllers/auth/cmd.php?" + username + "?" + password,
                data: {
                    "cmd": "login",
                    "username": username,
                    "password": password
                },
                beforeSend: function () {
                    $("#btn-login").html('sending ...');
                },
                success: function (res) {
                    console.log(res.status);
                    if (res.status == false) {
                        toastr.clear()
                        toastr.error("" + res.data.resMsg, 'Error Alert', {timeOut: alertTimeOut});
                        $("#btn-login").html('Login');
                    } else {
                        toastr.clear()
                        toastr.success(res.data.resMsg, 'Success Alert', {timeOut: alertTimeOut});
                        window.location = "news";
                    }
                },
                error: function (res) {
                    var errors = res.responseJSON;
                    console.log(errors);
                    // Render the errors with js ...
                }
            });
            return false;
        });
    }
}