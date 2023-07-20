<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>

        <meta name="description" content="Batik Sakata Solo. Pusat Kemeja Batik Premium Langsung dari Produsen">

        <!-- MDB icon -->
        <link rel="icon" href="{{ asset('template_front') }}/img/mdb-favicon.ico" type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="{{ asset('template_front') }}/css/mdb.min.css" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('template_back/assets/img/favicon') }}/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('template_back/assets/img/favicon') }}/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('template_back/assets/img/favicon') }}/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('template_back/assets/img/favicon') }}/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template_back/assets/img/favicon') }}/favicon-16x16.png">
        <link rel="manifest" href="{{ asset('template_back/assets/img/favicon') }}/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('template_back/assets/img/favicon') }}/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        {{-- end Favicon --}}


        {{-- Font Style --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100;700;900&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        {{-- My style --}}
        {{-- <link rel="stylesheet" href="{{ asset('css') }}/style.css"> --}}

        {{-- Boxicon --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- Animation On Scroll --}}
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

        {{-- Datatable --}}
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

        <style>
            body {
                font-family: 'Geologica', sans-serif;
                font-family: 'Poppins', sans-serif;
            }

            .text-brown {
                color: #795548;
            }

            .navbar-nav .nav-item .nav-link.active {
                font-weight: 600;
            }

            #bg-kategori:hover {
                transform: scale(1.1);
            }

            .btn.hover-slide-right:hover::before {
                width: 100%;
            }
        </style>
    </head>

    <body>
        @include('home.layouts.navbar')
        @if (!Request::is('login', 'register', 'keranjang', 'checkout'))
        @include('home.layouts.hero')
        @endif

        @yield('content')
        @stack('modals')
        @include('home.layouts.footer')

        <!-- MDB -->
        <script type="text/javascript" src="{{ asset('template_front') }}/js/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        {{-- Datatable --}}
        <!-- JavaScript -->
        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
        @stack('scripts')
        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        </script>
        @endif
    </body>

</html>