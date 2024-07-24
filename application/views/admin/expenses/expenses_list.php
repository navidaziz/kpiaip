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
        font-size: 10px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->

            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-3">
                    <!-- BREADCRUMBS -->
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>

                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>

                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-9">
                    <div class="col-md-7">
                        <div class="box-body">
                            <h4>Budget Utilization Summary</h4>

                            <div class="table-responsive ">
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
                                if ($expense->total_expense) {
                                    $buring_rate = round((($expense->total_expense / $donor_fund->rs_total) * 100), 2)  . "%";
                                } else {
                                    $buring_rate = "0%";
                                }
                                $remaing_donor_founds =  $project->cost - $donor_fund->dollar_total;
                                ?>
                                <table class="table table_small table-bordered">
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
                    <div class="col-md-5">
                        <h4>FY Wise Expense Summary</h4>
                        <table class="table table_small ">
                            <thead>
                                <tr>
                                    <?php
                                    $query = "SELECT * FROM `financial_years` ORDER BY `financial_year` ASC";
                                    $financialyears = $this->db->query($query)->result();
                                    foreach ($financialyears as $financialyear) { ?>
                                        <th><?php echo $financialyear->financial_year; ?></th>
                                    <?php  }  ?>
                                </tr>
                                <tr>
                                    <?php foreach ($financialyears as $financialyear) {
                                        $query = "SELECT SUM(net_pay) as net_pay FROM `expenses` 
                                                  WHERE `expenses`.`financial_year_id` = '" . $financialyear->financial_year_id . "'";
                                        $fy_expense = $this->db->query($query)->row();
                                    ?>
                                        <td>
                                            <?php if ($fy_expense->net_pay > 0) {
                                                echo @number_format($fy_expense->net_pay);
                                            } else {
                                                echo '0.00';
                                            }
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php foreach ($financialyears as $financialyear) {
                                        $query = "SELECT SUM(net_pay) as net_pay FROM `expenses` 
                                                  WHERE `expenses`.`financial_year_id` = '" . $financialyear->financial_year_id . "'";
                                        $fy_expense = $this->db->query($query)->row();
                                    ?>
                                        <td>
                                            <?php
                                            if ($donor_fund->rs_total) {
                                                echo  round(($fy_expense->net_pay / $donor_fund->rs_total) * 100, 2) . "%";
                                            }
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<style>
    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: #f0ad4e;
        z-index: 3;
        color: black;
        font-weight: bold;
    }
</style>

<div class="row" style="margin-top:-25px;">
    <div class="col-md-6" style="text-align: left;">
        <strong>Financial Year: </strong>
        <select onchange="reloadPage()" id="financial_year" class="form-control" style="width: 120px; display:inline !important">
            <?php $query = "SELECT * FROM `financial_years`";
            $financialyearsList = $this->db->query($query)->result();
            foreach ($financialyearsList as $financialyear) { ?>
                <option <?php if ($financial_year->financial_year_id == $financialyear->financial_year_id) { ?>selected <?php } ?> value="<?php echo $financialyear->financial_year_id; ?>?date=<?php echo $financialyear->start_date; ?>"><?php echo $financialyear->financial_year ?></option>
            <?php } ?>
        </select>

    </div>
    <div class="col-md-6">


        <div style="padding: 4px; text-align:right">

            <span style="margin-left: 10px;"></span>
            <script>
                function reloadPage() {
                    var selectedValue = document.getElementById("financial_year").value;

                    window.location.href = '<?php echo site_url(ADMIN_DIR . 'expenses/index/'); ?>' + selectedValue;
                }
            </script>
            <a href="<?php echo site_url(ADMIN_DIR . "expenses/schemes") ?>" class="btn btn-danger">Schemes Expenses</a>
            <!-- <a href="<?php echo site_url(ADMIN_DIR . "expenses/salaries") ?>" class="btn btn-primary">Salaries</a> -->

            <button class="btn btn-success" onclick="expense_form(0)">General Expense</button>
            <button class="btn btn-warning" onclick="tax_expense_form(0)">Tax As an Expense</button>
            <script>
                function tax_expense_form(expense_id, purpose) {
                    $.ajax({
                            method: "POST",
                            url: "<?php echo site_url(ADMIN_DIR . 'expenses/tax_expense_form'); ?>",
                            data: {
                                expense_id: expense_id,
                                purpose: purpose,
                            },
                        })
                        .done(function(respose) {
                            $('#modal').modal('show');
                            $('#modal_title').html('Add Tax As an Expense');
                            $('#modal_body').html(respose);
                        });
                }

                function expense_form(expense_id) {
                    $.ajax({
                            method: "POST",
                            url: "<?php echo site_url(ADMIN_DIR . 'expenses/expense_form'); ?>",
                            data: {
                                expense_id: expense_id,
                            },
                        })
                        .done(function(respose) {
                            $('#modal').modal('show');
                            $('#modal_title').html('Add Expense');
                            $('#modal_body').html(respose);
                        });
                }
            </script>
        </div>
    </div>
    <div class="box border blue">
        <div class="box-title">
            <h4><i class="fa fa-money"></i> FY: <?php echo $financial_year->financial_year; ?></h4>
        </div>
        <div class="box-body">
            <div class="tabbable header-tabs">
                <ul class="nav nav-tabs">

                    <?php

                    $start_date = new DateTime($financial_year->start_date);
                    $end_date = new DateTime($financial_year->end_date);

                    // Create a DatePeriod object to iterate through each month
                    $interval = new DateInterval('P1M'); // 1 month interval
                    $dateRange = new DatePeriod($start_date, $interval, $end_date);
                    $months = array();
                    // Print each month and year
                    foreach ($dateRange as $date) {

                        $months[] = $date->format('Y-m-d');
                    } ?>

                    <?php rsort($months) ?>

                    <?php
                    foreach ($months as $index => $month) {
                    ?>
                        <li <?php if (date('y-m', strtotime($filter_date)) == date('y-m', strtotime($month))) {
                                echo ' class="active" ';
                            } ?>>

                            <a href="<?php echo site_url(ADMIN_DIR . "expenses/index/" . $financial_year->financial_year_id) ?>?date=<?php echo date('Y-m-d', strtotime($month)); ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <span class="hidden-inline-mobile"><?php echo date('M, y', strtotime($month)); ?></span></a>
                        </li>
                    <?php } ?>




                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="box_tab3">
                        <!-- TAB 1 -->
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <table class="table table_small">
                                        <tr>
                                            <th>Gross Pay</th>
                                            <th>WHIT</th>
                                            <th>WHST</th>
                                            <th>St.Duty</th>
                                            <th>RDP</th>
                                            <th>KPRA</th>
                                            <th>Misc.Dedu.</th>
                                            <th>Net Pay</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo @number_format($expense_summary->gross_pay); ?></td>
                                            <td><?php echo @number_format($expense_summary->whit_tax); ?></td>
                                            <td><?php echo @number_format($expense_summary->whst_tax); ?></td>
                                            <td><?php echo @number_format($expense_summary->st_duty_tax); ?></td>
                                            <td><?php echo @number_format($expense_summary->rdp_tax); ?></td>
                                            <td><?php echo @number_format($expense_summary->kpra_tax); ?></td>
                                            <td><?php echo @number_format($expense_summary->misc_deduction); ?></td>
                                            <td><?php echo @number_format($expense_summary->net_pay); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes Paid</td>
                                            <td> <?php echo @number_format($tax_paid['WHIT']) ?> </td>
                                            <td> <?php echo @number_format($tax_paid['WHST']) ?> </td>
                                            <td> <?php echo @number_format($tax_paid['St. Duty']) ?> </td>
                                            <td> <?php echo @number_format($tax_paid['RDP']) ?> </td>
                                            <td> <?php echo @number_format($tax_paid['KPRA']) ?> </td>
                                            <td> <?php echo @number_format($tax_paid['MISC.DEDU']) ?> </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes Remaining</td>
                                            <td> <?php echo @number_format($tax_paid['WHIT'] - $expense_summary->whit_tax); ?> </td>
                                            <td> <?php echo @number_format($tax_paid['WHST'] - $expense_summary->whst_tax); ?> </td>
                                            <td> <?php echo @number_format($tax_paid['St. Duty'] - $expense_summary->st_duty_tax);  ?> </td>
                                            <td> <?php echo @number_format($tax_paid['RDP'] - $expense_summary->rdp_tax); ?> </td>
                                            <td> <?php echo @number_format($tax_paid['KPRA'] - $expense_summary->kpra_tax); ?> </td>
                                            <td> <?php echo @number_format($tax_paid['MISC.DEDU'] - $expense_summary->misc_deduction); ?> </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="table-responsive" style=" overflow-x:auto;">

                                    <table class="table table-bordered table_small" id="db_table">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>Region</th>
                                            <th>District</th>
                                            <th>Component Category</th>
                                            <th>Category Detail</th>
                                            <th>Purpose</th>
                                            <th>WUA Reg.</th>
                                            <th>WUA Asso.</th>
                                            <th>Scheme</th>
                                            <th>FY</th>
                                            <th>Voucher Number</th>
                                            <th>Cheque</th>
                                            <th>Date</th>
                                            <th>Payee Name</th>
                                            <th>Gross Pay</th>
                                            <th>WHIT</th>
                                            <th>WHST</th>
                                            <th>St.Duty</th>
                                            <th>RDP</th>
                                            <th>Misc.Dedu.</th>
                                            <th>Net Pay</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                            <?php


                                            $count = 1;
                                            foreach ($expenses as $expense) : ?>

                                                <tr>
                                                    <td><a href="<?php echo site_url(ADMIN_DIR . 'expenses/delete_expense_record/' . $expense->expense_id); ?>" onclick="return confirm('Are you sure? you want to delete the record.')"><i class="fa fa-trash-o"></i></a> </td>

                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $expense->region; ?></td>
                                                    <td><?php echo $expense->district_name; ?></td>
                                                    <?php
                                                    if ($expense->component_category_id > 0) {
                                                        $query = "SELECT cc.`category`, cc.category_detail 
                                                        FROM `component_categories` as cc 
                                                        WHERE cc.component_category_id=$expense->component_category_id";
                                                        $c_category = $this->db->query($query)->row();
                                                    ?>
                                                        <td><?php echo $c_category->category; ?></td>
                                                        <td><?php echo $c_category->category_detail; ?></td>
                                                    <?php } else { ?>
                                                        <td></td>
                                                        <td></td>
                                                    <?php } ?>
                                                    <td><small><?php echo $expense->purpose; ?></small></td>

                                                    <?php
                                                    if ($expense->scheme_id > 0) {
                                                        $query = "SELECT wau.wua_registration_no as wua_reg_no,
                        wau.wua_name,
                        s.scheme_name
                        FROM `water_user_associations` as wau
                        INNER JOIN schemes as s ON(s.water_user_association_id = wau.water_user_association_id)
                        WHERE s.scheme_id = $expense->scheme_id";
                                                        $scheme = $this->db->query($query)->row();
                                                    ?>
                                                        <td><?php echo $scheme->wua_reg_no; ?></td>
                                                        <td><?php echo $scheme->wua_name; ?></td>
                                                        <td><?php echo $scheme->scheme_name; ?></td>
                                                    <?php } else { ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php } ?>
                                                    <td><?php echo $expense->financial_year; ?></td>
                                                    <td><?php echo $expense->voucher_number; ?></td>
                                                    <td><?php echo $expense->cheque; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                                    <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                                                    <td><?php echo number_format($expense->gross_pay); ?></td>
                                                    <td><?php echo number_format($expense->whit_tax); ?></td>
                                                    <td><?php echo number_format($expense->whst_tax); ?></td>
                                                    <td><?php echo number_format($expense->st_duty_tax); ?></td>
                                                    <td><?php echo number_format($expense->rdp_tax); ?></td>
                                                    <td><?php echo number_format($expense->misc_deduction); ?></td>
                                                    <td><?php echo number_format($expense->net_pay); ?></td>
                                                    <td>
                                                        <?php
                                                        $tax_array = array("WHIT", "WSHT", "ST.DUTY", "RDP", "MISC.DEDU");
                                                        if (in_array($expense->category, $tax_array)) { ?>
                                                            <button onclick="tax_expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
                                                        <?php } else { ?>
                                                            <button onclick="expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
                                                        <?php } ?>
                                                    </td>


                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>




                                </div>


                            </div>

                        </div>
                        <hr class="margin-bottom-0">

                    </div>


                </div>
            </div>
        </div>
    </div>



</div>
<!-- /MESSENGER -->
</div>




<script>
    title = "Expenses";
    $(document).ready(function() {
        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                },
                {
                    extend: 'excelHtml5',
                    title: title,

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',

                }
            ]
        });
    });
</script>