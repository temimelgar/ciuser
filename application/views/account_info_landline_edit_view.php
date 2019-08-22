<style>
select {
height: 50px;
}
</style>
<div class="container-fluid">
  <section class="col-lg-12">
    <div class="box box-info">
      <div class="box-body">
        <div class="modal-body">
          <form method="POST">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label >Account Number</label>
                  <input type="text" class="form-control" id="accountnumberupdate"  name="accountnumberupdate" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label >Phone Number</label>
                  <input type="text" class="form-control" id="phonenumberupdate"  name="phonenumberupdate">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label >Supplier</label>
                  <select class="form-control" id="supplierupdate" name="supplierupdate">
                    <option>Please select..</option>
                    <?php foreach ($providers as $provider) {
                    ?>
                    <option value="<?php echo $provider->supplier_id; ?>"><?php echo $provider->supplier_name; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label >Type</label>
                  <select class="form-control" id="typeupdate" name="typeupdate">
                    <option>Please select..</option>
                    <?php foreach ($types as $type) {
                    ?>
                    <option value="<?php echo $type->type_id; ?>"><?php echo $type->type_name; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label >Assignee / Employee </label>
                  <select class="form-control" id="assigneeupdate" name="assigneeupdate">
                    <?php foreach ($employees as $employee) {
                    ?>
                    <option value="<?php echo $employee->fullname; ?>"><?php echo $employee->fullname; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label >Assignee / Section</label>
                  <select class="form-control" id="assigneesectionupdate" name="assigneesectionupdate">
                    <?php foreach ($sections as $section) {
                    ?>
                    <option value="<?php echo $section->section; ?>"><?php echo $section->section; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>              
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label >New Number</label>
                  <input type="text" class="form-control" id="newnumberupdate"  name="newnumberupdate">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label >Trunkline</label>
                  <input type="text" class="form-control" id="trunklineupdate"  name="trunklineupdate">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label >No. of Trunkline</label>
                  <input type="text" class="form-control" id="nooftrunklineupdate"  name="nooftrunklineupdate">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label >Due Date</label>
                  <select class="form-control" id="duedateupdate" name="duedateupdate">
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
                  <input type="date" class="form-control" id="activefromupdate"  name="activefromupdate" style="text-transform: uppercase;">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label >Remarks</label>
              <textarea  type="date" class="form-control" id="remarksupdate"  name="remarksupdate"></textarea>
            </div>
            <input type="hidden" id="id" name="id" value="<?php echo $id?>">
            
            <div class="form-group">
              <label id="active">Active</label><br>
              <input class="form-control" type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" id="activecheckbox" <?php
              if($inactive == 1)
              {
              echo "checked";
              }
              ?> value="<?php $inactive; ?>">
            </div>
            <button type="button" class="btn btn-danger pull-right" id="updateAccountInfoLandLine">Save changes</button>
          </div>
          </section><!-- right col -->
        </div>


<script type="text/javascript">
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

$(document).ready(function() {

  

   $('select').selectpicker({
    liveSearch: true
   });
   // $('[name="assigneeupdate"]').select2();
    get_account_info_by_id();


    function get_account_info_by_id() {
        var id = $('#id').val();
            $.ajax({
                method: "POST",
                data: { id: id },
                async : true,
                dataType : 'json',
                url: "<?php echo base_url(); ?>accountinfolandline/get_account_info_by_id",            
                success : function(data){

                  console.log(data);
                    $.each(data, function(key, value) {
                        $('#accountnumberupdate').val(value.account_number);
                        $('#phonenumberupdate').val(value.phone_number);
                        $('#newnumberupdate').val(value.newnumber);
                        $('#activefromupdate').val(value.active_from);
                        $('#trunklineupdate').val(value.trunkline);
                        $('#nooftrunklineupdate').val(value.nooftrunkline);
                        // $('#supplierNameUpdate').val(value.supplier_name);                     
                        $('[name="assigneeupdate"]')
                        .val(value.assignee)
                        .trigger('change');
                        $('[name="assigneesectionupdate"]')
                        .val(value.assigneesection)
                        .trigger('change');                        
                        $('[name="typeupdate"]')
                        .val(value.type_id)
                        .trigger('change');
                        $('[name="duedateupdate"]')
                        .val(value.due_date)
                        .trigger('change');    
                        $('[name="supplierupdate"]')
                        .val(value.supplier_id)
                        .trigger('change');       
                    });
                }
            });
    }


    $('#updateAccountInfoLandLine').click(function() {
       var id = $('#id').val();
       var accountnumberupdate = $('#accountnumberupdate').val();
       var phonenumberupdate = $('#phonenumberupdate').val();
       var newnumberupdate = $('#newnumberupdate').val();
       var trunklineupdate = $('#trunklineupdate').val();
       var nooftrunklineupdate = $('#nooftrunklineupdate').val();
       var activefromupdate = $('#activefromupdate').val();
       var remarksupdate = $('#remarksupdate').val();
       var assigneeupdate = $('#assigneeupdate').val();
       var assigneesectionupdate = $('#assigneesectionupdate').val();
       var typeupdate = $('#typeupdate').val();
       var duedateupdate = $('#duedateupdate').val();
       var supplierupdate = $('#supplierupdate').val();
;
      var inactivedate = "";
      var fullDate = new Date();
      var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
      // var activecheckbox = $('#activecheckbox').html();
      if( $('#activecheckbox').is(':checked')) {
       var activecheckbox = 1
        var inactivedate = "";
      } else {
       var activecheckbox = 0;
       var currentDate = fullDate.getFullYear() + "/" + twoDigitMonth + "/" +  fullDate.getDate()  ;
       var inactivedate =  currentDate;
      }



      // alert(inactivedate);

            $.ajax({
                method: "POST",
                data: { 
                  id: id,
                  accountnumberupdate: accountnumberupdate,
                  phonenumberupdate: phonenumberupdate,
                  newnumberupdate: newnumberupdate,
                  trunklineupdate: trunklineupdate,
                  nooftrunklineupdate: nooftrunklineupdate,
                  activefromupdate: activefromupdate,
                  remarksupdate: remarksupdate,
                  assigneeupdate: assigneeupdate,
                  assigneesectionupdate: assigneesectionupdate,
                  typeupdate: typeupdate,
                  duedateupdate: duedateupdate,
                  supplierupdate: supplierupdate,
                  inactivedate: inactivedate,
                  activecheckbox: activecheckbox,

                },
                url: "<?php echo base_url(); ?>accountinfolandline/update_account_info",            
                success : function(data){

                  // console.log(data);
 
                  Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 2000
                  })
                   setTimeout(window.location.href = '<?php echo base_url(); ?>accountinfolandline', 2000);
             response.redirect;
                }
            });
    });



});

</script>