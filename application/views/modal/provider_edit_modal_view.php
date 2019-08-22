<div class="modal fade" id="updateProviderModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Provider</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Supplier Name</label>
            <input type="text" class="form-control" id="supplierNameUpdate"  >
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Active Date</label >
          <input type="date" class="form-control" id="activeFromUpdate" name="activefrom">
          </div>
          <div class="form-group" id='id_100'>

    <!--                   <input type="text" class="form-control" id="suppliercategoryUpdate" name="suppliercategoryUpdate"> -->
            <label for="exampleFormControlSelect1">Supplier Category</label>
            <select class="form-control" id="suppliercategory" name="suppliercategoryUpdate">
              <option>Please select..</option>
              <?php  
              foreach ($categories as $category) {
               ?>
               <option value="<?php echo $category->category_id; ?>" ><?php echo $category->category; ?></option>
              <?php  } ?>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="addProvider">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>      
    </div>
  </div>
</div>