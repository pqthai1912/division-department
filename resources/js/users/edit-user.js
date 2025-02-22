$( function() {

    var originalEmail = $('#original-email').val(); // prevent change this email when open F12

    // support choose date
    $( "#user-edit #entered_date" ).datepicker(
        { dateFormat: 'yy/mm/dd' }
    );

    $.validator.addMethod('required_with', function(value, element, params) {
        var otherValue = $('input[name=' + params[0] + ']').val();
        if (otherValue === '') {
            return true;
        }
        return (value !== ''); // return true if value is not empty, true pass, false show valid
    });

    // check valid when search
    $("#user-edit").validate({
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
                        original_email: function() {
                            return originalEmail;
                        }
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
                checkCharacterLatinLower: true,
                minlength: 8,
                maxlength: 20
            },
            password_confirmation: {
                required_with: ['password'],
                maxlength: 20,
                equalTo: "#password"
            },

        },
        messages: {
            email: {
                remote: $.validator.format('すでにメールアドレスは登録されています。'),
            },
            password_confirmation: {
                required_with: function (p, e) {
                    return $.validator.format('{0}は必須項目です。', [
                        $(e).data('label'),
                    ]); // {0} is required field.
                }
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
    $('#user-edit #entered_date').on('change', function(){
        $(this).valid();
    })

    // $('#user-edit #password').on('change', function(){
    //     $('#user-edit #password_confirmation').valid();
    // })
    $('#delete-btn').on('click', function() {
        if (!confirm('このユーザーを削除しますか？')) {
            return false;
        }
        $.ajax({
            type: "DELETE",
            url: url_delete_user,
            success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.error_msg) {
                    var content = '<div class="alert alert-danger" role="alert">';
                    content += response.error_msg + '</div>';

                    $('#msg-error-ajax').html(content);
                } else {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                window.location.reload();
            }
          });
    })

} );
