<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item {{ (request()->is('search*') || request()->url() == route('user.index')) ||
         request()->is('user*') ?
            'active' : '' }}">
        <a class="nav-link" href="{{route('user.index')}}">
            <span>User List</span>
        </a>
    </li><!-- End User List Nav -->
    @if (!$partialAccess)
        <li class="nav-item {{ request()->is('division*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('division.index') }}">
                <span>Division List</span>
            </a>
        </li><!-- End Division List Nav -->
    @endif

    {{-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
        </a>
        </li>
        <li>
        <a href="icons-remix.html">
            <i class="bi bi-circle"></i><span>Remix Icons</span>
        </a>
        </li>
        <li>
        <a href="icons-boxicons.html">
            <i class="bi bi-circle"></i><span>Boxicons</span>
        </a>
        </li>
    </ul>
    </li><!-- End Icons Nav --> --}}

    {{-- <li class="nav-heading">Pages</li>

    <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>Profile</span>
    </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
    </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
    </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
    </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
    </a>
    </li><!-- End Login Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
    </a>
    </li><!-- End Error 404 Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="pages-blank.html">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
    </a>
    </li><!-- End Blank Page Nav --> --}}

</ul>
