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
                                    <td>{{ Str::limit($event->description, 40) }}</td>
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
                                        <button type="button" onclick="showEvent({{ $event->id }})"
                                            class="btn btn-info btn-sm">
                                            Show
                                        </button>
                                        {{-- <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                                            Show
                                        </a> --}}
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit
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
                <!-- Modal -->
                @include('admin.events.modal')
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $events->links() }}
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
        // Helper to format datetime string to readable format
        function formatDateTime(dt) {
            if (!dt) return '';
            const d = new Date(dt);
            // Format: YYYY-MM-DD HH:mm
            return d.getFullYear() + '-' +
                String(d.getMonth() + 1).padStart(2, '0') + '-' +
                String(d.getDate()).padStart(2, '0') + ' ' +
                String(d.getHours()).padStart(2, '0') + ':' +
                String(d.getMinutes()).padStart(2, '0');
        }
        // Show Event
        function showEvent(id) {
            $.ajax({
                url: "{{ route('events.show', '') }}/" + id,
                method: 'GET',
                success: function(response) {
                    $('#eventName').text(response.name);
                    $('#eventDescription').text(response.description);
                    $('#eventPrice').text(response.price);
                    $('#eventLocation').text(response.location);
                    $('#eventMaxCapacity').text(response.max_capacity);
                    // Show time period
                    let timePeriod = formatDateTime(response.start_time) + ' - ' + formatDateTime(response
                        .end_time);
                    $('#eventTime').text(timePeriod);

                    if (response.event_banner) {
                        $('#eventBanner').attr('src', `/storage/${response.event_banner}`);
                    } else {
                        $('#eventBanner').attr('src',
                            `{{ Vite::asset('resources/assets/img/no_image.jpg') }}`);
                    }

                    // Show the modal
                    $('#showEventModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to fetch event details.');
                }
            });

        }
    </script>
@endpush
