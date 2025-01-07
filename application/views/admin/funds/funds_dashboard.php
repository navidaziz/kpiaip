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
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 11px !important;
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

                <div class="col-md-3">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>Financial Dashboard</li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-9">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="box-body">
                                <h4>Project Financial Summary</h4>

                                <div class="table-responsive">
                                    <?php
                                    $query = "SELECT * FROM projects WHERE project_id=1";
                                    $project = $this->db->query($query)->row();

                                    $query = "SELECT SUM(dollar_total) as dollar_total,
                                    SUM(rs_total) as rs_total
                                    FROM donor_funds_released as dfs";
                                    $donor_fund = $this->db->query($query)->row();

                                    $query = "SELECT SUM(rs_total) as rs_total
                              FROM budget_released as br";
                                    $budget_released = $this->db->query($query)->row();

                                    $query = "SELECT SUM(e.net_pay) as total_expense
                               FROM expenses as e";
                                    $expense = $this->db->query($query)->row();
                                    if ($expense->total_expense and $donor_fund->rs_total > 0) {
                                        $buring_rate = round((($expense->total_expense / $donor_fund->rs_total) * 100), 2)  . "%";
                                    } else {
                                        $buring_rate = "0%";
                                    }
                                    $remaing_donor_founds =  $project->cost - $donor_fund->dollar_total;
                                    ?>
                                    <table class="table table_s_small table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Project Cost </th>
                                                <th>Received from WB</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <th><?php echo @number_format($project->cost); ?> $.</th>
                                            <th><?php echo @number_format($donor_fund->dollar_total); ?> $.</th>
                                            <th><?php echo @number_format($remaing_donor_founds); ?> $.</th>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th style="text-align: center;"><?php
                                                                                $received_percentage = round(($donor_fund->dollar_total / $project->cost) * 100, 2);
                                                                                echo $received_percentage . ' %';
                                                                                ?></th>
                                                <th style="text-align: center;"><?php
                                                                                $remaing_percentage = round(($remaing_donor_founds / $project->cost) * 100, 2);
                                                                                echo $remaing_percentage . ' %';
                                                                                ?></th>


                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="box-body">
                                <h4>Budget Utilization Summary</h4>

                                <div class="table-responsive">
                                    <table class="table table_s_small table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Received from WB</th>
                                                <th>Budget Released</th>
                                                <th>Budget Used (Exp.)</th>
                                                <th>Budget Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <th><?php echo @number_format($donor_fund->rs_total); ?> <small style="font-weight: lighter;">PKRs.</small></th>
                                            <th><?php echo @number_format($budget_released->rs_total); ?> <small style="font-weight: lighter;">PKRs.</small></th>

                                            <th><?php echo @number_format($expense->total_expense); ?></th>
                                            <th>
                                                <?php $remaing_budget = ($budget_released->rs_total - $expense->total_expense);
                                                echo @number_format($remaing_budget);
                                                ?>
                                            </th>

                                        </tbody>
                                        <tfoot>
                                            <th>Remaing funds in account <br />
                                                <?php $remaing_in_account = ($donor_fund->rs_total - $budget_released->rs_total); ?>
                                                <span style="color: green;">
                                                    <?php echo @number_format($remaing_in_account); ?>
                                                    <small style="font-weight: lighter;">PKRs.</small>
                                                </span>

                                            </th>

                                            <th style="text-align: center;"><?php
                                                                            if ($donor_fund->rs_total) {
                                                                                echo round(($budget_released->rs_total / $donor_fund->rs_total) * 100, 2) . ' %';
                                                                            }
                                                                            ?></th>
                                            <th style="text-align: center;"><?php
                                                                            if ($budget_released->rs_total) {
                                                                                echo round(($expense->total_expense / $budget_released->rs_total) * 100, 2) . ' %';
                                                                            }
                                                                            ?></th>
                                            <th style="text-align: center;"><?php
                                                                            if ($budget_released->rs_total) {
                                                                                echo $budget_released_percentage = round(($remaing_budget / $budget_released->rs_total) * 100, 2) . ' %';
                                                                            }
                                                                            ?></th>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>


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

                                $query = "SELECT SUM(e.net_pay) as total_expense
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

                            $query = "SELECT SUM(e.net_pay) as total_expense
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
    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i>Funds released by World Bank</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table_small table-bordered" id="fund_released_by_wb">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>FY</th>
                                <th>Date</th>
                                <th>US$</th>
                                <th>Forex</th>
                                <th>PKRs</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT dfs.*, fy.financial_year 
                            FROM donor_funds_released as dfs
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = dfs.financial_year_id)
                            ORDER BY date ASC";
                            $dollar_total = 0;
                            $rs_total = 0;
                            $donor_funds = $this->db->query($query)->result();
                            foreach ($donor_funds as $donor_fund) { ?>
                                <tr>
                                    <td><a href="<?php echo site_url(ADMIN_DIR . 'funds/delete_donor_fund_released/' . $donor_fund->id); ?>" onclick="return confirm('Are you sure? you want to delete the record.')">Delete</a> </td>

                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $donor_fund->financial_year; ?></td>
                                    <td><?php echo date("d M, Y", strtotime($donor_fund->date)); ?></td>
                                    <td><?php echo @number_format($donor_fund->dollar_total); ?></td>
                                    <td><?php echo $donor_fund->forex; ?></td>
                                    <td><?php echo @number_format($donor_fund->rs_total); ?></td>
                                    <td><button onclick="get_donor_funds_release_form('<?php echo $donor_fund->id; ?>')">Edit</button></td>
                                </tr>
                            <?php
                                $dollar_total += $donor_fund->dollar_total;
                                $rs_total += $donor_fund->rs_total;
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th><?php echo @number_format($dollar_total) ?></th>
                                <td></td>
                                <th><?php echo @number_format($rs_total) ?></th>
                                <td></td>

                            </tr>
                        </tfoot>
                    </table>
                    <div style="text-align: center;">
                        <button onclick="get_donor_funds_release_form('0')" class="btn btn-primary">Add Fund Release</button>
                    </div>
                </div>
                <script>
                    function get_donor_funds_release_form(id) {
                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'funds/get_donor_funds_release_form'); ?>",
                                data: {
                                    id: id
                                },
                            })
                            .done(function(respose) {
                                $('#modal').modal('show');
                                $('#modal_title').html('Funds Release');
                                $('#modal_body').html(respose);
                            });
                    }
                </script>




            </div>


        </div>

    </div>


    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i>Budget released by Finance Department</h4>

            </div>
            <div class="box-body">


                <div class="table-responsive">
                    <table class="table table_small table-bordered" id="budjet_releases_list">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>FY</th>
                                <th>Date</th>
                                <th>Rs Total</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $budget_released_total = 0;
                            $count = 1;
                            $query = "SELECT br.*, fy.financial_year 
                            FROM budget_released as br
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = br.financial_year_id)
                            ORDER BY date ASC";
                            $rows = $this->db->query($query)->result();
                            foreach ($rows as $row) {
                                $budget_released_total += $row->rs_total;
                            ?>
                                <tr>
                                    <td><a href="<?php echo site_url(ADMIN_DIR . 'funds/delete_budget_released/' . $row->budget_released_id); ?>" onclick="return confirm('Are you sure? you want to delete the record.')">Delete</a> </td>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->financial_year; ?></td>
                                    <td><?php echo date("d M, Y", strtotime($row->date)); ?></td>
                                    <td><?php echo @number_format($row->rs_total); ?></td>
                                    <td><?php echo $row->remarks; ?></td>
                                    <td><button onclick="get_budget_released_form('<?php echo $row->budget_released_id; ?>')">Edit<botton>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo @number_format($budget_released_total); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div style="text-align: center;">
                        <button onclick="get_budget_released_form('0')" class="btn btn-primary">Add Budget Release</button>
                    </div>
                </div>
                <script>
                    function get_budget_released_form(budget_released_id) {
                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'funds/get_budget_released_form'); ?>",
                                data: {
                                    budget_released_id: budget_released_id
                                },
                            })
                            .done(function(respose) {
                                $('#modal').modal('show');
                                $('#modal_title').html('Budget Released');
                                $('#modal_body').html(respose);
                            });
                    }
                </script>

            </div>


        </div>

    </div>

    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i>Direct Payments</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered table_small" id="direct_payments">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Payee Name</th>
                                    <th>Iban No</th>
                                    <th>Bank Name</th>
                                    <th>Branch Code</th>
                                    <th>Address</th>
                                    <th>Country State</th>
                                    <th>Mode Of Payment</th>
                                    <th>Wa Ref No</th>
                                    <th>Purpose Of Payment</th>
                                    <th>Component Category</th>
                                    <th>Currency</th>
                                    <th>Forex</th>
                                    <th>Amount Usd</th>
                                    <th>Amount Pkr</th>
                                    <th>Amount Other</th>
                                    <th>Date</th>
                                    <th>FY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $query = "SELECT *, component_categories.category, financial_years.financial_year  FROM direct_payments 
                                INNER JOIN component_categories ON(component_categories.component_category_id = direct_payments.component_category_id)
                                INNER JOIN financial_years ON(financial_years.financial_year_id = direct_payments.financial_year_id)";
                                $rows = $this->db->query($query)->result();

                                foreach ($rows as $row) { ?>
                                    <tr>
                                        <td><a href="<?php echo site_url(ADMIN_DIR . 'direct_payments/delete_direct_payment/' . $row->id); ?>" onclick="return confirm('Are you sure? you want to delete the record.')">Delete</a> </td>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $row->payee_name; ?></td>
                                        <td><?php echo $row->iban_no; ?></td>
                                        <td><?php echo $row->bank_name; ?></td>
                                        <td><?php echo $row->branch_code; ?></td>
                                        <td><?php echo $row->address; ?></td>
                                        <td><?php echo $row->country_state; ?></td>
                                        <td><?php echo $row->mode_of_payment; ?></td>
                                        <td><?php echo $row->wa_ref_no; ?></td>
                                        <td><?php echo $row->purpose_of_payment; ?></td>
                                        <td><?php echo $row->category; ?></td>
                                        <td><?php echo $row->currency; ?></td>
                                        <td><?php echo $row->forex; ?></td>
                                        <td><?php echo $row->amount_usd; ?></td>
                                        <td><?php echo $row->amount_pkr; ?></td>
                                        <td><?php echo $row->amount_other; ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row->payment_date)); ?></td>
                                        <td><?php echo $row->financial_year; ?></td>
                                        <td><button onclick="get_direct_payment_form('<?php echo $row->id; ?>')">Edit<botton>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div style="text-align: center;">
                            <button onclick="get_direct_payment_form('0')" class="btn btn-primary">Add Direct Payment</button>
                        </div>
                    </div>
                    <script>
                        function get_direct_payment_form(id) {
                            $.ajax({
                                    method: "POST",
                                    url: "<?php echo site_url(ADMIN_DIR . 'direct_payments/get_direct_payment_form'); ?>",
                                    data: {
                                        id: id
                                    },
                                })
                                .done(function(respose) {
                                    $('#modal').modal('show');
                                    $('#modal_title').html('Direct Payments');
                                    $('#modal_body').html(respose);
                                });
                        }
                    </script>

                </div>




            </div>


        </div>

    </div>
