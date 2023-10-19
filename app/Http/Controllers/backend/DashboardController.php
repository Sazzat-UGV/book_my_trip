<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Flight;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function dashboard()
    {
        Gate::authorize('access-dashboard');
        $category = Category::count();
        $packages = Package::count();
        $flights = Flight::count();
        $hotels = Hotel::count();
        $users = User::where('role_id', 3)->count();
        $orders = Order::count();
        $contact = Contact::count();
        $systemAdmins = User::whereNot('role_id', 3)->count();
        $totalIncome = Order::sum('amount');
        return view('backend.pages.dashboard', compact(
            'category',
            'packages',
            'flights',
            'hotels',
            'users',
            'orders',
            'contact',
            'systemAdmins',
            'totalIncome',
        ));
    }
}
