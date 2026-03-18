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

    

<div class="row">
    <div class="col-md-8">
        <h3 class="mb-4">Opinie o produkcie</h3>

        @auth
            <form action="{{ route('reviews.store', $shoe) }}" method="POST" class="mb-5">
                @csrf

                <div class="mb-3">
                    <label for="rating" class="form-label">Ocena</label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="5">5/5</option>
                        <option value="4">4/5</option>
                        <option value="3">3/5</option>
                        <option value="2">2/5</option>
                        <option value="1">1/5</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Twoja opinia</label>
                    <textarea name="content" id="content" rows="4" class="form-control" placeholder="Napisz, co sądzisz o tych butach"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Dodaj opinię</button>
            </form>
        @else
            <div class="alert alert-info">
                Zaloguj się, aby dodać opinię.
            </div>
        @endauth

        @forelse($shoe->reviews()->latest()->get() as $review)
            <div class="border rounded p-3 mb-3 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>{{ $review->user->name }}</strong>
                    <span>{{ $review->rating }}/5</span>
                </div>

                <p class="mb-2">{{ $review->content }}</p>

                @auth
                    @if(auth()->id() === $review->user_id)
                        <div class="d-flex gap-3">
                            <span>
                                <a href="{{ route('reviews.edit', $review) }}">Edytuj</a>
                            </span>

                            <span>
                                <a href="{{ route('reviews.destroy', $review) }}"
                                onclick="event.preventDefault(); document.getElementById('delete-review-{{ $review->id }}').submit();">
                                    Usuń
                                </a>
                            </span>
                        </div>

                        <form id="delete-review-{{ $review->id }}"
                            action="{{ route('reviews.destroy', $review) }}"
                            method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <p>Ten produkt nie ma jeszcze opinii.</p>
        @endforelse
    </div>
</div>
@endsection
