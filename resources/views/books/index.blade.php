@extends('layouts.app')

@section('title', 'Buku')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Daftar Buku</h2>
                    <a href="{{ route('book.create') }}" class="btn btn-primary">Tambah Buku</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Genre</th>
                                <th>Penulis</th>
                                <th>Tahun Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="img-fluid" style="max-width: 100px">
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->genre->name }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->publication_year }}</td>
                                    <td>
                                        <a href="{{ route('book.edit', $book->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
