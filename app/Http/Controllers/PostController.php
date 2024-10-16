<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Authors; // Pastikan ini sesuai dengan nama model Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Menampilkan semua postingan (guest dan user)
    public function index()
    {
        $posts = Post::with('category')->get();
        return view('posts.index', compact('posts'));
    }

    // Menampilkan form untuk membuat postingan baru (hanya user)
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat postingan.');
        }

        $categories = Category::all();
        $authors = Authors::all();

        return view('posts.create', compact('categories', 'authors'));
    }

// Menyimpan postingan baru (hanya user)
public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk menyimpan postingan.');
    }

    $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|max:2048',
        'is_published' => 'required|boolean', // Pastikan ini 'required'
    ]);
    

    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->category_id = $request->input('category_id');
    // Menangani checkbox dengan memeriksa keberadaan input
    $post->is_published = $request->has('is_published') ? 1 : 0;

    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('posts', 'public');
    }

    $post->save();
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}

// Menampilkan form untuk mengedit postingan (hanya user)
public function edit(Post $post)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit postingan.');
    }

    $categories = Category::all();
    $authors = Authors::all();

    return view('posts.edit', compact('post', 'categories', 'authors'));
}


// Memperbarui postingan (hanya user)
public function update(Request $request, Post $post)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk memperbarui postingan.');
    }

    $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|max:2048',
        'is_published' => 'required|boolean', // Pastikan ini 'required'
    ]);

    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->category_id = $request->input('category_id');
    // Menangani checkbox dengan memeriksa keberadaan input
    $post->is_published = $request->has('is_published') ? 1 : 0;

    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('posts', 'public');
    }

    $post->save();
    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}


    // Menghapus postingan (hanya user)
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus postingan.');
        }

        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Menampilkan detail postingan (guest dan user)
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
