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
<table class="table " id="providerTable" style='white-space: nowrap'>
                <thead class="">
                    <tr>
                        <th>ID.</th>
                        <th>Account No.</th>
                        <th>Assignee</th>
                        <th>Section</th>
                        <th>Supplier Name</th>
                        <th>Type</th>
                        <th>Payment Date</th>
                        <th>SOA Number</th>
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
                        $assignee = $row->assignee;
                        $assigneesection = $row->assigneesection;
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
                        <td><?php echo $id ; ?></td>
                        <td><?php echo $account_number ; ?></td>
                        <td><?php echo $assignee ; ?></td>
                        <td><?php echo $assigneesection ; ?></td>
                        <td ><?php echo $supplier_name ; ?></td>
                        <td ><?php echo $type_name ; ?></td>
                        <td ><?php echo mydateFormat($payment_date); ?></td>
                        <td ><?php echo $soa; ?></td>
                        <td ><?php echo $due_date ; ?></td>
                        <td ><?php echo mydateFormat($billing_from) ; ?></td>
                        <td ><?php echo mydateFormat($billing_to) ; ?></td>
                        <td ><?php echo number_format((float)$gross, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$vat, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$vatable, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$nvat, 2, '.', ',');  ?></td>
                        <td ><?php if ($nvat > 0) { ?>   
                            <a href="" 
                            data-billing_entry_no="<?php echo $billing_entry_no; ?>" 
                            data-id="<?php echo $id; ?>"
                            data-gross="<?php echo $gross; ?>" 
                            data-vat="<?php echo $vat; ?>" 
                            data-vatable="<?php echo $vatable; ?>" 
                            data-nvat="<?php echo $nvat; ?>"                             
                            data-wtx="<?php echo $wtx; ?>"                             
                            data-netpay="<?php echo $netpay; ?>"    
                            data-adj="<?php echo $adj; ?>" 

                            
                            data-toggle="modal" data-target="#updateAdj"  class="btn btn-sm updateAdj" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Update"></i></a><?php } ?> <?php echo number_format((float)$adj, 2, '.', ',');  ?></td>
                        <td ><a href="" 
                            data-billing_entry_no="<?php echo $billing_entry_no; ?>" 
                            data-id="<?php echo $id; ?>"
                            data-gross="<?php echo $gross; ?>" 
                            data-vat="<?php echo $vat; ?>" 
                            data-vatable="<?php echo $vatable; ?>" 
                            data-nvat="<?php echo $nvat; ?>"                             
                            data-wtx="<?php echo $wtx; ?>"     
                            data-adj="<?php echo $adj; ?>"                          
                            data-netpay="<?php echo $netpay; ?>"                     
                            data-toggle="modal" data-target="#updateAdj" class="btn btn-sm updateWtx"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Update"></i></a> <?php echo number_format((float)$wtx, 2, '.', ',');  ?></td>
                        <td ><?php echo number_format((float)$netpay, 2, '.', ',');  ?></td>
                        <td ><?php echo $amount_limit ; ?></td>
                        <td ><?php echo $last_user ; ?></td>
                        <td ><?php echo myDateTime($last_update) ; ?></td>
                        
                    </tr>
                    <?php } ?>

                </tbody>
               
           </table> <br>
          <a href="<?php echo site_url('billingentry/exportbillingentrybydetails/'.$row->billing_entry_no);?>" class="btn btn-sm btn-danger">Export to Excel</a>
        </div>
    
 

