<div class="modal fade" id="update_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="update_product_form" onsubmit="return false">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label>Date</label>
                <input type="hidden" name="product_id" id="product_id" value="">
                <input type="text" class="form-control form-control-sm" id="added_date" name="added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
              </div>

              <div class="form-group col-md-6">
                <label>New Product Name</label>
                <input type="text" class="form-control form-control-sm" id="update_product_name" name="new_product_name">
                <small id="p_error" class="form-text text-muted"></small>
              </div>
            </div>

            <div class="form-group">
              <label>Category</label>
              <select class="form-control form-control-sm" id="update_category_name" name="new_category_name">

              
              </select>
              <small id="c_error" class="form-text text-muted"></small>

            </div>

            <div class="form-group">
              <label>Brand</label>
              <select class="form-control form-control-sm" id="update_brand_name" name="new_brand_name">


                ...
              </select>
              <small id="b_error" class="form-text text-muted"></small>

            </div>
            
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control form-control-sm" id="update_product_price" name="new_product_price">
                <small id="price_error" class="form-text text-muted"></small>

              </div>

               <div class="form-row">
              <div class="form-group col-md-4">
                <label>Quantity</label>
                <input type="number" class="form-control form-control-sm" id="update_product_stock" name="new_product_stock" placeholder="0">
                <small id="stock_error" class="form-text text-muted"></small>

              </div>
            </div>

          <button type="submit" class="btn btn-success">Update</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>