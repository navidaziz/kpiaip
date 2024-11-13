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
                    <div class="description"><?php echo $description;
                                                ?></div>
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
                <div class="header-tabs">

                    <ul class="nav nav-tabs">
                        <?php
                        // Define the schemes statuses array
                        $schemes = array(
                            "Completed",
                            "Final",
                            "ICR-II",
                            "ICR-I",
                            "Ongoing",
                            "Initiated",
                            "Registered",
                            "Par-Completed",
                            "Disputed",
                            "Not Approved"
                        );

                        // Loop through each scheme status
                        foreach ($schemes as $scheme_status) {
                            // Build the query to count the total of each scheme_status
                            $query = "SELECT COUNT(scheme_status) as total FROM schemes 
                            WHERE scheme_status = '" . $scheme_status . "'";

                            // Add the district filter if district_id is provided
                            if ($district_id) {
                                $query .= " AND district_id = $district_id";
                            }

                            // Execute the query and get the result
                            $s_status = $this->db->query($query)->row(); // Using `row()` to fetch a single result

                            // Display the tab for each scheme status
                        ?>
                            <li <?php if ($scheme_status == $tab) { ?> class="active" <?php } ?>>
                                <a href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view"); ?>/<?php echo $scheme_status; ?>"
                                    contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <?php echo $scheme_status; ?> (<?php echo $s_status->total; ?>)
                                </a>
                            </li>
                        <?php } ?>

                        <!-- WUA List Tab -->
                        <li <?php if ('wua' == $tab) { ?> class="active" <?php } ?>>
                            <a href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/wua"); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <?php
                                // Count the total WUA List
                                $query = "SELECT COUNT(*) as total FROM water_user_associations";
                                if ($district_id) {
                                    $query .= " WHERE district_id = $district_id";
                                }
                                $wuas = $this->db->query($query)->row(); // Fetch the total count
                                ?>
                                WUA List (<?php echo $wuas->total; ?>)
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" style="margin-top: -35px;">
                        <?php if ('wua' == $tab) { ?>
                            <?php $this->load->view(ADMIN_DIR . "water_user_associations/wua_list"); ?>
                        <?php } else { ?>
                            <?php $this->load->view(ADMIN_DIR . "water_user_associations/schemes_list"); ?>
                        <?php } ?>
                    </div>
                </div>



            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<script>
    // Function to apply heatmap color based on value
    function Heatmap(className, maxColor) {
        // Function to convert a value to a color between white and maxColor
        function valueToColor(value, min, max) {
            if (value === 0 || isNaN(value)) {
                return 'rgb(255, 255, 255)'; // White color for 0 or non-numeric values
            }
            const ratio = (value - min) / (max - min);
            const [rMax, gMax, bMax] = maxColor.match(/\w\w/g).map(hex => parseInt(hex, 16));
            const r = Math.round(255 + ratio * (rMax - 255)); // Interpolating between 255 and rMax
            const g = Math.round(255 + ratio * (gMax - 255)); // Interpolating between 255 and gMax
            const b = Math.round(255 + ratio * (bMax - 255)); // Interpolating between 255 and bMax
            return `rgb(${r}, ${g}, ${b})`;
        }

        // Get all table cells with the specified class name
        const cells = document.querySelectorAll(`td.${className}`);

        // Extract numeric values from the cells
        const values = Array.from(cells).map(cell => parseFloat(cell.textContent.trim()) || 0);

        // Determine the minimum and maximum values, excluding 0 and non-numeric values
        const nonZeroValues = values.filter(value => !isNaN(value) && value !== 0);
        const min = Math.min(...nonZeroValues);
        const max = Math.max(...nonZeroValues);

        // Apply the heatmap effect to each cell
        cells.forEach(cell => {
            const value = parseFloat(cell.textContent.trim()) || 0;
            const color = valueToColor(value, min, max);
            cell.style.backgroundColor = color;
        });
    }

    // Example usage
    Heatmap('scheme_status', '#82B018');
    Heatmap('scheme_status_total', '#82B018');
</script>