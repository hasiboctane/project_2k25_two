@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('main')
    <div class="container-fluid">
        @include('admin.role&permission.includes.menu-bar')
        <div class="row ">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Edit Role</h4>
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">
                                Roles List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name" value="{{ $role->name }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-2 d-flex justify-content-start align-items-center flex-wrap gap-4">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                                {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                                name="permissions[]" value="{{ $permission->name }}">
                                            <label class="form-check-label"
                                                for="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('permissions')
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
