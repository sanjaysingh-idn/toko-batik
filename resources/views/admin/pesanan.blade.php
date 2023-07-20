@extends('admin.layouts.app')

@section('content')
<div class="row">
    <h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
    <div class="col-12">
        <div class="card">
            <div class="card-header">

            </div>

            <div class="card-body">
                <div class="text-nowrap">
                    <table id="table" class="table table-hover w-100">
                        <caption class="ms-4">

                        </caption>
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP / Whatsapp</th>
                                <th>Daftar Barang</th>
                                <th>Tujuan</th>
                                <th>Status</th>
                                <th>Dipesan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $item)
                            <tr>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->contact }}</td>
                                <td>
                                    <button class="btn btn-xs btn-primary">Daftar Barang</button>
                                </td>
                                <td>{{ $item->province->name }} -> {{ $item->city->name }}</td>
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
                                <td>{{ $item->created_at->format('d M Y, H:i:s') }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}"><i class="bx bx-info-circle"></i> Detail</button>
                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}"><i class="bx bx-trash-alt"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')

{{-- Modal Detail--}}
{{-- @foreach ($produk as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
<div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header bg-info pb-3">
            <h5 class="modal-title text-white" id="modalDetailTitle">Detail Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img class="img-thumbnail mx-auto shadow" src="{{ asset('storage/'. $item->image) }}" width="200" alt="Foto {{ $item->name }}" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <div class="table-responsive text-nowrap">
                        <table id="table" class="table table-hover">
                            <tbody>
                                <tr>
                                    <td class="bg-info text-white">Kategori</td>
                                    <td><span class="badge rounded-pill bg-warning"><strong>{{ $item->kat->name }}</strong></span></td>
                                </tr>
                                <tr>
                                    <td class="bg-info text-white">Nama</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-info text-white">Harga</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-info text-white">Ukuran Ready</td>
                                    <td>
                                        @php
                                        $ukuran = explode(',', $item->ukuran);
                                        @endphp
                                        @foreach ($ukuran as $u)
                                        <span class="badge badge-center px-4 bg-dark">{{ $u }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-info text-white">Stok</td>
                                    <td>{{ $item->stok }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p><strong>Deskripsi</strong></p>
                    {!! $item->desc !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach --}}

{{-- Modal Delete --}}
{{-- @foreach ($produk as $item)
<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header bg-danger pb-3">
            <h5 class="modal-title text-white" id="modalDeleteTitle">Delete Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('produk.destroy', $item->id) }}" method="POST">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="alert-heading">Apakah anda yakin ingin menghapus data Produk</h4>
                        <p><strong>{{ $item->name }}</strong> ?</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Delete Produk</button>
            </div>
        </form>
    </div>
</div>
</div>
@endforeach --}}

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