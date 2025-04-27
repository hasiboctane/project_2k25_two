@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Create Category</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> View All Categories
            </a>
        </div>

        <!-- ECategory table -->
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3 input-group">
                            <input type="file" name="image" id="image" class="form-control">
                            <label class="input-group-text" for="image">Upload</label>
                        </div>
                        <div class="mb-3 ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {


        });
    </script>
@endpush
