@extends('layouts.app')

@section('title', 'Buku | ' . $book->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book->cover }}" class="img-fluid" alt="{{ $book->title }}">
            </div>
            <div class="col-md-8">
                <h2 class="fw-bold">{{ $book->title }}</h2>
                <p>Penulis : {{ $book->author }}</p>
                <p>Tahun Terbit : {{ $book->publication_year }}</p>
                <p>Genre : {{ $book->genre->name }}</p>
                <p>Deskripsi : {{ $book->description }}</p>
                <div class="badge text-bg-primary mb-3">{{ $book->genre->name }}</div>
                <br>

                @if ($book->isRecommendation())
                    <button class="btn btn-primary" disabled>Buku ini sudah anda rekomendasikan</button>
                @else
                    <button onclick="hitRekomendasi()" class="btn btn-primary">Rekomendasikan Buku Ini</button>
                @endif

                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function hitRekomendasi() {
            $.ajax({
                url: '{{ route('recomendation.store') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    book_id: '{{ $book->id }}',
                    note: 'Saya merekomendasikan buku ini'
                },
                success: function(response) {
                    alert(response.message);
                    $('button').prop('disabled', true).text('Buku ini sudah anda rekomendasikan');
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    </script>
@endsection
