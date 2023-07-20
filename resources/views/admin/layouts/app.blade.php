<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('template_back') }}/assets/" data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>{{ $title }}</title>

        <meta name="description" content="" />
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

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/vendor/fonts/boxicons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/css/demo.css" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

        <link rel="stylesheet" href="{{ asset('template_back') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{ asset('template_back') }}/assets/vendor/js/helpers.js"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('template_back') }}/assets/js/config.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

        <style>
            .selected-user {
                display: inline-block;
                padding: 5px;
                margin: 5px;
            }

            .delete-button {
                margin-left: 10px;
                padding: 10px;
                cursor: pointer;
            }
        </style>

    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('admin.layouts.sidebar')

                <!-- Layout container -->
                <div class="layout-page">
                    @include('admin.layouts.topbar')

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">
                            @include('admin.layouts.toast')
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        @stack('modals')
                        @include('admin.layouts.footer')

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('template_back') }}/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="{{ asset('template_back') }}/assets/vendor/libs/popper/popper.js"></script>
        <script src="{{ asset('template_back') }}/assets/vendor/js/bootstrap.js"></script>
        <script src="{{ asset('template_back') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="{{ asset('template_back') }}/assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('template_back') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="{{ asset('template_back') }}/assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="{{ asset('template_back') }}/assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
        @stack('scripts')
    </body>

</html>