<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $query = Books::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('author', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        $books = $query->latest()->paginate(10)->withQueryString();
        $genre = Books::distinct()->pluck('genre');

        return view('books.index', compact('books', 'genre'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'published_year' => 'required|integer',
            'isbn' => 'required|unique:books,isbn',
            'pages' => 'required|integer',
            'language' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['is_available'] = $request->has('is_available');

        Books::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Books $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Books $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Books $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'published_year' => 'required|integer',
            'isbn' => 'required|unique:books,isbn,'.$book->id,
            'pages' => 'required|integer',
            'language' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['is_available'] = $request->has('is_available');

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Books $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }
}
