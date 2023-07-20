@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </nav>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-3"><a href="/keranjang" class="btn btn-secondary"><i class="fas fa-long-arrow-alt-left me-2"></i>Kembali ke Keranjang</a></h5>
                    <hr>
                    <h2 class="mb-1"><i class="fa fa-cart-shopping me-4"></i>Keranjang Belanja</h2>
                    <p class="my-2">Periksa kembali keranjang ada sebelum melanjutkan ke halaman checkout</p>
                    <p class="my-2 text-warning">Ini adalah halaman terakhir sebelum melanjutkan ke halamanan pembayaran</p>
                </div>
                <div class="card-body">
                    <p class="mb-4">Daftar Pesananan</p>
                    @php
                    $subtotalBerat = 0;
                    @endphp
                    @foreach ($cartItems as $item)
                    <div class="d-flex justify-content-between my-2">
                        <div class="d-flex flex-row align-items-center">
                            <div>
                                <img src="{{ asset('storage/'.$item->attributes->image) }}" class="rounded-3" alt="{{ $item->name }}" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="ms-3">
                                <p><strong>{{ $item->name }}</strong></p>
                                <p class="small mb-0">Qty : {{ $item->quantity }} Pcs</p>
                                <p class="small mb-0">Size : {{ $item->attributes->ukuran }}</p>
                                <p class="small mb-0">Harga Satuan : Rp. {{ number_format($item->price) }}</p>
                                <p class="small mb-0"><strong>Total Harga : Rp. {{ number_format(Cart::get($item->id)->getPriceSum()) }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <hr>

                    @php
                    $berat = $item->attributes->berat*$item->quantity;
                    $subtotalBerat += $berat;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Credit card form -->
    <section>
        <div class="row mt-4">
            <div class="col-md-7 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3 bg-dark text-white">
                        <h5 class="mb-0">Detail Pengiriman</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('order_store') }}" method="POST">
                            @csrf
                            <label class="form-label text-uppercase mb-4 fw-bold" for="name">Data Penerima</label>

                            <div class="form-outline mb-4">
                                <input type="text" id="name" class="form-control" name="name" value="{{ Auth()->user()->name }}" required />
                                <label class="form-label" for="name">Nama Penerima</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control" name="email" value="{{ Auth()->user()->email }}" required />
                                <label class="form-label" for="email">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="number" id="contact" class="form-control" name="contact" value="{{ Auth()->user()->contact }}" required />
                                <label class="form-label" for="contact">No HP / Whatsapp</label>
                            </div>

                            <hr class="my-4" />

                            <label class="form-label text-uppercase mb-4 fw-bold" for="name">PENGIRIMAN</label>

                            <input type="hidden" value="{{ $subtotalBerat }}" id="weight" name="weight">

                            <div class="form-group mb-3">
                                <label class="font-weight-bold mb-2">Provinsi</label>
                                <select class="form-control provinsi-tujuan" id="province_id" name="province_id" style="width: 100%">
                                    <option value="" hidden>--Pilih Provinsi--</option>
                                    @foreach ($provinces as $item)
                                    <option value="{{ $item['province_id']  }}" getProvince="{{$item['province']}}">{{$item['province']}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" id="province_name" nama="province_name" placeholder="ini untuk menangkap nama provinsi ">
                            </div>
                            <div class=" form-group mb-4">
                                <label class="font-weight-bold mb-2">Kota / Kabupaten</label>
                                <select class="form-control" name="city_id" id="city_id" required>
                                    <option value="" hidden>--Pilih Kota/Kabupaten--</option>
                                </select>
                                <input type="hidden" class="form-control" id="cityName" nama="cityName" placeholder="ini untuk menangkap nama kota ">
                            </div>

                            <div class=" form-group mb-4">
                                <label class="font-weight-bold mb-2">Pilih Ekspedisi</label>
                                <select class="form-control" name="courier" id="courier" required>
                                    <option value="" hidden>--Pilih Ekspedisi--</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS INDONESIA</option>
                                </select>
                            </div>

                            <div class=" form-group mb-4">
                                <label class="font-weight-bold mb-2">Pilih Layanan</label>
                                <select class="form-control" name="layanan" id="layanan" required>
                                    <option value="">--Pilih Layanan--</option>
                                </select>
                            </div>

                            <input type="hidden" class="form-control" id="service" name="service">
                            <input type="hidden" class="form-control" id="ongkir" name="ongkir">

                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="address" rows="4" name="address" required="required"></textarea>
                                <label class="form-label" for="address">Alamat Lengkap</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="pos_code" class="form-control" name="pos_code" required />
                                <label class="form-label" for="pos_code">Kode Pos</label>
                            </div>

                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="catatan" rows="4"></textarea>
                                <label class="form-label" for="catatan">Catatan Pengiriman</label>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3 bg-dark text-white">
                        <h5 class="mb-0">Total Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Items
                                <span>{{ Cart::getTotalQuantity() }} Pcs</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Total
                                <span><strong>Rp. {{ number_format(Cart::getTotal()) }}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Pengiriman
                                <span id="pengiriman"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Sub Total</strong>
                                    <strong>
                                        <p class="mb-0">(Termasuk Ongkir)</p>
                                    </strong>
                                </div>
                                <span id="sumResult" class="fw-bold"></span>
                            </li>
                            <hr>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Continue to checkout
                            </button>
                        </ul>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <!-- Credit card form -->
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('select[name="province_id"]').on('change', function() {
            let getProvince = $("#province_id option:selected").attr("getProvince");
            $("#province_name").val(getProvince);
            let provinceId = $(this).val();
        
            if (provinceId) {
                $.ajax({
                    url: '/city/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('select[name="city_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.city_id + '" cityName="' + value.type + ' ' + value.city_name + '">' + value.type + ' ' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city_id"]').empty();
            }
        });
        
        $('select[name="courier"]').on('change', function() {
            let origin = {{ $city_origin }};
            let destination = $("select[name=city_id]").val();
            let courier = $("select[name=courier]").val();
            let weight = $("input[name=weight]").val();
            if (courier) {
                $.ajax({
                    url: "/origin=" + origin + "&destination=" + destination + "&weight=" + weight + "&courier=" + courier,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('select[name="layanan"]').empty();
                        $('select[name="layanan"]').change(function() {
                            var selectedOption = $(this).find('option:selected');
                            var ongkir = parseFloat(selectedOption.data('ongkir'));
                            var total = parseFloat("{{ Cart::getTotal() }}");
                            var sum = ongkir + total;
                            $('input[name="service"]').val(selectedOption.data('service'));
                            $('input[name="ongkir"]').val(ongkir);
                            $('#pengiriman').text('Rp. ' + ongkir.toLocaleString());
                            // console.log(ongkir);
                            $('#sumResult').text('Rp. ' + sum.toLocaleString());
                        });
                        $.each(data, function(key, value) {
                            $.each(value.costs, function(key1, value1) {
                                $.each(value1.cost, function(key2, value2) {
                                    var service = value1.service;
                                    var ongkir = value2.value;
                                    var option = $('<option>')
                                    .val(key2)
                                    .text(service + ' | Rp. ' + ongkir.toLocaleString())
                                    .data('service', service)
                                    .data('ongkir', ongkir);
                                    $('select[name="layanan"]').append(option);
                                });
                            });
                        });
                    }
                });
            } else {
                $('select[name="layanan"]').empty();
            }
        });
    });
</script>
@endpush