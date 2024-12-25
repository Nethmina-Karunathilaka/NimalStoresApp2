@foreach ($orders as $order)
    <div>
        <h3>Order #{{ $order->id }}</h3>
        <p>User: {{ $order->user->name }}</p>
        <p>Total: ${{ $order->total }}</p>
        <p>Status: {{ $order->status }}</p>
        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
            @csrf
            @method('PATCH')
            <select name="status">
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
@endforeach
<p>Total Orders: {{ $orders->count() }}</p>

