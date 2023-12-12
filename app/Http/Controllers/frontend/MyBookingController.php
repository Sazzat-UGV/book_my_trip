<?php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyBookingController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->select('id', 'created_at', 'currency', 'booking_status', 'payment_status', 'booking_from', 'booking_package_type', 'booking_to','booking_package_name', 'member', 'amount')->latest('id')->get();
        return view('frontend.pages.user.mybooking', compact('orders'));
    }
}
