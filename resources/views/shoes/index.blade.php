<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep z butami</title>
    <!-- <link rel="stylesheet" href="Styles/main.css">
    <link rel="stylesheet" href="Styles/naglowek.css">
    <script src="Scripts/filtrowanie.js"></script> -->
</head>
<body>
    @extends('layouts.app')

    @section('content')
    
    <!-- Nagłówek -->
        <header class="gora">
            <div class="logo">
                <a class="lewo" href="index.html"><img src="Images/logo.png" alt="logo strony"></a>
            </div>
            <h1 class="tytul">Buty.pl</h1>
            <div class="prawo">
                <button class="rejestracja"><a href="rejestracja.html">Zarejestruj się</a></button>
                <button class="login"><a href="logowanie.html">Zaloguj się</a></button>
                <a href="koszyk.html"><img class="koszyk" src="Images/koszyk.png" alt="koszyk"></a>
                <a href="uzytkownik.html"><img class="user" src="Images/user.png" alt="ikona użytkownika"></a>
            </div>
        </header>
        <!-- Szukanie po nazwie -->
        <div class="szukaj">
            <input type="text" class="szukaj_input" id="filtr" placeholder="Wyszukaj swoich wymarzonych butów">
        </div>
        <details class="details">
            <h3>Wybierz markę</h3>
            <select id="marka">
                <option value="">Wszystkie</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" @selected(request('brand') == $brand)>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
            <h3>Wybierz kategorię</h3>
            <select id="kat">
                <option value="">Wszystkie</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') == $category)>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
            <h3>Wybierz Rodzaj</h3>
            <select id="rodz">
                <option value="">Wszystkie</option>
                @foreach($types as $type)
                    <option value="{{ $type }}" @selected(request('type') == $type)>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            <input type="text" id="min" placeholder="Min cena">
            <input type="text" id="max" placeholder="Max cena">
        </details>
        <!-- Buty -->
        <div class="widok">
                <ul class="lista">
                    <li>
                        <div>
                            <div>
                                <img src="images/Carina2.0_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">CARINA 2.0</h1>
                                <h2>Puma</h2>
                                <h2 class="cena">339.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Sportowe</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/NebzedBasic_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">NEBZED BASIC</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">239.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Sportowe</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Run70s2.0_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">RUN 70s 2.0</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">299.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/BreaknetSleek_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">BREAKNET SLEEK</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">239.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Polbuty_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">PÓŁBUTY SKÓRZANE</h1>
                                <h2>Gino Rossi</h2>
                                <h2 class="cena">299.99 zł</h2>
                                <h3>Dla mężczyzn</h3>
                                <h3>Eleganckie</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Czolenka_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">CZÓŁENKA SKÓRZANE</h1>
                                <h2>Gino Rossi</h2>
                                <h2 class="cena">299.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Eleganckie</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Enzo_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">ENZO 2 CLEAN</h1>
                                <h2>Puma</h2>
                                <h2 class="cena">299.99 zł</h2>
                                <h3>Dla mężczyzn</h3>
                                <h3>Sportowe</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/NebzedBasic_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">NEBZED BASIC</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">239.99 zł</h2>
                                <h3>Dla mężczyzn</h3>
                                <h3>Sportowe</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Milton_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">MILTON</h1>
                                <h2>Vans</h2>
                                <h2 class="cena">239.99 zł</h2>
                                <h3>Dla mężczyzn</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/VsSwitch_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">VS SWITCH 3</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">149.99 zł</h2>
                                <h3>Dla dzieci</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Rickie_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">RICKIE CLASSIC V PS</h1>
                                <h2>Puma</h2>
                                <h2 class="cena">139.99 zł</h2>
                                <h3>Dla dzieci</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/DayOne_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">DAY ONE CLASSIC</h1>
                                <h2>Converse</h2>
                                <h2 class="cena">219.99 zł</h2>
                                <h3>Dla mężczyzn</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/DayOne_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">DAY ONE CLASSIC</h1>
                                <h2>Converse</h2>
                                <h2 class="cena">219.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/VLMOVE_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">VL MOVE EL C</h1>
                                <h2>Adidas</h2>
                                <h2 class="cena">129.99 zł</h2>
                                <h3>Dla dzieci</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <img src="images/Charge_01.jpg" alt="but">
                            </div>
                            <div>
                                <h1 class="nazwa">CHARGE</h1>
                                <h2>Reebok</h2>
                                <h2 class="cena">279.99 zł</h2>
                                <h3>Dla kobiet</h3>
                                <h3>Codzienne</h3>
                            </div>
                        </div>
                    </li>
                </ul>
        </div>
        <img src="images/sunflower.png" style="opacity: 6.7%; width: 100%; height: 40px;" onclick="window.open('https://i.imgflip.com/6m7i18.png?a492312')">
    @endsection

</body>
</html>