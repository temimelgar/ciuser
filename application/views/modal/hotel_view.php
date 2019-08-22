<div class="form-group" id="sbc">
    <label class="col-sm-3 control-label">Sub Category</label>
    <div class="col-sm-7">
        <select id="select-sub_category" class="selectpicker" name="sub_category_id" data-live-search="true">
            <option value="">Nothing selected</option>
            <?php foreach($sub_categories as $row) { ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->sub_category; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Name of Hotel</label>
    <div class="col-sm-3">
        <input placeholder="Name of Hotel" class="form-control" name="hotel" id="hotel" type="text" required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Destination</label>
    <div class="col-sm-3">
        <input placeholder="Destination" class="form-control" name="hotel_place" id="hotel_place" type="text" required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Prefered Date</label>
    <div class="col-sm-3">
        <input placeholder="Prefered Arrival Date" class="form-control" name="pref_arrival_date" id="pref_arrival_date" type="text" required>
    </div>
    <div class="col-sm-3">
        <input placeholder="Prefered Departure Date" class="form-control" name="pref_departure_date" id="pref_departure_date" type="text" required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Date</label>
    <div class="col-sm-3">
        <input placeholder="Arrival Date" class="form-control" name="arrival_date" id="arrival_date" type="text" required>
    </div>
    <div class="col-sm-3">
        <input placeholder="Departure Date" class="form-control" name="departure_date" id="departure_date" type="text" required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Travelers</label>
    <div class="col-sm-3">
        <select id="travelers" class="select2" name="travelers[]" data-live-search="true" multiple required>
            <?php foreach($employee_list as $row) { ?>
                <option value="<?php echo $row->full_name; ?>" style="color: black;"><?php echo $row->full_name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Room Count:</label>
    <div class="col-sm-3">
        <input placeholder="Room Count" class="form-control" id="room_count" type="text" value="" readonly>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Requirement</label>
    <div class="col-sm-3">
        <input placeholder="Requirement" class="form-control" name="hotel_requirement" id="hotel_requirement" type="text" required>
    </div>
</div>

