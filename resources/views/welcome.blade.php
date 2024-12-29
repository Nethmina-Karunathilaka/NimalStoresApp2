@extends('layouts.welcome')
@section('content')
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/cover2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="img/cover3.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="img/maggeb.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section2">
        <h2 class="topic1">
            Feature Products
        </h2>

        <div class="product-grid">
        @foreach($featuredProducts as $product)
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
                <form method="GET" action="{{ route('login') }}">
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

    </section>
    
    <footer>
        <div class="footer">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('welcomeabout')}}">About</a></p><br><br>
          <p class="copyright">© Visulio Designs</p>
        </div>
    </footer>
@endsection
</html>