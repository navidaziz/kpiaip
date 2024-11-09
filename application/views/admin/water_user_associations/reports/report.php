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
                          WHERE s.component_category_id = $category->component_category_id";
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
                            <th style="text-align: center;"><?php echo $finance_completed - $sft_completed; ?></th>

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
                        <th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                 AND e.scheme_id IS NULL";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_not_user_cheques = $this->db->query($query)->row();
                            echo $cat_not_user_cheques->total;
                            ?>
                        </th>
                        <th><?php echo $cat_cheques->total - $cat_not_user_cheques->total; ?></th>
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
                      WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
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
                        <th style="text-align:center"><?php echo $finance_completed_total - $sft_completed_total; ?></th>
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
                                                            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
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
                            <th style="text-align: center;"><?php echo $finance_completed - $sft_completed; ?></th>

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
                        <th>
                            <?php $query = "SELECT COUNT(*) as total FROM expenses as e
                                                WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                                 AND e.scheme_id IS NULL";
                            if ($district_id) {
                                $query .= " AND e.district_id = $district_id";
                            }
                            $cat_not_user_cheques = $this->db->query($query)->row();
                            echo $cat_not_user_cheques->total;
                            ?>
                        </th>
                        <th><?php echo $cat_cheques->total - $cat_not_user_cheques->total; ?></th>
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
                      WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
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
                        <th style="text-align:center"><?php echo $finance_completed_total - $sft_completed_total; ?></th>
                    </tr>
                </table>

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