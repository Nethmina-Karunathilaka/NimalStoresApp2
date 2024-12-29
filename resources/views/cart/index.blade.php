@extends('layouts.user')

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', () => {
            const orderTotalElement = document.querySelector('#order-total');
            const confirmCheckoutButton = document.querySelector('#confirmCheckout');

            // Ensure cart is passed properly to JavaScript and is an object
            const cart = @json($cart);
            console.log('Cart:', cart); // Debugging cart

            // Check if cart is an object and has values
            if (cart && typeof cart === 'object' && Object.keys(cart).length > 0) {
                // Convert the object to an array using Object.values()
                const cartArray = Object.values(cart);
                
                // Calculate the total using reduce
                const total = cartArray.reduce((carry, item) => carry + (parseFloat(item.price) * item.quantity), 0);
                
                // Update the total in the UI
                orderTotalElement.textContent = total.toFixed(2); // Show the total with 2 decimal places
            } else {
                orderTotalElement.textContent = 'Cart is empty!';
            }

            // Checkout button functionality (submit the form when clicked)
            confirmCheckoutButton?.addEventListener('click', () => {
                document.querySelector('#checkout-form').submit();
            });
    });
</script>        




<div class="container">
    <h2>Your Cart</h2>
    @if (session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $id => $details)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($details['image']) }}" alt="{{ $details['name'] }}" width="50">
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td>Rs {{ $details['price'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('cart.clear') }}" method="POST" class="clear-cart-form">
            @csrf
            <button type="submit" class="btn btn-danger">Clear Cart</button>
        </form>
        <form action="{{ route('orders.checkout') }}" method="POST" id="checkout-form">
            @csrf
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#checkoutModal">
            Checkout
            </button>
        </form>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>

<!-- Modal for Clear Cart Confirmation -->
<div class="modal fade" id="clearCartModal" tabindex="-1" aria-labelledby="clearCartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clearCartModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to clear the cart?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmClearCart">Yes, Clear</button>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Confirmation Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Confirm Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your total is: Rs <span id="order-total"></span></p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="confirmCheckout">Confirm</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<footer>
        <div class="footer" style="position:fixed">
          <p class="email">Email: nipun.nethmina@icloud.com</p>
          <p class="address">Address: Nimal Stores, Wariyapola</p>
          <p class="about"><a href="{{route ('about')}}">About</a></p><br><br>
          <p class="copyright">© NimalStores</p>
        </div>
</footer>
@endsection
