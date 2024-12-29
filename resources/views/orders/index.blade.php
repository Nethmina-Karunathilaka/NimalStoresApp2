@extends('layouts.user')
@section('content')
<!-- Orders List -->
<div class="row mt-4" style="margin:50px">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3> My Orders </h3>
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
                                    <th>Item Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>Rs {{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->status }}</td>
                                        @foreach ($order->items as $item)
                                        <td>{{ $item->product->name }} (x{{ $item->quantity }}) - Rs {{ $item->price }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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