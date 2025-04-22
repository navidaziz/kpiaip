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
                    <table class="table table-bordered borderd-striped" id="budjet_releases_list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FY</th>
                                <th>Date</th>
                                <th>Rs Total</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $budget_released_total = 0;
                            $count = 1;
                            $query = "SELECT br.*, fy.financial_year 
                            FROM budget_released as br
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = br.financial_year_id)
                            ORDER BY date ASC";
                            $rows = $this->db->query($query)->result();
                            foreach ($rows as $row) {
                                $budget_released_total += $row->rs_total;
                            ?>
                                <tr>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->financial_year; ?></td>
                                    <td><?php echo date("d M, Y", strtotime($row->date)); ?></td>
                                    <td><?php echo @number_format($row->rs_total); ?></td>
                                    <td><?php echo $row->remarks; ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo @number_format($budget_released_total); ?></th>
                                <th></th>
                            </tr>
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