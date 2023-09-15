@extends('admin.layouts.app')

@section('content')
    <div class="manage-user-detail-page">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        {{ $title }}
                        <div class="page-title-subheading">{{ $subtitle }}</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-dark-tms">
                        <i class="fas fa-chevron-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ $url_action }}" method="post" enctype="multipart/form-data">
            @if (@$user)
                @method('PUT')
            @endif
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Masukkan Nama Lengkap" value="{{ old('name', @$user->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            placeholder="Masukkan Nomor Telepon" value="{{ old('phone', @$user->phone) }}" required>
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Masukkan Email" value="{{ old('email', @$user->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="&bull;&bull;&bull;&bull;&bull;" value="">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Avatar</label>
                        <x-input.dropify name="avatar" :default="@$user?->getPhoto()" />
                    </div>

                    <div class="d-grid mt-3">
                        <button class="btn btn-secondary-app" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
