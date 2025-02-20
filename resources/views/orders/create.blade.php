@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <!-- Customer Name -->
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                @error('customer_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Selection -->
            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ isset($product) && $product->id == old('product_id', $product->id) ? 'selected' : '' }}>
                            {{ $product->name }} - ${{ $product->price }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Optional: Automatically prefill the selected product if coming from the welcome page -->
            @isset($product)
                <input type="hidden" name="product_id" value="{{ $product->id }}">
            @endisset

            <!-- Status (initially set to 'new') -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="new" selected>New</option>
                    <option value="completed">Completed</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Created At -->
            <div class="form-group">
                <label for="created_at">Order Date</label>
                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ old('created_at', now()->toDateString()) }}" required>
                @error('created_at')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Place Order</button>
        </form>
    </div>
@endsection
