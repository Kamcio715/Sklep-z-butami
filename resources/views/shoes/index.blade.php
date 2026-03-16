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
            @if($shoes->count() > 0)
                <ul class="lista">
                    @foreach($shoes as $shoe)
                        <li>
                            <a href="{{ route('shoes.show', $shoe) }}" class="product-link">
                                <div class="product-card">
                                    @if($shoe->image)
                                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->name }}">
                                    @else
                                        <div class="no-image">Brak zdjęcia</div>
                                    @endif

                                    <div class="produkt">
                                        <h4 class="nazwa">{{ $shoe->name }}</h4>
                                        <div class="product-brand">{{ $shoe->brand }}</div>
                                        <div class="product-price">
                                            {{ number_format($shoe->price, 2, ',', ' ') }} zł
                                        </div>
                                        <div class="product-meta">{{ $shoe->category }}</div>
                                        <div class="product-meta">{{ $shoe->type }}</div>

                                        <div style="margin-top: 14px;">
                                            <span class="btn-main">Zobacz produkt</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert-box" style="width: 100%;">
                    Brak produktów spełniających wybrane kryteria.
                </div>
            @endif
        </section>
    </div>

    <div class="pagination-wrap">
        {{ $shoes->links() }}
    </div>
</div>
@endsection


<!-- <li>
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
                    </li> -->