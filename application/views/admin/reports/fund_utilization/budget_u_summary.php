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

<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">
                <h4>Receipts Vs Expenditures Summary</h4>

                <div class="table-responsive">
                    <table id="budjet_releases_list" class="table table_s_small table-bordered">
                        <thead>
                            <tr>
                                <th>Received from WB (PKR)</th>
                                <th>Budget Released From FD (PKR)</th>
                                <th>Expenditures (PKR)</th>
                                <th>Balance (PKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <th><?php echo @number_format($donor_fund->rs_total); ?> <small style="font-weight: lighter;"></small></th>
                            <th><?php echo @number_format($budget_released->rs_total); ?> <small style="font-weight: lighter;"></small></th>

                            <th><?php echo @number_format($expense->total_expense); ?></th>
                            <th>
                                <?php $remaing_budget = ($budget_released->rs_total - $expense->total_expense);
                                echo @number_format($remaing_budget);
                                ?>
                            </th>

                        </tbody>
                        <tfoot>
                            <th>Balance Funds RFA Account (PKR)<br />
                                <?php $remaing_in_account = ($donor_fund->rs_total - $budget_released->rs_total); ?>
                                <span style="color: green;">
                                    <?php echo @number_format($remaing_in_account); ?>
                                    <small style="font-weight: lighter;"></small>
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

<script>
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
</script>