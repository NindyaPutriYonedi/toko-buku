<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\NindyOrder;

class NindyHistoryController extends Controller
{
    public function index()
    {
        $orders = NindyOrder::with('items.book')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('books.history', compact('orders'));
    }
}

