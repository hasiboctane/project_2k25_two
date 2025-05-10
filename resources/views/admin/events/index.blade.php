@extends('admin.layouts.app')

@section('title', 'Event List')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Events List</h1>
            @can('create events')
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Event
                </a>
            @endcan
        </div>

        <!-- Events table -->
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
                                <th>ID</th>
                                <th>Title</th>
                                <th>description</th>
                                <th>Banner</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr id="event-row-{{ $event->id }}">
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>
                                        @if ($event->event_banner)
                                            <img src="{{ asset('storage/' . $event->event_banner) }}"
                                                alt="{{ $event->event_banner }}" class="img-fluid"
                                                style="width: 50px; height: 50px;">
                                        @else
                                            <img src="{{ Vite::asset('resources/assets/img/no_image.jpg') }}" alt="No Image"
                                                class="img-fluid" style="width: 50px; height: 50px;">
                                        @endif
                                    </td>
                                    <td>{{ $event->location }}</td>
                                    <td>
                                        <span class="badge bg-{{ $event['type'] == 'free' ? 'success' : 'warning' }}">
                                            {{ $event['type'] === 'free' ? 'Free' : 'Paid' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" onclick="" class="btn btn-info btn-sm">
                                            Show
                                        </button>
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="btn btn-warning btn-sm">Edit
                                        </a>
                                        @can('delete events')
                                            <button type="button" onclick="deleteEvent({{ $event->id }})"
                                                class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        @endcan
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
@push('custom-js')
    <script>
        function deleteEvent(id) {
            if (confirm('Do you want to delete this event?')) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('events.destroy', '') }}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#event-row-' + id).remove();
                            let successMessage = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`;
                            $('.table-responsive').prepend(successMessage);
                        } else {
                            alert('Failed to delete event');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

        }
    </script>
@endpush
