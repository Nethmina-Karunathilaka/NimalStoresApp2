<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nimal Stores | admin</title>
        <link rel="stylesheet" href="{{ asset('build/assets/products.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/main.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/admin.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('userRegistrationsChart').getContext('2d');
                const chartData = @json($userRegistrations); // This converts the PHP array into a JS object
                
                const dates = chartData.map(item => item.date);
                const counts = chartData.map(item => item.count);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'User Registrations',
                            data: counts,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    </head>
    <body>

    <header class="header">        
            <a href="#" style="text-decoration: none;">
                <div class="logo">Admin Dashboard</div>
            </a>
            <div>
                <button class="btn-2">
                    <a href="{{ route('logout') }}"
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

    <div class="nav">
            <div class="nav-item"><a href="{{route('dashboard')}}">DashBoard</a></div>
            <div class="nav-item"><a href="{{route('admin.orders.index')}}">Order Management</a></div>
            <div class="nav-item"><a href="{{route('admin.products.index')}}">Products Management</a></div>
            <div class="nav-item"><a href="{{route('admin.users.index')}}">User Details</a></div>
    </div>

    
    <section style="margin:50px;">
    <!-- Your page content like the user table and chart goes here -->
    <h1>User Management</h1>

    <div class="alert alert-info">
        Total Users: {{ $totalUsers }}
    </div>

    <!-- Users Table -->
    <table class="table" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Total Checkout Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>Rs {{ number_format($user->total_checkout_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- User Registrations Chart -->
    <div>
        <canvas id="userRegistrationsChart"></canvas>
    </div>
    </body>
    </section>
    <footer>
        <div class="footer">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('about')}}">About</a></p><br><br>
          <p class="copyright">© NimalStores</p>
        </div>
    </footer>
</html>    

