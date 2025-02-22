<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

@stack('title')
<meta content="" name="description">
<meta content="" name="keywords">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|
Nunito:300,300i,400,400i,600,600i,700,700i|
Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- Vendor CSS Files -->
<link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

@vite(['resources/css/app.css'])

<style>
    label.form-control-label {
        white-space: pre-line;
    }
    .custom-btn {
        width: 100px;
    }
    #csv{
        width:150px;
        /* color:rgb(16, 15, 15); */
    }
    .input-group-text {
        width: 45%;
        border-radius: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        text-align: left;
    }
    .input-group > input {
        border-radius: 0;
    }

    @media (min-width: 774px) and (max-width: 992px){
        #search-user .input-group-text {
            width: 45%;
            font-size: 0.70em;
        }
        #search-user input {
            font-size: 0.70em;
        }
    }

    @media (min-width: 992px) and (max-width: 1199.98px){
        #search-user .input-group-text {
            width: 45%;
            font-size: 0.75em;
        }
        #search-user input {
            font-size: 0.75em;
        }
    }
    @media (min-width: 1199.98px) and (max-width: 1564px){
        #search-user .input-group-text {
            width: 52%;
            font-size: 0.70em;
        }

        #search-user input {
            font-size: 0.70em;
        }
        /* #sidebar {
            left: -300px;
        } */
    }
    /*
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .input-group-text {
            font-size: 0.75em;
            border-radius: 0;
        }
     }*/
    /* .table th, .table td {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
    } */
    .input-group > select {
        border-radius: 0;
    }

    .active a {
        background:#4154f1 !important;
        color:white !important;
    }
</style>

@stack('styles')
