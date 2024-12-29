@extends('layouts.admin')

@section('content')
<br><br>
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
                @endif
            </div>

            <div class="form-group">
                <label for="featured">Featured Product</label>
                <input type="checkbox" name="featured" id="featured" value="1" {{ $product->featured ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-dark mt-3">Update Product</button>
        </form>
    </div>
    <footer>
        <div class="footer" style="margin-top:10px">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('about')}}">About</a></p><br><br>
          <p class="copyright">© NimalStores</p>
        </div>
    </footer>
@endsection
