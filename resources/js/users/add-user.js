$( function() {
    // support choose date
    $( "#user-add #entered_date" ).datepicker(
        { dateFormat: 'yy/mm/dd' }
    );

    // check valid when search
    $("#user-add").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50,
            },
            email: {
                required: true,
                latin:true,
                checkValidEmailRFC: true,
                maxlength: 255,
                remote: {
                    url: baseUrl + "/user/check_email_unique",
                    type: "post",
                    data: {
                        email: function(){
                            return $("#email").val();
                        },
                    }
                }
            },
            division_id: {
                required: true,
            },
            entered_date: {
                required: true,
                date: true,
            },
            position_id: {
                required: true,
            },
            password: {
                required: true,
                checkCharacterLatinLower: true,
                minlength: 8,
                maxlength: 20
            },
            password_confirmation: {
                required: true,
                maxlength: 20,
                equalTo: "#password"
            },

        },
        messages:{
            email: {
                remote: $.validator.format('すでにメールアドレスは登録されています。'),
            },
            password: {
                minlength: $.validator.format('パスワードは半角英数字記号で8～20文字で入力してください。'),
                maxlength: $.validator.format('パスワードは半角英数字記号で8～20文字で入力してください。')
            }
        },

        errorPlacement: function (error, element) {
            var place = element.closest('.input-group');
            error.insertAfter(place);
        }

    });

    // check valid when choose date instead of typing
    $('#user-add #entered_date').on('change', function(){
        $(this).valid();
    })


} );
