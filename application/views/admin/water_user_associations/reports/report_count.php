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
        font-size: 11px !important;
        color: black;
        margin: 0px !important;
    }

    .table_v_small>thead>tr>th,
    .table_v_small>tbody>tr>th,
    .table_v_small>tfoot>tr>th,
    .table_v_small>thead>tr>td,
    .table_v_small>tbody>tr>td,
    .table_v_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 6px !important;
        color: black;
        margin: 0px !important;
    }

    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: #f0ad4e;
        z-index: 3;
        color: black;
        font-weight: bold;
    }
</style>
<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-5">
                    <div class="clearfix">
                        <h3 class="content-title pull-left">Schemes SFT Data Reconciliation Progress Dashboard Summary</h3>
                    </div>
                    <div class="description">Real Time Tracking auto refresh set for 5 minutes </div>
                </div>

                <div class="col-md-7">
                    <h4>
                        <table class="table table_medium">
                            <tr>
                                <th>Description</th>
                                <th>Total</th>
                                <th>Work Done</th>
                                <th>Percentage</th>
                            </tr>
                            <tr>
                                <th>Schemes</th>
                                <th><?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
            WHERE s.scheme_status IN ('Completed', 'Par-Completed')
            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";

                                    echo $scheme_total = $this->db->query($query)->row()->total;
                                    ?><br />
                                    <small>Par-Completed</small>
                                </th>
                                <th><?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
            WHERE s.scheme_status IN ('Completed')
            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";

                                    echo $completed = $this->db->query($query)->row()->total;
                                    ?>
                                    <br />
                                    <small>Completed</small>
                                </th>
                                <th><?php
                                    $precentage = round((($completed * 100) / $scheme_total), 2);
                                    //echo $precentage."%";
                                    ?>
                                    <div class="progress" style="height:20px!important">
                                        <style>
                                            .bg-danger {
                                                background-color: #dc3545 !important;
                                                color: white;
                                                font-weight: bold;
                                            }
                                        </style>
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: <?php echo $precentage ?>%;" aria-valuenow="<?php echo $precentage ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $precentage ?>%</div>
                                        <strong style="color: #dc3545 ;"><?php echo $scheme_total - $completed ?></strong>
                                    </div>
                                </th>

                            </tr>
                            <tr>
                                <th>Cheques</th>
                                <th><?php
                                    $query = "SELECT COUNT(*) as total FROM expenses as e
            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                    $total_cheques = $this->db->query($query)->row()->total;
                                    echo $total_cheques;
                                    ?>
                                </th>
                                <th><?php
                                    $query = "SELECT COUNT(*) as total FROM expenses as e
            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
            AND e.scheme_id IS NOT NULL";
                                    $completed_cheques = $this->db->query($query)->row()->total;

                                    echo $completed_cheques;
                                    ?>

                                </th>
                                <th><?php
                                    $precentage = round((($completed_cheques * 100) / $total_cheques), 2);
                                    //echo $precentage."%";
                                    ?>
                                    <div class="progress" style="height:20px!important">
                                        <style>
                                            .bg-warning {
                                                background-color: #ffc107 !important;
                                                color: black;
                                                font-weight: bold;
                                            }
                                        </style>
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: <?php echo $precentage ?>%;" aria-valuenow="<?php echo $precentage ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $precentage ?>%</div>
                                        <strong style="color: #ffc107 ;"><?php echo $total_cheques - $completed_cheques ?></strong>
                                    </div>

                                </th>

                            </tr>
                        </table>
                    </h4>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4> <i class="fa fa-list"></i></h4>

            </div>
            <div class="box-body">

                <h4>


                    <?php
                    // Fetch data from the database
                    $districts = $this->db->query("SELECT 
        d.district_name,
        COUNT(*) AS total,
        SUM(CASE WHEN s.scheme_status = 'Completed' THEN 1 ELSE 0 END) AS completed_schemes,
        (SUM(CASE WHEN s.scheme_status = 'Completed' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS completed_percentage
        FROM schemes s
        INNER JOIN districts d ON d.district_id = s.district_id
        WHERE s.scheme_status IN ('Completed', 'Par-Completed')
        AND s.component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
        GROUP BY d.district_name
        ORDER BY completed_percentage ASC;")->result();

                    // Array to hold categorized data
                    $percentages = array();

                    // Categorize districts into ranges (e.g., 10-20%, 21-30%, etc.)
                    foreach ($districts as $district) {
                        $percentage = round($district->completed_percentage);

                        // Define percentage ranges based on specified categories
                        if ($percentage >= 0 && $percentage <= 10) {
                            $range_label = '1-10%';
                        } elseif ($percentage >= 11 && $percentage <= 20) {
                            $range_label = '11-20%';
                        } elseif ($percentage >= 21 && $percentage <= 30) {
                            $range_label = '21-30%';
                        } elseif ($percentage >= 31 && $percentage <= 40) {
                            $range_label = '31-40%';
                        } elseif ($percentage >= 41 && $percentage <= 50) {
                            $range_label = '41-50%';
                        } elseif ($percentage >= 51 && $percentage <= 60) {
                            $range_label = '51-60%';
                        } elseif ($percentage >= 61 && $percentage <= 70) {
                            $range_label = '61-70%';
                        } elseif ($percentage >= 71 && $percentage <= 80) {
                            $range_label = '71-80%';
                        } elseif ($percentage >= 81 && $percentage <= 90) {
                            $range_label = '81-90%';
                        } elseif ($percentage >= 91 && $percentage <= 95) {
                            $range_label = '91-95%';
                        } elseif ($percentage >= 96 && $percentage <= 99) {
                            $range_label = '96-99%';
                        } elseif ($percentage == 100) {
                            $range_label = '100%';
                        } else {
                            // This handles any edge cases, e.g., 0% or invalid values.
                            continue;
                        }

                        // Add district to the corresponding percentage range
                        $percentages[$range_label][] = $district;
                    }
                    ?>
                </h4>
                <h3>Districts Categorized by Schemes Completed Percentage</h3>
                <h4>
                    <table class="table table-bordered">
                        <tr>
                            <?php foreach ($percentages as $range => $districts) { ?>
                                <th style="text-align:center"><?php echo $range; ?></th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <?php foreach ($percentages as $range => $districts) { ?>
                                <th style="text-align:center; color:black">
                                    <ol style="font-size:10px; color:black">
                                        <?php foreach ($districts as $district) { ?>
                                            <li><?php echo $district->district_name . " - <small>" . round($district->total - $district->completed_schemes) . "</small>"; ?></li>
                                        <?php } ?>
                                    </ol>
                                </th>
                            <?php } ?>
                        </tr>
                    </table>
                </h4>
                FY Wise Cheques Remaining
                <table class="table table-bordered">
                    <tr>
                        <th>FY</th>
                        <?php
                        $query = "SELECT * FROM financial_years";
                        $financial_years = $this->db->query($query)->result();
                        foreach ($financial_years as $fy) {
                        ?>
                            <th><?php echo $fy->financial_year ?></th>
                        <?php } ?>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <th>Remaining Cheques</th>
                        <?php
                        $query = "SELECT * FROM financial_years";
                        $financial_years = $this->db->query($query)->result();
                        foreach ($financial_years as $fy) {
                            $remaining_cheques = $this->db->query("
                        SELECT COUNT(*) AS total
                        FROM expenses
                        WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                        AND scheme_id IS NULL
                        AND financial_year_id = '{$fy->financial_year_id}'
                        ")->row()->total;
                        ?>
                            <td><?php echo $remaining_cheques; ?></td>
                        <?php } ?>
                        <td>
                            <?php
                            echo $remaining_cheques_total = $this->db->query("
                        SELECT COUNT(*) AS total
                        FROM expenses
                        WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                        AND scheme_id IS NULL
                        AND financial_year_id = '{$fy->financial_year_id}'
                        ")->row()->total;
                            ?>
                        </td>
                    </tr>
                </table>
                <h4>District Wise Data Reconciliation</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_db">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Region</th>
                                <th>District</th>
                                <th>Ongoing Schemes</th>
                                <th>Total Schemes</th>
                                <th>Schemes Completed</th>
                                <th>Completed Percentage</th>
                                <th>Total Cheques</th>
                                <th>Cheques Completed</th>
                                <th>Completed Percentage</th>
                                <th>Remaining Cheques</th>

                                <?php
                                $query = "SELECT * FROM financial_years";
                                $financial_years = $this->db->query($query)->result();
                                foreach ($financial_years as $fy) {
                                ?>
                                    <th><?php echo $fy->financial_year ?></th>
                                <?php } ?>
                                <th>Last Activity</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Get regions
                            $regions = $this->db->query("SELECT DISTINCT region 
                        FROM districts WHERE is_district = 1")->result();
                            $count = 1;
                            foreach ($regions as $index => $region) {
                                // Get districts for each region
                                $districts = $this->db->query("
                        SELECT d.district_name, d.district_id, d.region
                        FROM districts AS d
                        WHERE d.is_district = 1 AND d.region = '{$region->region}'
                        ORDER BY d.district_name
                    ")->result();

                                foreach ($districts as $district) {
                                    // Get total and completed schemes

                                    $ongoing_scheme = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM schemes
                    WHERE scheme_status IN ('Ongoing', 'ICR-I', 'ICR-II', 'Final')
                    AND component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                     ")->row()->total;

                                    $scheme_total = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM schemes
                    WHERE scheme_status IN ('Completed', 'Par-Completed')
                    AND component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                                    $completed_schemes = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM schemes
                    WHERE scheme_status = 'Completed'
                    AND component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                                    // Get total and completed cheques
                                    $total_cheques = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM expenses
                    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                                    $completed_cheques = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM expenses
                    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND scheme_id IS NOT NULL
                    AND district_id = '{$district->district_id}'
                ")->row()->total;
                                    $remaining_cheques = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM expenses
                    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND scheme_id IS  NULL
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                                    $last_updated = $this->db->query("
                    SELECT MAX(`last_updated`) as last_updated
                    FROM schemes
                    WHERE district_id = '{$district->district_id}'
                ")->row()->last_updated;
                                    // Calculate percentages
                                    $completed_scheme_percentage = ($scheme_total > 0) ? round(($completed_schemes * 100) / $scheme_total, 2) : 0;
                                    $completed_cheque_percentage = ($total_cheques > 0) ? round(($completed_cheques * 100) / $total_cheques, 2) : 0;
                            ?>
                                    <tr>
                                        <th><?php echo $count++; ?></th>
                                        <td><?php echo $district->region; ?></td>
                                        <td><?php echo $district->district_name; ?></td>
                                        <th><?php echo $ongoing_scheme; ?></th>
                                        <td><?php echo $scheme_total; ?></td>
                                        <td><?php echo $completed_schemes; ?></td>
                                        <td><?php echo $completed_scheme_percentage . "%"; ?></td>
                                        <td><?php echo $total_cheques; ?></td>
                                        <td><?php echo $completed_cheques; ?></td>
                                        <td><?php echo $completed_cheque_percentage . "%"; ?></td>
                                        <td><?php echo $remaining_cheques; ?></td>
                                        <?php
                                        $query = "SELECT * FROM financial_years";
                                        $financial_years = $this->db->query($query)->result();
                                        foreach ($financial_years as $fy) {
                                            $remaining_cheques = $this->db->query("
                                        SELECT COUNT(*) AS total
                                        FROM expenses
                                        WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                                        AND scheme_id IS NULL
                                        AND financial_year_id = '{$fy->financial_year_id}'
                                        AND district_id = '{$district->district_id}'
                                        ")->row()->total;
                                        ?>
                                            <td><?php echo $remaining_cheques; ?></td>
                                        <?php } ?>
                                        <th><?php echo date('d M, Y h:m:s', strtotime($last_updated)); ?></th>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>



        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<?php $table_title = 'Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
    title = 'Progress Report';
    $(document).ready(function() {
        var t = $('#table_db').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [], // No initial sorting
            "ordering": true,
            searching: true,
            columnDefs: [{
                targets: [0], // Disable sorting for the first column (index 0)
                orderable: false
            }],
            buttons: [{
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'
                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'
                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'
                }
            ]
        });
        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
    setInterval(function() {
        location.reload();
    }, 300000); // 300000 milliseconds = 5 minutes
</script>