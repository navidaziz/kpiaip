<div class="box-body">

    <table class="table table_small table-bordered" id="water_user_associations">
        <thead>
            <tr>
                <th>#</th>
                <th>Change Date-Time</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>detail</th>
                <th>Change By</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $query = "SELECT sl.*, u.user_title FROM scheme_logs  as sl
            INNER JOIN users as u ON(u.user_id = sl.created_by)
            WHERE sl.scheme_id = $scheme_id";
            $rows = $this->db->query($query)->result();
            foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $row->created_date; ?></td>
                    <td><?php echo $row->scheme_status; ?></td>
                    <td><?php echo $row->remarks; ?></td>
                    <td><?php echo $row->detail; ?></td>
                    <td><?php echo $row->user_title; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>