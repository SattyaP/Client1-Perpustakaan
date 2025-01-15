@extends('layouts.app')

@section('title', 'Genre')

@section('content')
    <div class="container">
        @include('layouts.partials.flash')
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Daftar Genre</h2>
                    <a href="{{ route('genre.create') }}" class="btn btn-primary">Tambah Genre</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($genres as $genre)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $genre->name }}</td>
                                    <td>
                                        <a href="{{ route('genre.edit', $genre->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus genre ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
