@extends('layouts.app')
@section('content')
    <div id="admin-content">
        <div class="container">
            <!-- Bagian Card Statistik Atas -->
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $authors }}</p>
                            <h5 class="card-title mb-0">Authors Listed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $publishers }}</p>
                            <h5 class="card-title mb-0">Publishers Listed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $categories }}</p>
                            <h5 class="card-title mb-0">Categories Listed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $books }}</p>
                            <h5 class="card-title mb-0">Books Listed</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <hr class="my-4">

            <!-- Bagian Card Statistik Bawah -->
            <div class="row mt-3">
                <div class="col-md-3 offset-md-3">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $students }}</p>
                            <h5 class="card-title mb-0">Register Students</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 14rem; margin: 0 auto;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $issued_books }}</p>
                            <h5 class="card-title mb-0">Book Issued</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <hr class="my-4">

            <!-- Section Buku Paling Sering Dipinjam -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <h3 class="admin-heading">Popular Books</h3>
                            @if($most_issued_books->count() > 0)
                                <div class="mt-4">
                                    @foreach($most_issued_books as $index => $book)
                                        <div class="d-flex justify-content-between align-items-center py-2 px-4 mb-2 bg-light rounded">
                                            <span class="font-weight-bold">{{ $index + 1 }}</span>
                                            <span>{{ $book->book->name ?? 'Buku tidak ditemukan' }}</span>
                                            <span class="badge bg-primary">{{ $book->total }} kali</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mt-4">Belum ada data peminjaman buku</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
