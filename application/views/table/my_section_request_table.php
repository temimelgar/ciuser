<div class="col-md-12">
    <div class="box box-danger">
        <div class="box-body">
            <table id="my_section_request_table" class="table table-hover">
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
                    <?php foreach($result as $row) { ?>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#my_section_request_table').DataTable({
            "order": [[ 6, "desc" ]]
        });

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>