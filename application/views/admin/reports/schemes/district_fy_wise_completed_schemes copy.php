<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px;
        color: black;
        margin: 0px !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">

                    <?php
                    // Fetch the number of completed schemes
                    $query = "SELECT COUNT(*) AS completed_schemes FROM scheme_lists WHERE scheme_status = 'Completed'";
                    $completed_schemes = $this->db->query($query)->row()->completed_schemes;
                    ?>
                    <h5><?php echo htmlspecialchars($description); ?>: <?php echo $completed_schemes; ?></h5>

                    <?php
                    // Fetch financial years
                    $pre_fys_query = "SELECT * FROM financial_years WHERE status != 1 and financial_year_id !=1";
                    $pre_fys = $this->db->query($pre_fys_query)->result();

                    $current_fy_query = "SELECT * FROM financial_years WHERE status = 1";
                    $current_fy = $this->db->query($current_fy_query)->row();
                    ?>
                    <table class="table table_small table-bordered" id="schemesTable">
                        <thead>
                            <tr>

                                <th colspan="<?php echo count($pre_fys) + 5; ?>">A: Watercourses</th>
                                <th></th>
                                <th colspan="<?php echo count($pre_fys) + 3; ?>">B-2: Water Storage Tanks and Ponds</th>
                                <th></th>
                                <th colspan="<?php echo count($pre_fys) + 3; ?>">B-1: Installation of HEIS Systems</th>
                                <th></th>
                                <th colspan="<?php echo count($pre_fys) + 3; ?>">B-3: Strengthening Precision Laser
                                    Leveling Service in Private Sector</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <?php foreach ($pre_fys as $pre_fy) { ?>
                                    <th><?php echo htmlspecialchars($pre_fy->financial_year); ?></th>
                                <?php } ?>
                                <th>Total</th>
                                <th><?php echo htmlspecialchars($current_fy->financial_year); ?></th>
                                <th>G. Total</th>
                                <th></th>
                                <?php foreach ($pre_fys as $pre_fy) { ?>
                                    <th><?php echo htmlspecialchars($pre_fy->financial_year); ?></th>
                                <?php } ?>
                                <th>Total</th>
                                <th><?php echo htmlspecialchars($current_fy->financial_year); ?></th>
                                <th>G. Total</th>
                                <th></th>
                                <?php foreach ($pre_fys as $pre_fy) { ?>
                                    <th><?php echo htmlspecialchars($pre_fy->financial_year); ?></th>
                                <?php } ?>
                                <th>Total</th>
                                <th><?php echo htmlspecialchars($current_fy->financial_year); ?></th>
                                <th>G. Total</th>
                                <th></th>
                                <?php foreach ($pre_fys as $pre_fy) { ?>
                                    <th><?php echo htmlspecialchars($pre_fy->financial_year); ?></th>
                                <?php } ?>
                                <th>Total</th>
                                <th><?php echo htmlspecialchars($current_fy->financial_year); ?></th>
                                <th>G. Total</th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody>





                            <?php
                            // Fetch all districts
                            $districts_query = "SELECT * FROM districts WHERE is_district = 1 ORDER BY district_name";
                            $districts = $this->db->query($districts_query)->result();

                            $count = 1;
                            foreach ($districts as $district) { ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo htmlspecialchars($district->district_name); ?></td>

                                    <?php

                                    // Fetch completed schemes per previous financial year
                                    foreach ($pre_fys as $pre_fy) {
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND district_id = ? 
                                        AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                        $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id, $district->district_id])->row()->total;
                                    ?>
                                        <td><?php echo $fy_total_schemes; ?></td>
                                    <?php } ?>

                                    <?php
                                    // Total for all years
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy 
                                     WHERE fy.status=0) 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                    $pre_total_schemes = $this->db->query($query, [$district->district_id])->row()->total;
                                    // Current financial year total
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND district_id = ? 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                    $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id, $district->district_id])->row()->total;

                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                    $total_schemes = $this->db->query($query, [$district->district_id])->row()->total;

                                    ?>
                                    <td><?php echo $pre_total_schemes; ?></td>
                                    <td><?php echo $current_fy_schemes; ?></td>
                                    <td><?php echo $total_schemes; ?></td>
                                    <td></td>


                                    <?php

                                    // Fetch completed schemes per previous financial year
                                    foreach ($pre_fys as $pre_fy) {
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND district_id = ? 
                                        AND component_category_id IN(11)";
                                        $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id, $district->district_id])->row()->total;
                                    ?>
                                        <td><?php echo $fy_total_schemes; ?></td>
                                    <?php } ?>

                                    <?php
                                    // Total for all years
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(11)";
                                    $pre_total_schemes = $this->db->query($query, [$district->district_id])->row()->total;
                                    // Current financial year total
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND district_id = ? 
                                    AND component_category_id IN(11)";
                                    $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id, $district->district_id])->row()->total;

                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                    AND component_category_id IN(11)";
                                    $total_schemes = $this->db->query($query, [$district->district_id])->row()->total;

                                    ?>
                                    <td><?php echo $pre_total_schemes; ?></td>
                                    <td><?php echo $current_fy_schemes; ?></td>
                                    <td><?php echo $total_schemes; ?></td>
                                    <td></td>
                                    <?php

                                    // Fetch completed schemes per previous financial year
                                    foreach ($pre_fys as $pre_fy) {
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND district_id = ? 
                                        AND component_category_id IN(10)";
                                        $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id, $district->district_id])->row()->total;
                                    ?>
                                        <td><?php echo $fy_total_schemes; ?></td>
                                    <?php } ?>

                                    <?php
                                    // Total for all years
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(10)";
                                    $pre_total_schemes = $this->db->query($query, [$district->district_id])->row()->total;
                                    // Current financial year total
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND district_id = ? 
                                    AND component_category_id IN(10)";
                                    $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id, $district->district_id])->row()->total;

                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                    AND component_category_id IN(10)";
                                    $total_schemes = $this->db->query($query, [$district->district_id])->row()->total;

                                    ?>
                                    <td><?php echo $pre_total_schemes; ?></td>
                                    <td><?php echo $current_fy_schemes; ?></td>
                                    <td><?php echo $total_schemes; ?></td>
                                    <td></td>
                                    <?php

                                    // Fetch completed schemes per previous financial year
                                    foreach ($pre_fys as $pre_fy) {
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND district_id = ? 
                                        AND component_category_id IN(12)";
                                        $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id, $district->district_id])->row()->total;
                                    ?>
                                        <td><?php echo $fy_total_schemes; ?></td>
                                    <?php } ?>

                                    <?php
                                    // Total for all years
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(12)";
                                    $pre_total_schemes = $this->db->query($query, [$district->district_id])->row()->total;
                                    // Current financial year total
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND district_id = ? 
                                    AND component_category_id IN(12)";
                                    $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id, $district->district_id])->row()->total;

                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND district_id = ? 
                                    AND component_category_id IN(12)";
                                    $total_schemes = $this->db->query($query, [$district->district_id])->row()->total;

                                    ?>
                                    <td><?php echo $pre_total_schemes; ?></td>
                                    <td><?php echo $current_fy_schemes; ?></td>
                                    <td><?php echo $total_schemes; ?></td>
                                    <td></td>

                                </tr>
                            <?php } ?>
                            <tr>
                                <th></th>
                                <th>Grand Total</th>

                                <?php

                                // Fetch completed schemes per previous financial year
                                foreach ($pre_fys as $pre_fy) {
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                    $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id])->row()->total;
                                ?>
                                    <th><?php echo $fy_total_schemes; ?></th>
                                <?php } ?>

                                <?php
                                // Total for all years
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                $pre_total_schemes = $this->db->query($query)->row()->total;
                                // Current financial year total
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id])->row()->total;

                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND component_category_id IN(1,2,3,4,5,6,7,8)";
                                $total_schemes = $this->db->query($query)->row()->total;

                                ?>
                                <th><?php echo $pre_total_schemes; ?></th>
                                <th><?php echo $current_fy_schemes; ?></th>
                                <th><?php echo $total_schemes; ?></th>
                                <th></th>


                                <?php

                                // Fetch completed schemes per previous financial year
                                foreach ($pre_fys as $pre_fy) {
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND component_category_id IN(11)";
                                    $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id])->row()->total;
                                ?>
                                    <th><?php echo $fy_total_schemes; ?></th>
                                <?php } ?>

                                <?php
                                // Total for all years
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(11)";
                                $pre_total_schemes = $this->db->query($query)->row()->total;
                                // Current financial year total
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND component_category_id IN(11)";
                                $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id])->row()->total;

                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND component_category_id IN(11)";
                                $total_schemes = $this->db->query($query)->row()->total;

                                ?>
                                <th><?php echo $pre_total_schemes; ?></th>
                                <th><?php echo $current_fy_schemes; ?></th>
                                <th><?php echo $total_schemes; ?></th>
                                <th></th>
                                <?php

                                // Fetch completed schemes per previous financial year
                                foreach ($pre_fys as $pre_fy) {
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND component_category_id IN(10)";
                                    $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id])->row()->total;
                                ?>
                                    <th><?php echo $fy_total_schemes; ?></th>
                                <?php } ?>

                                <?php
                                // Total for all years
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(10)";
                                $pre_total_schemes = $this->db->query($query)->row()->total;
                                // Current financial year total
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND component_category_id IN(10)";
                                $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id])->row()->total;

                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND component_category_id IN(10)";
                                $total_schemes = $this->db->query($query)->row()->total;

                                ?>
                                <th><?php echo $pre_total_schemes; ?></th>
                                <th><?php echo $current_fy_schemes; ?></th>
                                <th><?php echo $total_schemes; ?></th>
                                <th></th>
                                <?php

                                // Fetch completed schemes per previous financial year
                                foreach ($pre_fys as $pre_fy) {
                                    $query = "SELECT COUNT(*) AS total FROM schemes 
                                        WHERE scheme_status = 'Completed' 
                                        AND financial_year_id = ? 
                                        AND component_category_id IN(12)";
                                    $fy_total_schemes = $this->db->query($query, [$pre_fy->financial_year_id])->row()->total;
                                ?>
                                    <th><?php echo $fy_total_schemes; ?></th>
                                <?php } ?>

                                <?php
                                // Total for all years
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                     AND financial_year_id IN (SELECT fy.financial_year_id FROM financial_years as fy WHERE status!=1) 
                                    AND component_category_id IN(12)";
                                $pre_total_schemes = $this->db->query($query)->row()->total;
                                // Current financial year total
                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND financial_year_id = ? 
                                    AND component_category_id IN(12)";
                                $current_fy_schemes = $this->db->query($query, [$current_fy->financial_year_id])->row()->total;

                                $query = "SELECT COUNT(*) AS total FROM schemes 
                                    WHERE scheme_status = 'Completed' 
                                    AND component_category_id IN(12)";
                                $total_schemes = $this->db->query($query)->row()->total;

                                ?>
                                <th><?php echo $pre_total_schemes; ?></th>
                                <th><?php echo $current_fy_schemes; ?></th>
                                <th><?php echo $total_schemes; ?></th>
                                <th></th>

                            </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>

                    <script>
                        // $(document).ready(function() {
                        //     $('#schemesTable').DataTable({
                        //         paging: false,
                        //         searching: true,
                        //         ordering: true,
                        //         info: true,
                        //         columnDefs: [{
                        //             orderable: false,
                        //             targets: [0, 1] // Disable sorting on the first two columns
                        //         }],
                        //         //fixedHeader: true,
                        //         //scrollX: true,
                        //         dom: 'Bfrtip', // Enable export buttons
                        //         buttons: ['copy', 'csv', 'excel', 'pdf', 'print'], // Optional: Export options
                        //     });
                        // });

                        $(document).ready(function() {
                            $('#schemesTable').DataTable({
                                paging: false,
                                searching: false,
                                ordering: false,
                                info: false,
                                columnDefs: [{
                                    orderable: false,
                                    targets: [0, 1] // Disable sorting on the first two columns
                                }],
                                dom: 'Bfrtip', // Enable export buttons
                                buttons: [{
                                        extend: 'copy',
                                        exportOptions: {
                                            //columns: ':visible',
                                            header: true,
                                            footer: true
                                        }
                                    },
                                    {
                                        extend: 'csv',
                                        exportOptions: {
                                            columns: ':all',
                                            header: true,
                                            footer: true
                                        }
                                    },
                                    {
                                        extend: 'excel',
                                        exportOptions: {
                                            columns: ':all',
                                            header: true,
                                            footer: true
                                        }
                                    },
                                    {
                                        extend: 'pdf',
                                        exportOptions: {
                                            columns: ':all',
                                            header: true,
                                            footer: true
                                        }
                                    },
                                    {
                                        extend: 'print',
                                        exportOptions: {
                                            columns: ':all',
                                            header: true,
                                            footer: true
                                        }
                                    }
                                ],
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>


</div>