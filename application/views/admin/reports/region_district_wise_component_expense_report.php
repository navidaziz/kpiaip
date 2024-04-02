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
        border: 1px solid black !important;
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

<div class="row">

    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-users"></i><?php echo $title; ?> list</h4>

            </div>
            <div class="box-body">

                <div>
                    <form id="reportForm" action="<?php echo site_url(ADMIN_DIR . "reports/region_district_wise_expense_report"); ?>" method="post">
                        Purpus: <?php
                                $f_purpose_filter_list = '';
                                $query = "SELECT purpose FROM expenses GROUP BY purpose";
                                $purpose_filters = $this->db->query($query)->result();
                                foreach ($purpose_filters as $purpose_filter) { ?>
                            <input <?php if ($f_purpose_array && in_array($purpose_filter->purpose, $f_purpose_array)) {
                                        $f_purpose_filter_list .= $purpose_filter->purpose . ",";
                                        echo 'checked';
                                    } ?> type="checkbox" value="<?php echo $purpose_filter->purpose; ?>" name="purpose[]" /> <?php echo $purpose_filter->purpose; ?>,
                        <?php } ?>
                        <br />
                        Regions: <?php
                                    $f_regions_filter_list = '';
                                    $query = "SELECT region FROM districts GROUP BY region";
                                    $regions_filters = $this->db->query($query)->result();
                                    foreach ($regions_filters as $regions_filter) { ?>
                            <input <?php if ($f_regions_array && in_array($regions_filter->region, $f_regions_array)) {
                                            $f_regions_filter_list .= $regions_filter->region . ', ';
                                            echo 'checked';
                                        } ?> type="checkbox" value="<?php echo $regions_filter->region; ?>" name="regions[]" /> <?php echo $regions_filter->region; ?>,
                        <?php } ?>
                        <br />
                        Financial Years: <?php
                                            $financial_year_filter_list = '';
                                            $query = "SELECT financial_year, financial_year_id FROM financial_years GROUP BY financial_year_id";
                                            $financial_year_filters = $this->db->query($query)->result();
                                            foreach ($financial_year_filters as $financial_year_filter) { ?>
                            <input <?php if ($f_financial_years_array && in_array($financial_year_filter->financial_year_id, $f_financial_years_array)) {
                                                    $financial_year_filter_list .= $financial_year_filter->financial_year . ", ";
                                                    echo 'checked';
                                                } ?> type="checkbox" value="<?php echo $financial_year_filter->financial_year_id; ?>" name="financial_years[]" /> <?php echo $financial_year_filter->financial_year; ?>,
                        <?php } ?>
                        <br />
                        Date: Start Date: <input type="date" value="<?php if ($f_start_date) {
                                                                        echo $f_start_date;
                                                                    } ?>" name="start_date" />
                        End Date: <input type="date" value="<?php if ($f_end_date) {
                                                                echo $f_end_date;
                                                            } ?>" name="end_date" />
                        <button onclick="submitForm()">Date Filter</button>
                    </form>
                    <?php
                    $table_title = '';

                    if ($f_regions_filter_list) {
                        $table_title .= ' - Region Filter: ' . $f_regions_filter_list;
                    }
                    if ($f_purpose_filter_list) {
                        $table_title .= ' - Purpose Filter: ' . $f_purpose_filter_list;
                    }
                    if ($f_start_date and $f_end_date) {
                        $table_title .= ' - Date filter: ' . $f_start_date . ' To ' . $f_end_date;
                    } else {
                        if ($f_financial_years_array) {
                            $table_title .= ' - Financial Year Filter: ' . $financial_year_filter_list;
                        }
                    }


                    ?>
                    <hr />
                </div>
                <script>
                    // Function to submit the form when a checkbox is clicked
                    function submitForm() {
                        document.getElementById("reportForm").submit();
                    }

                    // Add event listeners to checkboxes to call submitForm function
                    var checkboxes = document.querySelectorAll('input[type=checkbox]');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('click', submitForm);
                    });
                </script>


                <div class="table-responsive">
                    <table class="table table_small  table-bordered" id="report">
                        <thead>

                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Region</th>
                                <th>Districts</th>
                                <?php foreach ($component_categories as $component_category) { ?>
                                    <th> <?php echo $component_category->category; ?> </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($regions as $region) { ?>
                                <tr style="background-color: lightgray;">
                                    <th><?php echo $count++; ?></th>
                                    <th><?php echo $region->region; ?></th>
                                    <th></th>
                                    <?php
                                    foreach ($region->component_categories as $component_category) { ?>


                                        <td><?php echo @number_format($component_category->expenses->net_pay); ?></td>

                                    <?php } ?>
                                </tr>
                                <?php
                                $district_count = 1;
                                foreach ($region->districts as $district) { ?>
                                    <tr>
                                        <th></th>
                                        <th><?php echo $district_count++; ?></th>
                                        <th><?php echo $district->district_name ?></th>
                                        <?php
                                        foreach ($district->component_categories as $component_category) { ?>


                                            <td><?php echo @number_format($component_category->expenses->net_pay); ?></td>

                                        <?php } ?>
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
<!-- /MESSENGER -->
</div>

<script>
    title = "<?php echo $title; ?>";
    $(document).ready(function() {
        $('#report').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": false,
            searching: true,
            buttons: [

                {
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
    });
</script>