<?php include ('modal/update_adjustment_modal_view.php');?>
<?php include ('modal/update_wtx_modal_view.php');?>
 
  
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


    $('body').on('click', '.updateAdj', function() {
        var id = $(this).data("id");
        var gross = $(this).data("gross");
        var vat = $(this).data("vat");
        var vatable = $(this).data("vatable");
        var nvat = $(this).data("nvat");        
        var wtx = $(this).data("wtx");        
        var netpay = $(this).data("netpay");        
        var billing_entry_no = $(this).data("billing_entry_no");
        var adjustment = $(this).data("adj");

        $('#wtxForm').hide();
        $('#adjForm').show();
        $('#saveAdj').show();
        $('#saveWtx').hide();


        $("#newid").val(id);
        $("#newgross").val(gross);
        $("#newvat").val(vat);
        $("#newvatable").val(vatable);
        $("#newnvat").val(nvat);                
        $("#newwtx").val(wtx);
        $("#newnetpay").val(netpay);
        $("#newadjustment").val(adjustment);
        // alert (id + ' ' + nvat);

        // var newadj = $('#newAdj').val();
        // console.log(newadj);
    });

 $('#saveAdj').click(function() {
        var newid = $('#newid').val()
        var newnvat = $('#newnvat').val()
        var newgross = $('#newgross').val()
        var newvat = $('#newvat').val()
        var newvatable = $('#newvatable').val()
        var newwtx = $('#newwtx').val()
        var newnetpay = $('#newnetpay').val()
        var newbilling_entry_no = $('.updateAdj').data("billing_entry_no"); 
        var newadj = $('#newAdj').val(); 
        var newadjustment = $('#newadjustment').val(); 

var nvat = newgross - newvat - newvatable - newadj;

        // alert (newnvat + ' ' + newadj) 


        if (nvat < 0) {
            Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href>Why do I have this issue?</a>'
})
        } else {

        $.ajax({
            method: "post",
            data: {
                newid: newid,
                newadj: newadj,
                nvat: nvat,
                newvatable: newvatable,
                newgross: newgross,
                newbilling_entry_no: newbilling_entry_no
            },
            url: "<?php echo site_url('billingentry/update_adustment'); ?>",
            success: function(response) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                         setTimeout(window.location.href = '<?php echo base_url(); ?>billingentry/getpaidbybillingentryno/'+newbilling_entry_no, 3000);
                        response.redirect;
            }
        });    
             }
 
    });



    $('body').on('click', '.updateWtx', function() {
        var id = $(this).data("id");
        var gross = $(this).data("gross");
        var vat = $(this).data("vat");
        var vatable = $(this).data("vatable");
        var nvat = $(this).data("nvat");        
        var wtx = $(this).data("wtx");        
        var netpay = $(this).data("netpay");        
        var billing_entry_no = $(this).data("billing_entry_no");
        var adjustment = $(this).data("adj");

        $('#wtxForm').show();
        $('#adjForm').hide();     
        $('#saveAdj').hide();
        $('#saveWtx').show();


        $("#newid").val(id);
        $("#newgross").val(gross);
        $("#newvat").val(vat);
        $("#newvatable").val(vatable);
        $("#newnvat").val(nvat);                
        $("#newwtx").val(wtx);
        $("#newnetpay").val(netpay);
        $("#newadjustment").val(adjustment);
        // alert (id + ' ' + nvat);


        // var newadj = $('#newAdj').val();
        // console.log(newadj);
    });

 $('#saveWtx').click(function() {
        var newid = $('#newid').val()
        var newnvat = $('#newnvat').val()
        var newgross = $('#newgross').val()
        var newvat = $('#newvat').val()
        var newvatable = $('#newvatable').val()
        var newwtx = $('#newwtx').val()
        var newnetpay = $('#newnetpay').val()
        var newbilling_entry_no = $('.updateWtx').data("billing_entry_no"); 
        var newadj = $('#newAdj').val(); 
        var newadjustment = $('#newadjustment').val(); 
        var newwitholdingtax = $('#newwitholdingtax').val(); 





        var wwtx = parseFloat(newvatable) +  parseFloat(newnvat);
        var wtx = parseFloat(wwtx) * 0.02;

        // alert (wwtx);
        // alert (wtx);

        if (newwitholdingtax > wtx) {
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',

        })
        } else {

        var netpay = newgross - newwitholdingtax;

        // alert (netpay);http://localhost/ipc_central/ciuser/billingentry/exportbillingentrybydetails/1
        $.ajax({
            method: "post",
            data: {
                newid: newid,
                netpay: netpay,
                newwitholdingtax: newwitholdingtax,
                newbilling_entry_no: newbilling_entry_no                
            },
            url: "<?php echo site_url('billingentry/update_wtx'); ?>",
            success: function(response) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                         setTimeout(window.location.href = '<?php echo base_url(); ?>billingentry/getpaidbybillingentryno/'+newbilling_entry_no, 1500);
                        response.redirect;
            }
        });    
             }
 
    });

}); 
</script>