<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sklep z butami</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/naglowek.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/styl.css') }}">
    <script src="{{ asset('js/sprkoszyk.js') }}"></script>
    <script src="{{ asset('js/filtrowanie.js') }}"></script>
    <script src="{{ asset('js/liczprod.js') }}"></script>
    <script src="{{ asset('js/panele.js') }}"></script>
    <script src="{{ asset('js/recenzje.js') }}"></script>
    <script src="{{ asset('js/slide_naglowka.js') }}"></script>
    </head>
<body>
    <header class="header">
        <div class="logo">
            <a href="{{ route('shoes.index') }}" class="brand-logo"><img src="{{ asset('storage/shoes/Sneaker.png') }}" alt="Logo sklepu" class="img-fluid"></a>
        </div>
        <a href="{{ route('shoes.index') }}"><p class="tytul">Sklep z butami</p></a>
        <div class="prawo">
            <img id="searchlogo" src="{{ asset('storage/shoes/lupa.png') }}" alt="searchlogo"  id="sekcja_z_butami">
            <img class="koszykimg" onclick="window.location.href='{{ route('cart.index') }}'" src="{{ asset('storage/shoes/basketicon.png') }}" alt="koszyk">
            <img class="usericon" src="{{ asset('storage/shoes/usericon.png') }}" alt="ikona użytkownika">
            <div class="usermenu" id="usermenu">
                @auth
                    <a href="{{ route('profile.edit') }}">Profil</a>
                    <a class="btn btn-soft btn-sm" href="{{ route('orders.my') }}">Moje zamówienia</a>

                    @if(auth()->user()->is_admin)
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.shoes.index') }}">Panel admina</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Wyloguj</button>
                    </form>
                @else
                    <a class="btn btn-soft btn-sm" href="{{ route('login') }}">Logowanie</a>
                    <a class="btn btn-dark btn-sm" href="{{ route('register') }}">Rejestracja</a>
                @endauth
            </div>
        </div>
    </header>
    <main class="page-wrap">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    <footer class="footer">
        <div class="footercontainer">
            <p class="footertitle">POMOC</p>
            <hr>
            <div class="footerlink">
                <a href="#">Skontaktuj się z nami</a>
                <a href="#">Polityka prywatności</a>
                <a href="#">Regulamin</a>
            </div>
            <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone.</p>
        </div>
    </footer>
</body>
</html>