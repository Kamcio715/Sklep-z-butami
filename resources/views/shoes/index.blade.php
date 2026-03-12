<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="sidebar-box">
                <form method="GET" action="{{ route('shoes.index') }}">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Wybierz markę</label>
                        <select name="brand" class="form-select">
                            <option value="">Wszystkie</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" @selected(request('brand') == $brand)>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Wybierz kategorię</label>
                        <select name="category" class="form-select">
                            <option value="">Wszystkie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" @selected(request('category') == $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Wybierz rodzaj</label>
                        <select name="type" class="form-select">
                            <option value="">Wszystkie</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" @selected(request('type') == $type)>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Szukaj modelu</label>
                        <input type="text"
                            name="q"
                            value="{{ request('q') }}"
                            class="form-control"
                            placeholder="Np. CARINA 2.0">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-main">Filtruj</button>
                        <a href="{{ route('shoes.index') }}" class="btn btn-soft">Wyczyść</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="content-box">
                <h1 class="section-title">Buty</h1>

                <div class="row g-4">
                    @forelse($shoes as $shoe)
                        <div class="col-md-6 col-xl-4">
                            <div class="shop-card">
                                @if($shoe->image)
                                    <img src="{{ asset('storage/' . $shoe->image) }}"
                                        alt="{{ $shoe->name }}"
                                        class="shop-card-image">
                                @else
                                    <div class="empty-image">Brak zdjęcia</div>
                                @endif

                                <div class="p-3 d-flex flex-column h-100">
                                    <div class="product-name">{{ $shoe->name }}</div>
                                    <div class="product-brand">{{ $shoe->brand }}</div>
                                    <div class="product-price">{{ number_format($shoe->price, 2, ',', ' ') }} zł</div>
                                    <div class="product-meta">{{ $shoe->category }}</div>
                                    <div class="product-meta mb-3">{{ $shoe->type }}</div>

                                    <a href="{{ route('shoes.show', $shoe) }}" class="btn btn-main mt-auto">
                                        Zobacz produkt
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning mb-0">
                                Brak produktów spełniających wybrane kryteria.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $shoes->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection

</body>
</html>