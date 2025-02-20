@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order #{{ $order->id }}</h1>

        <table class="table table-bordered">
            <tr>
                <th>Customer Name</th>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <th>Product</th>
                <td>{{ $order->product->name }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($order->status) }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
            </tr>
        </table>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
    </div>
@endsection
