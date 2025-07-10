<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminCustomerController extends Controller
{

    public function index()
    {
        $customers = User::where('is_admin', 0)->get();

        $customers = User::with(['orders.items'])->get();

        foreach ($customers as $customer) {
            $customer->total_quantity = $customer->orders->sum(function ($order) {
            return $order->items->sum('quantity');
            });
        }
        return view('admin.customers.index', compact('customers'));
    }
}

