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
    @else
        <p>Your cart is empty!</p>
    @endif
</div>

<!-- Modal for Clear Cart Confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
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

@endsection

@section('scripts')
<script>
    let currentClearCartForm = null; // Track the form being submitted

    // Attach event listeners to clear-cart forms
    document.querySelectorAll('.clear-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            currentClearCartForm = this; // Store the current form
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal')); // Initialize modal
            confirmationModal.show(); // Show confirmation modal
        });
    });

    // Handle confirmation button click
    document.getElementById('confirmClearCart').addEventListener('click', function () {
        if (currentClearCartForm) {
            // Fetch form data
            const formData = new FormData(currentClearCartForm);

            // Send request to server
            fetch(currentClearCartForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF token for security
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message); // Display success message
                    const confirmationModal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
                    confirmationModal.hide(); // Hide the modal after successful action
                    location.reload(); // Reload the page to reflect changes in the cart
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your request.');
            });
        }
    });

</script>
@endsection
