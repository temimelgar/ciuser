<div class="form-group" id="sbc">
    <label class="col-sm-3 control-label">Sub Category</label>
    <div class="col-sm-7">
        <select id="select-sub_category" class="selectpicker" name="sub_category_id" data-live-search="true" required>
            <option value="" selected>Nothing selected</option>
            <?php foreach($sub_categories as $row) {?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->sub_category; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group network_div network_div2">
    <label class="col-sm-3 control-label">Network</label>
    <div class="col-sm-7">
        <select id="select-network" class="selectpicker" name="network" data-live-search="true" required>
            <option value="">Nothing selected</option>
            <option value="SMART">Smart</option>
            <option value="GLOBE">Globe</option>
            <!-- <option value="PLDT">Pldt</option> -->
        </select>
    </div>
</div>

<div class="form-group courier_div">
    <label class="col-sm-3 control-label">Shipping Method</label>
    <div class="col-sm-7">
        <select id="shipping_method" class="selectpicker" name="shipping_method" data-live-search="true" required>
            <option value="">Nothing selected</option>
            <option value="Air">Air</option>
            <option value="Sea">Sea</option>
            <option value="Land">Land</option>
        </select>
    </div>
</div>

<div class="form-group courier_div">
    <label class="col-sm-3 control-label">Service Provider</label>
    <div class="col-sm-7">
        <select id="service_provider" class="selectpicker" name="service_provider" data-live-search="true" required>
            <option value="">Nothing selected</option>
            <option value="LBC">LBC</option>
            <option value="Air21">Air 21</option>
            <option value="DHL">DHL Express</option>
            <option value="JRS">JRS Express</option>
        </select>
    </div>
</div>

<div class="form-group network_div">
    <label class="col-sm-3 control-label">Mobile / Tel. Number</label>
    <div class="col-sm-3">
        <input placeholder="Mobile Number" class="form-control" name="mobile_no" id="mobile_no" type="text" required>
    </div>
</div>

<div class="form-group courier_div">
    <label class="col-sm-3 control-label">Destination</label>
    <div class="col-sm-3">
        <input placeholder="Destination" class="form-control" name="distination" id="distination" type="text" required>
    </div>
</div>

<div class="form-group courier_div">
    <label class="col-sm-3 control-label">Reference No</label>
    <div class="col-sm-3">
        <input placeholder="Reference No" class="form-control" name="reference_no" id="reference_no" type="text" required>
    </div>
</div>

<div class="form-group amount_div">
    <label class="col-sm-3 control-label">Amount</label>
    <div class="col-sm-3">
        <input placeholder="Amount" class="form-control" name="amount" id="amount" type="text" required>
    </div>
</div>