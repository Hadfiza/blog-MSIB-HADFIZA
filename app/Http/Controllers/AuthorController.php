<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Authors::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
        ]);

        Authors::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Authors $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Authors $author)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors,email,'.$author->id,
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Authors $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}

