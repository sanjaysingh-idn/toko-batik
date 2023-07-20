@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <div class="login-container" data-aos="fade-in">
        <section>
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="text-center text-brown">
                            <h3><strong><span class="text-dark">Selamat Datang di</span> Batik Sakata Solo</strong></h3>
                            <hr>
                            <h6>Halaman <strong>Register</strong> Pelanggan</h6>
                            <div class="text-center">
                                <small>Silahkan isi formulir dibawah ini</small>
                            </div>
                        </div>
                        <div class="card text-black shadow-lg mt-3" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <form method="POST" class="mx-1 mx-md-4" action="{{ route('register') }}">
                                            @csrf
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    <label class="form-label" for="name">Nama</label>

                                                </div>
                                            </div>
                                            @error('name')
                                            <div class="mb-3">
                                                <small class="ms-4 text-danger text-small">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            </div>
                                            @enderror

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-phone-alt fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                                    <label class="form-label" for="contact">No Hp / Whatsapp</label>

                                                </div>
                                            </div>
                                            @error('contact')
                                            <div class="mb-3">
                                                <small class="ms-4 text-danger text-small">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            </div>
                                            @enderror

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                                </div>
                                            </div>

                                            <div class="my-3 text-center">
                                                <small>Sudah punya akun ? Silahkan <a href="/login">Login</a></small>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-registered"></i> Register</button>
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
</div>
@endsection