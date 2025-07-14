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

    public function destroy($id)
{
    $order = NindyOrder::findOrFail($id);

    // Hapus juga item-order agar tidak orphan (jika tidak pakai cascade)
    $order->items()->delete();

    $order->delete();

    return redirect()->route('admin.orders')->with('success', 'Order berhasil dihapus.');
}
}
