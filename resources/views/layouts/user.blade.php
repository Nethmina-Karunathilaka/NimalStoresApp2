<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="{{asset('build//assets//main.css')}}">
    <link rel="stylesheet" href="{{asset('build//assets//admin.css')}}">
    <link rel="stylesheet" href="{{asset('build//assets//products.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            document.getElementById('search-box').addEventListener('input', function () {
                const query = this.value;
                const suggestionsBox = document.getElementById('suggestions');

                if (query.length > 0) {
                    fetch(`/autosuggest?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            let suggestionsHtml = '';
                            data.forEach(item => {
                                suggestionsHtml += `<div class="suggestion-item">${item}</div>`;
                            });
                            suggestionsBox.innerHTML = suggestionsHtml;
                            suggestionsBox.style.display = 'block';
                        });
                } else {
                    suggestionsBox.style.display = 'none';
                }
            });

            const searchBox = document.getElementById('search-box');

            if (searchBox) {
            // Handle Enter keypress
                searchBox.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') { // Modern way of detecting Enter key
                        event.preventDefault(); // Prevent default form submission (if applicable)

                        const query = searchBox.value.trim();
                        if (query) {
                            // Redirect to search results page (example)
                            window.location.href = `/search?query=${encodeURIComponent(query)}`;

                        // OR fetch results via AJAX
                        /*
                        fetch(`/search?query=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                // Handle the returned search results
                                console.log(data);
                            });
                            */
                        }
                    }
                });
            } else {
            console.error('Search box not found!');
            }

            // Add event listener to handle clicking suggestions
            document.getElementById('suggestions').addEventListener('click', function (e) {
                if (e.target && e.target.matches(".suggestion-item")) {
                    document.getElementById('search-box').value = e.target.textContent;
                    this.style.display = 'none';
                }
            });

            // Store the form being cleared
            let currentClearCartForm = null;

            // Attach event listeners to clear-cart forms
            document.querySelectorAll('.clear-cart-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    currentClearCartForm = this;
                    const clearCartModal = new bootstrap.Modal(document.getElementById('clearCartModal'));
                    clearCartModal.show();
                });
            });

            // Handle the clear cart confirmation
            document.getElementById('confirmClearCart').addEventListener('click', function () {
                if (currentClearCartForm) {
                    currentClearCartForm.submit();
                }
            });
            
            // Checkout button functionality
            document.getElementById('checkout-button').addEventListener('click', function () {
                console.log("Checkout button clicked");
                const total = calculateTotal(); // Calculate the total dynamically
                document.getElementById('order-total').textContent = total.toFixed(2);
                const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                checkoutModal.show();
            });

            // Calculate cart total dynamically
            let cartItems = @json(session('cart', []));
            function calculateTotal() {
                console.log(cartItems, typeof cartItems); // Debugging

                if (typeof cartItems === 'string') {
                    try {
                        cartItems = JSON.parse(cartItems);
                    } catch (error) {
                        console.error('Invalid JSON for cartItems:', cartItems);
                        return;
                    }
                }


                if (!Array.isArray(cartItems)) {
                    console.error('cartItems is not an array:', cartItems);
                    return;
                }

                let total = 0;
                const cartItems = @json(session('cart', []));
                cartItems.forEach(item => {
                    total += item.price * item.quantity;
                });
                return total;
            }


        });
    

    </script>  
    <style>
            #suggestions {
                position: absolute;
                background: white;
                z-index: 1000;
                max-height: 150px;
                overflow-y: auto;
                cursor: pointer;
            }

            .suggestion-item {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            .suggestion-item:hover {
                background: #f0f0f0;
            }
    </style>  

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
        <div class="logo">Nimal Stores</div>
        <div>
            <input type="text" placeholder="Search in Nimal Stores" class="search-bar" id="search-box">
            <i class="fas fa-search search-icon" style="position: relative; right:40px; color:rgb(105, 105, 105)"></i>
            <div id="suggestions" style="border: 1px solid #ddd; display: none;"></div>
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
                <a href="{{route('profile.edit')}}">Account</a>
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
            <a href="{{route ('products')}}" style="text-decoration: none;" >Products</a>
        </div>
        <div class="nav-items">
            <a href="index.html" style="text-decoration: none;">About</a>
        </div>
        <div class="nav-items">
            <a href="{{route ('admin.dashboard')}}" style="text-decoration: none;">Seller DashBoard</a>
        </div>
        <div class="nav-items cart">
          <a href="{{route('cart.index')}}"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</body>
 
