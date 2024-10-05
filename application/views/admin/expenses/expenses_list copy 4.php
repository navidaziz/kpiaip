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

                            <a
                                href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>

                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-9">
                    <div class="col-md-6">
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
                                <table class="table table_small">
                                    <thead>
                                        <tr>
                                            <th>Received from WB</th>
                                            <th>Budget Released</th>
                                            <th>Budget Used (Exp.)</th>
                                            <th>Budget Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><?php echo @number_format($donor_fund->rs_total); ?> <small
                                                style="font-weight: lighter;">PKRs.</small></td>
                                        <td><?php echo @number_format($budget_released->rs_total); ?> <small
                                                style="font-weight: lighter;">PKRs.</small></td>

                                        <td><?php echo @number_format($expense->total_expense); ?></td>
                                        <td>
                                            <?php $remaing_budget = ($budget_released->rs_total - $expense->total_expense);
                                            echo @number_format($remaing_budget);
                                            ?>
                                        </td>

                                    </tbody>
                                    <tfoot>
                                        <td>Remaing funds in account <br />
                                            <?php $remaing_in_account = ($donor_fund->rs_total - $budget_released->rs_total); ?>
                                            <span style="color: green;">
                                                <?php echo @number_format($remaing_in_account); ?>
                                                <small style="font-weight: lighter;">PKRs.</small>
                                            </span>

                                        </td>

                                        <td style="text-align: center;"><?php
                                                                        if ($donor_fund->rs_total) {
                                                                            echo round(($budget_released->rs_total / $donor_fund->rs_total) * 100, 2) . ' %';
                                                                        }
                                                                        ?></td>
                                        <td style="text-align: center;"><?php
                                                                        if ($budget_released->rs_total) {
                                                                            echo round(($expense->total_expense / $budget_released->rs_total) * 100, 2) . ' %';
                                                                        }
                                                                        ?></th>
                                        <td style="text-align: center;"><?php
                                                                        if ($budget_released->rs_total) {
                                                                            echo $budget_released_percentage = round(($remaing_budget / $budget_released->rs_total) * 100, 2) . ' %';
                                                                        }
                                                                        ?></td>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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

