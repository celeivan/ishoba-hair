<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ishoba Hair </title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/scss/app.css"/>
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <div class="navbar bg-warning">
        <div class="container">
            <nav class="navbar navbar-expand-lg w-100">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase" href="{{ route('public.home')}}">Ishoba Hair</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column" id="navbarNavAltMarkup">
                        <div class="navbar-nav align-self-end">
                            <a class="nav-link text-uppercase" aria-current="page" href="#">About</a>
                            <a class="nav-link text-uppercase" href="#">Shop Now</a>
                            <a class="nav-link text-uppercase" href="#">Reviews</a>
                            <a class="nav-link text-uppercase" href="{{route('public.contact')}}">Contact Us</a>
                            <a class="nav-link text-uppercase" href=#><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container flex-grow-1">
        @yield('content')
    </div>

    <div class="footer bg-warning">
        <div class="container d-flex">
            <div class="col-md-3">Footer Col</div>
            <div class="col-md-3">Footer Col</div>
            <div class="col-md-3">Footer Col</div>
            <div class="col-md-3">Footer Col</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>