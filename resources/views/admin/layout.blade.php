<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- existing head content -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="App Name">
    <link rel="apple-touch-icon" href="/icon-192x192.png">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('asset/Logo_Desa_Krebet.png') }}" type="image/png">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
</head>

<body style="">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header pb-3">
                        <div class="dropdown profile-element">
                            <div class="bg-white px-2 py-1 rounded">
                                <img src="{{ asset('img\desa-krebet.png') }}" alt="Logo Desa Krebet"
                                    class="img-fluid navbar-brand ps-4">
                            </div>
                            <h3 class="block m-t-xs font-bold text-white mb-0 mt-4">{{ Auth::user()->name }}</h3>
                            {{-- <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{ Auth::user()->name }}</span>
                                <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                            </a> --}}
                            {{-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li>
                                    <a class="dropdown-item" href="profile.html">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="contacts.html">Contacts</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="mailbox.html">Mailbox</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul> --}}
                        </div>
                        <div class="logo-element">IN+</div>
                    </li>
                    @yield('menu')
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i
                                class="fa fa-bars"></i>
                        </a>
                        {{-- <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control"
                                    name="top-search" id="top-search" />
                            </div>
                        </form> --}}
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        {{-- <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                        </li> --}}
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/a7.jpg" />
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following
                                            <strong>Monica Smith</strong>. <br />
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/a4.jpg" />
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started
                                            following <strong>Monica Smith</strong>. <br />
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/profile.jpg" />
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">23h ago</small>
                                            <strong>Monica Smith</strong> love
                                            <strong>Kim Smith</strong>. <br />
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html" class="dropdown-item">
                                            <i class="fa fa-envelope"></i>
                                            <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>
                                <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16
                                            messages
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="float-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="grid_options.html">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="class="btn btn-sm btn-danger"">
                            <a href="{{ route('admin.logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                @yield('breadcrumb')
            </div>
            <section id="konten">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-md-12 mb-5">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
            {{-- <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content text-center p-md">
                                <h2>
                                    <span class="text-navy">INSPINIA - Responsive Admin Theme</span>
                                    is provided with two main layouts <br />three skins and
                                    separate configure options.
                                </h2>

                                <p>
                                    All config options you can turn on/off from the theme box
                                    configuration (green icon on the left side of page).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-content text-center p-md">
                                <h4 class="m-b-xxs">
                                    Top navigation, centered content layout
                                </h4>
                                <small>(optional layout)</small>
                                <p>Available configure options</p>
                                <span class="simple_tag">Scroll navbar</span>
                                <span class="simple_tag">Top fixed navbar</span>
                                <span class="simple_tag">Boxed layout</span>
                                <span class="simple_tag">Scroll footer</span>
                                <span class="simple_tag">Fixed footer</span>
                                <div class="m-t-md">
                                    <p>Check the Dashboard v.4 with top navigation layout</p>
                                    <div class="p-lg">
                                        <a href="dashboard_4.html"><img class="img-fluid img-shadow"
                                                src="img/dashboard4_2.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-content text-center p-md">
                                <h4 class="m-b-xxs">Basic left side navigation layout</h4>
                                <small>(main layout)</small>
                                <p>Available configure options</p>
                                <span class="simple_tag">Collapse menu</span>
                                <span class="simple_tag">Fixed sidebar</span>
                                <span class="simple_tag">Scroll navbar</span>
                                <span class="simple_tag">Top fixed navbar</span>
                                <span class="simple_tag">Boxed layout</span>
                                <span class="simple_tag">Scroll footer</span>
                                <span class="simple_tag">Fixed footer</span>
                                <div class="m-t-md">
                                    <p>Check the Dashboard v.4 with basic layout</p>
                                    <div class="p-lg">
                                        <a href="dashboard_4_1.html"><img class="img-fluid img-shadow"
                                                src="img/dashboard4_1.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-content text-center p-md">
                                <h4 class="m-b-xxs">
                                    Full height - Outlook view
                                    <span class="label label-primary">NEW</span>
                                </h4>
                                <small>(optional layout)</small>
                                <p>Available configure options</p>
                                <span class="simple_tag">Scroll navbar</span>
                                <span class="simple_tag">Boxed layout</span>
                                <span class="simple_tag">Scroll footer</span>
                                <span class="simple_tag">Fixed footer</span>
                                <div class="m-t-md">
                                    <p>Check the Outlook view in in full height page</p>
                                    <div class="p-lg">
                                        <a href="full_height.html"><img class="img-fluid img-shadow"
                                                src="img/full_height.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-content text-center p-md">
                                <h4 class="m-b-xxs">
                                    Off canvas menu <span class="label label-primary">NEW</span>
                                </h4>
                                <small>(optional layout)</small>
                                <p>Available configure options</p>
                                <span class="simple_tag">Collapse menu</span>
                                <span class="simple_tag">Fixed sidebar</span>
                                <span class="simple_tag">Top fixed navbar</span>
                                <span class="simple_tag">Boxed layout</span>
                                <span class="simple_tag">Scroll footer</span>
                                <span class="simple_tag">Fixed footer</span>
                                <div class="m-t-md">
                                    <p>Check the off canvas menu on example article page</p>
                                    <div class="p-lg">
                                        <a href="off_canvas_menu.html"><img class="img-fluid img-shadow"
                                                src="img/off_canvas.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="footer">
                <div class="float-right"><strong>Universitas Amikom Yogyakarta</strong></div>
                <div><strong>Copyright</strong> D3 - Manajemen Informatika &copy; 2024-2025</div>
            </div>
        </div>
    </div>

    {{-- <section id="nav">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <img src="{{ asset('img\desa-krebet.png') }}" alt="Logo Desa Krebet"
                    class="img-fluid navbar-brand ps-4" id="logo">
                <div>
                    <ul class="navbar-nav d-flex align-items-center text-center mb-2 mb-lg-0">
                        <li class="nav-item d-flex align-items-center gap-3 me-4">
                            <a class="nav-link active fw-bold text-secondary" href="#">
                                <i class="bi bi-exclude"></i> @yield('titleNav')
                            </a>

                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" id="userDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person-circle fs-5"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end relative shadow rounded"
                                    aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2 absolute"
                                            href="{{ route('admin.logout') }}">
                                            <i class="bi bi-door-open me-2"></i>Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </section> --}}


    <div class="fixed-bottom" id="mobile-content">
        <div class="container-fluid">
            <div class="row text-secondary fw-bold bg-white pt-1 shadow rounded-top" id="smartphone-menu">
                @yield('menuHp')
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    @yield('scripts')
    {{-- <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered'))
                    .catch(error => console.log('SW registration failed'));
            });
        }
    </script> --}}

</body>

</html>
