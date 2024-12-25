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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
    </main>>
</body>
 
