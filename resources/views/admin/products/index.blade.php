@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Management</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
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
