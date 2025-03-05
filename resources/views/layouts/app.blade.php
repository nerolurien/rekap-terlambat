<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>{{ $title }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    {{-- datatables --}}
    <!-- DataTables CSS & JS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <h3 class="fw-bold">RekapTerlambat</h3>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href={{ route('home') }}>
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.60352 3.25C4.36088 3.25 3.35352 4.25736 3.35352 5.5V8.99998C3.35352 10.2426 4.36087 11.25 5.60352 11.25H9.10352C10.3462 11.25 11.3535 10.2426 11.3535 8.99998V5.5C11.3535 4.25736 10.3462 3.25 9.10352 3.25H5.60352ZM4.85352 5.5C4.85352 5.08579 5.1893 4.75 5.60352 4.75H9.10352C9.51773 4.75 9.85352 5.08579 9.85352 5.5V8.99998C9.85352 9.41419 9.51773 9.74998 9.10352 9.74998H5.60352C5.1893 9.74998 4.85352 9.41419 4.85352 8.99998V5.5Z"
                                    fill="#9585ff" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.60352 12.75C4.36088 12.75 3.35352 13.7574 3.35352 15V18.5C3.35352 19.7426 4.36087 20.75 5.60352 20.75H9.10352C10.3462 20.75 11.3535 19.7426 11.3535 18.5V15C11.3535 13.7574 10.3462 12.75 9.10352 12.75H5.60352ZM4.85352 15C4.85352 14.5858 5.1893 14.25 5.60352 14.25H9.10352C9.51773 14.25 9.85352 14.5858 9.85352 15V18.5C9.85352 18.9142 9.51773 19.25 9.10352 19.25H5.60352C5.1893 19.25 4.85352 18.9142 4.85352 18.5V15Z"
                                    fill="#9585ff" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.8535 5.5C12.8535 4.25736 13.8609 3.25 15.1035 3.25H18.6035C19.8462 3.25 20.8535 4.25736 20.8535 5.5V8.99998C20.8535 10.2426 19.8462 11.25 18.6035 11.25H15.1035C13.8609 11.25 12.8535 10.2426 12.8535 8.99998V5.5ZM15.1035 4.75C14.6893 4.75 14.3535 5.08579 14.3535 5.5V8.99998C14.3535 9.41419 14.6893 9.74998 15.1035 9.74998H18.6035C19.0177 9.74998 19.3535 9.41419 19.3535 8.99998V5.5C19.3535 5.08579 19.0177 4.75 18.6035 4.75H15.1035Z"
                                    fill="#9585ff" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.1035 12.75C13.8609 12.75 12.8535 13.7574 12.8535 15V18.5C12.8535 19.7426 13.8609 20.75 15.1035 20.75H18.6035C19.8462 20.75 20.8535 19.7426 20.8535 18.5V15C20.8535 13.7574 19.8462 12.75 18.6035 12.75H15.1035ZM14.3535 15C14.3535 14.5858 14.6893 14.25 15.1035 14.25H18.6035C19.0177 14.25 19.3535 14.5858 19.3535 15V18.5C19.3535 18.9142 19.0177 19.25 18.6035 19.25H15.1035C14.6893 19.25 14.3535 18.9142 14.3535 18.5V15Z"
                                    fill="#9585ff" />
                            </svg>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item nav-item-has-children">
                            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                                aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.28636 3.71264C4.853 4.09212 4.5 4.60958 4.5 5.25V18.75C4.5 19.3904 4.853 19.9079 5.28636 20.2874C5.7212 20.6681 6.30718 20.9769 6.96654 21.2211C8.29107 21.7116 10.0708 22 12 22C13.9292 22 15.7089 21.7116 17.0335 21.2211C17.6928 20.9769 18.2788 20.6681 18.7136 20.2874C19.147 19.9079 19.5 19.3904 19.5 18.75V5.25C19.5 4.60958 19.147 4.09212 18.7136 3.71264C18.2788 3.33187 17.6928 3.02313 17.0335 2.77892C15.7089 2.28836 13.9292 2 12 2C10.0708 2 8.29107 2.28836 6.96654 2.77892C6.30718 3.02313 5.7212 3.33187 5.28636 3.71264ZM6.27454 4.84114C6.02476 5.05985 6 5.20007 6 5.25C6 5.29993 6.02476 5.44015 6.27454 5.65886C6.52284 5.87629 6.92537 6.10625 7.48751 6.31446C8.60601 6.72871 10.2013 7 12 7C13.7987 7 15.394 6.72871 16.5125 6.31446C17.0746 6.10625 17.4772 5.87629 17.7255 5.65886C17.9752 5.44015 18 5.29993 18 5.25C18 5.20007 17.9752 5.05985 17.7255 4.84114C17.4772 4.62371 17.0746 4.39375 16.5125 4.18554C15.394 3.77129 13.7987 3.5 12 3.5C10.2013 3.5 8.60601 3.77129 7.48751 4.18554C6.92537 4.39375 6.52284 4.62371 6.27454 4.84114ZM18 9.75V7.28202C17.7055 7.44688 17.3796 7.59287 17.0335 7.72108C15.7089 8.21164 13.9292 8.5 12 8.5C10.0708 8.5 8.29107 8.21164 6.96654 7.72108C6.62039 7.59287 6.29445 7.44688 6 7.28202V9.75C6 9.79993 6.02476 9.94015 6.27454 10.1589C6.52284 10.3763 6.92537 10.6063 7.48751 10.8145C8.60601 11.2287 10.2013 11.5 12 11.5C13.7987 11.5 15.394 11.2287 16.5125 10.8145C17.0746 10.6063 17.4772 10.3763 17.7255 10.1589C17.9752 9.94015 18 9.79993 18 9.75ZM6 11.782C6.29445 11.9469 6.62039 12.0929 6.96654 12.2211C8.29107 12.7116 10.0708 13 12 13C13.9292 13 15.7089 12.7116 17.0335 12.2211C17.3796 12.0929 17.7055 11.9469 18 11.782V14.25C18 14.2999 17.9752 14.4402 17.7255 14.6589C17.4772 14.8763 17.0746 15.1063 16.5125 15.3145C15.394 15.7287 13.7987 16 12 16C10.2013 16 8.60601 15.7287 7.48751 15.3145C6.92537 15.1063 6.52284 14.8763 6.27454 14.6589C6.02476 14.4402 6 14.2999 6 14.25V11.782ZM6 18.75V16.282C6.29445 16.4469 6.62039 16.5929 6.96654 16.7211C8.29107 17.2116 10.0708 17.5 12 17.5C13.9292 17.5 15.7089 17.2116 17.0335 16.7211C17.3796 16.5929 17.7055 16.4469 18 16.282V18.75C18 18.7999 17.9752 18.9401 17.7255 19.1589C17.4772 19.3763 17.0746 19.6063 16.5125 19.8145C15.394 20.2287 13.7987 20.5 12 20.5C10.2013 20.5 8.60601 20.2287 7.48751 19.8145C6.92537 19.6063 6.52284 19.3763 6.27454 19.1589C6.02476 18.9401 6 18.7999 6 18.75Z"
                                            fill="#9585ff" />
                                    </svg>
                                </span>
                                <span class="text">Data Master</span>
                            </a>
                            <ul id="ddmenu_2" class="collapse dropdown-nav">
                                <li>
                                    <a href={{ route('rombel.manage') }}> Data Rombel </a>
                                </li>
                                <li>
                                    <a href={{ route('rayon.index') }}> Data Rayon </a>
                                </li>
                                <li>
                                    <a href={{ route('siswa.index') }}> Data Siswa </a>
                                </li>
                                <li>
                                    <a href={{ route('user.manage') }}> Data User </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('terlambat.index') }}>
                                <span class="icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                        <path
                                            d="M3.5 5.25C3.5 4.83579 3.16421 4.5 2.75 4.5C2.33579 4.5 2 4.83579 2 5.25V17.25C2 18.4926 3.00736 19.5 4.25 19.5H21.25C21.6642 19.5 22 19.1642 22 18.75C22 18.3358 21.6642 18 21.25 18H4.25C3.83579 18 3.5 17.6642 3.5 17.25V5.25Z"
                                            fill="#9585ff" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 10.2773C5.89543 10.2773 5 11.1728 5 12.2773V15.7501C5 16.1643 5.33579 16.5001 5.75 16.5001H8.25C8.66421 16.5001 9 16.1643 9 15.7501V12.2773C9 11.1728 8.10457 10.2773 7 10.2773ZM6.5 12.2773C6.5 12.0012 6.72386 11.7773 7 11.7773C7.27614 11.7773 7.5 12.0012 7.5 12.2773V15.0001H6.5V12.2773Z"
                                            fill="#9585ff" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.5 6.5C10.5 5.39543 11.3954 4.5 12.5 4.5C13.6046 4.5 14.5 5.39543 14.5 6.5V15.7501C14.5 16.1643 14.1642 16.5001 13.75 16.5001H11.25C10.8358 16.5001 10.5 16.1643 10.5 15.7501V6.5ZM12.5 6C12.2239 6 12 6.22386 12 6.5V15.0001H13V6.5C13 6.22386 12.7761 6 12.5 6Z"
                                            fill="#9585ff" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18 8.05859C16.8954 8.05859 16 8.95402 16 10.0586V15.7501C16 16.1643 16.3358 16.5001 16.75 16.5001H19.25C19.6642 16.5001 20 16.1643 20 15.7501V10.0586C20 8.95402 19.1046 8.05859 18 8.05859ZM17.5 10.0586C17.5 9.78245 17.7239 9.55859 18 9.55859C18.2761 9.55859 18.5 9.78245 18.5 10.0586V15.0001H17.5V10.0586Z"
                                            fill="#9585ff" />
                                    </svg>

                                </span>
                                <span class="text">Data Keterlambatan</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'ps')
                    <li class="nav-item">
                        <a href={{ route('ps.siswa.index') }}>
                            <span class="icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                    <path
                                        d="M3.5 5.25C3.5 4.83579 3.16421 4.5 2.75 4.5C2.33579 4.5 2 4.83579 2 5.25V17.25C2 18.4926 3.00736 19.5 4.25 19.5H21.25C21.6642 19.5 22 19.1642 22 18.75C22 18.3358 21.6642 18 21.25 18H4.25C3.83579 18 3.5 17.6642 3.5 17.25V5.25Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7 10.2773C5.89543 10.2773 5 11.1728 5 12.2773V15.7501C5 16.1643 5.33579 16.5001 5.75 16.5001H8.25C8.66421 16.5001 9 16.1643 9 15.7501V12.2773C9 11.1728 8.10457 10.2773 7 10.2773ZM6.5 12.2773C6.5 12.0012 6.72386 11.7773 7 11.7773C7.27614 11.7773 7.5 12.0012 7.5 12.2773V15.0001H6.5V12.2773Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.5 6.5C10.5 5.39543 11.3954 4.5 12.5 4.5C13.6046 4.5 14.5 5.39543 14.5 6.5V15.7501C14.5 16.1643 14.1642 16.5001 13.75 16.5001H11.25C10.8358 16.5001 10.5 16.1643 10.5 15.7501V6.5ZM12.5 6C12.2239 6 12 6.22386 12 6.5V15.0001H13V6.5C13 6.22386 12.7761 6 12.5 6Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18 8.05859C16.8954 8.05859 16 8.95402 16 10.0586V15.7501C16 16.1643 16.3358 16.5001 16.75 16.5001H19.25C19.6642 16.5001 20 16.1643 20 15.7501V10.0586C20 8.95402 19.1046 8.05859 18 8.05859ZM17.5 10.0586C17.5 9.78245 17.7239 9.55859 18 9.55859C18.2761 9.55859 18.5 9.78245 18.5 10.0586V15.0001H17.5V10.0586Z"
                                        fill="#9585ff" />
                                </svg>

                            </span>
                            <span class="text">Data Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('ps.terlambat.index') }}>
                            <span class="icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                    <path
                                        d="M3.5 5.25C3.5 4.83579 3.16421 4.5 2.75 4.5C2.33579 4.5 2 4.83579 2 5.25V17.25C2 18.4926 3.00736 19.5 4.25 19.5H21.25C21.6642 19.5 22 19.1642 22 18.75C22 18.3358 21.6642 18 21.25 18H4.25C3.83579 18 3.5 17.6642 3.5 17.25V5.25Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7 10.2773C5.89543 10.2773 5 11.1728 5 12.2773V15.7501C5 16.1643 5.33579 16.5001 5.75 16.5001H8.25C8.66421 16.5001 9 16.1643 9 15.7501V12.2773C9 11.1728 8.10457 10.2773 7 10.2773ZM6.5 12.2773C6.5 12.0012 6.72386 11.7773 7 11.7773C7.27614 11.7773 7.5 12.0012 7.5 12.2773V15.0001H6.5V12.2773Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.5 6.5C10.5 5.39543 11.3954 4.5 12.5 4.5C13.6046 4.5 14.5 5.39543 14.5 6.5V15.7501C14.5 16.1643 14.1642 16.5001 13.75 16.5001H11.25C10.8358 16.5001 10.5 16.1643 10.5 15.7501V6.5ZM12.5 6C12.2239 6 12 6.22386 12 6.5V15.0001H13V6.5C13 6.22386 12.7761 6 12.5 6Z"
                                        fill="#9585ff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18 8.05859C16.8954 8.05859 16 8.95402 16 10.0586V15.7501C16 16.1643 16.3358 16.5001 16.75 16.5001H19.25C19.6642 16.5001 20 16.1643 20 15.7501V10.0586C20 8.95402 19.1046 8.05859 18 8.05859ZM17.5 10.0586C17.5 9.78245 17.7239 9.55859 18 9.55859C18.2761 9.55859 18.5 9.78245 18.5 10.0586V15.0001H17.5V10.0586Z"
                                        fill="#9585ff" />
                                </svg>

                            </span>
                            <span class="text">Data Keterlambatan</span>
                        </a>
                    </li>
                    @endif
                @endif
            </aside>
            <div class="overlay"></div>

            <main class="main-wrapper">
                <header class="header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-6">
                                <div class="header-left d-flex align-items-center">
                                    <div class="menu-toggle-btn mr-15">
                                        <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                            <i class="lni lni-chevron-left me-2"></i> Menu
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-6">
                                <div class="header-right">
                                    <div class="profile-box ml-15">
                                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="profile-info">
                                                <div class="info">
                                                    <div
                                                        class="image flex justify-center items-center h-16 w-16 bg-gray-200 rounded-full">
                                                        <i class="lni lni-user pt-15"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-500">{{ Auth::user()->name }}</h6>
                                                        <p>{{ Auth::user()->role }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                            <li>
                                                <div class="author-info flex items-center !p-1">
                                                    <div class="content">
                                                        <h4 class="text-sm">{{ Auth::user()->name }}</h4>
                                                        <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                                            href="#">{{ Auth::user()->email }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#0">
                                                    <i class="lni lni-user"></i> View Profile
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="lni lni-exit"></i> Sign Out
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <section class="section">
                    <div class="container-fluid">
                        <div class="title-wrapper">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="title"></div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 order-last order-md-first">
                                    <div class="copyright text-center text-md-start">
                                        <p class="text-sm">
                                            Designed and Developed by
                                            <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                                Me
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </footer>
            </main>
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
            <script src="{{ asset('assets/js/polyfill.js') }}"></script>
            <script src="{{ asset('assets/js/main.js') }}"></script>
            <script src="https://kit.fontawesome.com/08f68f1ffc.js" crossorigin="anonymous"></script>

            <script></script>
        </body>

        </html>
