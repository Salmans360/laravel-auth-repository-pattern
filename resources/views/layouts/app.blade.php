<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CarX') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <div id="app">
        @php
            $currentRoute   = request()->route()->getName();
            $dealerRoutes   = ['home', 'dealer.create', 'dealer.edit'];
            $marketRoutes   = ['market.index', 'market.create', 'market.edit'];
            $locationRoutes = ['location.index', 'location.create', 'location.edit'];
            $couponRoutes   = ['coupon.index', 'coupon.create', 'coupon.edit'];
            $contentRoutes  = ['content.index','content.create', 'content.edit'];
            $appointmentRoutes = ['appointment.index'];
        @endphp
        @if(auth()->check())
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg header-design-2">
                <div class="container">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation">
                      <span class="navbar-toggle-icon">
                        <span class="toggle-line"></span>
                      </span>
                    </button>
                    <a class="navbar-brand me-1 me-sm-3" href="{{ url('/') }}">
                        <div class="d-flex align-items-center">
                            <img class="me-2" src="{{ asset('img/car-x-assets/logo-extended.png') }}" alt="" />
                        </div>
                    </a>
                    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                        <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                            <li class="nav-item {{ in_array($currentRoute, $dealerRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Dealers</a>
                            </li>
                            <li class="nav-item {{ in_array($currentRoute, $marketRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('market.index') }}">Markets</a>
                            </li>
                            <li class="nav-item {{ in_array($currentRoute, $locationRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('location.index') }}">Locations</a>
                            </li>
                            <li class="nav-item {{ in_array($currentRoute, $couponRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('coupon.index') }}">Coupons</a>
                            </li>
                            <li class="nav-item {{ in_array($currentRoute, $contentRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('content.index') }}">Content</a>
                            </li>
                            <li class="nav-item {{ in_array($currentRoute, $appointmentRoutes) ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('appointment.index') }}">Appointments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header-bird">
                        <img src="{{ asset('img/car-x-assets/birds.png') }}" alt="" />
                    </div>
                    <ul class="navbar-nav navbar-nav-icons flex-row align-items-center">
                        <li class="nav-item">
                            <div class="theme-control-toggle fa-icon-wait px-2">
                                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark" />
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme">
                                    <span class="fas fa-sun fs-0"></span>
                                </label>
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme">
                                    <span class="fas fa-moon fs-0"></span>
                                </label>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="user-name">{{ ucwords(auth()->user()->name) }}</span>
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="{{ asset('img/team/3-thumb.png') }}" alt="" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">

                                    <a class="dropdown-item" href="$">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
            <main class="main" id="top">
                <div class="container" data-layout="container">
                    <script>
                        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                        if (isFluid) {
                            var container = document.querySelector('[data-layout]');
                            container.classList.remove('container');
                            container.classList.add('container-fluid');
                        }
                    </script>
                </div>
            </main>

        @endif


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>

    
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @yield('scripts')

</body>
</html>
