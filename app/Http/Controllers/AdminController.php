<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{

    public function home()
    {
        $orders = Order::all();
        return view('dashboard', ['orders' => $orders]);
    }

    public function viewOrder(Order $order)
    {
        return view('pages.admin.order', ['order' => $order]);
    }
}
