<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- existing head content -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="App Name">
    <link rel="apple-touch-icon" href="/icon-192x192.png">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Timepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    {{-- <link rel="stylesheet" href="/css/landingpage.css"> --}}

</head>

<body>
    <nav class="navbar bg-body-tertiary mb-5">
        <div
            class="container d-flex flex-wrap justify-content-center justify-content-xl-between align-items-center py-2">

            {{-- Logo --}}
            <a class="navbar-brand mb-2 mb-xl-0" href="#">
                <img src="/asset/Logo_Desa_Krebet.png" alt="Logo Desa Krebet" height="70">
            </a>

            {{-- Sosial Media --}}
            <ul class="list-unstyled d-flex gap-2 m-0 sosmed">
                <li class="shadow rounded d-flex align-items-center">
                    <a href="https://www.facebook.com/profile.php?id=100078985543662&mibextid=kFxxJD" target="_blank"
                        class="d-flex align-items-center justify-content-center px-3 py-2 text-dark text-decoration-none">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li class="shadow rounded d-flex align-items-center">
                    <a href="https://x.com/DesaKrebet?t=S0d-3KAQq06T1Xjak1C1rA&s=09" target="_blank"
                        class="d-flex align-items-center justify-content-center px-3 py-2 text-dark text-decoration-none">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li class="shadow rounded d-flex align-items-center">
                    <a href="https://www.instagram.com/desawisatakrebet?igsh=MTNtdDVqNmY4YXM0eg==" target="_blank"
                        class="d-flex align-items-center justify-content-center px-3 py-2 text-dark text-decoration-none">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li class="shadow rounded d-flex align-items-center">
                    <a href="https://www.youtube.com/@desawisatakrebet3690" target="_blank"
                        class="d-flex align-items-center justify-content-center px-3 py-2 text-dark text-decoration-none">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            </ul>

        </div>
    </nav>

    @yield('konten')
    <footer class="mt-5 p-5">
        <div class="container">
            <p class="mb-1">Copyright © 2020 Desa Wisata Krebet</p>

            <p class="m-0">Design by Dunia Blanter</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!-- Bootstrap Timepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

    @yield('script')

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