</div>
<!-- /MESSENGER -->
</div>
<script>
    $(document).ready(function() {
        $('#real_time_summary').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: "FINANCIAL PROGRESS - REALTIME (Date: <?php echo date("d-m-Y h:m:s") ?>)",
            "ordering": false,
            searching: true,
            buttons: [{
                    extend: 'print',
                    title: "FINANCIAL PROGRESS - REALTIME (Date: <?php echo date("d-m-Y h:m:s") ?>)",
                },
                {
                    extend: 'excelHtml5',
                    title: "FINANCIAL PROGRESS - REALTIME (Date: <?php echo date("d-m-Y h:m:s") ?>)",

                }
            ]
        });
        $('#budjet_releases_list').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: "Budget released by Finance Department (Date: <?php echo date("d-m-Y h:m:s") ?>)",
            "ordering": false,
            searching: true,
            buttons: [{
                    extend: 'print',
                    title: "Budget released by Finance Department (Date: <?php echo date("d-m-Y h:m:s") ?>)",
                },
                {
                    extend: 'excelHtml5',
                    title: "Budget released by Finance Department (Date: <?php echo date("d-m-Y h:m:s") ?>)",

                }
            ]
        });
        $('#fund_released_by_wb').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: "Funds released by World Bank (Date: <?php echo date("d-m-Y h:m:s") ?>)",
            "ordering": false,
            searching: true,
            buttons: [{
                    extend: 'print',
                    title: "Funds released by World Bank (Date: <?php echo date("d-m-Y h:m:s") ?>)",
                },
                {
                    extend: 'excelHtml5',
                    title: "Funds released by World Bank (Date: <?php echo date("d-m-Y h:m:s") ?>)",

                }
            ]
        });
    });
</script>

<style>
    .dt-buttons {
        padding: 2px !important;
    }
</style>