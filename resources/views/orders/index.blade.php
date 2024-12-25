@foreach ($orders as $order)
    <div>
        <h3>Order #{{ $order->id }}</h3>
        <p>Total: ${{ $order->total }}</p>
        <p>Status: {{ $order->status }}</p>
        <ul>
            @foreach ($order->items as $item)
                <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ${{ $item->price }}</li>
            @endforeach
        </ul>
    </div>
@endforeach
