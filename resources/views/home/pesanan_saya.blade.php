@extends('home.layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
                </ol>
            </nav>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row my-4">
        <div class="col-md-12">
            <h3>Daftar Pesanan Saya</h3>
            <hr>
            <table id="table" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order Number</th>
                        <th>Total Order</th>
                        <th>Status</th>
                        <th>Tujuan</th>
                        <th>Dipesan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($pesanan as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->order_number }}</td>
                        <td>Rp. <strong>{{ number_format($item->total_shopping) }}</strong></td>
                        <td>
                            @if ($item->status == 'unpaid')
                            <span class="badge bg-danger">{{ $item->status }}</span>
                            @elseif ($item->status == 'paid')
                            <span class="badge bg-success">{{ $item->status }}</span>
                            @elseif ($item->status == 'dikirim')
                            <span class="badge bg-info">{{ $item->status }}</span>
                            @elseif ($item->status == 'selesai')
                            <span class="badge bg-primary">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>{{ $item->province->name }} -> {{ $item->city->name }}</td>

                        <td>{{ $item->created_at->format('d M Y, H:i:s') }}</td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('pesanan_saya.invoice', ['id' => $item->order_number]) }}" id="pay-button" class="btn btn-xs btn-success"><i class="fa fa-file-invoice"></i> Invoice dan Pembayaran</a>
                                </div>
                                @if ($item->status === 'unpaid')
                                <div class="col-12 my-2">
                                    <button class="btn btn-xs btn-danger" data-mdb-toggle="modal" data-mdb-target="#modalBatal{{ $item->id }}"><i class="fa fa-trash"></i> Batal</button>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('modals')

{{-- Modal Detail Invoice --}}
@foreach ($pesanan as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark pb-3">
                <h5 class="modal-title text-white" id="modalDetailTitle">Detail Invoice</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-9">
                                    <p>Invoice >> <strong>{{ $item->order_number }}</strong></p>
                                </div>
                                <div class="col-xl-3 float-end">
                                    <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                                    <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
                                </div>
                                <hr>
                            </div>

                            <div class="container">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <p class="pt-0 display-5"><strong>Batik Sakata Solo</strong></p>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-xl-6">
                                        <ul class="list-unstyled">
                                            <li class="text-muted">Kepada: <strong>{{ $item->name }}</strong></li>
                                            <li class="text-muted">{{ $item->address }}, City</li>
                                            <li class="text-muted"><i class="fas fa-phone"></i> {{ $item->contact }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-4">
                                        <p class="text-muted">Invoice</p>
                                        <ul class="list-unstyled">
                                            <li class="text-muted"><i class="fas fa-circle text-dark"></i> <span class="fw-bold">ID: </span>{{ $item->order_number }}</li>
                                            <li class="text-muted"><i class="fas fa-circle text-dark"></i> <span class="fw-bold">Creation Date: </span> {{ $item->created_at->format('d M Y, H:i:s') }}</li>
                                            <li class="text-muted"><i class="fas fa-circle text-dark"></i> <span class="me-1 fw-bold">Status:</span>@if ($item->status == 'unpaid')
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                                @elseif ($item->status == 'paid')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                                @elseif ($item->status == 'dikirim')
                                                <span class="badge bg-info">{{ $item->status }}</span>
                                                @elseif ($item->status == 'selesai')
                                                <span class="badge bg-primary">{{ $item->status }}</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row my-2 mx-1 justify-content-center">
                                    <table class="table table-striped table-borderless">
                                        <thead class="text-white bg-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            $subTotal = 0;
                                            @endphp
                                            @foreach ($item->pesananDetails as $d)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $d->product_name }}</td>
                                                <td>{{ $d->size }}</td>
                                                <td>{{ $d->quantity }}</td>
                                                <td>Rp. {{ number_format($d->price) }}</td>
                                                <td>
                                                    @php
                                                    $amount = $d->quantity * $d->price;
                                                    $subTotal += $d->price;
                                                    @endphp
                                                    Rp. {{ number_format($amount) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xl-8">
                                        <p class="ms-3">Catatan : {{ $item->catatan }}</p>

                                    </div>
                                    <div class="col-xl-3">
                                        <ul class="list-unstyled">
                                            <li class="text-muted ms-3 d-flex align-items-center">
                                                <span class="text-black me-4">SubTotal</span>
                                                <span class="ms-auto">Rp. {{ number_format($subTotal) }}</span>
                                            </li>
                                            <li class="text-muted ms-3 mt-2 d-flex align-items-center">
                                                <span class="text-black me-4">Ongkir</span>
                                                <span class="ms-auto">Rp. {{ number_format($item->ongkir) }}</span>
                                            </li>
                                            <li class="text-muted ms-3 mt-2 d-flex align-items-center">
                                                <span class="text-black me-4">Total</span>
                                                <span class="ms-auto fw-bold">Rp. {{ number_format($item->total_shopping) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Termiakasih atas pembelian anda.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-mdb-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Delete --}}
@foreach ($pesananUnpaid as $item)
<div class="modal fade" id="modalBatal{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger pb-3">
                <h5 class="modal-title text-white" id="modalBatalTitle">Hapus Pesanan</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-12">
                                    <p>Apakah anda yakin untuk menghapus pesanan <strong>{{ $item->order_number }} ?</strong></p>
                                </div>
                                <div class="row my-2 mx-1 justify-content-center">
                                    <table class="table table-striped table-borderless">
                                        <thead class="text-white bg-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            $subTotal = 0;
                                            @endphp
                                            @foreach ($item->pesananDetails as $d)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $d->product_name }}</td>
                                                <td>{{ $d->size }}</td>
                                                <td>{{ $d->quantity }}</td>
                                                <td>Rp. {{ number_format($d->price) }}</td>
                                                <td>
                                                    @php
                                                    $amount = $d->quantity * $d->price;
                                                    $subTotal += $d->price;
                                                    @endphp
                                                    Rp. {{ number_format($amount) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xl-8">
                                        <p class="ms-3">Catatan : {{ $item->catatan }}</p>

                                    </div>
                                    <div class="col-xl-3">
                                        <ul class="list-unstyled">
                                            <li class="text-muted ms-3 d-flex align-items-center">
                                                <span class="text-black me-4">SubTotal</span>
                                                <span class="ms-auto">Rp. {{ number_format($subTotal) }}</span>
                                            </li>
                                            <li class="text-muted ms-3 mt-2 d-flex align-items-center">
                                                <span class="text-black me-4">Ongkir</span>
                                                <span class="ms-auto">Rp. {{ number_format($item->ongkir) }}</span>
                                            </li>
                                            <li class="text-muted ms-3 mt-2 d-flex align-items-center">
                                                <span class="text-black me-4">Total</span>
                                                <span class="ms-auto fw-bold">Rp. {{ number_format($item->total_shopping) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete Pesanan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-mdb-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            // "dom": 'rtip',
            responsive: true,
        });
    });
</script>
@endpush