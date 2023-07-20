<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="/" style="font-weight: 700px">
                <strong>Batik Sakata Solo</strong>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active border-bottom border-2' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($kategori as $item)
                        <li>
                            <a class="dropdown-item" href="/kategori/{{ $item->slug }}">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk*') ? 'active border-bottom border-2' : '' }}" href="/produk">Produk</a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="text-reset me-3" href="/keranjang">
                <i class="fas fa-shopping-cart"></i>
                {{ Cart::getTotalQuantity()}}
            </a>

            @if (Auth::check())
            <!-- Avatar -->
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    @if (Auth()->user()->image !== null)
                    <img src="{{ asset('storage/'. Auth()->user()->image) }}/default-image.png" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                    @else
                    <img src="{{ asset('template_back/assets/img') }}/default-image.png" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item" href="#">My profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/pesanan_saya">Pesanan Saya</a>
                    </li>
                    <li>
                        @if (Auth()->user()->role == 'admin')
                        <a class="dropdown-item" href="/admin"><span class="btn btn-primary text-white"><i class='bx bxs-dashboard'></i> Halaman Admin</span></a>
                        @endif
                    </li>
                    <li>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><span class="btn btn-danger"><i class='bx bxs-log-out'></i> Logout</span></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <div class="d-flex align-items-center">
            <a href="/login" class="btn btn-primary {{ request()->is('login', 'register') ? 'active' : '' }} me-3">
                <i class="bx bx-log-in-circle"></i>
                Login / Daftar
            </a>
        </div>
        @endif
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->