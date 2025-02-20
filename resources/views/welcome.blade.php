@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1>Welcome to Our Store</h1>

        <h2>Our Products</h2>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                Price: {{ $product->currency->symbol }}{{ number_format($product->price, 2) }}
                            </p>
                            <p class="card-text">Category: {{ $product->category->name }}</p>

                            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
