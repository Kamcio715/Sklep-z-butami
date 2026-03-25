@extends('layouts.app')

@section('content')

    <div class="szukaj">
        <input type="text" class="search" id="filtr" placeholder="Wyszukaj swoich wymarzonych butów">
    </div>

    <div class="filtr">
        <img id="filtricon" src="{{ asset('storage/shoes/filtricon.png') }}" alt="filtricon">
        <h1 id="filtrbtn">FILTR</h1>
    </div>

    <div id="filtrpanel" class="filtrpanel">

        <h3>Wybierz markę</h3>
        <select id="marka" name="brand">
            <option value="">Wszystkie</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->brand }}" {{ request('brand') == $brand->brand ? 'selected' : '' }}>
                    {{ $brand->brand }} ({{ $brand->total }})
                </option>
            @endforeach
        </select>

        <h3>Wybierz kategorię</h3>
        <select id="kat" name="category">
            <option value="">Wszystkie</option>
            @foreach($categories as $category)
                <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                    {{ $category->category }} ({{ $category->total }})
                </option>
            @endforeach
        </select>

        <h3>Wybierz rodzaj</h3>
        <select id="rodz" name="type">
            <option value="">Wszystkie</option>
            @foreach($types as $type)
                <option value="{{ $type->type }}" {{ request('type') == $type->type ? 'selected' : '' }}>
                    {{ $type->type }} ({{ $type->total }})
                </option>
            @endforeach
        </select>

        

        <h3>Cena</h3>
        <input type="text" id="min" placeholder="Min cena">
        <input type="text" id="max" placeholder="Max cena">
    </div>

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
                            <div class="product-card">
                                @if($shoe->image)
                                    <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->name }}">
                                @else
                                    <div class="no-image">Brak zdjęcia</div>
                                @endif

                                <div class="product-body">
                                    <h4 class="nazwa">{{ $shoe->name }}</h4>
                                    <hr>
                                    <div class="product-brand">{{ $shoe->brand }}</div>
                                    <div class="cena">{{ number_format($shoe->price, 2, '.', '') }} zł</div>
                                    <div class="product-meta">{{ $shoe->category }}</div>
                                    <div class="product-meta">{{ $shoe->type }}</div>
                                    <div class="product-meta" id="rozmiar" style="display: none;">{{ $shoe->size }}</div>
                                    
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
