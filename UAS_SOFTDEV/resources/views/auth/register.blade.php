<?php
    use App\Models\User;
    if (!User::exists()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
        <style>
            .form-control {
                padding: 0.8rem 1rem;
                border-radius: 0.5rem;
                border: 1px solid #e0e0e0;
                transition: all 0.3s ease;
                font-size: 0.95rem;
            }
            .form-control:focus {
                border-color: #435ebe;
                box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.15);
            }
            .form-control-icon {
                color: #6c757d;
                font-size: 1.1rem;
            }
            .btn-primary {
                background: #435ebe;
                border: none;
                padding: 0.8rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background: #364b9e;
                transform: translateY(-1px);
            }
            .auth-logo h1 {
                color: #435ebe;
                font-weight: 800;
                transition: all 0.3s ease;
            }
            .auth-logo h1:hover {
                color: #364b9e;
            }
            .font-bold {
                color: #435ebe;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .font-bold:hover {
                color: #364b9e;
            }
            #auth-right-register {
                background: linear-gradient(135deg, #435ebe 0%, #364b9e 100%);
            }
            .invalid-feedback {
                font-size: 0.85rem;
            }
            hr {
                border-color: #e0e0e0;
                opacity: 0.5;
            }
        </style>
</head>
<body>
        <div id="auth">
                <div class="row h-100">
                        <div class="col-lg-5 col-12">
                                <div id="auth-left">
                                        <div class="auth-logo d-flex justify-content-center">
                                            <a href="/"><h1><u>Ecommerce</u></h1></a>
                                        </div>
                                        <h2 class="text-center">Daftar.</h2>

                                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group position-relative has-icon-left mb-4">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">

                                                        @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror

                                                        <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                        </div>

                                                </div>

                                                <div class="form-group position-relative has-icon-left mb-4">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email" required autofocus>

                                                        @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror

                                                        <div class="form-control-icon">
                                                                <i class="bi bi-envelope"></i>
                                                        </div>

                                                </div>


                                                <div class="form-group position-relative has-icon-left mb-4">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Kata Sandi">
                                                        @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                        <div class="form-control-icon">
                                                                <i class="bi bi-shield-lock"></i>
                                                        </div>
                                                </div>
                                                <div class="form-group position-relative has-icon-left mb-4">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi">
                                                        <div class="form-control-icon">
                                                                <i class="bi bi-shield-lock-fill"></i>
                                                        </div>
                                                </div>

                                                <hr/>


                                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
                                        </form>
                                        <div class="text-center mt-5 text-lg">
                                                <p class='text-gray-600'>Sudah punya akun? <a href="/login" class="font-bold">Masuk</a>.</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block">
                                <div id="auth-right-register">

                                </div>
                        </div>
                </div>
        </div>
</body>
</html>
<?php
    }else{
        echo '
        <script>window.location = "/login";</script>
        ';
    }
?>
