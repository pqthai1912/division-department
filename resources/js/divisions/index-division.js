$( function() {
    $("#file_csv").on('change',function(e) {
        var $button = $('#btn-import-csv');
        if ($button.data("isDisabled")) {
          return;
        }
        $button.data("isDisabled", true);
        $button.prop("disabled", true);
        $('#loading').show();

      });

} );
