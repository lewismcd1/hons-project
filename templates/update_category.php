<!-- Modal -->
<div class="modal fade" id="form-category-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_category_form" onsubmit="return false">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="hidden" name="cid" id="cid" value=""/>
                        <input type="text" class="form-control" name="update_category_name" id="update_category_name"  placeholder="Enter category name">
                        <small id="cat_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select id="update_parent_cat" name="update_parent_cat" class="form-control">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>