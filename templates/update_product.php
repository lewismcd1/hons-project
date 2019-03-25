<!-- Modal -->
<div class="modal fade" id="update-form-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_product_form" onsubmit="return false">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="update_pid" id="update_pid" value=""/>
                            <label>Date</label>
                            <input type="text" class="form-control" name="update_added_date" id="update_added_date" value="<?php echo date("Y-m-d");?>" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="update_product_name" id="update_product_name" placeholder="Enter product name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="update_select_cat" name="update_select_cat" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control" id="update_select_brand" name="update_select_brand" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="update_product_price" id="update_product_price" placeholder="Enter product price"/>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="update_product_qty" id="update_product_qty" placeholder="Enter product quantity"/>
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