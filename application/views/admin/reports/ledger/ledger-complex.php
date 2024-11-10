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
            <div class="table-responsive">
                <?php
                $fy = $this->db->query("SELECT * FROM financial_years WHERE financial_year_id = ?", [$fy_id])->row();
                $date = new DateTime($fy->start_date);
                $end_month_date = new DateTime($fy->end_date);

                function fetchSum($query, $params = [])
                {
                    return $this->db->query($query, $params)->row()->total_rs ?? 0;
                }

                function calculateOpeningBalance($date)
                {
                    $released_sum = fetchSum("SELECT SUM(rs_total) as total_rs FROM donor_funds_released WHERE DATE(date) < ?", [$date->format('Y-m-1')]);
                    $expense_sum = fetchSum("SELECT SUM(net_pay) as total_rs FROM expenses WHERE DATE(date) < ?", [$date->format('Y-m-1')]);
                    return $released_sum - $expense_sum;
                }

                $wb_balance = calculateOpeningBalance($date);
                $budget_opening_balance = fetchSum("SELECT SUM(rs_total) as total_rs FROM budget_released WHERE DATE(date) < ?", [$date->format('Y-m-1')]) - fetchSum("SELECT SUM(net_pay) as total_rs FROM expenses WHERE DATE(date) < ?", [$date->format('Y-m-1')]);
                ?>

                <h3><strong>Fiscal Year:</strong> <?= $fy->financial_year; ?></h3>

                <table class="table table-bordered table_small">
                    <tr>
                        <th colspan="4">
                            <h4><strong>Donor: </strong> World Bank</h4>
                            <h4>Initial Account Opening Balance (Rs.): <strong><?= number_format(max($wb_balance, 0), 2); ?></strong></h4>
                        </th>
                        <th style="border: none;"></th>
                        <th colspan="4">
                            <h4><strong>Source: </strong> Finance Department (Budget Released)</h4>
                            <h4>Initial Account Opening Balance (Rs.): <strong><?= number_format(max($budget_opening_balance, 0), 2); ?></strong></h4>
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
                        <th><?= number_format(max($wb_balance, 0), 2); ?></th>
                        <th style="border: none;"></th>
                        <th>Opening Balance</th>
                        <th></th>
                        <th></th>
                        <th><?= number_format(max($budget_opening_balance, 0), 2); ?></th>
                    </tr>

                    <?php while ($date <= $end_month_date): ?>
                        <tr>
                            <?php
                            $query = "SELECT SUM(rs_total) as total_rs FROM donor_funds_released WHERE MONTH(date) = ? AND YEAR(date) = ?";
                            $wb_released = $this->db->query($query, [$date->format('m'), $date->format('Y')]);
                            $query = "SELECT SUM(rs_total) as total_rs FROM budget_released WHERE MONTH(date) = ? AND YEAR(date) = ?";
                            $br_released = $this->db->query($query, [$date->format('m'), $date->format('Y')]);

                            $query = "SELECT SUM(net_pay) as total_rs FROM expenses WHERE MONTH(date) = ? AND YEAR(date) = ?";
                            $expenses = $this->db->query($query, [$date->format('m'), $date->format('Y')]);

                            $query = "SELECT SUM(rs_total) as total_rs FROM donor_funds_released WHERE DATE(date) <= ?";
                            $wb_cumulative = $this->db->query($query, [$date->format('Y-m-31')]);
                            $query = "SELECT SUM(net_pay) as total_rs FROM expenses WHERE DATE(date) <= ?";
                            $expense_cumulative = $this->db->query($query, [$date->format('Y-m-31')]);

                            $wb_balance = $wb_comulative - $expense_cumulative;

                            $query = "SELECT SUM(rs_total) as total_rs FROM budget_released WHERE DATE(date) <= ?";
                            $budget_cumulative = $this->db->query($query, [$date->format('Y-m-31')]);

                            $br_balance = $budget_cumulative - $expense_cumulative;
                            ?>

                            <th><?= $date->format('M, Y'); ?></th>
                            <td><?= number_format($wb_released, 2); ?></td>
                            <td><?= number_format($expenses, 2); ?></td>
                            <th><?= number_format(max($wb_balance, 0), 2); ?></th>
                            <th style="border: none;"></th>
                            <th><?= $date->format('M, Y'); ?></th>
                            <td><?= number_format($bg_released, 2); ?></td>
                            <td><?= number_format($expenses, 2); ?></td>
                            <th><?= number_format(max($br_balance, 0), 2); ?></th>
                        </tr>
                    <?php $date->modify('+1 month');
                    endwhile; ?>

                    <tr>
                        <th>Closing Balance</th>
                        <th></th>
                        <th></th>
                        <th><?= number_format(max($wb_balance, 0), 2); ?></th>
                        <th style="border: none;"></th>
                        <th>Closing Balance</th>
                        <th></th>
                        <th></th>
                        <th><?= number_format(max($br_balance, 0), 2); ?></th>
                    </tr>
                </table>
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