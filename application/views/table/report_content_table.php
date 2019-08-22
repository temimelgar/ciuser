<?php if($assignee == NULL) { ?>
<div class="col-md-10">
    <div class="box box-danger">
        <div class="box-body" id="report_content">
            <table id="report_content_table" class="table table-hover" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Requester</th>
                        <th>Request #</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Request Date</th>
                        <th>Completed Date</th>
                        <th>Assignee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row) { ?>
                    <tr class="tr-hover clickable-row" data-href='<?php echo base_url(); ?>request/request_details/<?php echo encrypt($row->request_number); ?>'>
                        <td><?php echo ucwords(strtolower(get_employee_details($row->requester_id)->department)); ?></td>
                        <td><?php echo ucwords(strtolower(get_employee_details($row->requester_id)->section)); ?></td>
                        <td><?php echo ucwords(strtolower(get_employee_details($row->requester_id)->full_name)); ?></td>
                        <td><?php echo $row->request_number; ?></td>
                        <td><?php echo $row->category; ?></td>
                        <td><?php echo ($row->actual_completed_date)? getStatus('report_completed') : getStatus('report_pending'); ?></td>
                        <td><?php echo ($row->date_created)? date_format(date_create($row->date_created),'Y-m-d') : ''; ?></td>
                        <td><?php echo ($row->completed_date)? date_format(date_create($row->completed_date),'Y-m-d') : ''; ?></td>
                        <td><?php echo ($row->assigned_id)? ucwords(strtolower(get_employee_details($row->assigned_id)->full_name)) : ''; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-2">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Request Count</h3>
        </div>
        <div class="box-body">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td style="width:50%">Completed<div></div></td>
                        <td class="text-right"><?php echo $completed_total; ?></td>
                    </tr>
                    <tr>
                        <td style="width:50%">Pending</td>
                        <td class="text-right"><?php echo $pending_total; ?></td>
                    </tr>
                    <tr>
                        <td style="width:50%"><strong>Total</strong></td>
                        <td class="text-right"><strong><?php echo $total_request; ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } else { ?>
<div class="col-md-12">
    <div class="box box-danger">
        <div class="box-body" id="report_content">
            <table id="report_assignee_table" class="table table-hover" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Beginning Balance</th>
                        <th>Submission</th>
                        <th>Completion</th>
                        <th>Pending</th>
                        <th>Overdue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row) { ?>
                    <tr class="tr-hover">
                        <td><?php echo get_employee_details($row->assigned_id)->full_name; ?></td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#report_assignee_table').DataTable({
            "order": [[ 0, "desc" ]]
        });

        $('#report_content_table').DataTable({
            "order": [[ 0, "desc" ]]
        });

        $(".clickable-row").click(function() {
            var win = window.open($(this).data("href"), '_blank');
            win.focus();
        });

    });
</script>