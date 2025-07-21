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
            <div class="box-body">
                <div class="table-responsive">
                    <div class="box-body">
                        <h4>FY Wise Expense Summary</h4>
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th></th>
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

                                    $query = "SELECT SUM(e.net_pay) as total_expense, 
                                SUM(e.net_pay) as total_net_paid
                               FROM expenses as e";
                                    $expense = $this->db->query($query)->row();
                                    if ($expense->total_expense) {
                                        $buring_rate = round((($expense->total_expense / $donor_fund->rs_total) * 100), 2)  . "%";
                                    } else {
                                        $buring_rate = "0%";
                                    }
                                    $remaing_donor_founds =  $project->cost - $donor_fund->dollar_total;
                                    ?>
                                    <?php
                                    $query = "SELECT * FROM `financial_years` ORDER BY `financial_year` ASC";
                                    $financialyears = $this->db->query($query)->result();
                                    foreach ($financialyears as $financialyear) { ?>
                                        <th><?php echo $financialyear->financial_year; ?></th>
                                    <?php  }  ?>
                                </tr>

                                <tr>
                                    <th>Expenditures</th>
                                    <?php foreach ($financialyears as $financialyear) {
                                        $query = "SELECT SUM(net_pay) as total FROM `expenses` 
                                                  WHERE `expenses`.`financial_year_id` = '" . $financialyear->financial_year_id . "'";
                                        $fy_expense = $this->db->query($query)->row();
                                    ?>
                                        <td>
                                            <?php if ($fy_expense->total > 0) {
                                                echo @number_format($fy_expense->total);
                                            } else {
                                                echo '0.00';
                                            }
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <?php foreach ($financialyears as $financialyear) {
                                        $query = "SELECT SUM(net_pay) as total FROM `expenses` 
                                                  WHERE `expenses`.`financial_year_id` = '" . $financialyear->financial_year_id . "'";
                                        $fy_expense = $this->db->query($query)->row();
                                    ?>
                                        <td>
                                            <?php
                                            if ($donor_fund->rs_total) {
                                                echo  round(($fy_expense->total / $donor_fund->rs_total) * 100, 2) . "%";
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

<script>
    $('#budjet_releases_list').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: "Funds Authorized / Sur By F.D (Date: <?php echo date("d-m-Y h:m:s") ?>)",
        "ordering": false,
        searching: true,
        buttons: [{
                extend: 'print',
                title: "Funds Authorized / Sur By F.D (Date: <?php echo date("d-m-Y h:m:s") ?>)",
            },
            {
                extend: 'excelHtml5',
                title: "Funds Authorized / Sur By F.D (Date: <?php echo date("d-m-Y h:m:s") ?>)",

            }
        ]
    });
</script>