<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        Gate::authorize('order-list');
        $orders = Order::select('id', 'name', 'email', 'phone', 'address', 'created_at', 'currency', 'booking_status', 'payment_status', 'booking_from','booking_to', 'booking_package_type', 'booking_package_name', 'member', 'amount')->latest('id')->get();
        return view('backend.pages.order.index', compact('orders'));
    }


    public function orderStatus($id)
    {
        $order = Order::findOrFail($id);
        if ($order->booking_status == "Pending") {
            $order_update = 'Complete';
        } else {
            $order_update = 'Pending';
        }
        $order->update([
            'booking_status' => $order_update,
        ]);
        Toastr::success('Booking Status Updated!!');
        return back();
    }
}
