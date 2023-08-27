<?php

namespace App\Models;

use App\Helpers\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name', 'price', 'qty', 'options'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');

        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }

    public function getSubtotalFormatted()
    {
        $subtotal = 0;

        foreach ($this->products as $product) {
            $subtotal += $product->pivot->price * $product->pivot->qty;
        }

        return Currency::format($subtotal);
    }

    public function getShippingFormatted()
    {
        $shipping = .00;

        return Currency::format($shipping);
    }

    public function getGrandTotalFormatted()
    {
        $subtotal = floatval(str_replace(',', '', $this->getSubtotalFormatted()));
        $shipping = floatval(str_replace(',', '', $this->getShippingFormatted()));

        $grandTotal = $subtotal + $shipping;
        // dd($subtotal, $shipping);
        return Currency::format($grandTotal);
    }
}
