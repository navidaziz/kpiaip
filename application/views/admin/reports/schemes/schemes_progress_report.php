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
                        <th></th>
                        <th></th>
                        <th style="text-align: center;" colspan="7">Current FY (
                            <?php
                            $query = "SELECT * FROM `financial_years` WHERE `status`=1";
                            $current_fy = $this->db->query($query)->row();
                            if ($current_fy) {
                                echo $current_fy->financial_year;
                            }

                            ?>
                            )</th>
                        <th></th>

                    </tr>
                    <tr>
                        <th></th>
                        <th></th>

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
                    // Query all component categories
                    $district_id = NULL;
                    $query = "SELECT * FROM component_categories as cc 
                    WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                    $categories = $this->db->query($query)->result();
                    foreach ($categories as $category) { ?>
                        <tr>
                            <th>
                                <?php echo $category->category; ?>:
                            </th>
                            <th><?php echo $category->category_detail; ?></th>

                            <td class="scheme_ status" style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.scheme_status = 'Completed'
                                    AND s.financial_year_id < $current_fy->financial_year_id";
                                if ($district_id) {
                                    $query .= " AND district_id = $district_id";
                                }
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
                                $query = "SELECT COUNT(*) as total FROM `water_user_associations` 
                                WHERE  wua_registration_date between $current_fy->start_date and $current_fy->end_date ";
                                $wua = $this->db->query($query)->row();
                                if ($awp) {
                                    echo $wua->total;
                                }
                                ?>
                            </td>

                            <?php
                            // Populate cell values for each scheme status
                            foreach ($ongoing_schemes_status as $ongoing_scheme_status) { ?>
                                <td class="scheme_ status" style="text-align: center;">
                                    <?php
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.scheme_status = '" . $ongoing_scheme_status . "'";
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
                                if ($district_id) {
                                    $query .= " AND district_id = $district_id";
                                }
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </td>
                            <td class="scheme_ status" style="text-align: center;">
                                <?php
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id
                                    AND s.scheme_status = 'Completed'";
                                if ($district_id) {
                                    $query .= " AND district_id = $district_id";
                                }
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </td>


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