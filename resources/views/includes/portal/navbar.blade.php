    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="{{ route('portal.index') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="{{ url('frontend/images/logo-no-background.png') }}" alt="" />
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        <a class="nav-link scrollto" href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ url('#about') }}">About</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ url('#faq') }}">FAQ</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
            <!-- .navbar -->

            @auth
                <a class="btn-dashborad-dark scrollto" href="{{ route('dashboard.index') }}">My Dashboard</a>
            @else
                <a class="btn-getstarted scrollto" href="{{ route('login.index') }}">Get Started</a>
            @endauth

        </div>
    </header>
    <!-- End Header -->
