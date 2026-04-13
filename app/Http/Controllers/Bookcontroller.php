<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::latest()->get();
        return view('admin.book.index', compact('books'));
    }

    public function create(): View
    {
        return view('admin.book.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_year' => 'required|digits:4',
            'isbn' => 'required',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable'
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created');
    }

    public function edit(Book $book): View
    {
        return view('admin.book.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_year' => 'required|digits:4',
            'isbn' => 'required',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable'
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return back()->with('success', 'Book deleted');
    }
}