<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ishoba Hair </title>
    <link rel="stylesheet" href="/scss/app.css" />
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <div class="navbar bg-warning fixed-top">
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
                            {{-- <a class="nav-link text-uppercase" href="#">Reviews</a> --}}
                            <a class="nav-link text-uppercase {{\URL::current() === \URL::route('public.contact') ? 'active':''}}"
                                href="{{route('public.contact')}}">Contact Us</a>
                            <a class="nav-link text-uppercase text-primary" href="{{ route('public.shopping-cart')}}"><i
                                    class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container content flex-grow-1">
        @yield('content')
    </div>

    <div class="footer pt-4">
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
                            href="mailto:&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;</a>
                        <br />
                        <i class="fas fa-map-marker-alt"></i> <a href="">Shop 2 Sangro House,<br /> <i
                                class="fas fa-map-marker-alt hideIcon"></i> 417 Anton Lembede Street (Smith
                            Street),<br />
                            <i class="fas fa-map-marker-alt hideIcon"></i> Durban (CBD) 4000</a>
                    </p>
                </div>
                <div class="links">
                    <ol class="list-unstyled">
                        <li><a href="">About</a></li>
                        <li><a href="">Shop Now</a></li>
                        <li><a href="">Reviews</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ol>
                    <div class="socials mt-2">
                        <a target="_blank" href=""><i class="fab fa-2x fa-whatsapp"></i></a>
                        <a target="_blank" href=""><i class="fab fa-2x fa-facebook"></i></a>
                        <a target="_blank" href=""><i class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div>
                <div class="contacts mt-4 d-block d-md-none">
                    <p>
                        <i class="fas fa-phone"></i> <a
                            href="tel:&#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48;" target="_blank">
                            &#48;&#55;&#57;&#32;&#53;&#53;&#51;&#32;&#48;&#48;&#56;&#48</a>
                        <br />
                        <i class="fas fa-at"></i> <a
                            href="mailto:&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#115;&#116;&#114;&#101;&#115;&#115;&#108;&#101;&#115;&#115;&#103;&#114;&#111;&#117;&#112;&#46;&#99;&#111;&#46;&#122;&#97;</a>
                        <br />
                        <i class="fas fa-map-marker-alt"></i> <a href="">Shop 2 Sangro House,<br /> <i
                                class="fas fa-map-marker-alt hideIcon"></i> 417 Anton Lembede Street (Smith
                            Street),<br />
                            <i class="fas fa-map-marker-alt hideIcon"></i> Durban (CBD) 4000</a>
                    </p>
                </div>
            </div>
        </div>
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