@extends('admin.layouts.app')

@section('content')
    <div class="admin-users-page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold mb-0">Daftar User</h3>
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary-app">
                Tambah User
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>No.Telephone</th>
                        <th>Email Address</th>
                        <th style="min-width: 150px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-medium">
                            <div class="d-flex align-items-center">
                                <img src="{{ auth()->user()->getPhoto() }}" class="avatar me-3" alt="user photo">
                                <div>
                                    Tes
                                </div>
                            </div>
                        </td>
                        <td>081313314141</td>
                        <td>tes@gmail.com</td>
                        <td>
                            <a href="#" class="icon-link text-decoration-none me-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button class="btn btn-sm icon-link text-decoration-none btn-delete-data">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    {{-- @forelse ($users as $user)
                        <tr>
                            <td class="fw-medium">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->getPhoto() }}" class="avatar me-3" alt="user photo">
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('super-admin.user.show', $user->id) }}" class="icon-link text-decoration-none me-3">
                                    <x-icons.heroicons icon="eye-outline" />
                                </a>

                                <a href="{{ route('super-admin.user.edit', $user->id) }}" class="icon-link text-decoration-none me-2">
                                    <x-icons.heroicons icon="pencil-outline" />
                                </a>

                                <button class="btn btn-sm icon-link text-decoration-none btn-delete-data"
                                    data-url="{{ route('super-admin.user.destroy', $user->id) }}">
                                    <x-icons.heroicons icon="trash-outline" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak Ada Data
                            </td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection