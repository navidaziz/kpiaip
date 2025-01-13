<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px !important;
        color: black;
        margin: 0px !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        /* border: 1px solid black !important; */
    }

    .table_s_small>thead>tr>th,
    .table_s_small>tbody>tr>th,
    .table_s_small>tfoot>tr>th,
    .table_s_small>thead>tr>td,
    .table_s_small>tbody>tr>td,
    .table_s_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->

            <!-- /BREADCRUMBS -->
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

    .tax_paid {
        color: green !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax_unpaid {
        color: red !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax {
        /* background-color: #f4f4f4; */
    }
</style>


<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <?php
                        $query = "SELECT COUNT(*) AS completed_schemes FROM scheme_lists 
                        WHERE scheme_status = 'Completed'";
                        $completed_schemes = $this->db->query($query)->row()->completed_schemes;
                        ?>
                        <h5><?php echo $description; ?> of Completed Schemes: <?php echo $completed_schemes; ?></h5>
                    </div>

                    <table class="table table-bordered table_small" id="data_table">
                        <thead>
                            <tr>
                                <th></th>
                                <?php
                                // Query all financial years to display as columns
                                $query = "SELECT * FROM financial_years";
                                $fys = $this->db->query($query)->result();
                                foreach ($fys as $fy) { ?>
                                    <th style="text-align: center;"><?php echo $fy->financial_year; ?></th>
                                    <th></th>
                                    <th></th>
                                <?php } ?>
                                <th style="text-align: center;">Over All</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <?php
                                // Add sub-headers for Schemes, Cost, and AVG Cost under each financial year
                                foreach ($fys as $fy) { ?>
                                    <th>Total Schemes</th>
                                    <th>Total Cost</th>
                                    <th>AVG. Cost</th>
                                <?php } ?>
                                <th>Schemes</th>
                                <th>Cost</th>
                                <th>AVG.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query all component categories to display as rows
                            $query = "SELECT * FROM component_categories as cc
                         WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                            $categories = $this->db->query($query)->result();

                            foreach ($categories as $category) { ?>
                                <tr>
                                    <th><?php echo $category->category; ?>: </th>
                                    <?php
                                    // Loop over each financial year for each category
                                    foreach ($fys as $fy) {
                                        $query = "
                                    SELECT 
                                        COUNT(*) AS total_schemes,
                                        SUM(paid) AS total_cost,
                                        AVG(paid) AS avg_cost
                                    FROM 
                                        scheme_lists AS s
                                        WHERE s.component_category_id = '" . intval($category->component_category_id) . "' 
                                        AND s.financial_year = '" . $fy->financial_year . "' 
                                        AND s.scheme_status = 'Completed'
                                ";


                                        $category_scheme = $this->db->query($query)->row();
                                    ?>

                                        <td style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></td>
                                        <td><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></td>
                                        <td><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></td>
                                    <?php } ?>
                                    <?php
                                    $query = "
                            SELECT 
                                        COUNT(*) AS total_schemes,
                                        SUM(paid) AS total_cost,
                                        AVG(paid) AS avg_cost
                                    FROM 
                                        scheme_lists AS s
                                        WHERE s.component_category_id = '" . intval($category->component_category_id) . "'
                                        AND s.scheme_status = 'Completed'
                            ";


                                    $category_scheme = $this->db->query($query)->row();
                                    ?>

                                    <th style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></th>
                                    <th><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></th>
                                    <th><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></th>

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: right;">Total</th>
                                <?php
                                // Loop over each financial year for each category
                                foreach ($fys as $fy) {
                                    $query = "
                                    SELECT 
                                        COUNT(*) AS total_schemes,
                                        SUM(paid) AS total_cost,
                                        AVG(paid) AS avg_cost
                                    FROM 
                                        scheme_lists AS s 
                                        WHERE s.financial_year = '" . $fy->financial_year . "' 
                                        AND s.scheme_status = 'Completed'
                                ";
                                    $category_scheme = $this->db->query($query)->row();
                                ?>

                                    <th style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></th>
                                    <th><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></th>
                                    <th><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></th>
                                <?php } ?>
                                <?php
                                $query = "
                            SELECT 
                                        COUNT(*) AS total_schemes,
                                        SUM(paid) AS total_cost,
                                        AVG(paid) AS avg_cost
                                    FROM 
                                        scheme_lists AS s
                                        WHERE  s.scheme_status = 'Completed'
                            ";


                                $category_scheme = $this->db->query($query)->row();
                                ?>

                                <th style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></th>
                                <th><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></th>
                                <th><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></th>

                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $description . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                // {
                //     extend: 'pdfHtml5',
                //     title: title,
                //     pageSize: 'A4',
                //     //orientation: 'landscape',
                //     messageTop: '<?php echo $title; ?>'

                // }
            ]
        });
    });
</script>