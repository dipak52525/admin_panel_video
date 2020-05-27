<form action="" enctype="multipart/form-data" method="post" id="editCategoryModel" name="editCategoryModel">
    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="category_name" id="category_name" value="<?php echo $row->categ_name; ?>" class="form-control" placeholder="Update Category, For Example : Foods, Electronics">
            <p class="nameError"></p>
        </div>
        <div class="form-group">
            <label class="control-label">Sort By</label>
            <select name="sort_by" class="form-control">
                <option value="Oldest" <?php echo ($row->sort_by == "Oldest") ? 'selected' : '' ?>>Oldest</option>
                <option value="Newest" <?php echo ($row->sort_by == "Newest") ? 'selected' : '' ?>>Newest</option>
            </select>
        </div>
        <div class="control-group form-group">
                <div class="controls">
                    <label class="control-label">Upload Photo:</label>
                    <input name="imageUpload" type="file" id="image_file">
                    <p class="imageError"></p>
                </div>
        </div>
        <div class="form-group form-check">
            <!-- checked="checked" -->
            <input type="checkbox" <?php echo ($row->is_active == 1) ? 'checked' : '' ?> class="form-check-input" name="is_active" id="is_active">
            <label class="form-check-label" for="exampleCheck1">Active</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Category</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>