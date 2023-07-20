<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <div class="logo">
                    <img src="{{ asset('template_back/assets/img') }}/logo.jpg" alt="Batik Sakata Solo" width="50">
                </div>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Home Page</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="/admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Produk</span>
        </li>

        <li class="menu-item {{ request()->is('admin/produk*') ? 'active' : '' }}">
            <a href="{{ url('admin/produk') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-t-shirt'></i>
                <div>Produk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <a href="{{ url('admin/kategori') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-list-ul'></i>
                <div>Kategori</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/banner*') ? 'active' : '' }}">
            <a href="{{ url('admin/banner') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-image'></i>
                <div>Banner</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pesanan</span>
        </li>

        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : '' }}">
            <a href="{{ url('admin/pesanan') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-shopping-bag'></i>
                <div>Pesanan Masuk</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen User</span>
        </li>

        <li class="menu-item {{ request()->is('admin/user') ? 'active' : '' }}">
            <a href="{{ url('admin/user') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-user-circle'></i>
                <div>User</div>
            </a>
        </li>
        <hr>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
<!-- / Menu -->