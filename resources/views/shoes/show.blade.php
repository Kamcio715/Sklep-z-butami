@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6">
    @if($shoe->image)
        <img src="{{ asset('storage/' . $shoe->image) }}"
             alt="{{ $shoe->name }}"
             style="max-width: 100%; height: auto; border-radius: 8px;">
    @else
        <div>Brak zdjęcia</div>
    @endif
</div>

        <div class="col-lg-6">
            <h1 class="mb-3">{{ $shoe->name }}</h1>

            <div class="mb-3">
                <span class="badge bg-dark me-2">{{ $shoe->brand }}</span>
                @if($shoe->category)
                    <span class="badge bg-secondary me-2">{{ $shoe->category }}</span>
                @endif
                @if($shoe->type)
                    <span class="badge bg-secondary">{{ $shoe->type }}</span>
                @endif
            </div>

            <h3 class="text-dark mb-4">{{ number_format($shoe->price, 2, ',', ' ') }} zł</h3>
            <div class="product-meta">
                Stan:
                @if ($shoe->stock > 0)
                    <span class="text-success">Dostępny ({{ $shoe->stock }} w magazynie)</span>
                @else
                    <span class="text-danger">Niedostępny</span>
                @endif
            </div>

            <div class="row row-cols-2 g-3 mb-4">
                <div class="col">
                    <div class="border rounded p-3 h-100">
                        <small class="text-muted d-block">Marka</small>
                        <strong>{{ $shoe->brand }}</strong>
                    </div>
                </div>

                <div class="col">
                    <div class="border rounded p-3 h-100">
                        <small class="text-muted d-block">Kategoria</small>
                        <strong>{{ $shoe->category ?: 'Brak danych' }}</strong>
                    </div>
                </div>

                <div class="col">
                    <div class="border rounded p-3 h-100">
                        <small class="text-muted d-block">Rodzaj</small>
                        <strong>{{ $shoe->type ?: 'Brak danych' }}</strong>
                    </div>
                </div>

                <div class="col">
                    <div class="border rounded p-3 h-100">
                        <small class="text-muted d-block">Rozmiar</small>
                        <strong>{{ $shoe->size }}</strong>
                    </div>
                </div>

                <div class="col">
                    <div class="border rounded p-3 h-100">
                        <small class="text-muted d-block">Kolor</small>
                        <strong>{{ $shoe->color ?: 'Brak danych' }}</strong>
                    </div>
                </div>
            </div>

            @if($shoe->description)
                <div class="mb-4">
                    <h5>Opis</h5>
                    <p class="text-muted mb-0">{{ $shoe->description }}</p>
                </div>
            @endif

            @if($shoe->stock > 0)
                <form action="{{ route('cart.add', $shoe) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="d-flex gap-2">
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            class="form-control"
                            style="width: 90px;"
                            required
                        >

                        <button class="btn btn-success">Dodaj do koszyka</button>
                    </div>
                </form>
            @else
                <button class="btn btn-secondary mt-4" disabled>Brak w magazynie</button>
            @endif
        </div>
    </div>

    @if(isset($recommendedShoes) && $recommendedShoes->count())
        <div class="mt-5">
            <h3 class="mb-4">Proponowane buty</h3>

            <div class="row g-4">
                @foreach($recommendedShoes as $recommended)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            @if($recommended->image)
                                <img src="{{ asset('storage/' . $recommended->image) }}"
                                     class="card-img-top"
                                     alt="{{ $recommended->name }}"
                                     style="height: 220px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light"
                                     style="height: 220px;">
                                    <span class="text-muted">Brak zdjęcia</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $recommended->name }}</h5>
                                <p class="text-muted mb-2">{{ $recommended->brand }}</p>
                                <p class="fw-bold mb-3">{{ number_format($recommended->price, 2, ',', ' ') }} zł</p>

                                <a href="{{ route('shoes.show', $recommended) }}" class="btn btn-outline-dark mt-auto">
                                    Zobacz produkt
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<section class="bg-gray-200 pt-lg-14 pb-lg-16 pt-5 pb-8 mt-5">
    <div class="container">
        <div class="row mb-lg-10 mb-5">
            <div class="offset-lg-1 col-lg-10 col-12">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div>
                            <div class="mb-3">
                                <span class="text-dark fw-semibold">
                                    {{ number_format($shoe->reviews->avg('rating') ?? 0, 1) }}/5.0
                                </span>
                                <!-- <span>
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fs-6 align-top">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        </span>
                                    @endfor
                                </span> -->
                                <span class="ms-2">Na podstawie {{ $shoe->reviews->count() }} opinii</span>
                            </div>

                            <h2 class="mb-0">
                                Poznaj opinie klientów o tym modelu butów.
                            </h2>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-4 text-md-end mt-4 mt-md-0">
                        @auth
                            <a href="{{ route('login') }}" class="btn btn-primary">Zaloguj się</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5" id="dodaj-opinie">
            <div class="offset-lg-1 col-lg-10 col-12">
                @auth
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Dodaj swoją opinię</h4>

                            <form action="{{ route('reviews.store', $shoe) }}" method="POST">
                                @csrf

                                <div class="col-md-6">
                                    <div class="rating-card p-4">
                                        <div class="star-rating animated-stars">
                                            <input type="radio" id="star5" name="rating" value="5">
                                            <label for="star5" class="bi bi-star-fill"></label>
                                            <input type="radio" id="star4" name="rating" value="4">
                                            <label for="star4" class="bi bi-star-fill"></label>
                                            <input type="radio" id="star3" name="rating" value="3">
                                            <label for="star3" class="bi bi-star-fill"></label>
                                            <input type="radio" id="star2" name="rating" value="2">
                                            <label for="star2" class="bi bi-star-fill"></label>
                                            <input type="radio" id="star1" name="rating" value="1">
                                            <label for="star1" class="bi bi-star-fill"></label>
                                        </div>
                                        <p class="text-muted mt-2">Click to rate</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Twoja opinia</label>
                                    <textarea name="content" id="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="Napisz, co sądzisz o tych butach..." required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Dodaj opinię</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        Zaloguj się, aby dodać opinię.
                    </div>
                @endauth
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="position-relative">
                    <div class="sliderTestimonialThird">
                        @forelse($shoe->reviews as $review)
                            <div class="item">
                                <div class="card">
                                    <div class="card-body text-center p-6">
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'Użytkownik') }}&background=0D8ABC&color=fff&size=128"
                                            alt="{{ $review->user->name ?? 'Użytkownik' }}"
                                            class="avatar avatar-lg rounded-circle"
                                        >

                                        <p class="mb-0 mt-3">{{ $review->content }}</p>

                                        <div class="lh-1 mb-3 mt-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="fs-6 align-top">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}" viewBox="0 0 16 16">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                    </svg>
                                                </span>
                                            @endfor
                                            <span class="text-warning">{{ $review->rating }}/5</span>
                                        </div>

                                        <div>
                                            <h3 class="mb-0 h4">{{ $review->user->name ?? 'Użytkownik' }}</h3>
                                            <span>{{ $review->created_at->format('d.m.Y H:i') }}</span>
                                        </div>

                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
                                                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-outline-primary btn-sm">
                                                        Edytuj
                                                    </a>

                                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            Usuń
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="item">
                                <div class="card">
                                    <div class="card-body text-center p-6">
                                        <h3 class="mb-3 h4">Brak opinii</h3>
                                        <p class="mb-0">Ten produkt nie ma jeszcze opinii.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
