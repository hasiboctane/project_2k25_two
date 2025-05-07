@extends('admin.layouts.app')

@section('title', 'Category List')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Categories List</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Category
            </a>
        </div>

        <!-- Categories table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @forelse($categories as $category)
                                <tr id="category-row-{{ $category->id }}">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->image }}" class="img-fluid"
                                                style="width: 50px; height: 50px;">
                                        @else
                                            <img src="{{ Vite::asset('resources/assets/img/no_image.jpg') }}" alt="No Image"
                                                class="img-fluid" style="width: 50px; height: 50px;">
                                        @endif
                                    </td>
                                    <td>
                                        </button>
                                        {{-- <button type="button" onclick="" class="btn btn-info btn-sm">
                                            Show
                                        </button> --}}
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <button type="button" onclick="deleteCategory({{ $category->id }})"
                                            class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                        <!-- Button trigger modal -->
                                        <button type="button" onclick="showCategory({{ $category->id }})"
                                            class="btn btn-info btn-sm">
                                            Show
                                        </button>
                                        {{-- <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#showCategoryModal">
                                            Show
                                        </button> --}}

                                        {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No categories found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @include('admin.categories.modal')
                <!-- Modal -->

                <!-- Pagination -->
                <div class="mt-4">
                    {{-- {{ $events->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: "{{ route('categories.destroy', '') }}/" + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#category-row-' + id).remove();
                            // Show the success message dynamically
                            let successMessage = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                            $('.table-responsive').prepend(successMessage);
                        } else {
                            alert('Failed to delete category');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);

                    }
                });
            }
        }

        function showCategory(id) {
            $.ajax({
                url: "{{ route('categories.show', '') }}/" + id,
                type: 'GET',
                success: function(response) {
                    // $('#categoryTitle').text('Category Details');
                    $('#categoryName').text(response.name);

                    if (response.image) {
                        $('#categoryImage').attr('src', `/storage/${response.image}`).show();
                    } else {
                        $('#categoryImage').attr('src',
                            '{{ Vite::asset('resources/assets/img/no_image.jpg') }}').show();
                    }

                    // Show the modal
                    $('#showCategoryModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to fetch category details.');
                }
            });
        }
    </script>
@endpush
