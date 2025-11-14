<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', ) }} @yield('page_title', 'Dashboard')</title>

    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <style>
        .avatar-initials {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #6c757d;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .user-header .avatar-initials {
            width: 90px;
            height: 90px;
            font-size: 36px;
        }
    </style>
    @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="avatar-initials user-image">
                                {{ Auth::user()->initials }}
                            </span>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <span class="avatar-initials">
                                    {{ Auth::user()->initials }}
                                </span>
                                <p>{{ Auth::user()->name }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                                <form action="{{ route('logout') }}" method="post" class="d-inline float-end">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ url('/') }}" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                        src="{{ asset('dist/assets/img/logo.png') }}"
                        alt="Logo"
                        class="brand-image" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-bold">NontonApa</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->

            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul
                        class="nav sidebar-menu flex-column"
                        data-lte-toggle="treeview"
                        role="navigation"
                        aria-label="Main navigation"
                        data-accordion="false"
                        id="navigation">
                        <li class="nav-item menu-open">
                            <a href="{{ route('admin.films.index') }}" class="nav-link active">
                                <i class="nav-icon bi bi-table"></i>
                                <p>Data Film</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('admin.casts.index') }}" class="nav-link active">
                                <i class="nav-icon bi bi-table"></i>
                                <p>Data Pemain Film</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('admin.genres.index') }}" class="nav-link active">
                                <i class="nav-icon bi bi-table"></i>
                                <p>Data Genre Film</p>
                            </a>
                        </li>
                    </ul>

                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->

        </aside>
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('page_title', "Dashboard")</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('name_page', "Dashboard")</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>

            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    @yield('content')
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>

        </main>

    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {});
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

    @stack('scripts')

</body>
<!--end::Body-->

</html>