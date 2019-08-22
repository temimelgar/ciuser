
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
  <form method="post" id="my_form" enctype="multipart/form-data">
<section class="col-lg-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Billing Entry Details</h3>
         </div>
        <div class="box-body">
<!--             <div class="row">
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
                    <input type="file" name="excel" id="excel" class="custom-file-input form-control" required>
    
                </div>      
                <div class="col-lg-4">
                <button class="btn btn-danger btn-sm form-control" type="submit" name="upload" id="upload">Upload</button>
                </form>
                </div>  
            </div>            
            </div> -->
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
             <?php echo $supplier; ?>

  </div> 
  <?php   
    // if (isset($_POST['upload'])) 
    // { 

    //     $path = $_FILES['excel']['tmp_name'];
    //     $filename = $_FILES['excel']['name'];
    //     $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));


    //     if($imageFileType != "csv" && $imageFileType != "xls" && $imageFileType != "xlsx") 
    //     {
    //     $alert = "<br><div class='alert alert-danger' role='alert' style='margin-top: 20px; margin-left: 10px'>Sorry, only XLS, XLSX and CSV Files are allowed.</div><br>";
    //     } else 
    //     {
    //         $excel = PHPExcel_IOFactory::load($path);
    //         $excel -> setActiveSheetIndex(0);

    //         echo "<div class='box-body'>
    //         <div  id=''>
    //         <table class='table table-striped table-bordered' id='tblmonthlydues'>
    //         <thead> 
    //         <tr>
    //         <th>Account Number</th>
    //         <th>Assignee</th>
    //         <th>Phone Number</th>
    //         <th>Account Limit</th>
    //         <th>Supplier ID</th>
    //         </tr>
    //         </thead>            
    //         <tbody>    
                        
    //         ";

    //         $i = 2;
    //         $count = 1;
    //         $ctr = 0;
    //         $total = 0;

    //         while ($excel -> getActiveSheet()->getCell('A'.$i)->getValue() != "") {
    //             $account_number = $excel->getActiveSheet()->getCell('A'.$i)->getValue();
    //             $assignee = $excel->getActiveSheet()->getCell('B'.$i)->getValue();
    //             $phone_number = $excel->getActiveSheet()->getCell('C'.$i)->getValue();
    //             $account_limit = $excel->getActiveSheet()->getCell('D'.$i)->getValue();
    //             $account_id = $excel->getActiveSheet()->getCell('E'.$i)->getValue();


    //         echo " 
    //         <tr>          
    //             <td >'.$account_number.</td>
    //             <td >'.$assignee.'</td>
    //             <td >'.$phone_number.'</td>
    //             <td >'.$account_limit.'</td>
    //             <td >'.$account_id.'</td>
     
    //             ';

    //             $i++;
    //     $count++;
    //     $ctr++;
    //         }

    //         echo "</tr>
    //         </tbody>
    //         </table>
    //         </div>
    //         </div>


    //         ";
    // }       
    
    // }   
?> 

                


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

    // load_data();

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


    // $('#supplier').change(function() {
    //     var id = $('select[name="supplier"]').val();
    //     // alert(supplier);
    //     $.ajax({
    //         method: "post",
    //         url: "<?php echo site_url('billingentry/get_type_by_supplierid'); ?>",
    //         data: { id : id },
    //         async: true,
    //         dataType: 'json',
    //         success: function(data) {
    //                     $('select[name="type"]').empty();

    //                     $.each(data, function(key, value) {

    //                             $('select[name="type"]').append('<option value="'+ value.type_id +'">'+ value.type_name +'</option>');

    //                     });

    //                 }                
            
    //     });
    // });


 // $('#import_form').on('submit', function(event){
 //  event.preventDefault();
 //  var supplier = $('#supplier').val();
 //  var type = $('#type').val();
 //  var excel = $('#excel').val();
 //  $.ajax({
 //   url:"<?php echo base_url(); ?>billingentry/import",
 //   method:"POST",
 //   data: new FormData(this),
 //   contentType:false,
 //   cache:false,
 //   processData:false,
 //   success:function(data){
 //    // $('#excel').val('');
 //    // load_data();
 //    // alert(data);
 //    $('#customer_data').html(data);
 //   }
 //  })
 // });


 // $('#my_form').on('submit', function(event){
 //  event.preventDefault();
 //   var supplier = $('#supplier').val();
 //   alert(supplier);
 // });

 //    function load_data()
 //    {
 //        $.ajax({
 //            url: "<?php echo base_url(); ?>billingentry/fetch",
 //            method: "POST",
 //            success: function(data) {
 //                $('#customer_data').html(data);
 //            }
 //        })
 //    }

 //    });


</script>

