@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Currency</h1>

        <form action="{{ route('currencies.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Currency Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="symbol">Currency Symbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exchange_rate">Exchange Rate</label>
                <input type="number" name="exchange_rate" id="exchange_rate" class="form-control" step="0.000001" required>
            </div>

            <button type="submit" class="btn btn-success">Create Currency</button>
        </form>
    </div>
@endsection
