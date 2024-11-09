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
            <div class="box-body">

                <div class="table-responsive">
                    <?php
                    $query = "SELECT * FROM financial_years WHERE financial_year_id = ?";
                    $fy = $this->db->query($query, [$fy_id])->row();
                    ?>
                    <h4><?php echo $fy->financial_year; ?></h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Months</th>
                            <th>World Bank Receipts</th>
                            <th>Finance Receipts</th>
                            <th>Expenses</th>
                        </tr>
                        <?php
                        $start_month_date = new DateTime($fy->start_date); // Start date
                        $end_month_date = new DateTime($fy->end_date); // End date

                        // Loop through each month between start and end dates
                        for ($date = clone $start_month_date; $date <= $end_month_date; $date->modify('+1 month')) {
                        ?><tr>
                                <th><?php echo $date->format('F Y'); ?></th>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as total_rs, 
                                         SUM(dollar_total) 
                                         FROM `donor_funds_released` 
                                         WHERE MONTH(date) = '" . $date->format('m') . "' AND YEAR(date) = '" . $date->format('Y') . "';";
                                    $wb_released = $this->db->query($query)->row();
                                    if ($wb_released->total_rs and $wb_released->total_rs > 0) {
                                        echo number_format($wb_released->total_rs);
                                    }

                                    ?>
                                </th>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as total_rs 
                                         FROM `budget_released` 
                                         WHERE MONTH(date) = '" . $date->format('m') . "' AND YEAR(date) = '" . $date->format('Y') . "';";
                                    $finance_released = $this->db->query($query)->row();
                                    if ($finance_released->total_rs and $finance_released->total_rs > 0) {
                                        echo number_format($finance_released->total_rs);
                                    }

                                    ?>
                                </th>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(net_pay) as total_rs 
                                         FROM `expenses` 
                                         WHERE MONTH(date) = '" . $date->format('m') . "' AND YEAR(date) = '" . $date->format('Y') . "';";
                                    $expenses = $this->db->query($query)->row();
                                    if ($expenses->total_rs and $expenses->total_rs > 0) {
                                        echo number_format($expenses->total_rs);
                                    }

                                    ?>
                                </th>
                            </tr>
                        <?php } ?>





                    </table>



                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $title . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#taxes').DataTable({
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
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $title; ?>'

                }
            ]
        });
    });
</script>