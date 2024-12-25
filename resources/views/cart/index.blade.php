@extends('layouts.admin')

@section('content')
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
        <button id="checkout-button" class="btn btn-dark">Checkout</button>
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

<!-- Modal for Checkout Confirmation -->
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
                <form action="{{ route('orders.checkout') }}" method="POST" id="checkoutForm">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm</button>
                </form>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Store the form being cleared
    let currentClearCartForm = null;

    // Attach event listeners to clear-cart forms
    document.querySelectorAll('.clear-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            currentClearCartForm = this;
            const clearCartModal = new bootstrap.Modal(document.getElementById('clearCartModal'));
            clearCartModal.show();
        });
    });

    // Handle the clear cart confirmation
    document.getElementById('confirmClearCart').addEventListener('click', function () {
        if (currentClearCartForm) {
            currentClearCartForm.submit();
        }
    });

    // Checkout button functionality
    document.getElementById('checkout-button').addEventListener('click', function () {
        console.log("Checkout button clicked");
        const total = calculateTotal(); // Calculate the total dynamically
        document.getElementById('order-total').textContent = total.toFixed(2);
        const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    });

    // Calculate cart total dynamically
    function calculateTotal() {
        let total = 0;
        const cartItems = @json(session('cart', []));
        cartItems.forEach(item => {
            total += item.price * item.quantity;
        });
        return total;
    }
</script>
@endsection
