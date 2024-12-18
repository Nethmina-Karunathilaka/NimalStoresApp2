<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('build/assets/products.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <header class="header">
        <div class="logo">Nimal Stores</div>
        <div>
            <input type="text" placeholder="Search in Nimal Stores" class="search-bar">
            <i class="fas fa-search search-icon" style="position: relative; right:40px; color:rgb(105, 105, 105)"></i>
        </div>
        <div>
            <button class="btn-2"><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                </form>
            </button>
        </div>
    </header>

    <header class="header2">
        <div style="display: flex;" class="dropdowns">
            <div><i class="fa-solid fa-user"></i>
              <span style="margin-left: 3px;">Hi {{ Auth::user()->name }} !..</span><i class="fa-solid fa-caret-down" style="margin-left: 6px;"></i>
              <div class="dropdown-items">
                <a href="">Account</a>
                <a href="signup1page.html">My Orders</a>
                <a href="">Cart</a>
                <div>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="" method="POST" class="d-none">
                         @csrf
                    </form>
                </div>
              </div>
            </div>
        </div>
        <div class="nav-items active">
          <a href="index.html" style="text-decoration: none;">Home</a>
        </div>
        <div class="nav-items">
            <a href="{{ route('products') }}" style="text-decoration: none;" >Products</a>
        </div>
        <div class="nav-items">
            <a href="index.html" style="text-decoration: none;">About</a>
        </div>
        <div class="nav-items">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">Seller DashBoard</a>
        </div>
        <div class="nav-items cart">
          <a href=""><i class="fas fa-shopping-cart"></i></a>
        </div>
    </header>

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
                <form method="POST" action="">
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

</body>
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
