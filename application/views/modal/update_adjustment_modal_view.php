  <div class="modal fade" id="updateAdj" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Adjustment</h4>
        </div>
        <div class="modal-body">


<form method="post">
      <input type="hidden" name="newgross" id="newgross" class="form-control">
      <input type="hidden" name="newvat" id="newvat" class="form-control">
      <input type="hidden" name="newvatable" id="newvatable" class="form-control">
      <input type="hidden" name="newnvat" id="newnvat" class="form-control">      
      <input type="hidden" name="newwtx" id="newwtx" class="form-control">
      <input type="hidden" name="newnetpay" id="newnetpay" class="form-control">
      <input type="hidden" name="newid" id="newid" class="form-control">
      <input type="hidden" name="newadjustment" id="newadjustment" class="form-control">
    <div class="form-group" id="adjForm">
      <label for="comment">New Adjustment:</label>

      <input type="text" name="newAdj" id="newAdj" class="form-control">



    </div>
    <div class="form-group" id="wtxForm">
      <label for="comment">New Withholding Tax:</label>

      <input type="text" name="newwitholdingtax" id="newwitholdingtax" class="form-control">



    </div>    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger "name="saveAdj" id="saveAdj">Update Adj</button>
          <button type="button" class="btn btn-danger "name="saveWtx" id="saveWtx">Update Wtx</button>
</form>          
        </div>
      </div>  
