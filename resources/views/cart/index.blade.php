@extends('layouts.app')

@section('content')
<h1 class="mb-4">Koszyk</h1>

@if(empty($cart))
    <p>Koszyk jest pusty.</p>
@else
    <form action="{{ route('cart.clear') }}" method="POST" class="mb-3">
        @csrf
        <button class="btn btn-outline-danger btn-sm">Wyczyść koszyk</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Marka</th>
                    <th>Cena</th>
                    <th>Ilość</th>
                    <th>Suma</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['brand'] }}</td>
                        <td>{{ number_format($item['price'], 2, ',', ' ') }} zł</td>
                        <td>
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" class="form-control" style="max-width: 100px;">
                                <button class="btn btn-primary btn-sm">Zmień</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h4>Razem: {{ number_format($total, 2, ',', ' ') }} zł</h4>
        <a href="{{ route('checkout.index') }}" class="btn btn-success">Przejdź do zamówienia</a>
    </div>
@endif
@endsection
