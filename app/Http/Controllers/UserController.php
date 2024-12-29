<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class UserController extends Controller
{
    // In your UsersController
    public function showProducts()
    {
        $products = Product::all();
        return view('products', compact('products'));

       
    }

    public function welcomeproducts(){
        $products = Product::all();
        return view('welcomeproducts', compact('products'));
    }

    
}
