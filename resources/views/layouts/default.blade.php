<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('includes.header')
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        @include('includes.aside')
    </aside><!-- End Sidebar-->

    <!-- Main -->
    <main id="main" class="main">

        <!-- Page Title -->
        <div class="pagetitle">
            @stack('breadcrumbs')
        </div><!-- End Page Title -->

        <!-- Error messages -->
        <x-alert/>
        <div id="msg-error-ajax"></div>
        <!-- End Error messages -->

        <!-- Page Content -->
        <section class="section dashboard">
            @yield('content')
        </section><!-- End Page Content -->

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
