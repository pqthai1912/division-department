<div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    {{-- <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
    </a> --}}
</div><!-- End Logo -->

{{-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div><!-- End Search Bar --> use in future--}}

<div style="position: absolute; top: 0; left: 45%;">
    @stack('title_header')
</div><!-- End title-->

<nav class="header-nav ms-auto" style="margin-right: 5%;">
    <ul class="d-flex align-items-center">
        <li class="nav-item pe-3" >
            <span class="ps-2">{{ Auth::user()->name }}</span>
            {{-- </ul><!-- End Profile Dropdown Items --> --}}
        </li><!-- End Profile Nav -->
        <li class="nav-item pe-3">
            <a class="d-flex align-items-center" href="{{ route('logout') }}">
                {{-- <i class="bi bi-box-arrow-right"></i> --}}
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav><!-- End Icons Navigation -->
