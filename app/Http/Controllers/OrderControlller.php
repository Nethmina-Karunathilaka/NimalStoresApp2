<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $cart = session('cart', []); // Assuming you store cart in session
        $total = array_reduce($cart, fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0);

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'Pending',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function adminIndex()
    {
        $orders = Order::with('user', 'items.product')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}
