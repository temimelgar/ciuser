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
        <div class="box-body">
<form action="<?php echo site_url('provider/update_product');?>" method="post">
<table class="table table-hover table-striped table-condensed nowrap table-responsive" id="accountInfoTable">
                <thead class="thead-dark">
                    <tr>
                    
                        <th>Account No.</th>
                        <th>Supplier Name</th>
                        <th>Type</th>
                        <th>Phone No.</th>
                        <th>Assignee</th>
                        <th>Due</th>
                        <th>New Number</th>
                        <th>Trunkline</th>
                        <th>No. of Trunkline</th>
                        <th>Remarks</th>
                        <th>Active From</th>
                        <th>Inactive Date</th>
                        <th>Status</th>



                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {

                    $due_date = $row->due_date;
                    $due_datefix = substr($due_date, -1);

                    if($due_datefix == 1) {
                        $due_datefix = 'st';
                    } elseif ($due_datefix == 2) {
                        $due_datefix = 'nd';
                    } elseif ($due_datefix == 3) {
                        $due_datefix = 'rd';
                    } else {
                        $due_datefix = 'th';
                    }

                    $indate = $row->inactive_date;

                        if(($indate == "") || ($indate == '0000-00-00')) {
                            $indate = "";
                        } 

                 
                     
                    ?>
                    <tr>
                     
                    
                        <td><?php echo $row->account_number; ?></td>
                      <td><?php echo $row->supplier_name; ?></td>
                      <td><?php echo $row->type_name; ?></td>
                      <td><?php echo $row->phone_number; ?></td>
                      <td><?php echo $row->assignee; ?></td>
                      <td><?php echo $due_date.''.$due_datefix ; ?></td>
                      <td><?php echo $row->newnumber; ?></td>                      
                      <td><?php echo $row->trunkline; ?></td>                       
                      <td><?php echo $row->nooftrunkline; ?></td>                       
                      <td><?php echo $row->remarks; ?></td>
                      <td><?php echo $row->active_from; ?></td>
                      <td><?php echo $indate; ?></td>
                      <td><?php echo ($row->inactive == "0" ? 'Inactive' : 'Active'); ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
               
           </table> <br>

        </div>
    
 


 
  
</section><!-- right col -->


</div>

<?php include ('modal/account_info_landline_modal_view.php');?>



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
    var table = $('#accountInfoTable').DataTable({
        'searching' : true,
        'scrollX' : true,
        "lengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]]
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


});
</script>

