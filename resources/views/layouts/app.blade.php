<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep z butami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/naglowek.css') }}"> 
    <script src="{{ asset('js/filtrowanie.js') }}"></script>
    </head>
<body>
    <header class="topbar py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('shoes.index') }}" class="brand-logo">Sklep z butami</a>

            <div class="d-flex gap-2 align-items-center">
                <a class="btn btn-soft btn-sm" href="{{ route('cart.index') }}">Koszyk</a>

                @auth
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
</body>
</html>
