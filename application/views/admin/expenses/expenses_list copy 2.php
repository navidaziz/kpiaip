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
                    <div class="pull-right">

                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div style="padding: 10px; text-align:right">
            <?php
            $query = "SELECT e.purpose FROM expenses as e 
            GROUP BY e.purpose";
            $options = $this->db->query($query)->result();
            foreach ($options as $option) { ?>
                <button onclick="expense_form(0,'<?php echo $option->purpose; ?>')" class="btn btn-primary"><?php echo $option->purpose; ?></button>
            <?php  } ?>
            <button class="btn btn-danger">Scheme</button>
            <button class="btn btn-success">General Expense</button>
            <button class="btn btn-warning" onclick="tax_expense_form(0,'Operation Cost')">Tax As an Expense</button>
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

                function expense_form(expense_id, purpose) {
                    $.ajax({
                            method: "POST",
                            url: "<?php echo site_url(ADMIN_DIR . 'expenses/expense_form'); ?>",
                            data: {
                                expense_id: expense_id,
                                purpose: purpose,
                            },
                        })
                        .done(function(respose) {
                            $('#modal').modal('show');
                            $('#modal_title').html('Add Expense ' + purpose);
                            $('#modal_body').html(respose);
                        });
                }
            </script>
        </div>
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i> Expenses List</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive" style=" overflow-x:auto;">

                    <table class="table table-bordered table_small" id="db_table">
                        <thead>

                            <th>#</th>
                            <th>Region</th>
                            <th>District</th>
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
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT e.*,fy.financial_year, d.district_name, d.region  FROM expenses as e 
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                            INNER JOIN districts as d ON(d.district_id = e.district_id)
                            limit  500";
                            $expenses = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($expenses as $expense) : ?>

                                <tr>

                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $expense->region; ?></td>
                                    <td><?php echo $expense->district_name; ?></td>
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


                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>




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