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
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @php
                                $sl = 1;
                            @endphp
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No categories found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{-- {{ $events->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
