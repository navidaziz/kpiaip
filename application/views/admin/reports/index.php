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

                <div class="col-md-3">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a
                                href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-9">

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




                <div class="table-responsive">
                    <table class="table  table-bordered" id="reports">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Report</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td><a href="<?php echo site_url(ADMIN_DIR . 'reports/financial_statement') ?>">Financial
                                        Statement of Receipts and Payments</a> </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td><a
                                        href="<?php echo site_url(ADMIN_DIR . 'reports/region_district_wise_expense_report') ?>">Region
                                        and District Wise Expense Report</a> </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td><a
                                        href="<?php echo site_url(ADMIN_DIR . 'reports/region_district_wise_component_expense_report') ?>">Region
                                        and District Components Wise Expense Report</a> </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td><a target="_blank"
                                        href="<?php echo site_url(ADMIN_DIR . 'reports/export_expenses') ?>">Expenses
                                        Export</a> </td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td><a target="_blank"
                                        href="<?php echo site_url(ADMIN_DIR . 'reports/financial_summary_report') ?>">Expenses
                                        Financial Summary Report</a> </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>


        </div>

    </div>



</div>
<!-- /MESSENGER -->
</div>