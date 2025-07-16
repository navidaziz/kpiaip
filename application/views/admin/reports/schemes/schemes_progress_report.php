<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>






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



<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th colspan="2"></th>
                        <th></th>
                        <th style="text-align: center;" colspan="7">
                            <strong> Current FY ( <?php echo $current_fy->financial_year; ?> ) </strong>
                        </th>
                        <th></th>

                    </tr>
                    <tr>
                        <th>Components</th>
                        <th colspan="2" style="text-align: center;">Components Categories</th>

                        <th style="text-align: center;">Completed (Previous FYs)</th>
                        <th>AWP Target</th>
                        <th>WUAs Registered</th>
                        <?php
                        $ongoing_schemes_status = array("Sanctioned", "Initiated", "ICR-I", "ICR-II");
                        foreach ($ongoing_schemes_status as $ongoing_scheme_status) { ?>
                            <th style="text-align: center;"><?php echo $ongoing_scheme_status; ?></th>
                        <?php } ?>
                        <th style="text-align: center;">Competed</th>
                        <th>Total intervention Completed Since Inception</th>

                    </tr>

                    <?php

                    $query = "SELECT * FROM `components` WHERE `component_id` IN(1,2)";
                    $components = $this->db->query($query)->result();
                    foreach ($components as $component) {
                        $district_id = NULL;
                        $r_count = 0;
                        $query = "SELECT * FROM component_categories as cc 
                            WHERE cc.component_id = $component->component_id";
                        $categories = $this->db->query($query)->result();
                        foreach ($categories as $category) { ?>
                            <tr>
                                <?php if ($r_count == 0) { ?>
                                    <th style="text-orientation: upright;"
                                        rowspan="<?php echo count($categories); ?>">

                                        <?php echo $component->component_name . ': ' . $component->component_detail; ?>
                                    </th>
                                <?php $r_count++;
                                }
                                ?>
                                <td>
                                    <?php echo $category->category; ?>:
                                </td>
                                <td><?php echo $category->category_detail; ?></td>

                                <td class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.scheme_status = 'Completed'
                                    AND s.financial_year_id < $current_fy->financial_year_id";
                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT * FROM `annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id 
                                    AND  component_category_id= $category->component_category_id;";
                                    $awp = $this->db->query($query)->row();
                                    if ($awp) {
                                        echo $awp->anual_target;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT DISTINCT COUNT(water_user_association_id) as total 
                                    FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.financial_year_id = $current_fy->financial_year_id";
                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>

                                <?php
                                // Populate cell values for each scheme status
                                foreach ($ongoing_schemes_status as $ongoing_scheme_status) { ?>
                                    <td class="scheme_ status" style="text-align: center;">
                                        <?php
                                        $query = "SELECT COUNT(*) as total FROM schemes as s 
                                        WHERE s.component_category_id = $category->component_category_id
                                        AND s.scheme_status = '" . $ongoing_scheme_status . "'
                                        AND s.financial_year_id <= $current_fy->financial_year_id";
                                        if ($district_id) {
                                            $query .= " AND district_id = $district_id";
                                        }
                                        echo $this->db->query($query)->row()->total;
                                        ?></td>
                                <?php } ?>

                                <td class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.scheme_status = 'Completed'
                                    AND s.financial_year_id = $current_fy->financial_year_id";

                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>
                                <td class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.financial_year_id <= $current_fy->financial_year_id
                                    AND s.scheme_status = 'Completed'";

                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>
                            </tr>

                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align: right;"> Total</th>

                            <th class="scheme_ status" style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                INNER JOIN components as c ON sc.component_id = c.component_id
                                    WHERE c.component_id = $component->component_id
                                    AND s.scheme_status = 'Completed'
                                    AND s.financial_year_id < $current_fy->financial_year_id";
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>

                            <th>
                                <?php
                                $query = "SELECT SUM(anual_target) as total_target FROM `annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id 
                                    AND  component_id = $component->component_id";
                                $awp = $this->db->query($query)->row();
                                if ($awp) {
                                    echo $awp->total_target;
                                }
                                ?>
                            </th>

                            <th>
                                <?php
                                $query = "SELECT DISTINCT COUNT(water_user_association_id) as total 
                                    FROM schemes as s 
                                    INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                    INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                    INNER JOIN components as c ON sc.component_id = c.component_id
                                    WHERE  c.component_id = $component->component_id
                                    AND s.financial_year_id = $current_fy->financial_year_id";
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>

                            <?php
                            // Populate cell values for each scheme status
                            foreach ($ongoing_schemes_status as $ongoing_scheme_status) { ?>
                                <th class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                   INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                   INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                   INNER JOIN components as c ON sc.component_id = c.component_id
                                    WHERE s.scheme_status = '" . $ongoing_scheme_status . "'
                                    AND c.component_id = $component->component_id
                                    AND s.financial_year_id <= $current_fy->financial_year_id";
                                    echo $this->db->query($query)->row()->total;
                                    ?></th>
                            <?php } ?>

                            <th class="scheme_ status" style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                   INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                INNER JOIN components as c ON sc.component_id = c.component_id
                                    AND s.scheme_status = 'Completed'
                                    AND c.component_id = $component->component_id
                                    AND s.financial_year_id = $current_fy->financial_year_id";

                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>
                            <th class="scheme_ status" style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                   INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                INNER JOIN components as c ON sc.component_id = c.component_id
                                WHERE  s.scheme_status = 'Completed' AND c.component_id = $component->component_id
                                AND s.financial_year_id <= $current_fy->financial_year_id";

                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>
                        </tr>
                    <?php } ?>

                </table>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        var table = document.getElementById("schemesTable"); // Get the table element
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        }); // Convert the table to Excel
        XLSX.writeFile(wb, "district_fy_schemes_counts_" + Date.now() + ".xlsx"); // Download the Excel file
    });
</script>