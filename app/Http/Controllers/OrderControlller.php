<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderControlller extends Controller
{
    // Store order after checkout
    public function store(Request $request)
    {
        $cart = session('cart', []); // Assuming the cart is stored in the session
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = array_reduce($cart, fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0);

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'address' => $address,
            'mobile_number' =>$mobile_number,
            'status' => 'Pending',
        ]);

        // Create order items
        foreach ($cart as $product_id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    // User's orders
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    // Admin: View all orders
    public function adminIndex()
    {
        //$orders = Order::with('user', 'items.product')->get();
        //return view('admin.orders.index', compact('orders'));

         // Get total orders for this month
        $totalOrders = Order::count();
        
         // Get orders by month (for bar chart data)
        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as order_count')
             ->groupBy('month')
             ->orderBy('month', 'asc')
             ->get();
        
         // Calculate the total revenue for the current year
        $currentYear = Carbon::now()->year;
        $totalRevenue = Order::whereYear('created_at', $currentYear)
             ->sum('total'); // Assumes 'total' is the column storing order totals     


         // Prepare data for the chart
        $months = [];
        $orderCounts = [];
 
        foreach ($ordersByMonth as $order) {
             $months[] = Carbon::createFromFormat('m', $order->month)->format('F');
             $orderCounts[] = $order->order_count;
        }

        // Fetch all orders for the orders table
        $orders = Order::with('user')->get(); // Ensure related user data is loaded
 
        return view('admin.orders.index', [
             'totalOrders' => $totalOrders,
             'totalRevenue' => $totalRevenue, // Pass total revenue to the view
             'months' => $months,
             'orderCounts' => $orderCounts,
             'orders' => $orders
        ]);


    }

    // Admin: Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');

    }
}
