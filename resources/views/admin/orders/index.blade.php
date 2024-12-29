@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Order Management</h1>

    <!-- Total Orders Card -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Orders</h5>
                    </div>
                    <div class="card-body">
                        <h3>{{ $totalOrders }}</h3>
                        <p class="text-muted">Total number of orders</p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Bar Chart Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Orders by Month</h5>
                </div>
                <div class="card-body">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Orders List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>Rs {{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue Card -->
    <div class="col-md-4" style="margin-top:20px;">
            <div class="card">
                <div class="card-header">
                    <h5>Total Revenue ({{ now()->year }})</h5>
                </div>
                <div class="card-body">
                    <h3>Rs {{ number_format($totalRevenue, 2) }}</h3>
                    <p class="text-muted">Revenue generated this year</p>
                </div>
            </div>
        </div>
    </div>   
</div>
<footer>
        <div class="footer" style="margin-top:10px;">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('about')}}">About</a></p><br><br>
          <p class="copyright">© NimalStores</p>
        </div>
</footer>


@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const ctx = document.getElementById('ordersChart').getContext('2d');

        const chartData = {
            labels: @json($months),
            datasets: [{
                label: 'Orders per Month',
                data: @json($orderCounts),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Orders by Month'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const ordersChart = new Chart(ctx, config);
    });    
</script>
@endsection
