    @extends('layouts.app')

@section('content')
<div class="container-shop">

    <div class="szukaj">
        <form method="GET" action="{{ route('shoes.index') }}">
            <input
                type="text"
                name="q"
                class="szukaj_input"
                placeholder="Wyszukaj swoich wymarzonych butów"
                value="{{ request('q') }}"
            >

            <input type="hidden" name="brand" value="{{ request('brand') }}">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="type" value="{{ request('type') }}">
        </form>
    </div>

    <div class="layout-shop">
        <aside class="filters">
            <h3>Filtry</h3>

            <form method="GET" action="{{ route('shoes.index') }}">
                <input type="hidden" name="q" value="{{ request('q') }}">

                <label for="brand">Wybierz markę</label>
                <select name="brand" id="brand">
                    <option value="">Wszystkie</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') == $brand)>
                            {{ $brand }}
                        </option>
                    @endforeach
                </select>

                <label for="category">Wybierz kategorię</label>
                <select name="category" id="category">
                    <option value="">Wszystkie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" @selected(request('category') == $category)>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <label for="type">Wybierz rodzaj</label>
                <select name="type" id="type">
                    <option value="">Wszystkie</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>

                <div class="buttons">
                    <button type="submit" class="btn-main">Filtruj</button>
                    <a href="{{ route('shoes.index') }}" class="btn-soft">Wyczyść</a>
                </div>
            </form>
        </aside>

        <section class="widok">
            @if($shoes->count())
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