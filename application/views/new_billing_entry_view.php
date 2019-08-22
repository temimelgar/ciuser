

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
        cursor: pointer;
    }



</style>

<div class="container-fluid">
  <form method="post" id="import_form" enctype="multipart/form-data">
<section class="col-lg-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Billing Entry Details</h3> 
         </div>
        <div class="box-body">
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Supplier <span style="color:red"><strong>*</strong></span></label>
                    <select class="form-control" id="supplier" name="supplier">
                        <option>Please select..</option>
                        <?php foreach ($data as $row) { ?>
                        <option value="<?php echo $row->supplier_id; ?>"><?php echo $row->supplier_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <small><i><a href="../excel_template/billingentry_template.xlsx">Download Template Here.</a></i></small>
                </div>            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Type <span style="color:red"><strong>*</strong></span></label>
                    <select class="form-control" id="type" name="type">
                        <option>Please select..</option>
                        
                    </select>
                </div>  
            </div>
            <div class="col-md-5">
                                    <label>Upload Excel <span style="color:red"><strong>*</strong></span></label>
            <div class="row">

                <div class="col-lg-8 " >
                    <input type="file" name="excel" id="excel" class="custom-file-input form-control" required accept=".xls, .xlsx, .csv">
    
                </div>      
                <div class="col-lg-4">
                <button class="btn btn-danger btn-sm form-control" type="submit" name="upload" id="upload">Upload</button>
                </div>  
                </form>
            </div>            
            </div>
        </div>     
            
                 
        </div>
   </div>
  
</section><!-- right col -->

     <section class='col-md-12'>
<div class='box box-danger'>
        <div class='box-header'>
            <h3 class='box-title'>Incoming Dues <i class='fa fa-exclamation-circle'></i></h3>
         </div>
        <div class='box-body'>
            <form method="post" id="my_form" enctype="multipart/form-data">
             <div class="table-responsive" id="customer_data">

  </div> </form>

                


</section>
     
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

   $('#supplier').selectpicker({
    liveSearch: true
   });



/*<!-- DATATABLE --!>*/
    var table = $('#transactiontable').DataTable({
        'searching' : true,
        "lengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal + ' &nbsp&nbsp&nbsp&nbsp;('+ total + ' total Accounts)'
            );
        }
    });
