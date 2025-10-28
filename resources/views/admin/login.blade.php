<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Login | Admin Krebet</title>
    <link rel="icon" href="{{ asset('asset/Logo_Desa_Krebet.png') }}" type="image/png">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body style="background-color:rgb(243, 244, 246);" class="row align-items-center">
    <div class="loginColumns animated fadeInDown bg-white py-3 px-4">
        <div class="row">
            <div class="col-md-6">
                {{-- <h2 class="font-bold">Welcome to IN+</h2> --}}
                <img src="{{ asset('asset/Logo_Desa_Krebet.png') }}" alt="" class="img-fluid p-4">
                <p>
                    Sistem ini dirancang untuk mempermudah pengelolaan data kunjungan dan keuangan Desa Wisata Krebet secara terintegrasi, efisien, dan akurat.
                </p>

                <p>
                    <small>Dengan sistem yang terintegrasi, pengelolaan data menjadi lebih mudah, transparan, dan mendukung pengambilan keputusan yang tepat.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="{{ route('admin.login.proses') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" name="name" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        {{-- <a href="#">
                            <small>Forgot password?</small>
                        </a> --}}

                        {{-- <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p> --}}
                        {{-- <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> --}}
                    </form>
                    {{-- <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p> --}}
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Universitas Amikom Yogyakarta
            </div>
            <div class="col-md-6 text-right">
                <small><strong>Copyright</strong> D3 - Manajemen Informatika &copy; 2024-2025</small>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (SESSION('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Maaf",
                text: "{{ SESSION('error') }}",
            });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
