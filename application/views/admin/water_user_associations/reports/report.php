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

                <div class="col-md-3">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-9">
                    <table class="table table-bordered table_small" style="margin-top: -30px;">
                        <tr>
                            <th>Scheme Status</th>
                            <?php $query = "SELECT * FROM component_categories as cc 
                            WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                            $categories = $this->db->query($query)->result();
                            foreach ($categories as $category) { ?>
                                <th style="text-align: center;">
                                    <span class="pop-left" style="cursor: pointer;"
                                        data-content="<?php echo $category->category_detail; ?>" data-original-title=""
                                        title=""><?php echo $category->category; ?></span>
                                </th>
                            <?php } ?>
                            <th>Total</th>
                        </tr><?php
                                $query = "SELECT scheme_status, COUNT(scheme_status) as total FROM schemes ";
                                if ($district_id) {
                                    $query .= " WHERE district_id = $district_id";
                                }
                                $query .= " GROUP BY scheme_status";
                                $schemes_status = $this->db->query($query)->result();
                                foreach ($schemes_status as $scheme_status) { ?>
                            <tr>
                                <th style="text-align: right;"><?php echo $scheme_status->scheme_status ?></th>
                                <?php $query = "SELECT * FROM component_categories as cc 
                                    WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";

                                    $categories = $this->db->query($query)->result();
                                    foreach ($categories as $category) { ?>
                                    <td class="scheme_status" style="text-align: center;"><?php
                                                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                            WHERE s.component_category_id = $category->component_category_id
                                            AND s.scheme_status = '" . $scheme_status->scheme_status . "'";
                                                                                            if ($district_id) {
                                                                                                $query .= " AND district_id = $district_id";
                                                                                            }
                                                                                            echo $this->db->query($query)->row()->total;
                                                                                            ?></td>
                                <?php } ?>
                                <th style="text-align: center;"><?php
                                                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                            WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                            AND s.scheme_status = '" . $scheme_status->scheme_status . "'";
                                                                if ($district_id) {
                                                                    $query .= " AND district_id = $district_id";
                                                                }
                                                                echo $this->db->query($query)->row()->total;
                                                                ?></th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th>Total</th>
                            <?php $query = "SELECT * FROM component_categories as cc 
                            WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                            $categories = $this->db->query($query)->result();
                            foreach ($categories as $category) { ?>
                                <td class="scheme_status_total" style="text-align: center;"><?php
                                                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id";
                                                                                            if ($district_id) {
                                                                                                $query .= " AND district_id = $district_id";
                                                                                            }
                                                                                            echo $this->db->query($query)->row()->total;
                                                                                            ?></td>
                            <?php } ?>
                            <th style="text-align: center;"><?php
                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $this->db->query($query)->row()->total;
                                                            ?></th>
                        </tr>
                    </table>
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

                <h4>Category Wise Data Reconciliation</h4>
                <table class="table table-bordered table_small">
                    <tr>
                        <th></th>
                        <th></th>

                        <th style="text-align: center;" colspan="3">Finance Cheque Counts</th>
                        <th></th>
                        <th style="text-align: center;" colspan="8">Scheme Status</th>
                        <th></th>
                        <th style="text-align: center;" colspan="3">Scheme Reconciliation</th>
                    </tr>
                    <tr>
                        <th>Component</th>
                        <th>Detail</th>
                        <th>Total</th>
                        <th>Corrected</th>
                        <th>Remaining</th>
                        <th></th>
                        <?php
                        $schemes_status = array("Par-Completed", "Registered", "Initiated", "Ongoing", "ICR-I", "ICR-II", "FCR", "Completed");
                        foreach ($schemes_status as $scheme_status) { ?>
                            <th style="text-align: center;"><?php echo $scheme_status; ?></th>
                        <?php } ?>
                        <th></th>
                        <th>SFT Completed</th>
                        <th>Finance Completed</th>
                        <th>Difference</th>
                    </tr>
                    <?php
                    // Query all component categories
                    $query = "SELECT * FROM component_categories as cc 
                    WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                    $categories = $this->db->query($query)->result();
                    foreach ($categories as $category) { ?>
                        <tr>
                            <th>
                                <?php echo $category->category; ?>:
                            </th>
                            <th><?php echo $category->category_detail; ?></th>
                            <th>
                                <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id = $category->component_category_id";
                                if ($district_id) {
                                    $query .= " AND e.district_id = $district_id";
                                }
                                $cat_cheques = $this->db->query($query)->row();
                                echo $cat_cheques->total;
                                ?>
                            </th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id = $category->component_category_id
                                                AND e.scheme_id IS NOT NULL";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_not_use_cheques = $this->db->query($query)->row();

                            ?>
                            <th>
                                <?php echo $cat_not_use_cheques->total; ?>
                            </th>
                            <th><?php echo $cat_cheques->total - $cat_not_use_cheques->total; ?></th>
                            <th style="width: 20px;"></th>

                            <?php
                            // Populate cell values for each scheme status
                            foreach ($schemes_status as $scheme_status) { ?>
                                <td class="scheme_ status" style="text-align: center;"><?php
                                                                                        $query = "SELECT COUNT(*) as total FROM schemes as s 
                              WHERE s.component_category_id = $category->component_category_id
                              AND s.scheme_status = '" . $scheme_status . "'";
                                                                                        if ($district_id) {
                                                                                            $query .= " AND district_id = $district_id";
                                                                                        }
                                                                                        echo $this->db->query($query)->row()->total;
                                                                                        ?></td>
                            <?php } ?>
                            <th style="width: 20px;"></th>
                            <th style="text-align: center;"><?php
                                                            // Total for this category across all scheme statuses
                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                          WHERE s.component_category_id = $category->component_category_id
                           AND scheme_status IN ('Completed', 'Par-Completed') ";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $sft_completed = $this->db->query($query)->row()->total;
                                                            ?></th>
                            <th style="text-align: center;"><?php
                                                            // Total for this category across all scheme statuses
                                                            $query = "SELECT COUNT(*) as total FROM expenses as e
                          WHERE e.component_category_id = $category->component_category_id
                          AND e.installment = 'Final' ";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $finance_completed  = $this->db->query($query)->row()->total;
                                                            ?></th>
                            <th style="text-align: center;"><?php echo $sft_completed - $finance_completed; ?></th>

                        </tr>
                    <?php } ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_cheques = $this->db->query($query)->row();
                            echo $cat_cheques->total;
                            ?>
                        </th>
                        <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                 AND e.scheme_id IS NULL";
                        if ($district_id) {
                            $query .= " AND e.district_id = $district_id";
                        }
                        $cat_not_user_cheques = $this->db->query($query)->row();

                        ?>

                        <th><?php echo $cat_cheques->total - $cat_not_user_cheques->total; ?></th>
                        <th><?php echo $cat_not_user_cheques->total; ?></th>
                        <th></th>
                        <?php
                        // Total for each scheme status across all component categories
                        foreach ($schemes_status as $scheme_status) { ?>
                            <td style="text-align: center;"><?php
                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                          WHERE s.scheme_status = '" . $scheme_status . "'
                          AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $this->db->query($query)->row()->total;
                                                            ?></td>
                        <?php } ?>
                        <th></th>
                        <th style="text-align: center;"><?php
                                                        // Grand total for all categories and statuses
                                                        $query = "SELECT COUNT(*) as total FROM schemes as s 
                      WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                      AND scheme_status IN ('Completed', 'Par-Completed')  ";
                                                        if ($district_id) {
                                                            $query .= " AND district_id = $district_id";
                                                        }
                                                        echo $sft_completed_total = $this->db->query($query)->row()->total;
                                                        ?></th>
                        <th style="text-align: center;"><?php
                                                        // Grand total for all categories and statuses
                                                        $query = "SELECT COUNT(*) as total FROM expenses as e 
                      WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                      AND installment = 'Final'";
                                                        if ($district_id) {
                                                            $query .= " AND e.district_id = $district_id";
                                                        }
                                                        echo $finance_completed_total = $this->db->query($query)->row()->total;
                                                        ?></th>
                        <th style="text-align:center"><?php echo  $sft_completed_total - $finance_completed_total; ?></th>
                    </tr>
                </table>





                <h4>Financial Year Wise Data Reconciliation</h4>
                <table class="table table-bordered table_small">
                    <tr>
                        <th></th>
                        <th style="text-align: center;" colspan="3">Finance Cheque Counts</th>
                        <th></th>
                        <th style="text-align: center;" colspan="8">Scheme Status</th>
                        <th></th>
                        <th style="text-align: center;" colspan="3">Scheme Reconciliation</th>
                    </tr>
                    <tr>
                        <th>Financial Years</th>
                        <th>Total</th>
                        <th>Corrected</th>
                        <th>Remaining</th>
                        <th></th>
                        <?php
                        $schemes_status = array("Par-Completed", "Registered", "Initiated", "Ongoing", "ICR-I", "ICR-II", "FCR", "Completed");
                        foreach ($schemes_status as $scheme_status) { ?>
                            <th style="text-align: center;"><?php echo $scheme_status; ?></th>
                        <?php } ?>
                        <th></th>
                        <th>SFT Completed</th>
                        <th>Finance Completed</th>
                        <th>Difference</th>
                    </tr>
                    <?php
                    // Query all component categories
                    $query = "SELECT * FROM financial_years";
                    $fys = $this->db->query($query)->result();
                    foreach ($fys as $fy) { ?>
                        <tr>
                            <th>
                                <?php echo $fy->financial_year; ?>:
                            </th>
                            <th>
                                <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.financial_year_id = $fy->financial_year_id
                                                AND e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12) ";
                                if ($district_id) {
                                    $query .= " AND e.district_id = $district_id";
                                }
                                $cat_cheques = $this->db->query($query)->row();
                                echo $cat_cheques->total;
                                ?>
                            </th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.financial_year_id = $fy->financial_year_id
                                                AND e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                AND e.scheme_id IS NOT NULL";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_not_use_cheques = $this->db->query($query)->row();

                            ?>
                            <th>
                                <?php echo $cat_not_use_cheques->total; ?>
                            </th>
                            <th><?php echo $cat_cheques->total - $cat_not_use_cheques->total; ?></th>
                            <th style="width: 20px;"></th>

                            <?php
                            // Populate cell values for each scheme status
                            foreach ($schemes_status as $scheme_status) { ?>
                                <td class="scheme_ status" style="text-align: center;"><?php
                                                                                        $query = "SELECT COUNT(*) as total FROM schemes as s 
                                                                                        WHERE s.financial_year_id = $fy->financial_year_id
                                                                                        AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                                                        AND s.scheme_status = '" . $scheme_status . "'";
                                                                                        if ($district_id) {
                                                                                            $query .= " AND district_id = $district_id";
                                                                                        }
                                                                                        echo $this->db->query($query)->row()->total;
                                                                                        ?></td>
                            <?php } ?>
                            <th style="width: 20px;"></th>
                            <th style="text-align: center;"><?php
                                                            // Total for this category across all scheme statuses
                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                                            WHERE s.financial_year_id = $fy->financial_year_id
                                                            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                            AND scheme_status IN ('Completed', 'Par-Completed') ";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $sft_completed = $this->db->query($query)->row()->total;
                                                            ?></th>
                            <th style="text-align: center;"><?php
                                                            // Total for this category across all scheme statuses
                                                            $query = "SELECT COUNT(*) as total FROM expenses as e
                                                            WHERE e.financial_year_id = $fy->financial_year_id
                                                            AND e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                            AND e.installment = 'Final' ";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $finance_completed  = $this->db->query($query)->row()->total;
                                                            ?></th>
                            <th style="text-align: center;"><?php echo  $sft_completed - $finance_completed; ?></th>

                        </tr>
                    <?php } ?>
                    <tr>
                        <th></th>
                        <th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_cheques = $this->db->query($query)->row();
                            echo $cat_cheques->total;
                            ?>
                        </th>
                        <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                 AND e.scheme_id IS NULL";
                        if ($district_id) {
                            $query .= " AND e.district_id = $district_id";
                        }
                        $cat_not_user_cheques = $this->db->query($query)->row();

                        ?>

                        <th><?php echo $cat_cheques->total - $cat_not_user_cheques->total; ?></th>
                        <th><?php echo $cat_not_user_cheques->total; ?></th>
                        <th></th>
                        <?php
                        // Total for each scheme status across all component categories
                        foreach ($schemes_status as $scheme_status) { ?>
                            <td style="text-align: center;"><?php
                                                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                          WHERE s.scheme_status = '" . $scheme_status . "'
                          AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                                            if ($district_id) {
                                                                $query .= " AND district_id = $district_id";
                                                            }
                                                            echo $this->db->query($query)->row()->total;
                                                            ?></td>
                        <?php } ?>
                        <th></th>
                        <th style="text-align: center;"><?php
                                                        // Grand total for all categories and statuses
                                                        $query = "SELECT COUNT(*) as total FROM schemes as s 
                      WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                      AND scheme_status IN ('Completed', 'Par-Completed') ";
                                                        if ($district_id) {
                                                            $query .= " AND district_id = $district_id";
                                                        }
                                                        echo $sft_completed_total = $this->db->query($query)->row()->total;
                                                        ?></th>
                        <th style="text-align: center;"><?php
                                                        // Grand total for all categories and statuses
                                                        $query = "SELECT COUNT(*) as total FROM expenses as e 
                      WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                      AND installment = 'Final'";
                                                        if ($district_id) {
                                                            $query .= " AND e.district_id = $district_id";
                                                        }
                                                        echo $finance_completed_total = $this->db->query($query)->row()->total;
                                                        ?></th>
                        <th style="text-align:center"><?php echo  $sft_completed_total - $finance_completed_total; ?></th>
                    </tr>
                </table>


                <h4>Completed Scheme Average Cost</h4>
                <table class="table table-bordered table_small">
                    <tr>
                        <th></th>
                        <?php
                        // Query all financial years to display as columns
                        $query = "SELECT * FROM financial_years";
                        $fys = $this->db->query($query)->result();
                        foreach ($fys as $fy) { ?>
                            <th style="text-align: center;" colspan="3"><?php echo $fy->financial_year; ?></th>
                        <?php } ?>
                        <th style="text-align: center;" colspan="3">Total</th>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <?php
                        // Add sub-headers for Schemes, Cost, and AVG Cost under each financial year
                        foreach ($fys as $fy) { ?>
                            <th>Schemes</th>
                            <th>Cost</th>
                            <th>AVG.</th>
                        <?php } ?>
                        <th>Schemes</th>
                        <th>Cost</th>
                        <th>AVG.</th>
                    </tr>
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

                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
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

                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            $category_scheme = $this->db->query($query)->row();
                            ?>

                            <th style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></th>
                            <th><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></th>
                            <th><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></th>

                        </tr>
                    <?php } ?>

                    <tbody>
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

                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
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

                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            $category_scheme = $this->db->query($query)->row();
                            ?>

                            <th style="text-align: center;"><?php echo $category_scheme->total_schemes > 0 ? number_format($category_scheme->total_schemes) : '' ?></th>
                            <th><?php echo $category_scheme->total_cost > 0 ? number_format(round($category_scheme->total_cost, 2)) : ''; ?></th>
                            <th><?php echo $category_scheme->avg_cost > 0 ? number_format(round($category_scheme->avg_cost, 2)) : ''; ?></th>

                        </tr>
                    </tbody>
                </table>

                <h4>Completed Scheme and Final Payment</h4>
                <table class="table table-bordered table_small">
                    <tr>
                        <th>Financial Years</th>
                        <th>Schemes Completed</th>
                        <?php
                        // Query all financial years to display as columns
                        $query = "SELECT * FROM financial_years";
                        $fys = $this->db->query($query)->result();
                        foreach ($fys as $fy) { ?>
                            <th style="text-align: center;"><?php echo $fy->financial_year; ?></th>
                        <?php } ?>

                    </tr>
                    <tbody>
                        <?php
                        foreach ($fys as $fy) { ?>
                            <tr>
                                <th><?php echo $fy->financial_year; ?></th>
                                <th>
                                    <?php $query = "
                                    SELECT COUNT(s.scheme_id) AS total_schemes FROM
                                    schemes AS s WHERE
                                    s.financial_year_id = '" . intval($fy->financial_year_id) . "'
                                    AND s.scheme_status = 'Completed'";
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
                                    $scheme = $this->db->query($query)->row();
                                    echo $scheme->total_schemes;
                                    ?>
                                </th>
                                <?php
                                $query = "SELECT * FROM financial_years";
                                $fy_expenses = $this->db->query($query)->result();
                                foreach ($fy_expenses as $fy_expens) { ?>
                                    <th style="text-align: center;">
                                        <?php $query = "
                                    SELECT COUNT(s.scheme_id) AS total_schemes FROM
                                    schemes AS s 
                                    INNER JOIN expenses as e ON(e.scheme_id = s.scheme_id)
                                    WHERE
                                    s.financial_year_id = '" . intval($fy->financial_year_id) . "'
                                    AND e.financial_year_id = '" . intval($fy_expens->financial_year_id) . "'
                                    AND e.installment = 'Final'
                                    AND s.scheme_status IN('Completed')";
                                        if ($district_id) {
                                            $query .= " AND e.district_id = $district_id";
                                        }
                                        $last_payment = $this->db->query($query)->row();
                                        echo $last_payment->total_schemes;
                                        ?>
                                    </th>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>