<form action="" enctype="multipart/form-data" method="post" id="addCategoryModel" name="addCategoryModel">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="category_name" id="category_name" value="" class="form-control" placeholder="Add Category, For Example : Foods, Electronics">
            <p class="nameError"></p>
        </div>
        <div class="form-group">
            <label class="control-label">Sort By</label>
            <select name="sort_by" id="sort_by" class="form-control">
                <option value="Oldest">Oldest</option>
                <option value="Newest">Newest</option>
            </select>
            <p class="soryByError"></p>
        </div>
        <div class="control-group form-group">
                <div class="controls">
                    <label class="control-label">Upload Photo:</label>
                    <input name="imageUpload" type="file"  id="image_file" required>
                    <p class="imageError"></p>
                </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Category</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>