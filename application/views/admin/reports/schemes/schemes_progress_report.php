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
                    <div class="col-md-6">
                        <div class="clearfix">
                            <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                        </div>
                        <div class="description"><?php echo $description; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <script>
                            document.getElementById('exportButton').addEventListener('click', function() {
                                var table = document.getElementById("schemesTable"); // Get the table element
                                var wb = XLSX.utils.table_to_book(table, {
                                    sheet: "Sheet 1"
                                }); // Convert the table to Excel
                                XLSX.writeFile(wb, "cs_dist_fy_and_catgories_wise" + Date.now() + ".xlsx"); // Download the Excel file
                            });
                        </script>

                        <form id="filter" action="<?php echo site_url(ADMIN_DIR . "reports/schemes_progress_report"); ?>" method="post">

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Financial Year</th>
                                    <th>Districts</th>
                                    <th>Filter</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        $query = "SELECT * FROM financial_years";
                                        $fys = $this->db->query($query)->result();
                                        ?>
                                        <select class="form-control" name="financial_year_id" id="financial_year_id">
                                            <?php foreach ($fys as $fy) { ?>
                                                <option <?php if ($fy->financial_year_id == $current_fy->financial_year_id) { ?> selected <?php } ?> value="<?php echo $fy->financial_year_id; ?>"><?php echo $fy->financial_year; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>

                                    <td>
                                        <?php
                                        $query = "SELECT d.district_name, d.district_id  FROM  districts as d 
                                    WHERE is_district = 1
                                    GROUP BY d.district_name";
                                        $districts = $this->db->query($query)->result();
                                        ?>
                                        <select class="form-control" name="district_id" id="district_id">
                                            <option value="">All Districts</option>
                                            <?php foreach ($districts as $district) { ?>
                                                <option <?php if ($district_id == $district->district_id) { ?> selected <?php } ?> value="<?php echo $district->district_id; ?>"><?php echo $district->district_name; ?></option>
                                            <?php } ?>
                                        </select>

                                    </td>


                                    <td><button class="btn btn-danger" type="submit">Filter</button></td>
                                    <th> <button id="exportButton" class="btn btn-primary btn-sm">Export to Excel</button></th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .vertical-text-up {
        writing-mode: vertical-rl;
        /* vertical text, right to left */
        transform: rotate(180deg);
        /* flip it to go bottom to top */
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">



                <table class="table table-bordered table_small" id="schemesTable" style="font-size: 12px !important;">
                    <tr>
                        <th></th>
                        <th colspan="2">
                            <h5><strong>
                                    <?php if ($district_id) {
                                        $query = "SELECT * FROM districts WHERE district_id = ?";
                                        $district = $this->db->query($query, [$district_id])->row();

                                    ?>
                                        Filter By District: <?php echo $district->district_name; ?>
                                    <?php } else { ?>
                                        All Districts
                                    <?php } ?>
                                </strong></h5>
                        </th>
                        <th></th>
                        <th style="text-align: center;" colspan="7">
                            <h5><strong>
                                    <?php if ($current_fy->status == 1) { ?>
                                        Current
                                    <?php } ?>
                                    FY ( <?php echo $current_fy->financial_year; ?> ) </strong>
                            </h5>
                        </th>
                        <th></th>

                    </tr>
                    <tr>
                        <th>Comp.</th>
                        <th colspan="2" style="text-align: center;">Components Categories</th>

                        <th style="text-align: center;">Completed Upto (
                            <?php
                            $query = "SELECT * FROM financial_years 
                            WHERE financial_year_id < '" . $current_fy->financial_year_id . "' ORDER BY financial_year_id DESC LIMIT 1";
                            $previous_fy = $this->db->query($query)->row();
                            if ($previous_fy) {
                                echo $previous_fy->financial_year;
                            } else {
                                echo "N/A";
                            }
                            ?>
                            FYs)</th>
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
                        $r_count = 0;
                        $query = "SELECT * FROM component_categories as cc 
                            WHERE cc.component_id = $component->component_id";
                        $categories = $this->db->query($query)->result();
                        foreach ($categories as $category) { ?>
                            <tr>
                                <?php if ($r_count == 0) { ?>
                                    <th class="vertical-text-up"
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
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if ($district_id) {
                                        $query = "SELECT * FROM `district_annual_work_plans` 
                                        WHERE  financial_year_id= $current_fy->financial_year_id 
                                        AND  component_category_id= $category->component_category_id
                                        AND district_id = $district_id;";
                                        $awp = $this->db->query($query)->row();
                                        if ($awp) {
                                            echo $awp->anual_target;
                                        }
                                    } else {
                                        $query = "SELECT * FROM `annual_work_plans` 
                                        WHERE  financial_year_id= $current_fy->financial_year_id 
                                        AND  component_category_id= $category->component_category_id;";
                                        $awp = $this->db->query($query)->row();
                                        if ($awp) {
                                            echo $awp->anual_target;
                                        }
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT DISTINCT COUNT(water_user_association_id) as total 
                                    FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.financial_year_id = $current_fy->financial_year_id";
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
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
                                            $query .= " AND s.district_id = $district_id";
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
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
                                    echo $this->db->query($query)->row()->total;
                                    ?>
                                </td>
                                <td class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.financial_year_id <= $current_fy->financial_year_id
                                    AND s.scheme_status = 'Completed'";
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
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
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>

                            <th>
                                <?php
                                if ($district_id) {
                                    $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `district_annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id 
                                    AND  component_id = $component->component_id
                                    AND district_id = $district_id;";
                                    $awp = $this->db->query($query)->row();
                                    if ($awp) {
                                        echo $awp->total_target;
                                    }
                                } else {
                                    $query = "SELECT SUM(anual_target) as total_target FROM `annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id 
                                    AND  component_id = $component->component_id";
                                    $awp = $this->db->query($query)->row();
                                    if ($awp) {
                                        echo $awp->total_target;
                                    }
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
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
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
                                    if ($district_id) {
                                        $query .= " AND s.district_id = $district_id";
                                    }
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
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
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
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }

                                echo $this->db->query($query)->row()->total;
                                ?>
                            </th>
                        </tr>
                    <?php } ?>

                    <tr>
                        <th colspan="3" style="text-align: right;"> Grand Total</th>

                        <th class="scheme_ status" style="text-align: center;">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                INNER JOIN components as c ON sc.component_id = c.component_id
                                    WHERE  s.scheme_status = 'Completed'
                                    AND s.financial_year_id < $current_fy->financial_year_id";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            echo $this->db->query($query)->row()->total;
                            ?>
                        </th>

                        <th>
                            <?php
                            if ($district_id) {
                                $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `district_annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id 
                                     AND district_id = $district_id;";
                                $awp = $this->db->query($query)->row();
                                if ($awp) {
                                    echo $awp->total_target;
                                }
                            } else {
                                $query = "SELECT SUM(anual_target) as total_target FROM `annual_work_plans` 
                                     WHERE  financial_year_id= $current_fy->financial_year_id ";
                                $awp = $this->db->query($query)->row();
                                if ($awp) {
                                    echo $awp->total_target;
                                }
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
                                    WHERE  s.financial_year_id = $current_fy->financial_year_id";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
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
                                    AND s.financial_year_id <= $current_fy->financial_year_id";
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
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
                                    AND s.financial_year_id = $current_fy->financial_year_id";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            echo $this->db->query($query)->row()->total;
                            ?>
                        </th>
                        <th class="scheme_ status" style="text-align: center;">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                   INNER JOIN component_categories as cc ON s.component_category_id = cc.component_category_id
                                INNER JOIN sub_components as sc ON cc.sub_component_id = sc.sub_component_id
                                INNER JOIN components as c ON sc.component_id = c.component_id
                                WHERE  s.scheme_status = 'Completed' 
                                AND s.financial_year_id <= $current_fy->financial_year_id";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }

                            echo $this->db->query($query)->row()->total;
                            ?>
                        </th>
                    </tr>


                </table>
                <br />
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <th colspan="<?php echo (count($fys) * 2) + 3; ?>">
                        <strong>
                            <?php if ($district_id) {
                                $query = "SELECT * FROM districts WHERE district_id = ?";
                                $district = $this->db->query($query, [$district_id])->row();

                            ?>
                                District: <?php echo $district->district_name; ?>
                            <?php } else { ?>
                                All Districts
                            <?php } ?>
                            Financial Years Wise Ongoing and Completed Schemes Summary: </strong>
                    </th>
                    <tr>
                        <th></th>
                        <?php foreach ($fys as $fy) { ?>
                            <th colspan="2" style="text-align: center;">FY - <?php echo $fy->financial_year; ?>
                                <?php if ($fy->status == '1') {
                                    echo '<span style="color:green">*</span>';
                                } ?>
                            </th>
                        <?php } ?>
                        <th style="text-align: center;" colspan="2">Total</th>
                    </tr>
                    <tr>
                        <th></th>
                        <?php foreach ($fys as $fy) { ?>
                            <th style="text-align: center;">Target</th>
                            <th style="text-align: center;">Achievement</th>
                        <?php } ?>
                        <th style="text-align: center;">Target</th>
                        <th style="text-align: center;">Achievement</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Ongoing</th>
                        <?php foreach ($fys as $fy) { ?>
                            <th></th>
                            <td style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                WHERE  s.scheme_status IN ('Sanctioned', 'Initiated', 'ICR-I', 'ICR-II') 
                                AND s.financial_year_id = $fy->financial_year_id";
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </td>

                        <?php } ?>
                        <th></th>
                        <th style="text-align: center;">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                WHERE  s.scheme_status IN ('Sanctioned', 'Initiated', 'ICR-I', 'ICR-II') ";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            echo $this->db->query($query)->row()->total;
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Completed</th>
                        <?php foreach ($fys as $fy) { ?>
                            <td style="text-align: center;">
                                <small>
                                    <?php
                                    if ($district_id) {
                                        $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `district_annual_work_plans` 
                                     WHERE  financial_year_id= $fy->financial_year_id 
                                     AND district_id = $district_id;";
                                        $awp = $this->db->query($query)->row();
                                        if ($awp) {
                                            echo $awp->total_target;
                                        }
                                    } else {
                                        $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `annual_work_plans` 
                                     WHERE  financial_year_id= $fy->financial_year_id ";
                                        $awp = $this->db->query($query)->row();
                                        if ($awp) {
                                            echo $awp->total_target;
                                        }
                                    }
                                    ?>
                                </small>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                WHERE  s.scheme_status IN ('Completed') 
                                AND s.financial_year_id = $fy->financial_year_id ";
                                if ($district_id) {
                                    $query .= " AND s.district_id = $district_id";
                                }
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </td>

                        <?php } ?>
                        <th style="text-align: center;">
                            <small>
                                <?php
                                if ($district_id) {
                                    $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `district_annual_work_plans` 
                                     WHERE district_id = $district_id;";
                                    $awp = $this->db->query($query)->row();
                                    if ($awp) {
                                        echo $awp->total_target;
                                    }
                                } else {
                                    $query = "SELECT SUM(anual_target) as total_target 
                                    FROM `annual_work_plans` ";
                                    $awp = $this->db->query($query)->row();
                                    if ($awp) {
                                        echo $awp->total_target;
                                    }
                                }
                                ?>
                            </small>
                        </th>
                        <th style="text-align: center;">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM schemes as s 
                                WHERE  s.scheme_status IN ('Completed') ";
                            if ($district_id) {
                                $query .= " AND s.district_id = $district_id";
                            }
                            echo $this->db->query($query)->row()->total;
                            ?>
                        </th>
                    </tr>
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