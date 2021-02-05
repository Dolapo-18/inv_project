<div class="modal fade" id="form_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <small id="product_report" class="form-text text-muted text-center"></small>
      <div class="modal-body">
        <form id="product_form" onsubmit="return false">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Date</label>
                <input type="text" class="form-control form-control-sm" id="added_date" name="added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
              </div>

              <div class="form-group col-md-6">
                <label>Product Name</label>
                <input type="text" class="form-control form-control-sm" id="product_name" name="product_name">
                <small id="p_error" class="form-text text-muted"></small>
              </div>
            </div>

            <div class="form-group">
              <label>Category</label>
              <select class="form-control form-control-sm" id="select_cat" name="cat_id">

              
              </select>
              <small id="c_error" class="form-text text-muted"></small>

            </div>

            <div class="form-group">
              <label>Brand</label>
              <select class="form-control form-control-sm" id="select_brand" name="brand_id">


                ...
              </select>
              <small id="b_error" class="form-text text-muted"></small>

            </div>
            
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control form-control-sm" id="product_price" name="product_price" placeholder="Total product price" autocomplete="off">
                <small id="price_error" class="form-text text-muted"></small>

              </div>

               <div class="form-row">
              <div class="form-group col-md-4">
                <label>Quantity</label>
                <input type="number" class="form-control form-control-sm" id="product_stock" name="product_stock" placeholder="0">
                <small id="stock_error" class="form-text text-muted"></small>

              </div>
            </div>

              
            <button type="submit" class="btn btn-success">Submit</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>