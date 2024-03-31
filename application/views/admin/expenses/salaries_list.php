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
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>

                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-money"></i>

                    <a href="<?php echo site_url(ADMIN_DIR . 'expenses/index'); ?>">Expenses List</a>
                </li>

                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-6">

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

    <div class="col-md-12">
        <div style="padding: 4px; text-align:right">
            <select onchange="reloadPage()" id="financial_year" class="form-control" style="width: 120px; display:inline">
                <?php $query = "SELECT * FROM `financial_years`";
                $financialyearsList = $this->db->query($query)->result();
                foreach ($financialyearsList as $financialyear) { ?>
                    <option <?php if ($financial_year->financial_year_id == $financialyear->financial_year_id) { ?>selected <?php } ?> value="<?php echo $financialyear->financial_year_id; ?>?date=<?php echo $financialyear->start_date; ?>"><?php echo $financialyear->financial_year ?></option>
                <?php } ?>
            </select>
            <script>
                function reloadPage() {
                    var selectedValue = document.getElementById("financial_year").value;

                    window.location.href = '<?php echo site_url(ADMIN_DIR . 'expenses/salaries/'); ?>' + selectedValue;
                }
            </script>
            <a href="<?php echo site_url(ADMIN_DIR . "expenses/index") ?>" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Expense Dashboard</a>
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

        <div class="box border blue">
            <div class="box-title">
                <h4>FY: <?php echo $financial_year->financial_year; ?> Salaries</h4>
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

                                <a href="<?php echo site_url(ADMIN_DIR . "expenses/salaries/" . $financial_year->financial_year_id) ?>?date=<?php echo date('Y-m-d', strtotime($month)); ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <span class="hidden-inline-mobile"><?php echo date('M, y', strtotime($month)); ?></span></a>
                            </li>
                        <?php } ?>




                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="box_tab3">
                            <!-- TAB 1 -->
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive" style=" overflow-x:auto;">

                                        <table class="table table-bordered table_small" id="db_table">
                                            <thead>
                                                <td></td>
                                                <th>#</th>
                                                <th>Region</th>
                                                <th>District</th>
                                                <th>Component Category</th>
                                                <th>Category</th>
                                                <th>Purpose</th>
                                                <th>FY</th>
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
                                                            $query = "SELECT cc.`category` 
                                                        FROM `component_categories` as cc 
                                                        WHERE cc.component_category_id=$expense->component_category_id";
                                                            $c_category = $this->db->query($query)->row();
                                                        ?>
                                                            <td><?php echo $c_category->category; ?></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                        <?php } ?>
                                                        <td><?php echo $expense->category; ?></td>
                                                        <td><small><?php echo $expense->purpose; ?></small></td>

                                                        <td><?php echo $expense->financial_year; ?></td>
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
                                        <div style="text-align: center; padding:5px">
                                            <button onclick="salaries_expense_form()" class="btn btn-warning">Add <?php echo date('F Y', strtotime($filter_date)); ?> Salaries </button>
                                        </div>
                                        <script>
                                            function salaries_expense_form(employee_id) {
                                                $.ajax({
                                                        method: "POST",
                                                        url: "<?php echo site_url(ADMIN_DIR . 'expenses/salaries_expense_form'); ?>",
                                                        data: {
                                                            employee_id: employee_id,
                                                        },
                                                    })
                                                    .done(function(respose) {
                                                        $('#salaries_modal').modal('show');
                                                        $('#salaries_modal_title').html('Add Salaries for Month <?php echo date('F Y', strtotime($filter_date)); ?>');
                                                        $('#salaries_modal_body').html(respose);
                                                    });
                                            }
                                        </script>
                                        <!-- Modal -->
                                        <div class="modal fade" id="salaries_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="width: 70%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="salaries_modal_title" style="display: inline;"></h4>
                                                        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" id="salaries_modal_body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer" style="text-align: center;">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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