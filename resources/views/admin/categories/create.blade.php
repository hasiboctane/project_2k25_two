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

        <!-- Category table -->
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
                            <input type="file" name="image" id="imageInput" class="form-control">
                            <label class="input-group-text" for="imageInput">Category Image</label>
                        </div>
                        <!-- Preview Box -->
                        <div class="mb-3">
                            <div id="previewArea"
                                class="border-2 border-secondary rounded d-flex align-items-center justify-content-center"
                                style="width: 160px; height: 140px; background-color: #f8f9fa;">
                                <img id="previewImage" src="#" alt="Selected Image"
                                    style="display: none; width: 100%; height: 100%; object-fit: cover" class="rounded" />
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <button type="submit" class="mt-2 btn btn-primary">Submit</button>
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
            $('#imageInput').change(function(e) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewImage').show();
                }

                reader.readAsDataURL(e.target.files[0]);
            });


        });
    </script>
@endpush
