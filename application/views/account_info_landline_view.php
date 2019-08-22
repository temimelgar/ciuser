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
                        <th>Action</th>                        
                        <th>Account No.</th>
                        <th>Supplier Name</th>
                        <th>Type</th>
                        <th>Phone No.</th>
                        <th>Assignee</th>
                        <th>Section</th>
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
                            $due_datefix = '<sup>st</sup>';
                        } elseif ($due_datefix == 2) {
                            $due_datefix = '<sup>nd</sup>';
                        } elseif ($due_datefix == 3) {
                            $due_datefix = '<sup>rd</sup>';
                        } else {
                            $due_datefix = '<sup>th</sup>';
                        }



                        if ($due_date == 13) {
                            $due_datefix = '<sup>th</sup>';
                        } else if ($due_date == '') {
                             $due_datefix = "";
                        }

                    $indate = $row->inactive_date;

                        if(($indate == "") || ($indate == '0000-00-00')) {
                            $indate = "";
                        }   

                        $active_from = $row->active_from;
                        if (($active_from == NULL) || ($active_from == '01/01/1970') || ($active_from == '1970/01/01') || ($active_from == ''))
                        { 
                            $active_from == "";
                        }
                        else {
                            $active_from = mydateFormat($active_from);
                        }

                 
                     
                    ?>
                    <tr>
                     
                        <td class = "updateProvider"
                            data-id= '<?php echo $row->id;?>'
                        ><a href="<?php echo site_url('accountinfolandline/get_edit/'.$row->id);?>"  class="btn btn-sm btn-danger" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a></td>                        
                        <td><?php echo $row->account_number; ?></td>
                      <td><?php echo $row->supplier_name; ?></td>
                      <td><?php echo $row->type_name; ?></td>
                      <td><?php echo $row->phone_number; ?></td>
                      <td><?php echo $row->assignee; ?></td>
                      <td><?php echo $row->assigneesection; ?></td>
                      <td><?php echo $due_date.' '.$due_datefix ; ?></td>
                      <td><?php echo $row->newnumber; ?></td>                      
                      <td><?php echo $row->trunkline; ?></td>                       
                      <td><?php echo $row->nooftrunkline; ?></td>                       
                      <td><?php echo $row->remarks; ?></td>
                      <td><?php echo $active_from; ?></td>
                      <td><?php echo $indate; ?></td>
                      <td><?php echo ($row->inactive == "0" ? 'Inactive' : 'Active'); ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
               
           </table> <br>
        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">
  Add New Landline
</button>   
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

    $('select').selectpicker({
          liveSearch: true
    });

/* DATERANGEPICKER */
  $('#activefrom').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  });


/* DATERANGEPICKER */


/* select2 */
 // $('#supplier').editableSelect();
 // $('#assignee').editableSelect();
 // $('#type').editableSelect();
 // $('#duedate').editableSelect();
/* select2 */



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

/*ADD PROVIDER */
    $('#addNewLandline').click(function() {
        var accountnumber = $('#accountnumber').val();
        var landlinenumber = $('#landlinenumber').val();
        var supplier = $('#supplier').val();
        var assignee = $('#assignee').val();
        var assigneesection = $('#assigneesection').val();
        var type = $('#type').val();
        var newnumber = $('#newnumber').val();
        var trunkline = $('#trunkline').val();
        var nooftrunkline = $('#nooftrunkline').val();
        var duedate = $('#duedate').val();
        var input = $('#activefrom').val();
        // var input = "03/07/2016";
        var activefrom = input.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
        var remarks = $('#remarks').val();

        // alert(accountnumber + ' ' + landlinenumber + ' ' + supplier + ' ' + assignee + ' ' + type + ' ' + newnumber + ' ' + duedate + ' ' + activefrom + ' ' + remarks );

        if ((accountnumber == "") || (landlinenumber ==  "") || (supplier ==  "")  || (type ==  "")  || (duedate ==  "") || (activefrom ==  "") || (activefrom ==  "")){
            $("#myElem").show().delay(2000).fadeOut();

        } else {        

        $.ajax({
            method: "POST",
            data: {
                accountnumber : accountnumber,
                landlinenumber : landlinenumber,
                supplier : supplier,
                assignee : assignee,
                type : type,
                newnumber : newnumber,
                duedate : duedate,
                activefrom : activefrom,
                remarks : remarks,
                trunkline : trunkline,
                nooftrunkline : nooftrunkline,
                assigneesection : assigneesection,

            },
            url: '<?php echo base_url(); ?>accountinfolandline/validate_account_landline',
            success:function(response) {
                if (response != 'false') {
                    Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            // $("#notification").html(response);
            setTimeout(window.location.href = '<?php echo base_url(); ?>accountinfolandline', 1500);
             response.redirect;
                } else {
                $("#myElem").show().delay(2000).fadeOut().text(accountnumber + ' ' + "is already taken.");
                }
            }
        });
    }
    });
/*ADD PROVIDER */


});
</script>