/*<!-- DATATABLE --!>*/

    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('MMMM DD, YYYY  hh:mm:ss A') + ' '
                            + momentNow.format('dddd')
                           );
        $('#time-part').html(momentNow.format(' '));
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });

              
    $(document).on('blur','.vat',function () {


        //console.clear();
        var ctr = 0;
        var total = 0;
        var totalvat = 0;
        var totalvatable = 0;
        var totalnvat = 0;
        var totalwtx = 0;
        var totalnetpay = 0; 
        var totalgross = $('#totalgross').val();
 
  
        $('.vat').each(function () {

            var val = 0;

            var vatable = 0;
            var nvat = 0;
            var wtx = 0;
            var val = $('#gross'+ctr).val().replace(/,/g, '');
            var vattemp = $('#vattemp'+ctr).val();
            var vatnew = $('#vat'+ctr).val();

            if (vatnew > vattemp) 
            {
                $('#vat'+ctr).focus();
                $('#vat'+ctr).val(vattemp);
                $('#savedata').prop('disabled', true);                                       
                Swal.fire({
                  type: 'error',
                  title: "You have entered " + vatnew + ". New VAT can't be bigger than it's previous VAT!"
                }); 

            }
            else
            {
                $('#savedata').prop('disabled', false);     
            }

            if (vatnew == "") {
                $('#vat'+ctr).focus();
                $('#vat'+ctr).val(vattemp);
            }
            var adj = $('#adj'+ctr).val();
            val = val ? val : 0;
            total += val; 
            vat = (val/1.12)*.12;

            if(vat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') != parseFloat($(this).val().replace(/,/g, '')))
            {
                vat = parseFloat($(this).val().replace(/,/g, ''));
            }

            // if (vatnew > vattemp) 
            // {
            //     $('#vat'+ctr).focus();
            //     $('#vat'+ctr).val(vattemp);
          
            // } 
            // else 
            // {
            //     $('#savedata').prop('disabled', false);   
            // }
            vatable = vat/.12;
            nvat = (val - vat) - vatable;
            // if (nvat >= 0.00) 
            // {
            //     $('#adj'+ctr).val(adj);                 
            //     $('#adj'+ctr).attr("readonly", false);
            // } 
            // else
            // {
            //     $('#adj'+ctr).val(0);
            //     $('#adj'+ctr).attr("readonly", true);
            // }



            wtx = (vatable + nvat) * 0.02;
            netpay = val - wtx;
         
            totalvat += parseFloat(this.value);
            totalvatable = totalvat/.12;

            $('#vatable'+ctr).val(vatable.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#vatables'+ctr).val(vatable.toFixed(2)); 
            $('#nvat'+ctr).val(nvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#nvats'+ctr).val(nvat.toFixed(2)); 
            $('#wtxs'+ctr).val(wtx.toFixed(2)); 
            $('#wtx'+ctr).val(wtx.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#netpays'+ctr).val(netpay.toFixed(2)); 
            $('#netpay'+ctr).val(netpay.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 

            $('#totalvatdisplay').val(totalvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#totalvat').val(totalvat.toFixed(2)); 
            $('#totalvatable').val(totalvatable.toFixed(2)); 
            $('#totalvatabledisplay').val(totalvatable.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            // $('#totalnvat').val(totalnvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            ctr++;

        });

            $('.nvat').each(function () {

            totalnvat += parseFloat($(this).val().replace(/,/g, ''));
                $('#totalnvat').val(totalnvat.toFixed(2)); 
                $('#totalnvatdisplay').val(totalnvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 

            ctr++;
            });

                $('.wtx').each(function () {
           
            totalwtx += parseFloat($(this).val().replace(/,/g, ''));

            $('#totalwtx').val(totalwtx.toFixed(2)); 
            $('#totalwtxdisplay').val(totalwtx.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 

            ctr++;
        });
                $('.netpay').each(function () {
           
            totalnetpay += parseFloat($(this).val().replace(/,/g, ''));

            $('#totalnetpay').val(totalnetpay.toFixed(2)); 
            $('#totalnetpaydisplay').val(totalnetpay.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 

            ctr++;
        }); 


    });

    $(document).on('blur','.nvat',function () {

        var ctr = 0;
            var nvatnew = $('#nvat'+ctr).val();

            if (nvatnew <= 0) {
                $('#adj'+ctr).val(0);
                $('#adj'+ctr).attr("readonly", true);
            }
    });

    $(document).on('blur','.adj',function () {
    // //console.clear();
        var ctr = 0;
        var total = 0;
        var totalvat = 0;
        var totalvatable = 0;
        var totalnvat = 0;
        var totalwtx = 0;
        var totalnetpay = 0; 
        var totalgross = $('#totalgross').val();      
        var totaladj = 0;

        $('.adj').each(function ()
        {

            totaladj += parseFloat(this.value);

            var nvatplus = $('#nvats'+ctr).val();
            var nvat = $('#nvat'+ctr).val();

            var adj = $('#adj'+ctr).val();
            var adjs = $('#adjs'+ctr).val();

            var nevat = nvatplus - adj;

            if (nevat < 0) {
                $('#adj'+ctr).val(adjs); 
                $('#adj'+ctr).focus();
                totaladj += parseFloat(this.value);
            }
    // totalnvat = (totalgross - totalvat) - totalvatable;

    $('#totaladj').val(totaladj.toFixed(2)); 
    $('#totaladjdisplay').val(totaladj.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
    // $('#totalnvat').val(totalnvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
    $('#nvat'+ctr).val(nevat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
    // $('#nvats'+ctr).val(nevat.toFixed(2)); 
    ctr++;
    });


    $('.nvat').each(function () {

    totalnvat += parseFloat($(this).val().replace(/,/g, ''));


    $('#totalnvat').val(totalnvat.toFixed(2)); 
    $('#totalnvatdisplay').val(totalnvat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
    // $('#nvat'+ctr).val(nevat.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
    ctr++;
    });        

    });

    $(document).on('blur','.wtx',function () {
        //console.clear();
        
        var ctr = 0;
        var totalwtx = 0;


        $('.wtx').each(function () {

     var gross = $('#gross'+ctr).val();
     var wtxs = $('#wtxs'+ctr).val(); 

     var wtxtemp = $('#wtx'+ctr).val(); 
    if(wtxtemp > wtxs) {
                 $('#wtx'+ctr).focus();
        $('#wtx'+ctr).val(wtxs); 

        
    }
     // alert (grosss + ' ' + wtxs);
       netpay = gross - wtxs;

       // if (netpay > wtxtemp){
       // netpay = wtxtemp;
       // }
            totalwtx += parseFloat(this.value);
            $('#totalwtx').val(totalwtx.toFixed(2)); 
            $('#totalwtxdisplay').val(totalwtx.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#netpays'+ctr).val(netpay.toFixed(2)); 
            $('#netpay'+ctr).val(netpay.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#totalnetpay'+ctr).val(netpay.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 
            $('#totalnetpaydisplay'+ctr).val(netpay.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')); 


            ctr++;
        });

    });




    $('#supplier').change(function() {
        var id = $('select[name="supplier"]').val();
        // alert(supplier);
        $.ajax({
            method: "post",
            url: "<?php echo site_url('billingentry/get_type_by_supplierid'); ?>",
            data: { id : id },
            async: true,
            dataType: 'json',
            success: function(data) {
                        $('select[name="type"]').empty();

                        $.each(data, function(key, value) {

                                $('select[name="type"]').append('<option value="'+ value.type_id +'">'+ value.type_name +'</option>');

                        });

                    }                
            
        });
    });


     $('#import_form').on('submit', function(event)
     {
        event.preventDefault();
        var supplier = $('#supplier').val();
        var type = $('#type').val();
        var excel = $('#excel').val();

        $.ajax({
            url:"<?php echo base_url(); ?>billingentry/import",
            method:"POST",
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
            $('#customer_data').html(data);
                  
       }
      })
     });

 $('#my_form').on('submit', function(event){
  event.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>billingentry/batchInsert',
                type: 'POST',
                data: $("#my_form").serialize()
            }).always(function (response){

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(window.location.href = '<?php echo base_url(); ?>billingEntry/viewbillingentries', 1500);
                        response.redirect;

            });
        });



    function load_data()
    {
        $.ajax({
            url: "<?php echo base_url(); ?>billingentry/fetch",
            method: "POST",
            success: function(data) {

                $('#customer_data').html(data);

            }
        })
    }

    });

// function msg()
// {

//             $.ajax({
//                 url: '<?php echo base_url() ?>billingentry/batchInsert',
//                 type: 'POST',
//                 data: $("#import_form").serialize()
//             }).always(function (response){
       
//                 console.log(response);
//             });

// }

</script>

