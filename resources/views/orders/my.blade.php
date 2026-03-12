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
    <h1 class="mb-4">Moje zamówienia</h1>

    @if($orders->count() === 0)
        <p>Nie masz jeszcze żadnych zamówień.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Nr zamówienia</th>
                        <th>Data</th>
                        <th>Kwota</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ number_format($order->total, 2, ',', ' ') }} zł</td>
                            <td>{{ $order->customer_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
    @endif
    @endsection

</body>
</html>