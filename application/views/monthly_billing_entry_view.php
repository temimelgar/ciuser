
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
  <form method="post" id="formform" enctype="multipart/form-data">
<section class="col-lg-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Select Provider</h3>
         </div>
        <div class="box-body">

          <div class="form-group">
                            <div class="row">
                    <div class="col-md-1">            
            <label >Year</label>
                    </div>
                    <div class="col-md-3">
<input type="number" id="year" class="form-control" min="2019" max="3000">    
                    </div>                                
                    <div class="col-md-1">            
            <label >Supplier</label>
                    </div>
                    <div class="col-md-7">
            <select class="form-control" id="supplier" name="supplier">
              <option>Please select..</option>
              <?php foreach ($providers as $provider) {
               ?>
               <option value="<?php echo $provider->supplier_id; ?>"><?php echo $provider->supplier_name; ?></option>
              <?php  } ?>
            </select> 
                    </div>

                </div>
            <div class="form-group"><br>
                <button class="btn btn-danger pull-right " id="submit" type="submit">Submit</button>                
         
         </form>            
            </div>

          </div> 
        </div>
   

</section><!-- right col -->

     <section class='col-md-12'>
<div class='box box-danger'>
        <div class='box-header'>
            <h3 class='box-title'></h3>
         </div>
        <div class='box-body'>
            <form method="post" id="my_form" enctype="multipart/form-data">
             <div class="table-responsive" id="billing_entry_monthly_data">

  </div>
   </form>

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



        $('select').selectpicker({
          liveSearch: true
    });

/*<!-- DATATABLE --!>*/

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


$('#submit').on('click', function(event){

    $('#billingentrymonthlyreporttable').DataTable({
        'searching': true,
                'scrollX': true,
        "lengthMenu": [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "All"]
        ]
    });

        event.preventDefault();
        supplier = $('#supplier').val();

    var year = $('#year').val();

    // alert (year + ' ' + supplier);

        $.ajax({
            method: "POST",
            data: {
                year: year,
                supplier: supplier
            },
            url: "<?php echo base_url(); ?>billingentry/table_billing_entry_monthly",
            success:function(data){
            $('#billing_entry_monthly_data').html(data);
               // console.log(data);   
            }

        });
    });


 $('#exportBillingEntryPerMonth').click(function(event) {
        event.preventDefault();
        supplier = $('#supplierexport').val();

    // var year = $('#year').val();
    alert (supplier + ' ' + year);
        //     $.ajax({
        //     method: "POST",
        //     data: {
        //         supplier: supplier
        //     },
        //     dataType:'json',
        //     url: "<?php echo base_url(); ?>billingentry/export_table_billing_entry_monthly/",
        //     // success:function(data){
        //     // // $('#billing_entry_monthly_data').html(data);
        //     //    // console.log(data);   
        //     // }

        // });
 }); 

});

</script>

