<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $request = request();
        $products = Product::with(['category', 'store'])
            ->active()
            ->latest()
            ->limit(8)
            ->get();
        $categories = Category::with('children')
            ->active()
            ->limit(6)
            ->get();
        $stores = Store::with('products')
            ->active()
            ->get();

        return view('public.index', compact('products', 'categories', 'stores'));
    }
}
