<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Provider</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissible" role="alert" id="myElem" style="display: none">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Warning!</strong> All fields are required. 
        </div>
        <form method="POST">
          <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" class="form-control" id="suppliername"  name="suppliername" >
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
              <label>Active Date</label >
              <input type="text" class="form-control" id="activefrom" name="activefrom" style="text-transform: uppercase;">
              </div>              
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Supplier Category</label>
                <select class="form-control" id="suppliercategory" name="suppliercategory" >
                  <option value="">Please select..</option>
                  <?php foreach ($categories as $category) {
                   ?>
                   <option value="<?php echo $category->category_id; ?>"><?php echo $category->category; ?></option>
                  <?php  } ?>
                </select>
              </div>              
            </div>
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