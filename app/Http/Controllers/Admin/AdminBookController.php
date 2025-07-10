<?php

namespace App\Http\Controllers\Admin;

use App\Models\NindyBook;
use Illuminate\Http\Request;
use App\Models\NindyCategory;
use App\Http\Controllers\Controller;


class AdminBookController extends Controller
{
    public function index()
    {
        $books = NindyBook::all();
        return view('admin.books.index', compact('books'));
    }
    public function create()
{
    $categories = NindyCategory::all();
    return view('admin.books.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
    'title' => 'required',
    'author' => 'required',
    'description' => 'required',
    'category_id' => 'required|exists:nindy_categories,id',
    'price' => 'required|numeric',
    'stock' => 'required|integer',
    'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

$data = $request->only(['title', 'author', 'description', 'category_id', 'price', 'stock']);


if ($request->hasFile('cover_image')) {
    $coverPath = $request->file('cover_image')->store('covers', 'public');
    $data['cover_image'] = $coverPath;
}




NindyBook::create($data);

return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan');

}

public function edit($id)
{
    $book = NindyBook::findOrFail($id);
    $categories = NindyCategory::all();
    return view('admin.books.edit', compact('book', 'categories'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'description' => 'required',
        'category_id' => 'required|exists:nindy_categories,id',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $book = NindyBook::findOrFail($id);
    $data = $request->only(['title', 'author', 'description', 'category_id', 'price', 'stock']);

   if ($request->hasFile('cover_image')) {
    $coverPath = $request->file('cover_image')->store('covers', 'public');
    $data['cover_image'] = $coverPath;
}




    $book->update($data);

    return redirect()->route('admin.books')->with('success', 'Buku berhasil diperbarui');
}


public function destroy($id)
{
    $book = NindyBook::findOrFail($id);
    $book->delete();

    return redirect()->route('admin.books')->with('success', 'Buku berhasil dihapus');
}

}

