@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Currencies</h1>

        <a href="{{ route('currencies.create') }}" class="btn btn-primary mb-3">Add New Currency</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Exchange Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->symbol }}</td>
                        <td>{{ $currency->exchange_rate }}</td>
                        <td>
                            <a href="{{ route('currencies.edit', $currency) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('currencies.destroy', $currency) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
