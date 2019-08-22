
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
<section class="col-lg-9">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Transcations</h3>
         </div>
        <div class="box-body">

           <table class="table table-hover table-striped table-condensed " id="transactiontable">
                <thead>
                    <tr>
                        <th >Due Date</th>
                        <th>Supplier</th>
                        <th>Type</th>
                        <th>No. of Accounts</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                     foreach($data as $row) {

                        $due_date = $row->due_date;

                     ?>                    
                    <tr>
                        <td ><?php echo $due_date ; ?></td>
                        <td><?php echo $row->supplier_name; ?></td>
                        <td><?php echo $row->type_name; ?></td>
                        <td style="text-align: right"><?php echo $row->count; ?></td>
                    </tr>
                    <?php } ?>

                </tbody>
                <tfoot>
                <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
                </tr>
                </tfoot> 
           </table> 
             <a href='<?php echo base_url(); ?>billingentry/' class="btn btn-sm btn-danger">Click here for new Billing Entries</a>       
        </div>
   

</section><!-- right col -->
<section class="col-md-3">
<div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Incoming Dues <i class="fa fa-exclamation-circle"></i></h3>
         </div>
        <div class="box-body">
            <table class="table table-hover table-responsive table-condensed ">
                <tbody>
                    <tr>
                        <td><a class="btn btn-block btn-danger btn-sm" 
                        <?php if ($bilang != 0) {?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions" 
                        <?php } ?>
                        style="background-color: #840000">Today</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $bilang; ?></span></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-block btn-danger btn-sm" 
                        <?php if ($tomcount  != 0) { ?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions_tomorrow" 
                        <?php } ?>
                        style="background-color: #d21404">Tomorrow</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $tomcount; ?></span></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-block btn-danger btn-sm" 
                        <?php if($count2days != 0) { ?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions_2days"   
                        <?php } ?>
                        style="background-color: #ff0000">2 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count2days; ?></span></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-block btn-danger btn-sm" 
                        <?php if ($count3days != 0) { ?>
                        target="_blank"  href="<?php echo base_url(); ?>dashboard/transactions_3days"  
                        <?php } ?>
                        style="background-color: #ff5a00">3 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count3days; ?></span></td>
                    </tr>    
                    <tr>
                        <td><a  class="btn btn-block btn-warning btn-sm" 
                        <?php if ($count4days != 0) { ?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions_4days"  
                        <?php } ?>
                        style="background-color: #dd6813">4 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count4days; ?></span></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-block btn-warning btn-sm" 
                        <?php if ($count5days != 0) { ?>
                        target="_blank"  href="<?php echo base_url(); ?>dashboard/transactions_5days"
                        <?php } ?>
                        style="background-color: #ed9104">5 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count5days; ?></span></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-block btn-sm" 
                        <?php if ($count6days != 0) { ?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions_6days"   
                        <?php } ?>
                        style="background-color: #ffce00">6 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count6days; ?></span></td>
                    </tr>         
                    <tr>
                        <td><a class="btn btn-block btn-sm" 
                        <?php if ($count7days != 0) { ?>
                        target="_blank" href="<?php echo base_url(); ?>dashboard/transactions_7days"   
                        <?php } ?>
                        style="background-color:  #f3ff32  ">7 Days</a></td>
                        <td><span class="badge badge-info" style="background-color: #222d32"><?php echo $count7days; ?></span></td>
                    </tr>                                                                                       
                </tbody>

            </table> 
            <br>   
        </div>
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
});
</script>

