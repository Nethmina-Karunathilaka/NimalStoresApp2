<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count(); // Get the total number of orders
        return view('admin.dashboard', compact('totalOrders','totalUsers','totalProducts'));
    }
}
