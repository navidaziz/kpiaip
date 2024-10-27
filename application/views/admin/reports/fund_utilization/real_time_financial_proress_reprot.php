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
        /* border: 1px solid black !important; */
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

.tax_paid {
    color: green !important;
    font-size: 9px !important;
    text-align: right !important;
    /* background-color: #f4f4f4; */
}

.tax_unpaid {
    color: red !important;
    font-size: 9px !important;
    text-align: right !important;
    /* background-color: #f4f4f4; */
}

.tax {
    /* background-color: #f4f4f4; */
}
</style>


<div class="row">
   <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <h4> Khyber Pakhtunkhwa, Irrigated Agriculture Improvement Project (KP-IAIP) P163474</h4>
                        <h5>FINANCIAL PROGRESS -REALTIME</h5>
                    </div>
                    <table class="table table_small table-bordered" id="real_time_summary">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>


                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="text-align: center;"><strong>Opening Balance</strong></td>
                                <td style="display: none;">Opening Balance</td>
                                <td colspan="2" style="text-align: center;"><strong>Receipt from WB</strong></td>
                                <td style="display: none;">Receipt from WB</td>

                                <td colspan="2" style="text-align: center;"><strong>Funds Available</strong></td>
                                <td style="display: none;">Funds Available</td>
                                <td><strong>Expense</strong></td>

                                <td colspan="2" style="text-align: center;"><strong>Closing Balance</strong></td>
                                <td style="display: none;">Closing Balance</td>
                                <td><strong>Buring Rate</strong></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><strong>FY<strong></td>
                                <td><strong>US$<strong></td>
                                <td><strong>PKRs<strong></td>
                                <td><strong>US$<strong></td>
                                <td><strong>PKRs<strong></td>
                                <td><strong>US$<strong></td>
                                <td><strong>PKRs<strong></td>
                                <td><strong>PKRs<strong></td>
                                <td><strong>US$<strong></td>
                                <td><strong>PKRs<strong></td>
                                <td><strong>(%)</strong></td>
                            </tr>
                            <?php
                            $count = 1;
                            $opening_balance_dollar = 0;
                            $opening_balance_pkr = 0;
                            $funds_available_dollar = 0;
                            $funds_available_pkr = 0;
                            $closing_balance_dollar = 0;
                            $closing_balance_pkr = 0;
                            $query = "SELECT * FROM financial_years";
                            $f_years = $this->db->query($query)->result();
                            foreach ($f_years as $f_year) {
                                $query = "SELECT SUM(dollar_total) as dollar_total,
                                SUM(rs_total) as rs_total
                                    FROM donor_funds_released as dfs
                                    WHERE dfs.financial_year_id = $f_year->financial_year_id";
                                $donor_fund = $this->db->query($query)->row();

                                $query = "SELECT SUM(rs_total) as rs_total
                                    FROM budget_released as br
                                    WHERE br.financial_year_id = $f_year->financial_year_id";
                                $budget_released = $this->db->query($query)->row();

                                $query = "SELECT SUM(e.gross_pay) as total_expense
                                    FROM expenses as e
                                    WHERE e.financial_year_id = $f_year->financial_year_id";
                                $expense = $this->db->query($query)->row();
                                $funds_available_pkr = $opening_balance_pkr + $donor_fund->rs_total;
                                $closing_balance_pkr = $funds_available_pkr - $expense->total_expense;
                                if ($expense->total_expense and $funds_available_pkr > 0) {
                                    $buring_rate = round((($expense->total_expense / $funds_available_pkr) * 100), 2)  . "%";
                                } else {
                                    $buring_rate = "0%";
                                }
                            ?> <tr <?php if ($f_year->status == 1) { ?> style="background-color:#CAF7B7; font-weight:bold;" <?php } ?>>
                                    <th><?php echo $count++; ?></th>
                                    <th><?php echo $f_year->financial_year; ?><?php if ($f_year->status == 1) { ?> * <?php } ?></th>
                                    <td><?php echo @number_format($opening_balance_dollar); ?></td>
                                    <td><?php echo @number_format($opening_balance_pkr); ?></td>
                                    <td><?php echo @number_format($donor_fund->dollar_total); ?></td>
                                    <td><?php echo @number_format($donor_fund->rs_total); ?></td>
                                    <td><?php echo @number_format($funds_available_dollar); ?></td>
                                    <td><?php echo @number_format($funds_available_pkr); ?></td>
                                    <!-- <td><?php echo @number_format($budget_released->rs_total); ?></td> -->
                                    <td><?php echo @number_format($expense->total_expense); ?></td>
                                    <td><?php echo @number_format($closing_balance_dollar); ?></td>
                                    <td><?php echo @number_format($closing_balance_pkr); ?></td>
                                    <th style="text-align: center;"><?php echo $buring_rate; ?></th>
                                </tr>

                            <?php
                                $opening_balance_pkr = $closing_balance_pkr;
                            } ?>

                        </tbody>
                        <tfoot>
                            <?php

                            $query = "SELECT SUM(dollar_total) as dollar_total,
                                SUM(rs_total) as rs_total
                                    FROM donor_funds_released as dfs";
                            $donor_fund = $this->db->query($query)->row();

                            $query = "SELECT SUM(rs_total) as rs_total
                                    FROM budget_released as br";
                            $budget_released = $this->db->query($query)->row();

                            $query = "SELECT SUM(e.gross_pay) as total_expense
                                    FROM expenses as e";
                            $expense = $this->db->query($query)->row();
                            if ($expense->total_expense and $donor_fund->rs_total > 0) {
                                $buring_rate = round((($expense->total_expense / $donor_fund->rs_total) * 100), 2)  . "%";
                            } else {
                                $buring_rate = "0%";
                            }
                            ?> <tr>
                                <th></th>
                                <th></th>
                                <td></td>
                                <td></td>
                                <th><?php echo @number_format($donor_fund->dollar_total); ?></th>
                                <th><?php echo @number_format($donor_fund->rs_total); ?></th>
                                <td></td>
                                <td></td>
                                <!-- <td><?php echo @number_format($budget_released->rs_total); ?></td> -->
                                <th><?php echo @number_format($expense->total_expense); ?></th>
                                <td></td>
                                <td></td>
                                <th style="text-align: center;"><?php echo $buring_rate; ?></th>

                            </tr>



                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $title.' '.date('d-m-Y m:h:s'); ?>';
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