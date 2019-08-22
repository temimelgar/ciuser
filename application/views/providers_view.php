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


</style>

<div class="container-fluid">
<section class="col-lg-12">

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Transcations</h3>
         </div>
        <div class="box-body">

           <table class="table table-hover table-striped table-condensed">
                <thead class="">
                    <tr>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Category</th>
                        <th>Active From</th>
                        <th>Inactive Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {
                        $supplier_category = $row->supplier_category;

                        if ($supplier_category == 1) {
                            $supplier_category = "Communications";
                        } else {
                             $supplier_category = "Courier";
                        }
                    ?>
                    <tr>
                        <td><?php echo $row->supplier_id; ?></td>
                        <td><?php echo $row->supplier_name; ?></td>
                        <td><?php echo $supplier_category; ?></td>
                        <td><?php echo $row->active_from; ?></td>
                        <td><?php echo $row->inactive_date; ?></td>
                        <td class = "updateProvider"
                            data-id="<?php echo $row->supplier_id; ?>"
                            data-suppliername = "<?php echo $row->supplier_name; ?>"
                            data-suppliercategory = "<?php echo $supplier_category; ?>"
                            data-activefrom = "<?php echo $row->active_from; ?>"
                            data-inactivedate = "<?php echo $row->inactive_date; ?>"
                        ><a data-toggle="modal" data-target="#updateProviderModal"><span class='badge' style="background-color: #dd4b39"><i class="fa fa-edit" ></i></span></a></td>
                    </tr>
                     <?php } ?>
                </tbody>
               
           </table> <br>
        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">
  Add Provider
</button>
          <!--  <button class="btn btn-danger">Add Provider</button>        -->
        </div>

 


 
  
</section><!-- right col -->


</div>


<!-- 
<?php include ('modal/provider_modal_view.php');?>
<?php include ('modal/provider_edit_modal_view.php');?> -->




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

    $('#addProvider').click(function() {
        var suppliername = $('#suppliername').val();
        var activefrom = $('#activefrom').val();
        var suppliercategory = $('#suppliercategory').val();

        // alert(suppliername + ' ' + activefrom + ' ' + suppliercategory);

        $.ajax({
            method: "POST",
            data: {
                suppliername : suppliername,
                activefrom : activefrom,
                suppliercategory : suppliercategory
            },
            url: 'provider/validate_provider',
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
            setTimeout(window.location.href = '<?php echo base_url(); ?>provider', 1500);
             response.redirect;
                } else {
                Swal.fire({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something went wrong',
                    timer: 1500
                })
                }
            }
        });
    });


    $('body').on('click', '.updateProvider', function() {
        var id = $(this).data("id");
        var suppliername = $(this).data("suppliername");
        var suppliercategory = $(this).data("suppliercategory");
        var activefrom = $(this).data("activefrom");
        var inactivedate = $(this).data("inactivedate");

        $.ajax({
            method: "POST",
            data: { id, id },
            url: "provider/get_provider_by_id"
        });

    });
});
</script>

  <!-- data-id="<?php echo $row->supplier_id; ?>"
                            data-suppliername = "<?php echo $row->supplier_name; ?>"
                            data-suppliercategory = "<?php echo $supplier_category; ?>"
                            data-activefrom = "<?php echo $row->active_from; ?>"
                            data-inactivedate = "<?php echo $row->inactive_date; ?>" --