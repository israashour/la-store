<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }

        return view('public.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            // 'add.billing.first_name' => ['required', 'string', 'max:255'],
            // 'add.billing.last_name' => ['required', 'string', 'max:255'],
            // 'add.billing.email' => ['required', 'string', 'max:255'],
            // 'add.billing.phone_number' => ['required', 'string', 'max:255'],
            // 'add.billing.city' => ['required', 'string', 'max:255'],
        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                foreach ($cart_items as $item) {
                    // if (!$item || !$item->product) {
                    //     dd("Problematic item:", $item);
                    // }

                    $order = Order::create([
                        'store_id' => $store_id,
                        'user_id' => Auth::id(),
                        'payment_method' => 'cod',

                    ]);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'qty' => $item->qty,
                    ]);

                    foreach ($request->post('addr') as $type => $address) {

                        $address['type'] = $type;
                        $order->addresses()->create($address);
                    }
                }
                $this->cart->empty();
            }
            DB::commit();

            // event('order.created', $order);
            event(new OrderCreated($order));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('orders.payments.create', $order->id);
    }
}
