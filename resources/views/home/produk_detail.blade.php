@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $produk->name }}</li>
                </ol>
            </nav>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <h5 class="my-3"><a href="/produk" class="btn btn-info"><i class="fas fa-long-arrow-alt-left me-2"></i>Kembali</a></h5>
        <hr>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="wrap mx-2">
                    <img src="{{ asset('storage/'.$produk->image) }}" id="imageBox" class="img-fluid detail-foto rounded-start p-2" alt="...">
                    <div class="row mx-1 mb-3">
                        <div class="col-3">
                            <img src="{{ asset('storage/'.$produk->image) }}" alt="" class="preview-img img-thumbnail mx-auto" onclick="previewImg(this)">
                        </div>
                        @foreach ($produk->foto as $item)
                        <div class="col-3">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="" class="preview-img img-thumbnail mx-auto" onclick="previewImg(this)">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $produk->id }}" name="id">
                            <div class="col-12">
                                <h5 class="card-title">{{ $produk->name }}</h5>
                                <h4 class="mb-3 fw-bold text-success">Rp. {{ number_format($produk->harga) }}</h4>
                            </div>
                            <div class="col-12">
                                <label for="text" class="form-label d-block">Pilih Ukuran</label>
                                @php
                                $ukuranArray = explode(',', $produk->ukuran);
                                @endphp
                                @foreach ($ukuranArray as $u)
                                <input type="radio" class="btn-check" name="ukuran" id="{{ $u }}" value="{{ $u }}" autocomplete="off" required />
                                <label class="btn btn-secondary" for="{{ $u }}">{{ $u }}</label>
                                @endforeach
                            </div>
                    </div>
                    <div class="col-6">
                        <label for="text" class="form-label mt-3">Qty</label>
                        <div class="input-group mt-2">
                            <span class="input-group-text">Pcs</span>
                            <input type="number" class="form-control" name="qty" min="1" value="{{ old('qty') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-cart-plus"></i> Masukkan Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">
                    <p class="fw-bold text-center my-4">
                        Deskripsi
                    </p>
                    {!! $produk->desc !!}
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewImg(element) {
        var imageBox = document.getElementById('imageBox');
        imageBox.src = element.src;
        }
        
        function attachEventListeners() {
            var previewImages = document.querySelectorAll('.preview-img');
            previewImages.forEach(function (image) {
            image.addEventListener('click', function () {
                previewImg(this);
            });
            image.addEventListener('touchstart', function () {
                previewImg(this);
                });
            });
        }
        
        // Call the attachEventListeners function when the page has finished loading
        window.addEventListener('load', function () {
        attachEventListeners();
    });
</script>
@endpush