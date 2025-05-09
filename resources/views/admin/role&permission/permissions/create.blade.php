@extends('admin.layouts.app')

@section('title', 'Create Permission')

@section('main')
    <div class="container-fluid">
        @include('admin.role&permission.includes.menu-bar')
        <div class="row ">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Create Permission</h4>
                            <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-primary">
                                Permission List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 ">
                                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
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
{{-- <div class="page-header d-flex justify-content-between align-items-center">
                    <h4 class="page-title">Create Permission</h4>
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Permission List
                    </a>
                </div> --}}
