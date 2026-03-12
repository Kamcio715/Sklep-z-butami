@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        @if($shoe->image)
            <img src="{{ asset('storage/' . $shoe->image) }}"
                 alt="{{ $shoe->name }}"
                 class="img-fluid rounded shadow-sm">
        @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                 style="height: 400px;">
                Brak zdjęcia
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <h1 class="mb-3">{{ $shoe->name }}</h1>
        <p><strong>Marka:</strong> {{ $shoe->brand }}</p>
        <p><strong>Kategoria:</strong> {{ $shoe->category ?: 'Brak danych' }}</p>
        <p><strong>Rodzaj:</strong> {{ $shoe->type ?: 'Brak danych' }}</p>
        <p><strong>Rozmiar:</strong> {{ $shoe->size }}</p>
        <p><strong>Kolor:</strong> {{ $shoe->color ?: 'Brak danych' }}</p>
        <p><strong>Cena:</strong> {{ number_format($shoe->price, 2, ',', ' ') }} zł</p>
        <p>{{ $shoe->description }}</p>

        <form action="{{ route('cart.add', $shoe) }}" method="POST" class="mt-4">
            @csrf
            <div class="d-flex gap-2">
                <input type="number" name="quantity" value="1" min="1" class="form-control" style="max-width: 100px;">
                <button class="btn btn-success">Dodaj do koszyka</button>
            </div>
        </form>
    </div>
</div>
@endsection
