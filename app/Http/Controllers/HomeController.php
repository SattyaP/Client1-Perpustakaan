<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Recomendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popularBooks = Book::withCount('recomendations')->orderBy('recomendations_count', 'desc')->take(5)->get();
        return view('home', compact('popularBooks'));
    }

    public function indexBook()
    {
        $books = Book::with('genre')->paginate(10);

        return view('book', compact('books'));
    }

    public function showBook(Book $book)
    {
        $userId = Auth::id();
        $bookId = $book->id;

        $recommendationExists = Recomendation::where('user_id', $userId)
            ->whereHas('books', function ($query) use ($bookId) {
                $query->where('books.id', $bookId);
            })
            ->exists();
        return view('showBook', compact('book', 'recommendationExists'));
    }

    public function indexGenre()
    {
        $genres = Genre::withCount('books')->paginate(10);
        return view('genre', compact('genres'));
    }

    public function search(Request $request)
    {
        $search = $request->get('q');

        $books = Book::where('title', 'like', '%' . $search . '%')->paginate(10);

        return view('book', compact('books', 'search'));
    }
}
