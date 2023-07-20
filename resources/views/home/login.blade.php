@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav>
    <section>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="text-center text-brown">
                        <h3><strong><span class="text-dark">Selamat Datang di</span> Batik Sakata Solo</strong></h3>
                        <hr>
                        <h6>Halaman <strong>Login</strong> Pelanggan</h6>
                    </div>
                    <div class="card text-black shadow-lg mt-3" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <form method="POST" class="mx-1 mx-md-4" action="{{ route('login') }}">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <label class="form-label" for="email">Email</label>
                                            </div>
                                        </div>
                                        @error('email')
                                        <div class="mb-3">
                                            <small class="ms-4 text-danger text-small">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        </div>
                                        @enderror

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                <label class="form-label" for="password">Password</label>

                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="mb-3">
                                            <small class="ms-4 text-danger text-small">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        </div>
                                        @enderror

                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-check flex-fill mb-0">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="my-3 text-center">
                                            <small>Belum punya akun ? Silahkan <a href="{{ route('register') }}">Register</a></small>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-arrow-right"></i> Login</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection