<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('genre')->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'genre_id' => 'required',
                'author' => 'required',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'publication_year' => 'required',
            ]);

            $cover = $request->file('cover');
            $hashName = $cover->hashName();
            $cover_path = $cover->storeAs('covers', $hashName, 'public');

            Book::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'genre_id' => $request->genre_id,
                'author' => $request->author,
                'cover' => $cover_path,
                'publication_year' => $request->publication_year,
            ]);

            return redirect()->route('book.index')->with('success', 'Book created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre_id' => 'required',
            'author' => 'required',
            'publication_year' => 'required',
        ]);

        $book = Book::find($id);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $hashName = $cover->hashName();
            $cover_path = $cover->storeAs('covers', $hashName, 'public');
            $book->cover = $cover_path;
        }

        $request['slug'] = Str::slug($request->title);

        $book->update($request->all());

        return redirect()->route('book.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully');
    }
}
