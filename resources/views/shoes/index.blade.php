@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <section class="hero">
        <div class="heroleft">
            <h1>„Kocham Rebook i prezesa firmy 5/5"</h1>
            <h1> - Maciej Cichoń</h1>
            <button class="herobtn"><a href="#sekcja_z_butami">ZGARNIJ TERAZ</a></button>
        </div>
        <div class="heroimg">
            <img src="{{ asset('storage/shoes/hero123.png') }}" alt="but">
        </div>
    </section>
    <title>Sklep z butami</title>
    <div class="szukaj">
        <input type="text" class="search" id="filtr" placeholder="Wyszukaj swoich wymarzonych butów">
    </div>

    <div class="filtr" id="filtrbtn">
        <img src="{{ asset('storage/shoes/filtricon.png') }}" alt="filtricon">
        <h1>FILTR</h1>
    </div>

    <div id="filtrpanel" class="filtrpanel">
        <div>
            <img src="{{ asset('storage/shoes/Sneaker.png') }}" alt="logo strony">
        </div>
        <hr>
        <div class="filtrgrupa">
            <h3>Wybierz markę</h3>
            <select id="marka" name="brand">
                <option value="">Wszystkie</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->brand }}" {{ request('brand') == $brand->brand ? 'selected' : '' }}>
                        {{ $brand->brand }} ({{ $brand->total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">

            <h3>Wybierz kategorię</h3>
            <select id="kat" name="category">
                <option value="">Wszystkie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                        {{ $category->category }} ({{ $category->total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">

            <h3>Wybierz rodzaj</h3>
            <select id="rodz" name="type">
                <option value="">Wszystkie</option>
                @foreach($types as $type)
                    <option value="{{ $type->type }}" {{ request('type') == $type->type ? 'selected' : '' }}>
                        {{ $type->type }} ({{ $type->total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">

            <h3>Cena</h3>
            <input type="text" id="min" placeholder="Min cena">
            <input type="text" id="max" placeholder="Max cena">
        </div>
        <div class="filtrgrupa">
            <button id="reset" class="btn btn-secondary">Resetuj filtry</button>
        </div>
    </div>
    <div id="sekcja_z_butami"></div>
    <div class="widok">
        @if($shoes->count())
            <ul class="lista">
                @foreach($shoes as $shoe)
                    <li
                        data-name="{{ strtolower($shoe->name) }}"
                        data-brand="{{ strtolower($shoe->brand) }}"
                        data-category="{{ strtolower($shoe->category ?? '') }}"
                        data-type="{{ strtolower($shoe->type ?? '') }}"
                        data-price="{{ $shoe->price }}"
                        class="card"
                    >
                        <a href="{{ route('shoes.show', $shoe) }}" class="product-link">
                            @if($shoe->image)
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->name }}">
                            @else
                                <div class="no-image">Brak zdjęcia</div>
                            @endif
                            <h4 class="nazwa">{{ $shoe->name }}</h4>
                            <hr>
                            <div class="product-brand">{{ $shoe->brand }}</div>
                            <div class="cena">{{ number_format($shoe->price, 2, '.', '') }} zł</div>
                            <div class="product-meta">{{ $shoe->category }}</div>
                            <div class="product-meta">{{ $shoe->type }}</div>
                            <div class="product-meta" id="rozmiar" style="display: none;">{{ $shoe->size }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert-box" style="width: 100%;">
                Brak produktów spełniających wybrane kryteria.
            </div>
        @endif
    </div>

@endsection
