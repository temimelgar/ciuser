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
</div>
 -->    <div class="box box-info">
        <div class="box-header">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="box-title">Transcations</h3>                    
                </div>
            </div>


         </div>
         
        <div class="box-body">
<form action="<?php echo site_url('provider/update_product');?>" method="post">
<table class="table " id="providerTable" style='white-space: nowrap'>
                <thead class="">
                    <tr>
                        <th>Action</th>
                        <th>Account No.</th>
                        <th>Assignee</th>
                        <th>Supplier Name</th>
                        <th>Type</th>
                        <th>Payment Date</th>
                        <th>SOA Number</th>
                        <th>Checked Reference</th>
                        <th>OR Number</th>
                        <th>OR Date</th>
                        <th>Due Date</th>
                        <th>Billing From</th>
                        <th>Billing To</th>
                        <th>Gross</th>
                        <th>VAT</th>
                        <th>Vatable</th>
                        <th>NVAT</th>
                        <th>Adj</th>
                        <th>Withholding Tax</th>
                        <th>Net Pay</th>
                        <th>Amount Limit</th>
                        <th>Last User</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                 <tbody>
                     <?php
                     foreach($data as $row) {
                        $id = $row->id;
                        $billing_entry_no = $row->billing_entry_no;
                        $supplier_name = $row->supplier_name;
                        $type_name = $row->type_name;
                        $payment_date = $row->payment_date;
                        $gross = $row->gross;
                        $vat = $row->vat;
                        $vatable = $row->vatable;
                        $nvat = $row->nvat;
                        $adj = $row->adj;
                        $wtx = $row->wtx;
                        $netpay = $row->net_pay;
                        $last_user = $row->last_user;
                        $last_update = $row->last_update;
                        $account_number = $row->account_number;
                        $assignee = $row->fullname;
                        $due_date = $row->due_date;
                        $billing_from = $row->billing_from;
                        $billing_to = $row->billing_to;
                        $checked_reference = $row->checked_reference;
                        $or_number = $row->or_number;
                        $or_date = $row->or_date;
                        $soa = $row->soa;
                        $amount_limit = $row->amount_limit;


                     ?>                    
                    <tr>
         <!--                <td><?php echo $billing_entry_no ; ?></td> -->
                        <td data-billing_entry_no="<?php echo $id; ?>"><a href="<?php echo site_url('billingentry/updatepaidbyid/'.$row->id);?>"  class="btn btn-sm btn-danger" ><i class="fa fa-folder-open" data-toggle="tooltip" data-placement="top" title="Show Details"></i></a></td>
                        <td><?php echo $account_number ; ?></td>
                        <td><?php echo $assignee ; ?></td>
                        <td ><?php echo $supplier_name ; ?></td>
                        <td ><?php echo $type_name ; ?></td>
                        <td ><?php echo mydateFormat($payment_date); ?></td>
                        <td ><?php echo $soa; ?></td>
                        <td ><?php echo $checked_reference ; ?></td>
                        <td ><?php echo $or_number ; ?></td>
                        <td ><?php echo $or_date ; ?></td>
                        <td ><?php echo $due_date ; ?></td>
                        <td ><?php echo $billing_from ; ?></td>
                        <td ><?php echo $billing_to ; ?></td>
                        <td ><?php echo number_format((float)$gross, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$vat, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$vatable, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$nvat, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$adj, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$wtx, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$netpay, 2, '.', ',');  ?></td>
                        <td ><?php echo $amount_limit ; ?></td>
                        <td ><?php echo $last_user ; ?></td>
                        <td ><?php echo $last_update ; ?></td>
                        
                    </tr>
                    <?php } ?>

                </tbody>
               
           </table> <br>
          <a href="<?php echo site_url('billingentry/exportbillingentrybydetails/'.$row->billing_entry_no);?>" class="btn btn-sm btn-danger">Export to Excel</a>
        </div>
    
 


 
  
</section>
  </div><!-- right col -->



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


    /*<!-- DATATABLE --!>*/
    var table = $('#providerTable').DataTable({
        'searching': true,
        'scrollX': true,
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
        var activefrom = $('#activefrom').val();
        var suppliercategory = $('#suppliercategory').val();
        // alert(suppliername + ' ' + activefrom + ' ' + suppliercategory);

        if (suppliername == "" || activefrom == "" || suppliercategory == "") {
            $("#myElem").show().delay(2000).fadeOut();

        } else {

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