<?php
namespace App\Http\Controllers;

use App\Models\NindyBook;
use App\Models\NindyOrder;
use Illuminate\Http\Request;
use App\Models\NindyOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NindyBookController extends Controller
{
    public function index() {
        $books = NindyBook::with('category')->get();

        $bestSellers = NindyBook::withSum('orderItems as total_quantity', 'quantity')
    ->having('total_quantity', '>', 5)
    ->orderByDesc('total_quantity')
    ->take(4)
    ->get();



    return view('books.index', compact('books', 'bestSellers'));
    }

    public function cart() {
        // nanti bisa dikembangkan dengan session keranjang
        return view('cart.index');
    }
public function checkout(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong!');
    }

    DB::beginTransaction();
    try {
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Simpan order utama
        $order = NindyOrder::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Simpan tiap item order
        foreach ($cart as $bookId => $item) {
            NindyOrderItem::create([
                'order_id' => $order->id,
                'book_id' => $bookId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        DB::commit();

        // Kosongkan cart session setelah checkout sukses
        session()->forget('cart');

        return redirect()->route('books.index')->with('success', 'Pesanan berhasil dibuat!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat proses pesanan.');
    }
}

    // public function checkout(Request $request) {
    //     // simpan order ke database
    //     return redirect()->route('books.index')->with('success', 'Pesanan berhasil dibuat!');
    // }

    public function addToCart(Request $request, $id)
{
    $book = NindyBook::findOrFail($id);
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "title" => $book->title,
            "price" => $book->price,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    // ⬇️ Setelah ditambahkan ke keranjang, redirect ke halaman detail buku
    return redirect()->route('book.show', $id)->with('success', 'Buku ditambahkan ke keranjang!');
}

public function show($id)
{
    $book = NindyBook::findOrFail($id);
    return view('books.detail', compact('book'));
}

public function buyNow(Request $request, $id)
{
    $book = NindyBook::findOrFail($id);

    $order = NindyOrder::create([
        'user_id' => Auth::id(),
        'total_amount' => $book->price,
        'status' => 'pending',
    ]);

    NindyOrderItem::create([
        'order_id' => $order->id,
        'book_id' => $book->id,
        'quantity' => 1,
        'price' => $book->price,
    ]);

    session()->forget('cart');

    return redirect('/')->with('success', 'Pembelian berhasil!');

}

public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $action = $request->input('action');

        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease') {
            $cart[$id]['quantity']--;
            if ($cart[$id]['quantity'] < 1) {
                unset($cart[$id]);
            }
        }
    }

    session()->put('cart', $cart);
    return back();
}

public function removeCart($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return back();
}

 public function showBuyNow($id)
    {
        $book = NindyBook::findOrFail($id);
        $user = Auth::user();
        return view('books.buyNow', compact('book', 'user'));
    }

    public function processBuyNow(Request $request, $id)
{
    $request->validate([
        'metode_pembayaran' => 'required|in:transfer,ovo,gopay',
    ]);

    $book = NindyBook::findOrFail($id);
    $user = Auth::user();

    DB::beginTransaction();
    try {
        $order = NindyOrder::create([
            'user_id' => $user->id,
            'total_amount' => $book->price,
            'status' => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran, // OK
        ]);

        NindyOrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => 1,
            'price' => $book->price,
        ]);

        DB::commit();

        return redirect()->route('books.index')->with('success', 'Pembelian berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors('Terjadi kesalahan saat proses pembelian.');
    }
}

    public function showBuyNowAll()
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    return view('books.buyNowAll', compact('cart'));
}

public function processBuyNowAll(Request $request)
{
     $request->validate([
        'metode_pembayaran' => 'required|in:transfer,ovo,gopay',
    ]);

    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $order = NindyOrder::create([
        'user_id' => Auth::id(),
        'status' => 'pending',
        'total_amount' => collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        }),
        'metode_pembayaran' => $request->metode_pembayaran, // <-- Tambahkan ini
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

}

