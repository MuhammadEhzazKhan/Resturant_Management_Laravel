<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CookController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->usertype !== 'employee') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Proceed only if the user is an employee
        $orders = Order::where('status', 'pending')->get();
        return view('cook.dashboard', compact('orders'));
    }
}
