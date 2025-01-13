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


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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

                        </thead>

                        <tbody>

                            <tr>

                                <th colspan="<?php echo count($pre_fys) + 5; ?>">A: Watercourses</th>

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

                            </tr>



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

                                </tr>
                            <?php } ?>

                        </tbody>

                        <tfoot>
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

                            </tr>
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
                        //         dom: 'Bfrtip', // Enable export buttons
                        //         buttons: [{
                        //             extend: 'excelHtml5',
                        //             text: 'Export to Excel',
                        //             footer: true, // Exclude footer in the export
                        //             header: true,
                        //         }]
                        //     });
                        // });

                        $(document).ready(function() {
                            $('#schemes Table').DataTable({
                                paging: false,
                                searching: true,
                                ordering: true,
                                info: true,
                                columnDefs: [{
                                    orderable: false,
                                    targets: [0, 1] // Disable sorting on the first two columns
                                }],
                                dom: 'Bfrtip', // Enable export buttons
                                buttons: [{
                                    extend: 'excelHtml5',
                                    text: 'Export to Excel',
                                    footer: true, // Include footer in the export
                                    exportOptions: {
                                        columns: ':visible', // Export all visible columns
                                        format: {
                                            header: function(data, columnIdx) {
                                                // Clean up HTML from header text if needed
                                                return data.replace(/<[^>]+>/g, '').trim();
                                            }
                                        }
                                    }
                                }]
                            });
                        });
                    </script>

                    <button id="exportButton">Export to Excel</button>

                    <script>
                        document.getElementById('exportButton').addEventListener('click', function() {
                            var table = document.getElementById("schemesTable"); // Get the table element
                            var wb = XLSX.utils.table_to_book(table, {
                                sheet: "Sheet1"
                            }); // Convert the table to Excel
                            XLSX.writeFile(wb, "schemes_table.xlsx"); // Download the Excel file
                        });
                    </script>

                </div>

            </div>
        </div>
    </div>


</div>