<div class="modal fade" id="update_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <small id="cat_report" class="form-text text-muted text-center"></small>
        <form id="update_category_form" onsubmit="return false">
          <div class="form-group">
            <label>New Category Name</label>
            <input type="hidden" name="cat_id" id="cid" value="">

            <input type="text" class="form-control form-control-sm" id="update_cat_name" name="update_cat_name" placeholder="Please Enter Category Name" value="">
            <small id="cat_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group"> 
            <label>Parent Category</label>
            <select class="form-control form-control-sm" id="parent_cat" name="parent_cat">
              
              
            </select>
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