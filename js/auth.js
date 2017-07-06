var alertTimeOut = 3000;

$('document').ready(function() {

    // name validation
    var nameregex = /^[a-zA-Z ]+$/;

    $.validator.addMethod("validname", function(value, element) {
        return this.optional(element) || nameregex.test(value);
    });

    // valid email pattern
    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    $.validator.addMethod("validemail", function(value, element) {
        return this.optional(element) || eregex.test(value);
    });

    /* validation */
    $("#form").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
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
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: submitForm
    });
    /* validation */

    function submitForm() {
        $("#btn-login").click(function(e) {

            action = "#form";

            var username = $(action).find("input[name='username']").val();
            var password = $(action).find("input[name='password']").val();

            console.log(username);
            console.log(password);

            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: BASE_URL + "controllers/auth/cmd.php?" + username,
                data: {
                    "cmd": "login",
                    "username": username,
                    "password": password
                },
                beforeSend: function() {
                    $("#error").fadeOut();
                    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success: function(res) {
                    console.log(res.data);

                    window.location = "news";

                    // if (res.data.status === "admin") {

                    // } else {
                    //     $("#error").fadeIn(1000, function() {
                    //         $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                    //     });
                    // }
                }
            });
            return false;
        });
    }
});