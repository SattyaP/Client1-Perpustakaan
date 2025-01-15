@extends('layouts.app')

@section('title', 'Buku')

@section('content')
    <style>
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex: 1;
        }
    </style>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-3">Daftar Buku</h2>
            <form action="{{ route('buku.search') }}" class="d-flex mb-3">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q" value="{{ request('q') }}">
                <a class="btn btn-outline-secondary" href="{{ route('buku.index') }}">Reset</a>
            </form>
        </div>
        <div class="row">
            @foreach ($books as $book)
                <a href="{{ route('buku.show', $book->slug) }}" class="col-md-3 h-full text-decoration-none">
                    <div class="card rounded mb-3">
                        <img src="{{ $book->cover }}" class="img-fluid" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <span class="badge text-bg-primary">{{ $book->genre->name }}</span>
                        </div>
                        <div class="card-footer">
                            <p>Penulis : {{ $book->author }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
