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

/*ADD PROVIDER */

/*ADD PROVIDER */


});
</script>

