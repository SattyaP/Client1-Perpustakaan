@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="container">
        @include('layouts.partials.flash')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Buku</div>
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <select class="form-select @error('genre_id') is-invalid @enderror" id="genre"
                                    name="genre_id">
                                    <option value="">Pilih Genre</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ $genre->id == old('genre_id') ? 'selected' : '' }}>{{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genre_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Penulis</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror"
                                    id="author" name="author" value="{{ old('author') }}">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="publication_year" class="form-label
                                ">Tahun
                                    Terbit</label>
                                <input type="number" class="form-control @error('publication_year') is-invalid @enderror"
                                    id="publication_year" name="publication_year" value="{{ old('publication_year') }}">
                                @error('publication_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover</label>
                                <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                    id="cover" name="cover">
                                @error('cover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cover" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <a href="{{ route('book.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
