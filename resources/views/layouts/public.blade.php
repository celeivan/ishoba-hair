<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="Natural Hair, African Hair, Afro, Afro Hair">
    @php
    $description = "iShoba Hair is a range of locally (South African) made natural hair care products. Made from organic
    ingredients ensuring that the end products are safe for your hair and can be trusted.";
    @endphp
    <meta name="description" content="{{$description}}">

    <meta property="og:url" content="https://ishoba.co.za" />
    <meta property="og:site_name" content="Ishoba Hair" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Ishoba Hair" />
    <meta property="og:description" content="{{$description}}" />
    <meta property="og:image" content="{{ asset('images/fb-image.png') }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="1200" />
    <meta property="og:image:alt" content="iShoba Hair Logo" />
    <meta property="fb:app_id" content="675894680352863" />

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">

    <title>iShoba Hair </title>
    <link rel="stylesheet" href="/scss/app.css" />
</head>

<body class="bg-warning d-flex flex-column min-vh-100">
    <div class="navbar bg-light fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg w-100">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase d-flex align-items-center" href="{{ route('public.home')}}">
                        <img src="/images/ishobalogo.png" alt="" height="40px" class="d-inline-block align-text-top">
                        <span>Ishoba Hair</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    <div class="collapse navbar-collapse flex-column" id="navbarNavAltMarkup">
                        <div class="navbar-nav align-self-end">
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('public.home') ? 'active':''}}"
                                href="{{ route('public.home') }}">About</a>
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('public.shop') ? 'active':''}}"
                                href="{{ route('public.shop')}}">Shop Now</a>
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('public.distributor') ? 'active':''}}"
                                href="{{ route('public.distributor')}}">Distributors</a>
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('public.contact') ? 'active':''}}"
                                href="{{route('public.contact')}}">Contact Us</a>

                            @if(Auth::check())
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('admin.home') ? 'active':''}}"
                                href="{{ route('admin.home') }}">{{ Auth::user()->isAdmin() ?  'Orders' : 'My Orders' }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link text-uppercase text-danger" href='#' onclick="event.preventDefault();
                                this.closest('form').submit();">Logout</a>
                            </form>
                            @else
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('login') ? 'active':''}}"
                                href="{{route('login')}}">Login</a>
                            @endif

                            <a class="nav-link text-uppercase text-primary" href="{{ route('public.shopping-cart')}}"><i
                                class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="content flex-grow-1 d-flex flex-column">
        @if(session('success'))
        <div class="container bg-white rounded py-2 session-message text-center">
            <p class="alert alert-success rounded m-0">{{ session('success') }}</p>
        </div>
        @elseif(session('error'))
        @endif

        @if ($errors->any())
        <div class="container bg-white rounded py-2 text-center">
            <div class="alert m-0 alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @yield('content')
    </div>

    <div class="footer pt-4">
        @if(!Auth::check())
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="logo">
                    <img src="/images/ishobalogo.png" class="img-responsive img-fluid" alt="iShoba Hair logo" />
                </div>
                <div class="contacts d-none d-md-block">
                    <p>
                        <i class="fas fa-phone"></i> <a
                            href="tel:&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;" target="_blank">
                            &#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48</a>
                        <br />
                        <i class="fas fa-at"></i> <a
                            href="mailto:&#105;&#110;&#102;&#111;&#64;&#105;&#115;&#104;&#111;&#98;&#97;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#105;&#115;&#104;&#111;&#98;&#97;&#46;&#99;&#111;&#46;&#122;&#97;</a>
                        <br />
                        <i class="fas fa-map-marker-alt"></i> <a href="">Shop 2 Sangro House,<br /> <i
                                class="fas fa-map-marker-alt hideIcon"></i> 417 Anton Lembede Street (Smith
                            Street),<br />
                            <i class="fas fa-map-marker-alt hideIcon"></i> Durban (CBD) 4000</a>
                    </p>
                </div>
                {{-- <div class="links">
                    <ol class="list-unstyled">
                        <li><a href="{{ route('public.home') }}">About</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop Now</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact Us</a></li>
                    </ol>
                    <div class="socials mt-2">
                        <a target="_blank" href="https://wa.me/&#50;&#55;&#55;&#57;&#53;&#51;&#51;&#48;&#48;&#56;&#48;"
                            target="_blank"><i class="fab fa-2x fa-whatsapp"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ishobahair" target="_blank"><i
                                class="fab fa-2x fa-facebook"></i></a>
                        <a target="_blank" href="https://www.instagram.com/ishobahair/"><i
                                class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div> --}}
                <div class="contacts mt-4 d-block d-md-none">
                    <p>
                        <i class="fas fa-phone"></i> <a
                            href="tel:&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;" target="_blank">
                            &#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48</a>
                        <br />
                        <i class="fas fa-at"></i> <a
                            href="mailto:&#105;&#110;&#102;&#111;&#64;&#105;&#115;&#104;&#111;&#98;&#97;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#105;&#115;&#104;&#111;&#98;&#97;&#46;&#99;&#111;&#46;&#122;&#97;</a>
                        <br />
                        <i class="fas fa-map-marker-alt"></i> <a href="https:////goo.gl/maps/xiV1nchFNK3mL5DF6"
                            target="_blank">Shop 2 Sangro House,<br /> <i class="fas fa-map-marker-alt hideIcon"></i>
                            417 Anton Lembede Street (Smith
                            Street),<br />
                            <i class="fas fa-map-marker-alt hideIcon"></i> Durban (CBD) 4000</a>
                    </p>
                </div>
                <div class="links">
                    <ol class="list-unstyled">
                        <li><a href="{{ route('public.home') }}">About</a></li>
                        <li><a href="{{ route('public.shop') }}">Shop Now</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact Us</a></li>
                    </ol>
                    <div class="socials mt-2">
                        <a target="_blank" href="https://wa.me/&#50;&#55;&#55;&#57;&#53;&#51;&#51;&#48;&#48;&#56;&#48;"
                            target="_blank"><i class="fab fa-2x fa-whatsapp"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ishobahair" target="_blank"><i
                                class="fab fa-2x fa-facebook"></i></a>
                        <a target="_blank" href="https://www.instagram.com/ishobahair/"><i
                                class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <p class="text-center">
                &copy; {{date('Y')}} iShoba Hair<br />
                Design by <a href="#">The Excellence Mark Consult</a>
            </p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>