<div class="row" style="margin-bottom: 10px; margin-top:-15px">

    <div class="col-md-4">
        <strong>Financial Year: </strong>
        <select onchange="reloadPage()" id="financial_year" class="form-control"
            style="width: 120px; display:inline !important">
            <?php $query = "SELECT * FROM `financial_years`";
            $financialyearsList = $this->db->query($query)->result();
            foreach ($financialyearsList as $financialyear) { ?>
            <option <?php if ($financial_year->financial_year_id == $financialyear->financial_year_id) { ?>selected
                <?php } ?>
                value="<?php echo $financialyear->financial_year_id; ?>?date=<?php echo $financialyear->start_date; ?>">
                <?php echo $financialyear->financial_year ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-8" style="text-align: right;">
        <span style="margin-left: 10px;"></span>
        <script>
        function reloadPage() {
            var selectedValue = document.getElementById("financial_year").value;

            window.location.href = '<?php echo site_url(ADMIN_DIR . 'expenses/index/'); ?>' + selectedValue;
        }
        </script>
        <a href="<?php echo site_url(ADMIN_DIR . "expenses/schemes") ?>" class="btn btn-danger">Schemes Expenses [ A
            (All) + B (B-2) ] Only</a>
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


<div class="row">

    <div class="col-md-12">
        <div class="box border blue">
            <div class="box-title">
                <h4>FY: <?php echo $financial_year->financial_year; ?></h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <!-- <li <?php if ($this->input->get('fy') == 'all') {
                                echo ' class="active" ';
                            } ?>>

                            <a href="<?php echo site_url(ADMIN_DIR . "expenses/index/" . $financial_year->financial_year_id) ?>?fy=all"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <span class="hidden-inline-mobile">Over All Report</span></a>
                        </li> -->

                        <li <?php if ($this->input->get('fy') == 'fy') {
                                echo ' class="active" ';
                            } ?>>

                            <a href="<?php echo site_url(ADMIN_DIR . "expenses/index/" . $financial_year->financial_year_id) ?>?fy=fy"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <span class="hidden-inline-mobile">FY:
                                    <?php echo $financial_year->financial_year; ?></span></a>
                        </li>

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

                            <a href="<?php echo site_url(ADMIN_DIR . "expenses/index/" . $financial_year->financial_year_id) ?>?date=<?php echo date('Y-m-d', strtotime($month)); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <span
                                    class="hidden-inline-mobile"><?php echo date('M, y', strtotime($month)); ?></span></a>
                        </li>
                        <?php } ?>




                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="box_tab3">
                        <!-- TAB 1 -->
                        <div class="row">
                            <div class="col-md-12">
                                <div>

                                    <table class="table">
                                        <tr>
                                            <th>Gross Paid</th>
                                            <th>Net Paid</th>
                                            <?php foreach($tax_paid as $tax => $tax_value){ ?>
                                            <th><?php echo $tax; ?></th>
                                            <?php } ?>
                                            <th>Tax Payables</th>

                                        </tr>
                                        <tr>
                                            <th><?php echo @number_format($expense_summary->gross_pay); ?></th>
                                            <th><?php echo @number_format($expense_summary->net_pay); ?></th>
                                            <?php 
                                            $taxPayAble=0;
                                            foreach($tax_paid as $tax => $tax_value){ ?>
                                            <th>
                                                <?php
                                                    switch(trim($tax)) {
                                                        case 'WHST':
                                                            echo @number_format($expense_summary->whst_tax);
                                                            $taxPayAble+=$expense_summary->whst_tax;
                                                            break;
                                                        case 'WHIT':
                                                            echo @number_format($expense_summary->whit_tax);
                                                             $taxPayAble+=$expense_summary->whit_tax;
                                                            break;
                                                        case 'KPRA':
                                                            echo @number_format($expense_summary->kpra_tax);
                                                            $taxPayAble+=$expense_summary->kpra_tax;
                                                            break;
                                                        case 'St. Duty':
                                                            echo @number_format($expense_summary->st_duty_tax);
                                                            $taxPayAble+=$expense_summary->st_duty_tax;
                                                            break;
                                                        case 'RDP':
                                                            echo @number_format($expense_summary->rdp_tax);
                                                             $taxPayAble+=$expense_summary->rdp_tax;
                                                            break;
                                                        case 'WHT':
                                                            echo "0";
                                                            break;
                                                        case 'GUR.RET.':
                                                            echo @number_format($expense_summary->gur_ret);
                                                            $taxPayAble+=$expense_summary->gur_ret;
                                                            break;
                                                        case 'MISC.DEDU':
                                                            echo @number_format($expense_summary->misc_deduction);
                                                            $taxPayAble+=$expense_summary->misc_deduction;
                                                            break;
                                                        default:
                                                            echo $tax;  // In case of an unexpected tax key
                                                            break;
                                                    }
                                            ?>
                                            </th>
                                            <?php } ?>
                                            <th><?php echo @number_format($taxPayAble); ?></th>

                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Taxes Paid</th>
                                            <?php 
                                            $taxesPaid=0;
                                            foreach($tax_paid as $tax => $tax_value){ ?>
                                            <th>
                                                <?php echo @number_format($tax_value); 
                                                $taxesPaid+=$tax_value;
                                                ?>
                                            </th>

                                            <?php } ?>

                                            <th><?php echo @number_format($taxesPaid); ?></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Taxes Remaining</th>
                                            <?php 
                                            $taxesRemaining=0;
                                            foreach($tax_paid as $tax => $tax_value){ ?>
                                            <th>
                                                <?php
                                                    switch(trim($tax)) {
                                                        case 'WHST':
                                                            echo @number_format($expense_summary->whst_tax-$tax_value);
                                                            $taxesRemaining+=$expense_summary->whst_tax-$tax_value;
                                                            break;
                                                        case 'WHIT':
                                                            echo @number_format($expense_summary->whit_tax-$tax_value);
                                                            $taxesRemaining+=$expense_summary->whit_tax-$tax_value;
                                                            break;
                                                        case 'KPRA':
                                                            echo @number_format($expense_summary->kpra_tax-$tax_value);
                                                            $taxesRemaining+=$expense_summary->kpra_tax-$tax_value;
                                                            break;
                                                        case 'St. Duty':
                                                            echo @number_format($expense_summary->st_duty_tax-$tax_value);
                                                            $taxesRemaining+=$expense_summary->st_duty_tax-$tax_value;
                                                            break;
                                                        case 'RDP':
                                                            echo @number_format($expense_summary->rdp_tax-$tax_value);
                                                            $taxesRemaining+=$expense_summary->rdp_tax-$tax_value;
                                                            break;
                                                        case 'WHT':
                                                            echo "0";
                                                            break;
                                                        case 'GUR.RET.':
                                                            echo @number_format($expense_summary->gur_ret-$tax_value);
                                                            $taxesRemaining+=$expense_summary->gur_ret-$tax_value;
                                                            break;
                                                        case 'MISC.DEDU':
                                                            echo @number_format($expense_summary->misc_deduction-$tax_value);
                                                            $taxesRemaining+=$expense_summary->misc_deduction-$tax_value;
                                                            break;
                                                        default:
                                                            echo $tax;  // In case of an unexpected tax key
                                                            break;
                                                    }
                                            ?>
                                            </th>
                                            <?php } ?>
                                            <th><?php echo @number_format($taxesPaid-$taxPayAble); ?></th>
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
                                            <th>KPRA</th>
                                            <th>GUR.RET.</th>
                                            <th>Misc.Dedu.</th>
                                            <th>Net Pay</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                            <?php


                                            $count = 1;
                                            foreach ($expenses as $expense) : ?>

                                            <tr>
                                                <td><a href="<?php echo site_url(ADMIN_DIR . 'expenses/delete_expense_record/' . $expense->expense_id); ?>"
                                                        onclick="return confirm('Are you sure? you want to delete the record.')"><i
                                                            class="fa fa-trash-o"></i></a> </td>

                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $expense->region; ?></td>
                                                <td><?php echo $expense->district_name; ?></td>
                                                <td class="category"><?php echo $expense->category; ?></td>
                                                <td><?php echo $expense->category_detail; ?></td>
                                                <td><small><?php echo $expense->purpose; ?></small></td>

                                                <td><?php echo $expense->wua_registration_no; ?></td>
                                                <td><?php echo $expense->wua_name; ?></td>
                                                <td><?php echo $expense->scheme_name; ?></td>

                                                <td><?php echo $expense->financial_year; ?></td>
                                                <td><?php echo $expense->voucher_number; ?></td>
                                                <td><?php echo $expense->cheque; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                                <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                                                <td><?php if($expense->gross_pay>0){ echo number_format($expense->gross_pay, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->whit_tax>0){ echo number_format($expense->whit_tax, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->whst_tax>0){ echo number_format($expense->whst_tax, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->st_duty_tax>0){ echo number_format($expense->st_duty_tax, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->rdp_tax>0){ echo number_format($expense->rdp_tax, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->kpra_tax>0){ echo number_format($expense->kpra_tax, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->gur_ret>0){ echo number_format($expense->gur_ret, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->misc_deduction>0){ echo number_format($expense->misc_deduction, 2); }else{ echo 0; }?>
                                                </td>
                                                <td><?php if($expense->net_pay>0){ echo number_format($expense->net_pay, 2); }else{ echo 0; }?>
                                                </td>

                                                <td>
                                                    <?php if(in_array($expense->component_category_id, $taxes_ids)) { ?>
                                                    <button
                                                        onclick="tax_expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
                                                    <?php } else { ?>
                                                    <button
                                                        onclick="expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
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





<script>
title = "Expenses ";
$(document).ready(function() {
    $('#db_table').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: title,
        "order": [],
        searching: true,
        buttons: [{
            extend: 'excelHtml5',
            title: title,
        }]
    });

});
</script>