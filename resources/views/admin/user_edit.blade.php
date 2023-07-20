@extends('admin.layouts.app')

@section('content')
<div class="row">
    <h2 class="fw-bold"><span class="text-muted fw-light py-5">{{ $title }}</span></h2>
    <div class="row">
        <div class="col mb-3">
            <a href="/admin/user" class="btn btn-secondary"><i class="bx bx-left-arrow"></i> Kembali</a>
        </div>
    </div>
    <div class="col-12">
        <!-- Edit Profile -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h4 class="card-action-title mb-0"><i class='bx bx-edit'></i> Edit Profile</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    @if ($user->image)
                    <img src="{{ asset('storage/'. $user->image) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                    @else
                    <img src="{{ asset('template_back/assets/img') }}/default-image.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                    @endif
                    <div class="button-wrapper">
                        <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" class="account-file-input @error('image') is-invalid @enderror" id="upload" name="image" accept="image/png, image/jpeg" hidden>
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1MB</p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $user->name }}" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $user->email }}" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">role</label>
                        <select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role" required>
                            @foreach ($role as $r)
                            @if (old('role', $user->role) == $r)
                            <option value="{{ $r }}" class="text-capitalize" selected>{{ $r }}</option>
                            @else
                            <option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact" class="form-label">No. HP</label>
                        <input type="number" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ $user->contact }}" />
                        @error('contact')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}" />
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}" />
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $user->tgl_lahir }}" />
                        @error('tgl_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">role</label>
                        <select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role" required>
                            @foreach ($role as $r)
                            @if (old('role', $user->role) == $r)
                            <option value="{{ $r }}" class="text-capitalize" selected>{{ $r }}</option>
                            @else
                            <option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Ubah Password</label>
                        <br>
                        <button id="changePasswordButton" class="btn btn-warning mb-3">Change Password</button>

                        <div id="passwordForm" class="collapse">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                </div>
                </form>
            </div>
        </div>
        <!--/ Edit Profile -->
    </div>
</div>
<!--/ User Profile Content -->
@endsection
@push('scripts')
<script>
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function (e) {(function () {
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

    $(document).ready(function() {
        $('#changePasswordButton').click(function(event) {
            event.preventDefault();
        $('#passwordForm').collapse('toggle');
        });
    });
</script>
@endpush