$(function () {
    $("#login-form").validate({
        rules: {
            email: {
                required: true,
                checkValidEmailRFC: true,
                maxlength: 255,
                // remote: {
                //     url: baseUrl + "/check_email_exists",
                //     type: "post",
                //     data: {
                //         email: function(){
                //             return $("#email").val();
                //         },
                //     }
                // }
            },
            password: {
                required: true,
                maxlength: 20
            }
        },
        // messages:{
        //     email: {
        //         remote: $.validator.format('会員IDまたはメールアドレスが間違っています。'),
        //     }
        // },

    });

    // $.validator.addMethod('emailValid', function (value, element) {
    //     return this.optional(element) ||
    //     /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/.test(value);
    // }, "メールアドレスを正しく入力してください。"); // Please enter a valid email address.

});
