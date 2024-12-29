@extends('layouts.user')
@section('content')
    <div class="main-title"><h2>OUR PRODUCTS</h2></div>

    <div class="product-grid">
        @foreach($products as $product)
            <div class="pro-card">
                <!-- Display product image -->
                <div class="pro-img">
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">

                </div>
                
                <!-- Display product name -->
                <div class="card-title"> 
                <h4>{{ $product->name }}</h4>
                </div>

                <!-- Display product price -->
                <div class="card-price"><h6>Rs {{ $product->price }}</h6></div>

                <!-- Display product description -->
                <div class="card-des"><p>{{ Str::limit($product->description, 50) }}</p></div>

                <!-- Optional: Add to Cart or View Details button -->
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="card-qty">
                        <label>Quantity</label><input type="number" name="quantity" value="1" min="1">
                    </div>
                    <div class="cart-button">
                        <button type="submit">Add to Cart</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
    <footer>
        <div class="footer">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('about')}}">About</a></p><br><br>
          <p class="copyright">© NimalStores</p>
        </div>
    </footer>

@endsection
<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message); // Display success message
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>
</html>
