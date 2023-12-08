@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Category</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-title">Total of Categories</p>
                        <p class="card-text">{{ $allKategori }}</p>
                        <a href="/kategori" class="btn btn-primary">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>News</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-title">Total of News</p>
                        <p class="card-text">{{ $allBerita }}</p>
                        <a href="/berita" class="btn btn-primary">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
