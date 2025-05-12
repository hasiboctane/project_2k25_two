<div class="modal modal-lg fade" id="showEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eventTitle">Event Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="eventName"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <p><strong>Location:</strong> <span id="eventLocation"></span></p>
                <p><strong>Price:</strong> <span id="eventPrice"></span></p>
                <p><strong>Max Capacity:</strong> <span id="eventMaxCapacity"></span></p>
                <p><strong>Event Time:</strong> <span id="eventTime"></span></p>
                <p><strong>Image:</strong></p>
                <div id="previewArea"
                    class="border-2 border-secondary rounded d-flex align-items-center justify-content-center mx-auto d-block"
                    style="width: 500px; height: 400px;">
                    <img id="eventBanner" src="#" alt="event banner"
                        style="width: 100%; height: 100%; object-fit: cover" class="rounded" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
