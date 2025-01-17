@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="px-4 pt-5 my-5 text-center border-bottom">
                <h1 class="display-4 fw-bold text-body-emphasis">Selamat Datang di Perpustakaan Digital</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">Temukan buku favoritmu dan nikmati dunia pengetahuan tanpa batas</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <a href="#popular-books" class="btn btn-primary btn-lg px-4 me-sm-3">Cari Buku Segera</a>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/home/komunitasmembaca.jpg') }}" class="d-block w-100 img-fluid"
                                    alt="komunitas_membaca">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/home/maxresdefault.jpg') }}" class="d-block w-100 img-fluid"
                                    alt="laut_bercerita">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="popular-books" class="row mt-5">
            <div class="col-md-12">
                <h2 class="mb-4 text-center fw-bold">Buku Populer</h2>
                <div class="row g-3">
                    @foreach ($popularBooks as $item)
                        @if ($item->recomendations_count > 0)
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <img src="{{ $item->cover }}" class="img-fluid" alt="{{ $item->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>{{ $item->title }}</strong></h5>
                                        <p class="card-text">{{ $item->description }}</p>
                                        <span class="badge text-bg-primary">{{ $item->genre->name }}</span>

                                        @if ($item->isRecommendation())
                                            <span class="badge text-bg-success">Direkomendasikan
                                                {{ $item->recomendations_count }}</span>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Penulis: {{ $item->author }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
