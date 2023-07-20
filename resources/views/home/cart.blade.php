@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </nav>
</div>
<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-3"><a href="/produk" class="btn btn-warning"><i class="fas fa-long-arrow-alt-left me-2"></i>Kembali Belanja</a></h5>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-1"><i class="fa fa-cart-shopping me-4"></i>Keranjang Belanja</h2>
                                <p class="my-2">Periksa kembali keranjang ada sebelum melanjutkan ke halaman checkout</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        @foreach ($cartItems as $item)
                        <!-- Single item -->
                        <div class="row">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <!-- Image -->
                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                    <img src="{{ asset('storage/'.$item->attributes->image) }}" class="w-100" alt="Blue Jeans Jacket" />
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                    </a>
                                </div>
                                <!-- Image -->
                            </div>

                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <!-- Data -->
                                <p><strong>{{ $item->name }}</strong></p>
                                <p>Size: {{ $item->attributes->ukuran }}</p>
                                <p>Harga satuan: Rp. {{ number_format($item->price) }}</p>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Hapus dari keranjang">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- Data -->
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                <!-- Quantity -->
                                <div class="d-flex mb-4" style="max-width: 300px">
                                    <a class="btn btn-primary px-3 me-2" href="{{ route('decreaseQuantity', ['id' => $item->id]) }}">
                                        <i class="fas fa-minus"></i>
                                    </a>

                                    <div class="form-outline">
                                        <input id="form1" min="0" name="quantity" value="{{ $item->quantity }}" type="number" class="form-control" />
                                        <label class="form-label" for="form1">Quantity</label>
                                    </div>

                                    <a class="btn btn-primary px-3 ms-2" href="{{ route('increaseQuantity', ['id' => $item->id]) }}">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                <!-- Quantity -->

                                <!-- Price -->
                                <p class="text-start text-md-center">
                                    <strong>Rp. {{ number_format(Cart::get($item->id)->getPriceSum()) }}</strong>
                                </p>
                                <!-- Price -->
                            </div>
                        </div>
                        <!-- Single item -->
                        <hr>
                        @endforeach
                        @if (!$cartItems->isEmpty())
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Hapus Semua">
                                <i class="fas fa-trash-alt me-2"></i>
                                Hapus semua
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Total Keranjang</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Items
                                <span>{{ Cart::getTotalQuantity() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Sub Total
                                <span><strong>Rp. {{ number_format(Cart::getTotal())}}</strong></span>
                            </li>
                        </ul>
                        <hr>
                        @if (Auth::check())
                        <p>Silahkan lanjut ke halaman checkout untuk menghitung biaya pengiriman</p>
                        @if (Cart::getTotal() > 0)
                        <a href="/checkout" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-cash-register me-2"></i> Go to checkout
                        </a>
                        @endif
                        @else
                        <p><a href="/register">Daftar</a> / <a href="/login">Login</a>, untuk melanjutkan ke halaman checkout</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection