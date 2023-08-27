<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'store'])->paginate();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('dashboard.orders.show', [
            'order' => $order
        ]);
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $order = Order::findOrFail($id);

    //     $request->validate([
    //         'status' => 'required|in:Pending,Shipped,Delivered,Cancelled',
    //     ]);

    //     $order->update([
    //         'status' => $request->input('status'),
    //     ]);

    //     return redirect()->back()->with('success', 'Order status updated successfully.');
    // }
}
