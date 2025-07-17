<!-- XLSX library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- Optional: DataTables (if you're using it) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
    .table_small>thead>tr>th,
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
                            <a href="<?php echo site_url($this->session->userdata('role_homepage_uri')); ?>">
                                <?php echo $this->lang->line('Home'); ?>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h4>
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
                    $query = "SELECT COUNT(*) AS completed_schemes FROM scheme_lists WHERE scheme_status = 'Completed'";
                    $completed_schemes = $this->db->query($query)->row()->completed_schemes;
                    ?>
                    <h5>
                        <?php echo htmlspecialchars($description); ?>: <?php echo $completed_schemes; ?>
                        <span class="pull-right">
                            <button id="exportButton" class="btn btn-primary btn-sm">Export to Excel</button>
                        </span>
                    </h5>

                    <?php
                    $fys = $this->db->query("SELECT * FROM financial_years")->result();
                    $categories = $this->db->query("SELECT * FROM component_categories WHERE component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12) ORDER BY component_category_id")->result();
                    ?>

                    <table class="table table-bordered" id="schemesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <?php foreach ($categories as $category) { ?>
                                    <th style="text-align: center;"><?php echo $category->category; ?></th>
                                <?php } ?>
                                <th style="text-align: center;">Watercourses</th>
                                <th style="text-align: center;">Water Storage Tanks</th>
                                <th style="text-align: center;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $districts = $this->db->query("SELECT * FROM districts WHERE is_district = 1 ORDER BY district_name")->result();
                            $count = 1;
                            foreach ($districts as $district) { ?>
                                <tr style="background-color: lightgray;">
                                    <th><?php echo $count++; ?></th>
                                    <th><?php echo htmlspecialchars($district->district_name); ?></th>
                                    <?php foreach ($categories as $category) {
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id = ?";
                                        $total = $this->db->query($query, [$district->district_id, $category->component_category_id])->row()->total;
                                    ?>
                                        <th style="text-align: center;"><?php echo $total; ?></th>
                                    <?php } ?>
                                    <th style="text-align: center;">
                                        <?php
                                        $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id IN (1,2,3,4,5,6,7,8,9)";
                                        echo $total = $this->db->query($query, [$district->district_id])->row()->total;
                                        ?>
                                    </th>
                                    <th style="text-align: center;">
                                        <?php $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id IN (11)";
                                        echo $total = $this->db->query($query, [$district->district_id])->row()->total;
                                        ?>
                                    </th>
                                    <th style="text-align: center;">
                                        <?php $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? ";
                                        echo $total = $this->db->query($query, [$district->district_id])->row()->total;
                                        ?>
                                    </th>
                                </tr>

                                <?php foreach ($fys as $pre_fy) { ?>
                                    <tr>
                                        <td></td>
                                        <th style="text-align: right;"><?php echo htmlspecialchars($pre_fy->financial_year); ?></th>
                                        <?php foreach ($categories as $category) {
                                            $query = "SELECT COUNT(*) AS total FROM schemes 
                                                      WHERE scheme_status = 'Completed' 
                                                      AND district_id = ? 
                                                      AND component_category_id = ? 
                                                      AND financial_year_id = ?";
                                            $total = $this->db->query($query, [$district->district_id, $category->component_category_id, $pre_fy->financial_year_id])->row()->total;
                                        ?>
                                            <td style="text-align: center;"><?php echo $total; ?></td>
                                        <?php } ?>
                                        <th style="text-align: center; background-color:rgb(235, 235, 235);">
                                            <?php
                                            $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id IN (1,2,3,4,5,6,7,8,9)
                                                  AND component_category_id = ?";
                                            echo $total = $this->db->query($query, [$district->district_id, $pre_fy->financial_year_id])->row()->total;
                                            ?>
                                        </th>
                                        <th style="text-align: center; background-color: rgb(235, 235, 235);">
                                            <?php $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id IN (11)
                                                  AND component_category_id = ?";
                                            echo $total = $this->db->query($query, [$district->district_id, $pre_fy->financial_year_id])->row()->total;
                                            ?>
                                        </th>
                                        <th style="text-align: center; background-color:  rgb(235, 235, 235);">
                                            <?php $query = "SELECT COUNT(*) AS total FROM schemes 
                                                  WHERE scheme_status = 'Completed' 
                                                  AND district_id = ? 
                                                  AND component_category_id = ?";
                                            echo $total = $this->db->query($query, [$district->district_id, $pre_fy->financial_year_id])->row()->total;
                                            ?>
                                        </th>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        var table = document.getElementById("schemesTable"); // Get the table element
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Sheet 1"
        }); // Convert the table to Excel
        XLSX.writeFile(wb, "cs_dist_fy_and_catgories_wise" + Date.now() + ".xlsx"); // Download the Excel file
    });
</script>