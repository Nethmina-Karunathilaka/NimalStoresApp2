<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="{{asset('build//assets//main.css')}}">
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
            <a href="{{route ('products')}}" style="text-decoration: none;" >Products</a>
        </div>
        <div class="nav-items">
            <a href="index.html" style="text-decoration: none;">About</a>
        </div>
        <div class="nav-items">
            <a href="{{route ('admin.dashboard')}}" style="text-decoration: none;">Seller DashBoard</a>
        </div>
        <div class="nav-items cart">
          <a href=""><i class="fas fa-shopping-cart"></i></a>
        </div>
    </header>

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
    </section>
    
    <footer>
        <div class="footer">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about">About</p><br><br>
          <p class="copyright">© Visulio Designs</p>
        </div>
    </footer>

</body>
</html>