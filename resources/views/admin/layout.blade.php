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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
</head>

<body style="background-color:rgb(243, 244, 246);">

    <section id="nav">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <img src="{{ asset('img\desa-krebet.png') }}" alt="Logo Desa Krebet" class="img-fluid navbar-brand ps-4" id="logo">
                <div>
                    <ul class="navbar-nav d-flex align-items-center text-center mb-2 mb-lg-0">
                        <li class="nav-item d-flex align-items-center gap-3 me-4">
                            <a class="nav-link active fw-bold text-secondary" href="#">
                                <i class="bi bi-exclude"></i> @yield('titleNav')
                            </a>

                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
    </section>
    <section id="konten">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-md-2 bg-white pt-5 pb-5 min-vh-100" id="main-menu">
                    @yield('menu')
                </div>
                <div class="col-md-10">
                    @yield('content')

                </div>
            </div>
        </div>

    </section>

    <div class="fixed-bottom" id="mobile-content">
        <div class="container-fluid">
            <div class="row text-secondary fw-bold bg-white pt-1 shadow rounded-top" id="smartphone-menu">
                @yield('menuHp')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @yield('scripts')
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered'))
                    .catch(error => console.log('SW registration failed'));
            });
        }
    </script>

</body>

</html>
