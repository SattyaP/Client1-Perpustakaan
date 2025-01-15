@extends('layouts.app')

@section('title', 'Genre')

@section('content')
    <div class="container">
        <h2 class="fw-bold mb-3">Genre</h2>
        <div class="row justify-content-center">
            @foreach ($genres as $genre)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $genre->name }}</h5>
                            <p class="text-muted">({{ $genre->books_count }})</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
