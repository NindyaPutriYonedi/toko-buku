<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }



public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:500',
    ]);

    try {
        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'updated_at' => now(),
            ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    } catch (\Exception $e) {
        return back()->withErrors('Gagal menyimpan profil: ' . $e->getMessage());
    }
}
}
