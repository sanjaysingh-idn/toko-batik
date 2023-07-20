@extends('admin.layouts.app')

@section('content')
<div class="row">
    <h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-start">
                    <a href="/admin/produk/create" class="btn btn-primary"><i class="bx bx-plus-circle"></i> Tambah Data Produk</a>
                </div>
            </div>

            <div class="card-body">
                <div class="text-nowrap">
                    <table id="table" class="table table-hover w-100">
                        <caption class="ms-4">

                        </caption>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($produk as $item)
                            @php
                            $ukuran = explode(',', $item->ukuran);
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ Str::limit(strip_tags($item->name), 30) }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" style="max-width: 50px;">
                                </td>
                                <td>{{ $item->kat->name }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    @foreach ($ukuran as $u)
                                    <span class="badge badge-center bg-dark">{{ $u }}</span>
                                    @endforeach
                                </td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}"><i class="bx bx-info-circle"></i> Detail</button>
                                            <button class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $item->id }}"><i class="bx bxs-photo-album"></i> Tambah Foto</button>
                                            <a class="btn btn-xs btn-warning" href="{{ route('produk.edit', $item->id) }}"><i class="bx bx-edit-alt"></i> Edit</a>
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
@foreach ($produk as $item)
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
@endforeach

{{-- Modal Tambah Foto --}}
@foreach ($produk as $item)
<div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success pb-3">
                <h5 class="modal-title text-white" id="modalFotoTitle">Tambah Foto Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Tambah Foto untuk <strong>{{ $item->name }}</strong></h4>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <div class="button-wrapper">
                        <form action="{{ route('produk.foto', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="formFile" class="form-label">Upload Foto Produk</label>
                            <input class="form-control" id="imageInput" type="file" id="formFile" name="image" required>
                            <div class="mt-3">
                                <img id="previewImage" src="#" alt="Preview" class="img-fluid">
                            </div>
                            <button type="button" id="resetButton" class="btn btn-secondary my-3">Reset</button>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1MB</p>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-success me-2">Upload Foto</button>
                </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4>Daftar Foto <strong>{{ $item->name }}</strong></h4>
                    </div>
                    <hr>
                    @foreach ($item->foto as $item)
                    <div class="col-4">
                        <form action="{{ route('produk.foto.delete', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}" class="img-thumbnail shadow">
                            <div class="mt-2">
                                <button type="submit" class="btn btn-danger me-2">Hapus Foto</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Delete --}}
@foreach ($produk as $item)
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

    $(document).ready(function() {
    // When a file is selected
    $("#imageInput").change(function() {
    readURL(this);
    });
    
    // Reset button click event
    $("#resetButton").click(function() {
    resetPreview();
    });
    });
    
    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
    $('#previewImage').attr('src', e.target.result).css('width', '150px');
    }
    
    reader.readAsDataURL(input.files[0]);
    }
    }
    
    function resetPreview() {
    $('#imageInput').val(''); // Clear the file input value
    $('#previewImage').attr('src', '#'); // Reset the preview image source
    }
</script>
@endpush