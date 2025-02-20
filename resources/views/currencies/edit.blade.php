@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Currency</h1>

        <form action="{{ route('currencies.update', $currency) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Currency Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $currency->name) }}" required>
            </div>

            <div class="form-group">
                <label for="symbol">Currency Symbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control" value="{{ old('symbol', $currency->symbol) }}" required>
            </div>

            <div class="form-group">
                <label for="exchange_rate">Exchange Rate</label>
                <input type="number" name="exchange_rate" id="exchange_rate" class="form-control" value="{{ old('exchange_rate', $currency->exchange_rate) }}" step="0.000001" required>
            </div>

            <button type="submit" class="btn btn-success">Update Currency</button>
        </form>
    </div>
@endsection
