<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NindyOrder;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = NindyOrder::with('user', 'items.book')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = NindyOrder::with('user', 'items.book')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
