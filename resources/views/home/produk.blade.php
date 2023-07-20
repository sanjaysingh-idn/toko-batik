@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="card my-4">
                <div class="card-body">
                    <P class="fw-bold">Urutkan</P>
                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-mdb-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Harga Termnurah</a>
                        <a class="nav-link active" id="v-pills-home-tab" data-mdb-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Harga Termahal</a>
                        <a class="nav-link active" id="v-pills-home-tab" data-mdb-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Produk Terbaru</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="row">
                @foreach ($produk as $item)
                <div class="col-lg-3 col-md-4 my-4" data-aos="fade-right">
                    <div class="card">
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                            <img src="{{ asset('storage/'. $item->image) }}" class="w-100" alt="{{ $item->name }}" />
                            <a href="#!">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5><span class="badge bg-primary ms-2"></span></h5>
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
    </div>
</div>

@endsection

@push('scripts')
<script>
    function orderByLowestPrice() {
            window.location.href = "{{ route('orderLowestPrice', ['order' => 'price_asc']) }}";
        }
</script>
@endpush