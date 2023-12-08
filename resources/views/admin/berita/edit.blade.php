@extends('layouts.app')

@section('content')
    <div class="container mb-4">
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold my-auto">Update News</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="namaJudul" class="form-label">News Title</label>
                            <input type="text" name="judul" class="form-control" id="namaJudul"
                                value="{{ $berita->judul }}">
                            @error('judul')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input accept="image/*" type="file" name="cover" class="form-control" id="imageFile"
                                onchange="previewImage()">
                            @error('cover')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategoriSelect" class="form-label">Category</label>
                            <select class="form-select" name="kategori_id" id="kategoriSelect">
                                <option selected="" value="">-- Select Category --</option>
                                @foreach ($kategori as $itemk)
                                    @if ($itemk->id === $berita->kategori_id)
                                        <option value="{{ $itemk->id }}" selected>{{ $itemk->nama_kategori }}
                                        </option>
                                    @else
                                        <option value="{{ $itemk->id }}">{{ $itemk->nama_kategori }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Description</label>
                            <textarea class="form-control" id="editor" name="deskripsi" style="height:350px;">{{ $berita->deskripsi }}</textarea>
                            @error('deskripsi')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/berita" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
