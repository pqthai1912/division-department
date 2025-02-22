$(function () {
    // Force reload page when click back button in Safari, Chrome (IOS/MacOS)
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
                               ( typeof window.performance != "undefined" &&
                                    window.performance.getEntriesByType("navigation")[0].type == "back_forward" );
        if ( historyTraversal ) {
          // Handle page restore.
          window.location.reload();
        }
      });
});

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //create input format by date
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd', onClose: function () {
            $(this).valid(); // when close picker
        }
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#file-name').text(fileName)
        // Inside find search element where the name should display (by Id Or Class)
    });

    // prevent form submit multi times
    $("body").on("submit", "form", function() {
        $('#loading').show();
        $(this).submit(function() {
            // $('#btnSubmit').attr('disabled', true);
            return false;
        });
        return true;
    });

});
