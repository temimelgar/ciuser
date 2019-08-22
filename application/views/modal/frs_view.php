<div class="form-group">
    <label class="col-sm-3 control-label">Plate / CS No</label>
    <div class="col-sm-3">
        <input placeholder="Plate / CS No" class="form-control" name="plate_cs_no" type="text">
    </div>
    <div class="col-sm-1">
        <button id="btn-check" class="btn btn-danger btn-flat pull-right" type="button">Check</button>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Model</label>
    <div class="col-sm-4">
        <input placeholder="Model" class="form-control" name="model" id="model" type="text" readonly>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Liters</label>
    <div class="col-sm-3">
        <input placeholder="Liters" class="form-control" name="liters" type="text">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Fuel Type</label>
    <div class="col-sm-3">
        <select id="select-fuel_type" class="form-control select2" name="fuel_type">
            <option value=""></option>
            <option value="DIESEL">DIESEL</option>
            <option value="UNLEADED">UNLEADED</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Meter Reading</label>
    <div class="col-sm-2">
        <input placeholder="From" class="form-control" name="meter_reading_from" type="text">
    </div>
    <div class="col-sm-2">
        <input placeholder="To" class="form-control" name="meter_reading_to" type="text">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Purpose</label>
    <div class="col-sm-7">
        <textarea placeholder="Purpose" rows="5" class="form-control no-resize" name="purpose"></textarea>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: 'Nothing selected'
        });

        $('#btn-submit').click(function(){
            var error = false;

            if($('select[name=category_id]').val() == '' || $('select[name=category_id]').val() == null){
                $('select[name=category_id]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('select[name=category_id]').parent().parent().removeClass('has-error');
            }

            if($('input[name=plate_cs_no]').val() == '' || $('input[name=liters]').val() == null){
                $('input[name=plate_cs_no]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('input[name=plate_cs_no]').parent().parent().removeClass('has-error');
            }

            if($('input[name=model]').val() == '' || $('input[name=model]').val() == null){
                $('input[name=model]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('input[name=model]').parent().parent().removeClass('has-error');
            }

            if($('input[name=liters]').val() == '' || $('input[name=liters]').val() == null){
                $('input[name=liters]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('input[name=liters]').parent().parent().removeClass('has-error');
            }

            if($('select[name=fuel_type]').val() == '' || $('select[name=fuel_type]').val() == null){
                $('select[name=fuel_type]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('select[name=fuel_type]').parent().parent().removeClass('has-error');
            }

            if($('input[name=meter_reading_from]').val() == '' || $('input[name=meter_reading_from]').val() == null){
                $('input[name=meter_reading_from]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('input[name=meter_reading_from]').parent().parent().removeClass('has-error');
            }

            if($('input[name=meter_reading_to]').val() == '' || $('input[name=meter_reading_to]').val() == null){
                $('input[name=meter_reading_to]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('input[name=meter_reading_to]').parent().parent().removeClass('has-error');
            }

            if($('textarea[name=purpose]').val() == '' || $('textarea[name=purpose]').val() == null){
                $('textarea[name=purpose]').parent().parent().addClass('has-error');
                error = true;
            }
            else{
                $('textarea[name=purpose]').parent().parent().removeClass('has-error');
            }

            if(error == false){
                $('#my-form').submit();
            }                   
        });

        $('#btn-check').click(function(){
            var plate_cs_no = $.trim($('input[name=plate_cs_no]').val());
            if(plate_cs_no != "" && plate_cs_no != null)
            {
                $.ajax({
                    type: 'POST',
                    data: {
                        plate_cs_no : plate_cs_no
                    },
                    url: '<?php echo base_url(); ?>ajax_request/get_car_model',
                    success: function(data){
                        var info = JSON.parse(data);
                        $('input[name=model]').val('');
                        $('input[name=model]').val(info[0].model);  
                    }
                });
            }
            else
            {
                $('input[name=model]').val('');
            }
        });
    });
</script>