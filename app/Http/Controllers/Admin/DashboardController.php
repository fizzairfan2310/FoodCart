<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Food;
use App\Models\Category;  // Yeh line add karo

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalFoods = Food::count();
        $totalCategories = Category::count();  // Yeh line add kar do
        $recentOrders = Order::with('items.food', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'totalFoods', 
            'totalCategories',  // Yeh bhi pass kar do
            'recentOrders'
        ));
    }
}