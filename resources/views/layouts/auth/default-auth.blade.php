<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

    </header><!-- End Header -->

    <!-- Main -->
    <main>

        <!-- Error messages -->

        <!-- End Error messages -->

        <!-- Page Content -->
        <section class="section register" style="margin-top: 100px;">
            @yield('content')
        </section>
        <!-- End Page Content -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer class="row">
        @include('includes.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i></a>

    <!-- ======= Javascripts path ======= -->
    @include('includes.javascript')
    <!-- End Javascripts path -->


</body>
</html>
