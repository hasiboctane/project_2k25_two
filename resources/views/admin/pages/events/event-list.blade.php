@extends('admin.layouts.app')

@section('title', 'Event List')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Events List</h1>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Event
            </a>
        </div>

        <!-- Events table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td>{{ $event['id'] }}</td>
                                    <td>{{ $event['title'] }}</td>
                                    <td>{{ $event['date'] }}</td>
                                    <td>{{ $event['location'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ $event['status'] == 1 ? 'success' : 'danger' }}">
                                            {{ $event['status'] === 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <p>sample</p>
                                        {{-- <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No events found</td>
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
