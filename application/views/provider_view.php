<style>
    .div1 {
        width: 100px;
        height: 100px;
        padding: 10px;
    }

    #divv {
        width: 400px;
        height: 400px;
        padding: 10px;
        border: 1px solid #aaaaaa;
    }

        table {
        font-size: 12px;
    }

</style>

<div class="container-fluid">
<section class="col-lg-12">
<!-- <div class="alert alert-success" id="success-alert">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Success! </strong> Updates successfully saved.
</div> -->
    <div class="box box-info">
        <div class="box-header">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title">Transcations</h3>                    
                </div>
                <div class="col-md-2">
                    <a type="button" href="<?php echo site_url();?>provider/exportprovider" class="btn btn-danger btn-block btn-sm" >Export to Excel</a> 
                </div>                
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#myModal">Add Provider</button> 
                </div>
            </div>


         </div>
         
        <div class="box-body">
<form action="<?php echo site_url('provider/update_product');?>" method="post">
<table class="table " id="providerTable">
                <thead class="">
                    <tr>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Category</th>
                        <th>Active From</th>
                        <th>Inactive Date</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {
                        $supplier_category = $row->supplier_category;
                        $isactive = $row->isactive;

                        if ($supplier_category == 1) {
                            $Category = "Communications";
                        } else {
                             $Category = "Courier";
                        }

                        $indate = $row->inactive_date;

                        if(($indate == "") || ($indate == '0000-00-00')) {
                            $indate = "";
                        } 
                    ?>


                    <tr>
                        <td><?php echo $row->supplier_id; ?></td>
                        <td><?php echo $row->supplier_name; ?></td>
                        <td><?php echo $Category; ?></td>
                        <td><?php echo mydateFormat($row->active_from); ?></td>
                        <td><?php echo $indate; ?></td>
                        <td><?php echo ($row->isactive == 1 ? 'Active' : 'Inactive'); ?></td>
                        <td class = "updateProvider"
                            data-id="<?php echo $row->supplier_id; ?>"
                            data-suppliername = "<?php echo $row->supplier_name; ?>"
                            data-suppliercategory = "<?php echo $supplier_category; ?>"
                            data-activefrom = "<?php echo $row->active_from; ?>"
                            data-inactivedate = "<?php echo $row->inactive_date; ?>"
                        ><a href="<?php echo site_url('provider/get_edit/'.$row->supplier_id);?>"  class="btn btn-danger btn-sm" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a></td>
                    </tr>
                     <?php } ?>
                </tbody>
               
           </table> <br>
  
        </div>
    
 


 
  
</section><!-- right col -->


</div>

<?php include ('modal/provider_modal_view.php');?>
<?php include ('modal/provider_edit_modal_view.php');?>

<script type = "text/javascript" >
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


  $('#activefrom').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  });

    /*<!-- DATATABLE --!>*/
    var table = $('#providerTable').DataTable({
        'searching': true,
        "lengthMenu": [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "All"]
        ]
    });
    /*<!-- DATATABLE --!>*/


    /*LIVE TIME CLOCK*/
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('MMMM DD, YYYY  hh:mm:ss A') + ' ' + momentNow.format('dddd'));
        $('#time-part').html(momentNow.format(' '));
    }, 100);

    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });
    /*LIVE TIME CLOCK*/

    /*ADD PROVIDER */
    $('#addProvider').click(function() {

        var suppliername = $('#suppliername').val();
        var input = $('#activefrom').val();

        // var input = "03/07/2016";
        var activefrom = input.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
        var suppliercategory = $('#suppliercategory').val();
        // alert(suppliername + ' ' + activefrom + ' ' + suppliercategory);

        if (suppliername == "" || activefrom == "" || suppliercategory == "") {
            $("#myElem").show().delay(2000).fadeOut();

        } else {
// alert (activefrom);
            $.ajax({
                method: "POST",
                data: {
                    suppliername: suppliername,
                    activefrom: activefrom,
                    suppliercategory: suppliercategory
                },
                url: '<?php echo base_url(); ?>provider/validate_provider',
                success: function(response) {
                    if (response != 'false') {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(window.location.href = '<?php echo base_url(); ?>provider', 1500);
                        response.redirect;
                    } else {

                        $("#myElem").show().delay(2000).fadeOut().text(suppliername + ' ' + "is already taken.");
                    }
                }
            });
        }
    });
    /*ADD PROVIDER */


    $('body').on('click', '.updateProvider', function() {
        var id = $(this).data("id");
        var suppliername = $(this).data("suppliername");
        var suppliercategory = $(this).data("suppliercategory");
        var activefrom = $(this).data("activefrom");
        var inactivedate = $(this).data("inactivedate");

        $.ajax({
            method: "POST",
            data: {
                id,
                id
            },
            url: "<?php echo base_url(); ?>provider/get_provider_by_id",
            async: true,
            dataType: 'json',


            success: function(data) {
                $.each(data, function(key, value) {
                    $('#activeFromUpdate').val(value.active_from);
                    $('#supplierNameUpdate').val(value.supplier_name);
                    $('[name="suppliercategoryUpdate"]').val(value.supplier_category).trigger('change');
                });

            }
        });
    });
}); 
</script>