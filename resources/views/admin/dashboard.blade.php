@extends('layouts.admin')

@section('content')

    <div class="cards">
        <div class="card-con">
            <h2>Total Users</h2>
            <p>{{ $totalUsers }}</p>
        </div>

        <div class="card-con">
            <h2>Total Orders</h2>
            <p>{{ $totalOrders }}</p>
        </div>

        <div class="card-con">
            <h2>Total Products</h2>
            <p>{{$totalProducts}}</p>
        </div>
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
