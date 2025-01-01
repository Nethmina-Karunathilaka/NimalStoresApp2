<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.results', compact('products'));
    }

    public function autosuggest(Request $request)
    {
        $query = $request->input('query');
        $suggestions = Product::where('name', 'LIKE', "%{$query}%")
            ->take(5)
            ->pluck('name');

        return response()->json($suggestions);
    }


    public function searchinwelcome(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.welcomeresults', compact('products'));
    }
}
