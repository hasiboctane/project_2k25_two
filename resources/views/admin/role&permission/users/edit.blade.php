@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('main')
    <div class="container-fluid">
        @include('admin.role&permission.includes.menu-bar')
        <div class="row ">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit User</h4>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                                Users List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name" value="{{ $user->name }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="email" value="{{ $user->email }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-2 d-flex justify-content-start align-items-center flex-wrap gap-4">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $role->id }}"
                                                {{ $hasRoles->contains($role->name) ? 'checked' : '' }} name="roles[]"
                                                value="{{ $role->name }}">
                                            <label class="form-check-label"
                                                for="{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('role')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 ">
                                    <button type="submit" class="mt-2 btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script></script>
@endpush
