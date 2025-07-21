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
                    <table class="table table-bordered borderd-striped" id="fund_released_by_wb">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FY</th>
                                <th>Date</th>
                                <th>US$</th>
                                <th>Forex</th>
                                <th>PKRs</th>
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
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $donor_fund->financial_year; ?></td>
                                    <td><?php echo date("d M, Y", strtotime($donor_fund->date)); ?></td>
                                    <td><?php echo @number_format($donor_fund->dollar_total); ?></td>
                                    <td><?php echo $donor_fund->forex; ?></td>
                                    <td><?php echo @number_format($donor_fund->rs_total); ?></td>
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
                                <th><?php echo @number_format($dollar_total) ?></th>
                                <td></td>
                                <th><?php echo @number_format($rs_total) ?></th>

                            </tr>
                        </tfoot>
                    </table>

                </div>


            </div>
        </div>
    </div>


</div>

<script>
    $('#fund_released_by_wb').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: "Disbursment By WBG / IDA (Direct Payments) (Date: <?php echo date("d-m-Y h:m:s") ?>)",
        "ordering": false,
        searching: true,
        buttons: [{
                extend: 'print',
                title: "Disbursment By WBG / IDA (Direct Payments) (Date: <?php echo date("d-m-Y h:m:s") ?>)",
            },
            {
                extend: 'excelHtml5',
                title: "Disbursment By WBG / IDA (Direct Payments) (Date: <?php echo date("d-m-Y h:m:s") ?>)",

            }
        ]
    });
</script>