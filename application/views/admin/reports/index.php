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
    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4>Financial Reports</h4>

            </div>
            <div class="box-body">
                <h4>Basic Financial Summary Reports</h4>
                <ol>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/budget_u_summary') ?>">Budget Utilization Summary</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/fy_w_expense_summary') ?>">FY Wise Expense Summary</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/real_time_financial_proress_reprot') ?>">Financial Progress - Realtime</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/f_released_by_wb') ?>">Funds Released by World Bank</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/f_released_by_fd') ?>">Funds Released by Finance Department</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/financial_summary_report') ?>">Financial Reconciliation Summary Report</a>
                    </li>

                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/region_district_wise_expense_report') ?>">Expenses (Region and District) Wise Report</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/region_district_wise_component_expense_report') ?>">Expenses Conponent Categories (Region and District) Wise Report</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/cc_q_f_targe_and_expense_report') ?>">Annual Budget and Expense</a>
                    </li>
                </ol>

                <h4>Ledgers</h4>
                <ol>
                    <li>

                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/ledger_combined') ?>">Ledger</a>

                    </li>
                    <?php
                    $query = "SELECT * FROM financial_years";
                    $fys = $this->db->query($query)->result();
                    foreach ($fys as $fy) { ?>
                        <li>
                            <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/ledger/' . $fy->financial_year_id) ?>"><?php echo $fy->financial_year ?> Ledger</a>
                        </li>
                    <?php } ?>
                </ol>


                <h4>Receipts and Payments</h4>
                <ol>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/components_wise_financial_statement') ?>">
                            Components Wise (COAs)</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/sub_financial_statement') ?>">
                            Sub Components Wise (COAs)</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/component_cetrgory_statment') ?>">
                            Component Cetrgories Wise (COAs)</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/financial_statement') ?>">
                            Component / Sub Components / Cetrgories Wise (COAs)</a>
                    </li>
                </ol>
                <h4>Taxes</h4>
                <ol>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/district_wise_taxes') ?>">
                            District Wise Taxes </a>
                    </li>

                </ol>

                <h4>Download Data for Analysis</h4>
                <ol>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/export_expenses') ?>">Export Financial Data</a>
                    </li>

                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/export_filter_expenses') ?>">Custom Financial Report</a>
                    </li>
                    <li>

                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/export_scheme_data') ?>">Export Scheme Data</a>

                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/export_wua_data') ?>">Export Water User Association Data</a>
                    </li>

                </ol>



            </div>


        </div>

    </div>



    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4>Schemes Reports</h4>

            </div>
            <div class="box-body">
                <h4>Basic Schemes Summary Reports</h4>
                <ol>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/district_components_avg_cost') ?>">District Wise Components AVG Cost</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/district_sub_components_avg_cost') ?>">District Wise Sub Components AVG Cost</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/district_categories_avg_cost') ?>">District Wise Categories AVG Cost</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/category_fy_avg_cost') ?>">Category and Financial Year Wise AVG Cost</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/district_fy_wise_completed_schemes') ?>">District and FY Wise Completed Report</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/completed_intervention_summary') ?>">Completed Intervention Summary</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/schemes_summary_report') ?>">Schemes Summary Report</a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/export_scheme_list_by_status') ?>">Scheme Liabality Ladger</a>
                    </li>
                </ol>

            </div>
        </div>
    </div>



</div>