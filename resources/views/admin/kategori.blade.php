@extends('admin.layouts.app')

@section('content')
<div class="row">
    <h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-start">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="bx bx-plus-circle"></i> Tambah Data Kategori</button>
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
                                <th>Nama Kategori</th>
                                <th>Foto Kategori</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($kategori as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img class="img-thumbnail" style="width: 200px;" src="{{ asset('storage/'.$item->image) }}" alt="">
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}"><i class="bx bx-edit me-1"></i> Edit</button>
                                    <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}"><i class="bx bx-trash-alt me-1"></i> Delete</button>
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
<!--/ User Profile Content -->
@endsection

@push('modals')

{{-- Modal Tambah --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary pb-2">
                <h5 class="modal-title text-white" id="modalAddTitle">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label for="formFile" class="form-label">Upload Foto Kategori</label>
                            <input class="form-control" id="imageInput" type="file" id="formFile" name="image" required>
                            <div class="mt-3">
                                <img id="previewImage" src="#" alt="Preview" class="img-thumbnail">
                            </div>
                            <button type="button" id="resetButton" class="btn btn-secondary my-3">Reset</button>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1MB</p>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
@foreach ($kategori as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning pb-3">
                <h5 class="modal-title text-white" id="modalDeleteTitle">Upadte Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label for="name" class="form-label">Foto Lama</label>
                            <img class="img-thumbnail" style="width: 200px;" src="{{ asset('storage/'.$item->image) }}" alt="">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="formFile" class="form-label">Upload Foto Kategori</label>
                            <input class="form-control" id="imageInput" type="file" id="formFile" name="image">
                            <div class="mt-3">
                                <img id="previewImage" src="#" alt="Preview" class="img-thumbnail">
                            </div>
                            <button type="button" id="resetButton" class="btn btn-secondary my-3">Reset</button>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1MB</p>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $item->name }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-warning"><i class="bx bx-save"></i> Update Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Modal Delete --}}
@foreach ($kategori as $item)
<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger pb-3">
                <h5 class="modal-title text-white" id="modalDeleteTitle">Delete Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="alert-heading">Apakah anda yakin ingin menghapus Kategori</h4>
                            <p><strong>{{ $item->name }}</strong> ?</p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Delete Kategori</button>
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
</script>
@endpush