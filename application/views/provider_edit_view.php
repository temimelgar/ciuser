


<div class="container-fluid">
<section class="col-lg-6">

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Update Provider</h3>
         </div>
        <div class="box-body">

      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Supplier Name</label>
            <input type="text" class="form-control" id="supplierNameUpdate"  >
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Active Date</label >
          <input type="text" class="form-control" id="activeFromUpdate" name="activefrom">
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
          <div class="form-group">
          <label for="exampleInputPassword1" id="active">Active</label><br>
           <input class="form-control" type="checkbox"  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" id="activecheckbox" <?php 
                        if($isactive == 1) 
                            {
                             echo "checked"; 
                            } 
                        ?> value="<?php $isactive; ?>">
          <input type="hidden" id="id" name="id" value="<?php echo $id?>">
    
      </div>
      <button type="button" class="btn btn-danger pull-right" id="updateProvider">Save changes</button>
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

    $('#activeFromUpdate').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
      format: 'MM/DD/YYYY'
    }
  });


    get_provider_by_id();


    function get_provider_by_id() {
        var id = $('#id').val();
            $.ajax({
                method: "POST",
                data: { id: id },
                async : true,
                dataType : 'json',
                url: "<?php echo base_url(); ?>provider/get_provider_by_id",            
                success : function(data){

                  console.log(data);
                    $.each(data, function(key, value) {
                      // var = value.active_from.replace(/(\d{4})\/(\d\d)\/(\d\d)/, "$2-$3-$1")
                        var x =  value.active_from;
                        var arr = x.split('-');

                        $('#activeFromUpdate').val(arr[1]+"-"+arr[2]+"-"+arr[0]);
                        $('#supplierNameUpdate').val(value.supplier_name);
                        $('[name="suppliercategoryUpdate"]')
                        .val(value.supplier_category)
                        .trigger('change');
                    });
                }
            });
    }


    $('#updateProvider').click(function() {
       var id = $('#id').val();

      var input = $('#activeFromUpdate').val();
              var activeFromUpdate = input.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
      var supplierNameUpdate = $('#supplierNameUpdate').val();
      var suppliercategory = $('#suppliercategory').val();
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


            $.ajax({
                method: "POST",
                data: { 
                  id: id,
                  activecheckbox: activecheckbox,
                  activeFromUpdate: activeFromUpdate,
                  supplierNameUpdate: supplierNameUpdate,
                  suppliercategory: suppliercategory,
                  inactivedate: inactivedate
                },
                url: "<?php echo base_url(); ?>provider/update_provider",            
                success : function(data){

                  // console.log(data);
 
                  Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 2000
                  })
                   setTimeout(window.location.href = '<?php echo base_url(); ?>provider', 2000);
             response.redirect;
                    // $.each(data, function(key, value) {
                    //     $('#activeFromUpdate').val(value.active_from);
                    //     $('#supplierNameUpdate').val(value.supplier_name);
                    //     $('[name="suppliercategoryUpdate"]')
                    //     .val(value.supplier_category)
                    //     .trigger('change');
                    // });
                }
            });
     

    });


});

</script>