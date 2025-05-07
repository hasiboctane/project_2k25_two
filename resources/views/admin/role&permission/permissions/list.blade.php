@extends('admin.layouts.app')

@section('title', 'Permissions list')

@section('main')
    <div class="container-fluid">
        @include('admin.role&permission.includes.menu-bar')
        <div class="row ">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="">Permissions</h4>
                            {{-- <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary">
                                create Permission
                            </a> --}}
                        </div>
                        <div class=" mt-2 py-2 px-1 rounded">
                            <form action="{{ route('permissions.store') }}" method="POST">
                                @csrf
                                <div class="d-flex space-x-4 justify-content-center align-items-center">
                                    <div class="">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <button type="submit" class=" btn btn-primary">create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @forelse($permissions as $permission)
                                        <tr id="category-row-{{ $permission->id }}">
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                </button>
                                                {{-- <button type="button" onclick="" class="btn btn-info btn-sm">
                                                    Show
                                                </button> --}}
                                                <a href="" class="btn btn-warning btn-sm inline-block">Edit</a>
                                                <button type="button" onclick=""
                                                    class="inline-block btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No permissions found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script></script>
@endpush
