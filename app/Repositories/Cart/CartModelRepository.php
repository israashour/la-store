<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        if(!$this->items->count()){
            $this->items = Cart::with('product')->get();
        }

        return $this->items;
    }

    public function add(Product $product, $qty = 1)
    {
        $item = Cart::where('product_id', '=', $product->id)
            ->first();
            if ($qty === null) {
                $qty = 1;
            }
        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'qty' => $qty,
            ]);
            $this->get()->push($cart);
            return $cart;
        }

        return $item->increment('qty', $qty);
    }

    public function update($id, $qty)
    {
        Cart::where('id', '=', $id)
            ->update([
                'qty' => $qty,
            ]);
    }

    public function delete($id)
    {
        Cart::where('product_id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total() : float
    {
        // return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.qty) as total')
        //     ->value('total');
        return $this->get()->sum(function($item) {
            return $item->qty * $item->product->price;
        });
    }


}
