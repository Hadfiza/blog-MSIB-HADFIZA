<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Menampilkan semua kategori (guest dan user)
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan detail kategori (guest dan user)
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // Menampilkan form untuk membuat kategori baru (hanya user)
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat kategori.');
        }
        return view('categories.create');
    }

    // Menyimpan kategori baru (hanya user)
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menyimpan kategori.');
        }

        $request->validate([
            'name'        => 'required|unique:categories|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    // Menampilkan form edit kategori (hanya user)
    public function edit(Category $category)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit kategori.');
        }

        return view('categories.edit', compact('category'));
    }

    // Memperbarui kategori (hanya user)
    public function update(Request $request, Category $category)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk memperbarui kategori.');
        }

        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    // Menghapus kategori (hanya user)
    public function destroy(Category $category)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus kategori.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
