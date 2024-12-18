<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head> 
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimal Stores | admin</title>
    <link rel="stylesheet" href="{{ asset('build/assets/products.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <header class="header">        
        <a href="#"style="text-decoration: none;">
            <div class="logo">Admin Dashboard</div>
        </a>
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

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>>
    </body>
</html>
