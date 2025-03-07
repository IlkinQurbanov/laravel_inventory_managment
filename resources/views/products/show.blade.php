@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <p><strong>Price:</strong> {{ $product->currency->symbol }}{{ number_format($product->price, 2) }}</p>

        <p><strong>Category:</strong> {{ $product->category->name }}</p>

        <p><strong>Description:</strong> {{ $product->description }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
    </div>
@endsection
