@extends('layouts.app')

@section('content')

    <div class="szukaj">
        <input
            type="text"
            class="szukaj_input"
            id="filtr"
            placeholder="Wyszukaj swoich wymarzonych butów"
        >
    </div>

    <aside class="details">

        <h3>Wybierz markę</h3>
        <select id="marka">
            <option value="">Wszystkie</option>
            @foreach($brands as $brand)
                <option value="{{ $brand }}">{{ $brand }}</option>
            @endforeach
        </select>

        <h3>Wybierz kategorię</h3>
        <select id="kat">
            <option value="">Wszystkie</option>
            @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>

        <h3>Wybierz rodzaj</h3>
        <select id="rodz">
            <option value="">Wszystkie</option>
            @foreach($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>

        

        <h3>Cena</h3>
        <input type="text" id="min" placeholder="Min cena">
        <input type="text" id="max" placeholder="Max cena">
    </aside>

    <div class="widok">
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

                                <div class="product-body">
                                    <h4 class="nazwa">{{ $shoe->name }}</h4>
                                    <div class="product-brand">{{ $shoe->brand }}</div>
                                    <div class="cena">{{ number_format($shoe->price, 2, '.', '') }} zł</div>
                                    <div class="product-meta">{{ $shoe->category }}</div>
                                    <div class="product-meta">{{ $shoe->type }}</div>
                                    <div class="product-meta" id="rozmiar" style="display: none;">{{ $shoe->size }}</div>
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
    </div>

@endsection
