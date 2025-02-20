@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders List</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View</a>
                            @if($order->status !== 'completed')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('orders.create') }}" class="btn btn-primary">Create Order</a>
    </div>
@endsection
