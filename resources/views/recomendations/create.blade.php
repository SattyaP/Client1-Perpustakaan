@extends('layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')
    <div class="container">
        @include('layouts.partials.flash')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Rekomendasi</div>
                    <div class="card-body">
                        <form action="{{ route('recomendation.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>

                                <textarea class="form-control @error('note') is-invalid @enderror"
                                    id="note" name="note" value="{{ old('note') }}"></textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="book_id" class="form-label">Book</label>
                                <select class="form-select @error('book_id') is-invalid @enderror"
                                    id="book_id" name="book_id">
                                    <option value="">Pilih Buku</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
