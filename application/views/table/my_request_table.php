<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#new" data-toggle="tab" aria-expanded="true">New</a></li>
            <li class=""><a href="#in_progress" data-toggle="tab" aria-expanded="false">In Progress</a></li>
            <li class=""><a href="#completed" data-toggle="tab" aria-expanded="false">Completed</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="new">
                <table id="my_request_table_new" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Request #</th>
                            <th>Purpose</th>
                            <th>Requester</th>
                            <th>Section</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($new as $row) { ?>
                        <tr class="tr-hover clickable-row" data-href='<?php echo base_url(); ?>request/request_details/<?php echo encrypt($row->request_number); ?>'>
                            <td><?php echo $row->request_number; ?></td>
                            <td><?php echo $row->purpose; ?></td>
                            <td><?php echo $row->full_name; ?></td>
                            <td><?php echo $row->section; ?></td>
                            <td><?php echo $row->category_type; ?></td>
                            <td><?php echo $row->category; ?></td>
                            <td><?php echo getStatus($row->status); ?></td>
                            <td><?php echo $row->last_update; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="in_progress">
                <div class="tab-pane active" id="new">
                    <table id="my_request_table_in_progress" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Request #</th>
                                <th>Purpose</th>
                                <th>Requester</th>
                                <th>Section</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($in_progress as $row) { ?>
                            <tr class="tr-hover clickable-row" data-href='<?php echo base_url(); ?>request/request_details/<?php echo encrypt($row->request_number); ?>'>
                                <td><?php echo $row->request_number; ?></td>
                                <td><?php echo $row->purpose; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td><?php echo $row->section; ?></td>
                                <td><?php echo $row->category_type; ?></td>
                                <td><?php echo $row->category; ?></td>
                                <td><?php echo getStatus($row->status); ?></td>
                                <td><?php echo $row->last_update; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="completed">
                <div class="tab-pane active" id="new">
                    <table id="my_request_table_completed" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Request #</th>
                                <th>Purpose</th>
                                <th>Requester</th>
                                <th>Section</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($completed as $row) { ?>
                            <tr class="tr-hover clickable-row" data-href='<?php echo base_url(); ?>request/request_details/<?php echo encrypt($row->request_number); ?>'>
                                <td><?php echo $row->request_number; ?></td>
                                <td><?php echo $row->purpose; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td><?php echo $row->section; ?></td>
                                <td><?php echo $row->category_type; ?></td>
                                <td><?php echo $row->category; ?></td>
                                <td><?php echo getStatus($row->status); ?></td>
                                <td><?php echo $row->last_update; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#my_request_table_new').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#my_request_table_in_progress').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#my_request_table_completed').DataTable({
            "order": [[ 0, "desc" ]]
        });

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>