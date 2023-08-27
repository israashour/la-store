<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductsController extends Controller
{

    public function show(Product $product)
    {
        if ($product->status != 'active'){
            abort(404);
        }
        return view('public.products.show', compact('product'));
    }
}
