$( function() {
    $('#btn-reset').blur();

    // support choose date
    $( "#entered_date_from" ).datepicker(
        { dateFormat: 'yy/mm/dd' }
    );
    $( "#entered_date_to" ).datepicker(
        { dateFormat: 'yy/mm/dd' }
    );

    // check valid when search
    $("#search-user").validate({
        rules: {
            name: {
                maxlength: 100,
            },
            entered_date_from: {
                date: true,
                // greaterThanDateUpgrade: '#entered_date_to'
            }
            ,
            entered_date_to: {
                date: true,
                // check range
                lessThanDate: '#entered_date_from'
            }
        },
        // messages:{

        // },

    });

    // check valid when choose date instead of typing
    $('#entered_date_from').on('input change', function(){
        $(this).valid();
        $('#entered_date_to').valid();
    })

    $('#entered_date_to').on('input change', function(){
        $(this).valid();
        $('#entered_date_from').valid();
    })

    $("#csv").click(function(e) {
        var $button = $(this);
        if ($button.data("isDisabled")) {
          return;
        }
        $button.data("isDisabled", true);
        $button.prop("disabled", true);

        setTimeout(function() {
          $button.data("isDisabled", false);
          $button.prop("disabled", false);
        }, 1000);
      });

} );
