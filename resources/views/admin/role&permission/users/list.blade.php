@extends('admin.layouts.app')

@section('title', 'Users list')

@section('main')
    <div class="container-fluid">
        @include('admin.role&permission.includes.menu-bar')
        <div class="row ">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="">Users</h4>
                            {{-- <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary">
                                create Permission
                            </a> --}}
                        </div>
                        {{-- <div class=" mt-2 py-2 px-1 rounded">
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="d-flex flex-col justify-content-center align-items-center">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="role" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="mt-1 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center align-items-center flex-wrap gap-4">
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                                    name="permissions[]" value="{{ $permission->name }}">
                                                <label class="form-check-label"
                                                    for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                        @error('permissions')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <button type="submit" class=" btn btn-primary">create role</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
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
                                        <th>Assigned Roles</th>
                                        {{-- <th>Permissions</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @forelse($users as $user)
                                        <tr id="user-row-{{ $user->id }}">
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                            {{-- <td>
                                                {{ $role->permissions->pluck('name')->implode(', ') }}
                                            </td> --}}
                                            <td>
                                                </button>
                                                {{-- <button type="button" onclick="" class="btn btn-info btn-sm">
                                                    Show
                                                </button> --}}
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm inline-block">Edit</a>
                                                {{-- <button type="button" onclick="deleteItem({{ $user->id }})"
                                                    class="inline-block btn btn-danger btn-sm">
                                                    Delete
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-warning">No roles found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        // function deleteItem(id) {
        //     if (confirm('Are you sure you want to delete this role?')) {
        //         $.ajax({
        //             url: "{{ route('roles.destroy', '') }}/" + id,
        //             type: 'DELETE',
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             success: function(response) {
        //                 if (response.status === 'success') {
        //                     $('#role-row-' + id).remove();
        //                     let successMessage = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
    //                     ${response.message}
    //                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //                 </div>`;
        //                     $('.table-responsive').prepend(successMessage);
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error:', error);

        //             }
        //         })
        //     } else {
        //         return;
        //     }

        // }
    </script>
@endpush
