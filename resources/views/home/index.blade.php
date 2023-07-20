@extends('home.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($kategori as $item)
        <div class="col-sm-6 mt-2" data-aos="fade-right">
            <div id="bg-kategori" class="bg-image card shadow-1-strong" style="background-image: url('{{ asset('storage/'.$item->image) }}');">
                <div class="card-body text-white">
                    <h5 class="card-title" style="font-weight: 700;">{{ $item->name }} </h5>
                    <a href="/kategori/{{ $item->slug }}" class="btn btn-light">Button</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <hr>
    <section>
        <div class="text-center container py-5">
            <h3 class="mt-2 mb-5"><strong>Produk Terbaru</strong></h3>

            <div class="row">
                @foreach ($produkNew as $item)
                <div class="col-lg-4 col-md-12 mb-4" data-aos="fade-right">
                    <div class="card">
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                            <img src="{{ asset('storage/'. $item->image) }}" class="w-100" alt="{{ $item->name }}" />
                            <a href="#!">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5><span class="badge bg-primary ms-2">New</span></h5>
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="" class="text-reset">
                                <h6 class="card-title mb-3">{{ $item->name }}</h6>
                            </a>
                            <a href="" class="text-reset">
                                <p class="text-muted"><small>{{ $item->kat->name }}</small></p>
                            </a>
                            <hr>
                            <h4 class="mb-3 fw-bold text-success">Rp. {{ number_format($item->harga) }}</h4>
                            <a href="/produk/{{ $item->slug }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Masukkan Keranjang</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
<section class="bg-dark text-white">
    <div class="container">
        <div class="row py-5">
            <h3 class="text-center mb-4">Pelayanan Kami</h3>
            <div class="col-4" data-aos="fade-right">
                <div class="icon text-center">
                    <span class="badge rounded-circle p-3 bg-white">
                        <i class="fas fa-truck-fast fa-4x text-dark"></i>
                    </span>
                </div>
                <div class="text-center mt-3">
                    <p>Setelah pembayaran selesai, maka pesanan akan diproses segera</p>
                </div>
            </div>
            <div class="col-4" data-aos="fade-right">
                <div class="icon text-center">
                    <span class="badge rounded-circle p-3 bg-white">
                        <i class="fas fa-credit-card fa-4x text-dark"></i>
                    </span>
                </div>
                <div class="text-center mt-3">
                    <p>Pembayaran dapat dilakukan dengan banyak cara, sehingga memudahkan pelanggan</p>
                </div>
            </div>
            <div class="col-4" data-aos="fade-right">
                <div class="icon text-center">
                    <span class="badge rounded-circle p-3 bg-white">
                        <i class="fas fa-headset fa-4x text-dark"></i>
                    </span>
                </div>
                <div class="text-center mt-3">
                    <p>Terdapat Customer Service yang siap membantu anda</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection