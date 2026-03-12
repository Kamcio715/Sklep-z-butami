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
    <h1 class="mb-4">Edytuj but</h1>

    <form action="{{ route('admin.shoes.update', $shoe) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.shoes.form', ['shoe' => $shoe])
        <button class="btn btn-primary">Zapisz zmiany</button>
        <a href="{{ route('admin.shoes.index') }}" class="btn btn-secondary">Anuluj</a>
    </form>
    @endsection

</body>
</html>