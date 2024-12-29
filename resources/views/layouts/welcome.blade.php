<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimal Stores</title>
    <link rel="stylesheet" href="{{asset('build//assets//main.css')}}">
    <link rel="stylesheet" href="{{asset('build//assets//products.css')}}">
    <link rel="stylesheet" href="{{asset('build//assets//about.css')}}">
    <link rel="stylesheet" href="{{asset('build//assets//search.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<body>
    <header class="header">
        <a href="{{ route('welcome') }}" style="text-decoration:none;"><div class="logo">NIMAL STORES</div></a>
        <div>
            <input type="text" placeholder="Search in Nimal Stores" class="search-bar">
            <i class="fas fa-search search-icon" style="position: relative; right:40px; color:rgb(105, 105, 105)"></i>
        </div>
        <div>
            <button class="btn-1"><a href="{{route('login')}}">Login</a></button>
            <button class="btn-2"><a href="{{route('register')}}">Sign Up</a></button>
        </div>
    </header>

    <header class="header2">
        <div style="display: flex;" class="dropdowns">
            <div><i class="fa-solid fa-user"></i>
              <span style="margin-left: 3px;">Account</span><i class="fa-solid fa-caret-down" style="margin-left: 6px;"></i>
              <div class="dropdown-items">
                <a href="{{route('register')}}">Create Account</a>
                <a href="{{route('login')}}">Sign In</a>
              </div>
            </div>
        </div>
        <div class="nav-items active">
          <a href="{{ route('welcome') }}" style="text-decoration: none;">Home</a>
        </div>
        <div class="nav-items">
            <a href="{{ route('welcomeproducts') }}" style="text-decoration: none;" >Products</a>
        </div>
        <div class="nav-items">
            <a href="{{ route('welcomeabout') }}" style="text-decoration: none;">About</a>
        </div>
        <div class="nav-items">
            <a href="{{ route('login') }}" style="text-decoration: none;">Seller DashBoard</a>
        </div>
        <div class="nav-items cart">
          <a href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
  