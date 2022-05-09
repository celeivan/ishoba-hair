<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function home()
    {
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                $orders = Order::all();
            }else{
                $orders = Auth::user()->orders;
            }
            
            return view('dashboard', ['orders' => $orders]);

        } else{
            return redirect()->route('login');
        }
    }

    public function viewOrder(Order $order)
    {
        return view('pages.admin.order', ['order' => $order]);
    }
}
