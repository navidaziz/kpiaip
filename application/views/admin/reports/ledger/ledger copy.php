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
                    $start_month_date = new DateTime($fy->start_date); // Start date
                    $end_month_date = new DateTime($fy->end_date); // End date
                    $date = clone $start_month_date;
                    ?>
                    <h3><strong>Fiscal Year:</strong> <?php echo $fy->financial_year; ?></h3>

                    <table class="table table-bordered table_small" id="ledger">
                        <tr>
                            <th colspan="4">
                                <h4><strong>Donor: </strong> World Bank</h4>
                                <h4>Initial Account Opening Balance (Rs.):
                                    <strong> <?php
                                                $query = "SELECT SUM(rs_total) as total_rs, 
                                         SUM(dollar_total) 
                                         FROM `donor_funds_released` 
                                         WHERE DATE(date) < '" . $date->format('Y-m-1') . "';";
                                                $wb_commulative = $this->db->query($query)->row();

                                                $query = "SELECT SUM(net_pay) as total_rs 
                                         FROM `expenses` 
                                        WHERE DATE(date) < '" . $date->format('Y-m-1') . "';";
                                                $expense_cummulative = $this->db->query($query)->row();
                                                $wb_balance = $wb_commulative->total_rs - $expense_cummulative->total_rs;
                                                if ($wb_balance > 0) {
                                                    echo number_format($wb_balance);
                                                } else {
                                                    echo '00.00';
                                                }


                                                ?>
                                    </strong>
                                </h4>
                            </th>
                            <th style="border: none;"></th>
                            <th colspan="4">
                                <h4><strong>Source: </strong> Finance Department (Budget Released)</h4>
                                <h4>Initial Account Opening Balance (Rs.):
                                    <strong> <?php
                                                $query = "SELECT SUM(rs_total) as total_rs
                                         FROM `budget_released` 
                                         WHERE DATE(date) < '" . $date->format('Y-m-1') . "';";
                                                $br_commulative = $this->db->query($query)->row();
                                                $budget_opening_balance = $br_commulative->total_rs - $expense_cummulative->total_rs;
                                                if ($budget_opening_balance > 0) {
                                                    echo number_format($budget_opening_balance);
                                                } else {
                                                    echo '00.00';
                                                }


                                                ?>
                                    </strong>
                                </h4>
                            </th>
                        </tr>

                        <tr>
                            <th>Months</th>
                            <th>Receipts (Debited) Rs.</th>
                            <th>Expenses (Credited) Rs.</th>
                            <th>Monthly Balance Rs.</th>
                            <th style="border: none;"></th>
                            <th>Months</th>
                            <th>Receipts (Debited) Rs.</th>
                            <th>Expenses (Credited) Rs.</th>
                            <th>Monthly Balance Rs.</th>
                        </tr>
                        <tr>
                            <th>Opening Balance</th>
                            <th></th>
                            <th></th>
                            <th><?php if ($wb_balance > 0) {
                                    echo number_format($wb_balance);
                                } else {
                                    echo '00.00';
                                } ?></th>
                            <th style="border: none;"></th>
                            <th>Opening Balance</th>
                            <th></th>
                            <th></th>
                            <th><?php if ($budget_opening_balance > 0) {
                                    echo number_format($budget_opening_balance);
                                } else {
                                    echo '00.00';
                                } ?></th>
                        </tr>
                        <?php


                        // Loop through each month between start and end dates
                        for ($date; $date <= $end_month_date; $date->modify('+1 month')) {
                        ?>
                            <tr>
                                <th><?php echo $date->format('M, Y'); ?></th>
                                <td>
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
                                </td>


                                <td>
                                    <?php
                                    $query = "SELECT SUM(net_pay) as total_rs 
                                         FROM `expenses` 
                                         WHERE MONTH(date) = '" . $date->format('m') . "' AND YEAR(date) = '" . $date->format('Y') . "';";
                                    $expenses = $this->db->query($query)->row();
                                    if ($expenses->total_rs and $expenses->total_rs > 0) {
                                        echo number_format($expenses->total_rs);
                                    }

                                    ?>
                                </td>

                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as total_rs, 
                                         SUM(dollar_total) 
                                         FROM `donor_funds_released` 
                                         WHERE DATE(date) <= '" . $date->format('Y-m-31') . "';";
                                    $wb_commulative = $this->db->query($query)->row();

                                    $query = "SELECT SUM(net_pay) as total_rs 
                                         FROM `expenses` 
                                        WHERE DATE(date) <= '" . $date->format('Y-m-31') . "';";
                                    $expense_cummulative = $this->db->query($query)->row();
                                    $wb_balance = $wb_commulative->total_rs - $expense_cummulative->total_rs;
                                    if ($wb_balance > 0) {
                                        echo number_format($wb_balance);
                                    }


                                    ?>

                                </th>
                                <th style="border: none;"></th>
                                <th><?php echo $date->format('M, Y'); ?></th>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as total_rs
                                         FROM `budget_released` 
                                         WHERE MONTH(date) = '" . $date->format('m') . "' AND YEAR(date) = '" . $date->format('Y') . "';";
                                    $bg_released = $this->db->query($query)->row();
                                    if ($bg_released->total_rs and $bg_released->total_rs > 0) {
                                        echo number_format($bg_released->total_rs);
                                    }

                                    ?>
                                </th>


                                <th>
                                    <?php
                                    if ($expenses->total_rs and $expenses->total_rs > 0) {
                                        echo number_format($expenses->total_rs);
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as total_rs
                                         FROM `budget_released` 
                                         WHERE DATE(date) <= '" . $date->format('Y-m-31') . "';";
                                    $br_commulative = $this->db->query($query)->row();
                                    $br_balance = $br_commulative->total_rs - $expense_cummulative->total_rs;
                                    if ($br_balance > 0) {
                                        echo number_format($br_balance);
                                    } else {
                                        echo '0.00';
                                    }


                                    ?>
                                </th>
                            </tr>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <th>Closing Balance</th>
                                <th></th>
                                <th></th>
                                <th><?php if ($wb_balance > 0) {
                                        echo number_format($wb_balance);
                                    } else {
                                        echo '00.00';
                                    } ?></th>
                                <th style="border: none;"></th>
                                <th>Closing Balance</th>
                                <th></th>
                                <th></th>
                                <th><?php if ($br_balance > 0) {
                                        echo number_format($br_balance);
                                    } else {
                                        echo '00.00';
                                    } ?></th>
                            </tr>
                        </tfoot>




                    </table>



                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $title . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#ledger').DataTable({
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