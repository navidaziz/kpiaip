<div class="table-responsive" style=" overflow-x:auto;">

    <table id="db_table" class="table  table_small table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>District</th>
                <th>WUA</th>
                <th>FY</th>
                <th>Scheme Code</th>
                <th>Scheme Name</th>
                <th>Category</th>
                <th>Sanctioned Cost</th>
                <th>Gross Paid</th>
                <th>Deduction</th>
                <th>Net Paid</th>
                <th>Remaining</th>
                <th>Pay. Count</th>
                <th>ICR-I</th>
                <th>ICR-II</th>
                <th>ICR-I&II</th>
                <th>Other</th>
                <th>FCR</th>
                <th>Phy. Completed</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($schemes as $scheme) { ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $scheme->district_name; ?></td>
                    <td><?php echo $scheme->wua_name; ?></td>
                    <td><?php echo $scheme->financial_year; ?></td>
                    <td><?php echo $scheme->scheme_code; ?></td>
                    <td><?php echo $scheme->scheme_name; ?></td>
                    <td><?php echo $scheme->component_category; ?></td>
                    <td><?php echo $scheme->sanctioned_cost; ?></td>
                    <td><?php echo $scheme->total_paid; ?></td>
                    <td><?php echo $scheme->deduction; ?></td>
                    <td><?php echo $scheme->net_paid; ?></td>
                    <td><?php echo $scheme->remaining; ?></td>
                    <td><?php echo $scheme->payment_count; ?></td>
                    <td><?php echo $scheme->first; ?></td>
                    <td><?php echo $scheme->second; ?></td>
                    <td><?php echo $scheme->first_second; ?></td>
                    <td><?php echo $scheme->other; ?></td>
                    <td><?php echo $scheme->final; ?></td>
                    <td><?php
                        if ($scheme->phy_completion) {
                            echo date('d M, y', strtotime($scheme->phy_completion_date));
                        } ?></td>
                    <td><a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/print_scheme/' . $scheme->scheme_id . '') ?>">View Scheme</a></td>
                </tr>
            <?php } ?>
        </tbody>
        <tbody></tbody>
    </table>





</div>


<script>
    title = "Scheme List";
    $('#db_table').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: title,
        "order": [],
        searching: true,
        buttons: [

            {
                extend: 'print',
                title: title,
            },
            {
                extend: 'excelHtml5',
                title: title,

            },
            {
                extend: 'pdfHtml5',
                title: title,
                pageSize: 'A4',

            }
        ]
    });
</script>