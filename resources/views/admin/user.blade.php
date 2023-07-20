@extends('admin.layouts.app')

@section('content')
<div class="row">
    <h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-start">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="bx bx-plus-circle"></i> Tambah Data User</button>
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
                                <th>Role</th>
                                <th>Contact</th>
                                <th>Foto</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->role == 'admin')
                                    <span class="badge bg-label-primary me-1">{{ $item->role }}</span>
                                    @elseif ($item->role == 'customer')
                                    <span class="badge bg-label-success me-1">{{ $item->role }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->contact }}</td>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="{{ $item->name }}">
                                            @if ($item->image)
                                            <img src="{{ asset('storage/'. $item->image) }}" alt="{{ $item->name }}" class="rounded-circle" />
                                            @else
                                            <img src="{{ asset('template_back/assets/img') }}/default-image.png" alt="{{ $item->name }}" class="rounded-circle" />
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}"><i class="bx bx-info-circle me-1"></i> Detail</button>
                                    <a class="btn btn-xs btn-warning" href="{{ route('user.edit', $item->id, '.edit') }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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
                <h5 class="modal-title text-white" id="modalAddTitle">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="role" class="form-label">role</label>
                            <select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role" required>
                                <option value="" class="text-capitalize">--Pilih Role--</option>
                                @foreach ($role as $r)
                                <option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="contact" class="form-label">No. HP</label>
                            <input class="form-control @error('contact') is-invalid @enderror" type="number" id="contact" name="contact" value="{{ old('contact') }}" />
                            @error('contact')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ old('address') }}" />
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" />
                            @error('tempat_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" />
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="password" class="form-label">password</label>
                            <input class="form-control" type="password" id="password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Detail--}}
@foreach ($users as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info pb-3">
                <h5 class="modal-title text-white" id="modalDetailTitle">Detail User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <img class="img-thumbnail mx-auto shadow" @if ($item->image)
                        src="{{ asset('storage/'. $item->image) }}"
                        @else
                        src="{{ asset('template_back/assets/img') }}/default-image.png"
                        @endif
                        width="200"
                        alt="Foto {{ $item->name }}"
                        class="img-thumbnail">
                    </div>
                    <div class="col-12">
                        <div class="table-responsive text-nowrap">
                            <table id="table" class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="bg-info text-white">Role</td>
                                        <td><strong>{{ $item->role }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Nama</td>
                                        <td>{{ $item->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Email</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">No Hp / Whatsapp</td>
                                        <td>{{ $item->contact }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">TTL</td>
                                        <td>{{ $item->tempat_lahir }}, {{ $item->tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-info text-white">Alamat</td>
                                        <td>{{ $item->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

{{-- Modal Delete --}}
@foreach ($users as $item)
<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger pb-3">
                <h5 class="modal-title text-white" id="modalDeleteTitle">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="alert-heading">Apakah anda yakin ingin menghapus data User</h4>
                            <p><strong>{{ $item->name }}</strong> ?</p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Delete User</button>
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

    'use strict';
    
    document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');
    
    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
    resetFileInput = document.querySelector('.account-image-reset');
    
    if (accountUserImage) {
    const resetImage = accountUserImage.src;
    fileInput.onchange = () => {
    if (fileInput.files[0]) {
    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
    }
    };
    resetFileInput.onclick = () => {
    fileInput.value = '';
    accountUserImage.src = resetImage;
    };
    }
    })();
    });
</script>
@endpush