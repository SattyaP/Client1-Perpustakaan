@extends('layouts.app')

@section('title', 'Edit Recomendation')

@section('content')
    <div class="container">
        @include('layouts.partials.flash')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Recomendation</div>
                    <div class="card-body">
                        <form action="{{ route('recomendation.update', $recomendation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="book_id" class="form-label">Book</label>
                                <select class="form-select @error('book_id') is-invalid @enderror" id="book_id"
                                    name="book_id">
                                    <option value="">Pilih Buku</option>
                                    @foreach ($books as $book)
                                        @if ($book->id == $recomendation->books->first()->id)
                                            @continue
                                        @endif

                                        @if ($book->isRecommendation())
                                            @continue
                                        @endif

                                        <option value="{{ $book->id }}"
                                            {{ $book->id == $recomendation->books->first()->id ? 'selected' : '' }}>
                                            {{ $book->title }}</option>

                                    @endforeach
                                </select>
                                @error('book_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control @error('note') is-invalid @enderror"
                                    id="note" name="note">{{ $recomendation->note }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <a href="{{ route('recomendation.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
