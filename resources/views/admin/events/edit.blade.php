@extends('admin.layouts.app')

@section('title', 'Edit Event')

@section('main')
    <div class="container-fluid">
        <!-- Page header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Edit Event</h1>
            <a href="{{ route('events.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> View All Events
            </a>
        </div>

        <!-- Events table -->
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
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $event->name) }}" placeholder="name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $event->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="category" name="category_id" required>
                                {{-- <option selected value="{{ $event->category->id }}">
                                    {{ $event->category->name }}</option> --}}
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $event->category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <select class="form-select" id="type" name="type" required>
                                    {{-- <option selected disabled value="">Select Type</option> --}}
                                    <option @if ($event->type == 'free') selected @endif value="free">Free</option>
                                    <option @if ($event->type == 'paid') selected @endif value="paid">Paid</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ old('location', $event->location) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('price', $event->price) }}" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="max_capacity" class="form-label">Max Capacity</label>
                                <input type="number" class="form-control" id="max_capacity" name="max_capacity"
                                    value="{{ old('max_capacity', $event->max_capacity) }}" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start time</label>
                                <input type="datetime-local" class="form-control" name="start_time"
                                    value="{{ old('start_time', \Illuminate\Support\Carbon::parse($event->start_time)->format('Y-m-d\TH:i')) }}"
                                    id="start_time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_time" class="form-label">End time</label>
                                <input type="datetime-local" class="form-control" name="end_time"
                                    value="{{ old('end_time', \Illuminate\Support\Carbon::parse($event->end_time)->format('Y-m-d\TH:i')) }}"
                                    id="end_time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="event_banner" name="event_banner">
                                <label class="input-group-text" for="event_banner">Event Banner</label>
                            </div>
                            <!-- Preview Box -->
                            <div class="mb-3">
                                <div id="previewArea"
                                    class="border-2 border-secondary rounded d-flex align-items-center justify-content-center"
                                    style="width: 140px; height: 120px; background-color: #f8f9fa;">
                                    @if ($event->event_banner)
                                        <img id="previewImage" src="{{ asset('storage/' . $event->event_banner) }}"
                                            alt="{{ $event->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover" class="rounded" />
                                    @else
                                        <img id="previewImage"
                                            src="{{ Vite::asset('resources/assets/img/no_image.jpg') }}" alt="No Image"
                                            style="width: 100%; height: 100%; object-fit: cover" class="rounded" />
                                    @endif
                                </div>
                            </div>
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
            // Type Selection
            $('#type').change(function() {
                var selectedType = $(this).val();
                var priceInput = $('#price');

                if (selectedType === 'free') {
                    priceInput.val(0);
                    priceInput.prop('readonly', true);
                } else {
                    priceInput.val('');
                    priceInput.prop('readonly', false);
                }
            });
            // Category Selection / Add
            // $('#addCategoryBtn').click(function() {
            //     // console.log('Button clicked');
            //     var categoryName = $("#new_category_name").val();
            //     var messageBox = $("#message_box");
            //     if (categoryName === '') {
            //         messageBox.text('Please enter a category name').removeClass('d-none text-success')
            //             .addClass('text-warning');
            //         return;
            //     }
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('categories.ajax-store') }}",
            //         data: {
            //             name: categoryName,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             // console.log(response);
            //             if (response.status === 'success') {
            //                 $('#category').append(
            //                     `<option value="${response.category.id}" selected>${response.category.name}</option>`
            //                 );
            //                 $("#new_category_name").val('');
            //                 messageBox.text(response.message).removeClass('d-none text-warning')
            //                     .addClass('text-success');
            //             }
            //         },
            //         error: function(xhr) {
            //             var err = xhr.responseJSON.errors?.name?.[0] ?? "Something went wrong!";
            //             messageBox.text(err).removeClass('d-none text-success').addClass(
            //                 'text-danger');
            //         }

            //     })
            // });
            // Image preview
            $('#event_banner').change(function(e) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    // $('#previewImage').show();
                }

                reader.readAsDataURL(e.target.files[0]);
            });

        });
    </script>
@endpush
