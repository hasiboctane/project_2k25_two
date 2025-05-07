<div class="modal fade" id="showCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryTitle">Category Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="categoryName"></span></p>
                <p><strong>Image:</strong></p>
                <div id="previewArea"
                    class="border-2 border-secondary rounded d-flex align-items-center justify-content-center"
                    style="width: 450px; height: 400px;">
                    <img id="categoryImage" src="#" alt="categoryImage"
                        style="display: none; width: 100%; height: 100%; object-fit: cover" class="rounded" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
