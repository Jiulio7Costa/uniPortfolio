<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
        {
            $totalRevenue = Order::where('status', 'paid')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->sum(DB::raw('order_items.quantity * products.price'));
    
            return Inertia::render('Admin/Dashboard', [
                'userCount' => User::count(),
                'orderCount' => Order::count(),
                'productCount' => Product::count(),
                'totalRevenue' => $totalRevenue ?: 0, 
            ]);
        }
    }