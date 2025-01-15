@extends('layouts.app')

@section('title', 'Rekomendasi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Daftar Rekomendasi Buku</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Buku</th>
                                <th>Rekomendasi By</th>
                                <th>Note</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recomendations as $recomendation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $recomendation->books->first()->title }}</td>
                                    <td>{{ $recomendation->user->name }}</td>
                                    <td>{{ $recomendation->note }}</td>
                                    <td>
                                        <a href="{{ route('recomendation.edit', $recomendation->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('recomendation.destroy', $recomendation->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus rekomendasi ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
