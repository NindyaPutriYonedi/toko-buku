<?php

namespace App\Http\Controllers;

use App\Models\NindyOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NindyOrderController extends Controller
{

public function checkout(Request $request)
{
    $request->validate([
        'metode_pembayaran' => 'required|in:transfer,ovo,gopay',
    ]);

    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    $order = NindyOrder::create([
        'user_id' => Auth::id(),
        'status' => 'pending',
        'total_amount' => $totalAmount,
        'metode_pembayaran' => $request->metode_pembayaran, // ✅ ini wajib ditambahkan
    ]);

    foreach ($cart as $bookId => $item) {
        $order->items()->create([
            'book_id' => $bookId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('books.history')->with('success', 'Pesanan berhasil dibuat.');
}


    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled'
    ]);

    $order = NindyOrder::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.show', $id)->with('success', 'Status order diperbarui.');
}



}
