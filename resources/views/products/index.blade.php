@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
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
