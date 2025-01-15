<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Recomendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recomendations = Recomendation::with('user', 'books')->paginate(10);

        return view('recomendations.index', compact('recomendations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('recomendations.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'book_id' => 'required',
        ]);

        $recomendation = new Recomendation();

        if (Recomendation::where('user_id', Auth::id())->whereHas('books', function ($query) use ($request) {
            $query->where('book_id', $request->book_id);
        })->exists()) {
            return response()->json([
                'error' => 'You have already recommended this book'
            ]);
        }

        $recomendation->note = $request->note;
        $recomendation->user_id = Auth::id();
        $recomendation->save();

        $recomendation->books()->attach($request->book_id);

        return response()->json([
            'message' => 'Recomendation created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recomendation $recomendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recomendation $recomendation)
    {
        $books = Book::all();
        return view('recomendations.edit', compact('recomendation', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recomendation $recomendation)
    {
        $request->validate([
            'note' => 'required',
            'book_id' => 'required',
        ]);

        $recomendation->update([
            'note' => $request->note,
        ]);

        $recomendation->books()->sync($request->book_id);

        return redirect()->route('recomendation.index')->with('success', 'Recomendation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recomendation $recomendation)
    {
        $recomendation->delete();

        return redirect()->route('recomendation.index')->with('success', 'Recomendation deleted successfully');
    }
}
