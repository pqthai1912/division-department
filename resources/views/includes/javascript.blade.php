<script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ asset('js/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dist/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js') }}"
 type="text/javascript"></script>

<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<!-- Vendor JS Files -->
{{-- <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/quill/quill.min.js') }}"></script> --}}
<script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
{{-- <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script> --}}
<script>window.baseUrl="{{ URL::to('/') }}"</script>
<script>
    $(window).on('load', function() {
        $('#loading').hide();
    });
</script>
@stack('javascript')
<!-- Template Main JS File -->
@vite(['resources/js/app.js'])
{{-- <script src="{{ asset('js/admin/utils/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/utils/additional-custom.js') }}"></script> --}}

