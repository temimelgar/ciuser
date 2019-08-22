<div class="modal fade" id="myModal">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Add New Account (Mobile)</strong></h4>
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Account Number</label>
                <input type="text" class="form-control" id="accountnumber"  name="accountnumber">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label >Mobile Number</label>
                <input type="text" class="form-control" id="mobilenumber"  name="mobilenumber">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label >Supplier</label>
            <select class="form-control" id="supplier" name="supplier">
                  <option value="">Please select..</option>
              <?php foreach ($providers as $provider) {
              ?>
              <option value="<?php echo $provider->supplier_id; ?>"><?php echo $provider->supplier_name; ?></option>
              <?php  } ?>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Assignee / Employee</label>
                <select class="form-control" id="assignee" name="assignee">
                  <option value="">Please select..</option>
                     <?php foreach ($employees as $employee) {
                  ?>
                  <option value="<?php echo $employee->fullname; ?>"><?php echo $employee->fullname; ?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group"  id="assigneealt">
                <label >Assignee / Section</label>
                <select class="form-control" id="assigneesection" name="assigneesection">
                  <option value="">Please select..</option>
                  <?php foreach ($sections as $section) {
                  ?>
                  <option value="<?php echo $section->section; ?>"><?php echo $section->section; ?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Type</label>
                <select class="form-control" id="type" name="type">
                  <option value="">Please select..</option>
                  <?php foreach ($types as $type) {
                  ?>
                  <option value="<?php echo $type->type_id; ?>"><?php echo $type->type_name; ?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label >Amount Limit</label>
                <input type="text" class="form-control" id="amountlimit"  name="amountlimit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Due Date</label>
                <select class="form-control" id="duedate" name="duedate">
                  <option>Please select..</option>
                  <?php for ($i="1"; $i<=31; $i++) {
                  ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label >Active From</label>
                <input type="text" class="form-control" id="activefrom"  name="activefrom" style="text-transform: uppercase;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label >Remarks</label>
            <textarea  type="date" class="form-control" id="remarks"  name="remarks"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="addNewMobile">Save New Mobile</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>