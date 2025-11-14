<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_public.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg @yield('navbar_class', 'navbar-light bg-white shadow-sm')">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <img src="{{ asset('dist/assets/img/logo.png') }}"
                        alt="Logo"
                        style="height: 30px;"
                        class="me-2">
                    <span class="brand-text fw-bold">{{ config('app.name') }}</span>
                </a>

                <div class="d-flex">
                    @guest
                    <a href="{{ route('login') }}" class="btn @yield('navbar_guest_class') me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn @yield('navbar_guest_class')">Register</a>
                    @else
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center @yield('navbar_text_color')"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="avatar-initials">
                                {{ Auth::user()->initials }}
                            </span>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu @yield('dropdown_menu_class', 'dropdown-menu-light') dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2"></i> Profile
                                </a></li>
                            @if (Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="{{ route('admin.films.index') }}">
                                    <i class="bi bi-gear-fill me-2"></i> Admin Panel
                                </a></li>
                            @endif

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    @stack('scripts')
</body>

</html>