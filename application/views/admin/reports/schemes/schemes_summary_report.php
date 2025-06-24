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

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        /* border: 1px solid black !important; */
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

<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px;
        color: black;
        margin: 0px !important;
    }

    .tax_paid {
        color: green !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax_unpaid {
        color: red !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax {
        /* background-color: #f4f4f4; */
    }
</style>
<style>
    .dashboard-box {
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 5px;
        margin: 10px 0;
        transition: transform 0.2s;
    }

    .dashboard-box:hover {
        transform: scale(1.05);
    }

    .dashboard-box h3 {
        margin: 0;
        font-size: 10px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-box p {
        font-size: 14px;
        color: #777;
    }

    .dashboard-box .count {
        font-size: 15px;
        font-weight: bold;
        color: #2c3e50;
    }
</style>
<div class="row" id="contentToDownload">
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

                </div>

            </div>
            <div class="row">
                <div class="col-md-2">
                    <div style="margin-top: 5px; text-align: center;">
                        <img style="width: 60%" src="<?php echo site_url("assets/logo.jpeg") ?>" />
                        <h5><?php echo $title; ?></h5>
                        <div class="description"><?php echo $description; ?></div>
                    </div>


                </div>
                <div class="col-md-5">
                    <div class="alert alert-danger" id="messenger">
                        <h4>Ongoing Schemes <small><a target="_blank" class="label label-warning pull-right" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_ongoing"); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download</a></small>
                        </h4>
                        <hr />
                        <?php
                        $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Final', 'ICR-I', 'ICR-II', 'Initiated')";
                        $ongoing = $this->db->query($query)->row(); ?>
                        <table class="table table-bordered table-striped" style="color: black !important;">
                            <tr>
                                <th>Total No.</th>
                                <th>Sactioned Cost (Rs.)</th>
                                <th>Total Paid (Rs.)</th>
                                <th>Balance (Rs.)</th>
                            </tr>
                            <tr>
                                <th><?php echo number_format($ongoing->total); ?></th>
                                <th><?php echo number_format($ongoing->sactioned_cost); ?></th>
                                <th><?php echo number_format($ongoing->total_paid); ?></th>
                                <th><?php echo number_format($ongoing->balance); ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-success" id="messenger">
                        <h4>Completed Schemes</h4>
                        <hr />
                        <?php
                        $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed')";
                        $completed = $this->db->query($query)->row();
                        ?>
                        <table class="table table-bordered table-striped" style="color: black !important;">
                            <tr>
                                <th>Total (Rs.)</th>
                                <th>Total Paid (Rs.)</th>
                            </tr>
                            <tr>
                                <th><?php echo number_format($completed->total); ?></th>
                                <th><?php echo number_format($completed->total_paid); ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="alert alert-warning" id="messenger">
                        <h4>Total Schemes.</h4>
                        <hr />
                        <h3 style="font-weight: bolder; color:black"><?php echo number_format($ongoing->total + $completed->total); ?><br />
                            <small> Schemes So far</small>
                        </h3>
                    </div>
                </div>
            </div>
            <?php
            $colors = array(
                "Registered" => "#FE6A35",
                "Initiated" => "#6B8ABC",
                "Not-Approved"  => "#2CAFFE",
                "Sanctioned"  => "#D568FB",
                "ICR-I" => "#2EE0CA",
                "ICR-II" => "#FA4B42",
                "Final" => "#FEB56A",
                "Disputed" => "#544FC5",
                "Par-Completed" => "#00E272",
                "Completed"  => "#91E8E1"
            );
            $ongoingschemes = array(
                //"Registered",
                //"Initiated",
                //"Not-Approved",
                "Sanctioned",
                "Initiated",
                "ICR-I",
                "ICR-II",
                //"Final",
                //"Disputed",
                //"Par-Completed",
                //"Completed"
            );
            $completedschemes = array(
                //"Par-Completed",
                "Completed"
            );

            ?>
            <div class="row">
                <div class="col-md-10">
                    <div sty class="alert alert-danger" style="padding: 5px; background-color: #f9f9f9;">
                        <h6 style="text-align: center;"><strong>Ongoing Schemes</strong></h6>
                        <div class="row">
                            <?php
                            foreach ($ongoingschemes as $scheme_status) {
                                $query = "SELECT scheme_status, COUNT(*) as total FROM schemes 
                            WHERE scheme_status ='" . $scheme_status . "'";
                                $scheme = $this->db->query($query)->row();
                            ?>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="dashboard-box" style="background-color: <?php echo $colors[$scheme_status] ?>;">
                                        <h5 style="font-weight: bold; color:black"><?php
                                                                                    if ($scheme_status == 'Ongoing') {
                                                                                        echo 'ICR-0';
                                                                                    } else {
                                                                                        echo $scheme_status;
                                                                                    }
                                                                                    ?></h5>
                                        <h2 style="font-weight: bold; color:black"><?php echo $scheme->total ?></h2>
                                        <p style="text-align: center;">
                                            <button onclick="get_list('<?php echo $scheme_status; ?>')" class="label label-success" style="border: 0px !important;"><i class="fa fa-list"></i> View List </button>
                                            <a target="_blank" class="label label-warning" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_by_status/" . $scheme_status); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                        </p>
                                        <div class="clear:both"></div>
                                    </div>
                                </div>
                            <?php } ?>

                            <script>
                                function get_list(scheme_status) {
                                    $.ajax({
                                            method: "POST",
                                            url: "<?php echo site_url(ADMIN_DIR . 'reports/get_scheme_list'); ?>",
                                            data: {
                                                scheme_status: scheme_status
                                            },
                                        })
                                        .done(function(respose) {
                                            $('#modal').modal('show');

                                            $('#modal_title').html(scheme_status + ' Schemes List');
                                            $('#modal_body').html(respose);
                                            $('.modal-dialog').css('width', '99%'); // Directly set the width
                                        });
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="alert alert-success" style="padding: 5px; background-color: #f9f9f9;">
                        <h6 style="text-align: center;"><strong>Completed Schemes</strong></h6>
                        <div class="row">
                            <?php
                            foreach ($completedschemes as $scheme_status) {
                                $query = "SELECT scheme_status, COUNT(*) as total FROM schemes 
                                WHERE scheme_status ='" . $scheme_status . "'";
                                $scheme = $this->db->query($query)->row();
                            ?>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="dashboard-box" style="background-color: <?php echo $colors[$scheme_status] ?>;">
                                        <h5 style="font-weight: bold; color:black"><?php
                                                                                    if ($scheme_status == 'Ongoing') {
                                                                                        echo 'ICR-0';
                                                                                    } else {
                                                                                        echo $scheme_status;
                                                                                    }
                                                                                    ?></h5>
                                        <h2 style="font-weight: bold; color:black"><?php echo $scheme->total ?></h2>
                                        <p style="text-align: right;">
                                            <a target="_blank" class="label label-warning" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_by_status/" . $scheme_status); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="alert alert-danger" id="messenger">

                        <h4>Ongoing Schemes (Sanctioned, Initiated, ICR-I, ICR-II, ICRI&II)

                            <small class="pull-right">
                                <button onclick="get_schemes_summary('Ongoing')" class="btn btn-danger btn-sm">Category Wise <i class="fa fa-expand"></i></button>
                                <script>
                                    function get_schemes_summary(scheme_status) {
                                        $.ajax({
                                                method: "POST",
                                                url: "<?php echo site_url(ADMIN_DIR . 'reports/get_schemes_summary'); ?>",
                                                data: {
                                                    scheme_status: scheme_status
                                                },
                                            })
                                            .done(function(respose) {
                                                $('#modal').modal('show');

                                                $('#modal_title').html(scheme_status + ' Schemes Summary');
                                                $('#modal_body').html(respose);
                                                $('.modal-dialog').css('width', '99%'); // Directly set the width
                                            });
                                    }
                                </script>
                            </small>
                        </h4>
                        <hr />
                        <table class="table table-bordered table_s mall table-striped" style="color: black !important;">
                            <thead>
                                <tr>
                                    <th>Components</th>
                                    <th>Total No. of Schemes</th>
                                    <th>SC/FCR</th>
                                    <th>ICR-I (Paid)</th>
                                    <th>ICR-II (Paid)</th>
                                    <th>ICR-I&II (Paid)</th>
                                    <th>OTHER (Paid)</th>
                                    <th>FCR (Paid)</th>
                                    <th>TOTAL (Paid)</th>
                                    <th>TOTAL PAYABLE</th>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT 
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes` 
                                    WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II') 
                                    AND component_category_id IN (1,2,3,4,5,6,7,8)";
                                $ongoing_a = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>A: Water Courses</th>
                                    <td><?php echo $ongoing_a->total; ?></td>
                                    <td><?php echo number_format($ongoing_a->sactioned_cost); ?></td>
                                    <td><?php echo number_format($ongoing_a->first); ?></td>
                                    <td><?php echo number_format($ongoing_a->second) ?></td>
                                    <td><?php echo number_format($ongoing_a->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_a->other); ?></td>
                                    <td><?php echo number_format($ongoing_a->final); ?></td>
                                    <td><?php echo number_format($ongoing_a->total_paid); ?></td>
                                    <td><?php echo number_format($ongoing_a->balance); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes` 
                                    WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II')  
                                    AND component_category_id IN (10)";
                                $ongoing_b1 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B1: HEIS</th>
                                    <td><?php echo $ongoing_b1->total; ?></td>
                                    <td><?php echo number_format($ongoing_b1->sactioned_cost); ?></td>
                                    <td><?php echo number_format($ongoing_b1->first); ?></td>
                                    <td><?php echo number_format($ongoing_b1->second) ?></td>
                                    <td><?php echo number_format($ongoing_b1->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b1->other); ?></td>
                                    <td><?php echo number_format($ongoing_b1->final); ?></td>
                                    <td><?php echo number_format($ongoing_b1->total_paid); ?></td>
                                    <td><?php echo number_format($ongoing_b1->balance); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                                        SUM(`sft_schemes`.`1st`) AS `first`,
                                        SUM(`sft_schemes`.`2nd`) AS `second`,
                                        SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                        SUM(`sft_schemes`.`other`) AS `other`,
                                        SUM(`sft_schemes`.`final`) AS `final` 
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II')  
                                        AND component_category_id IN (11)";
                                $ongoing_b2 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B2: Water Storage Tank </th>
                                    <td><?php echo $ongoing_b2->total; ?></td>
                                    <td><?php echo number_format($ongoing_b2->sactioned_cost); ?></td>
                                    <td><?php echo number_format($ongoing_b2->first); ?></td>
                                    <td><?php echo number_format($ongoing_b2->second) ?></td>
                                    <td><?php echo number_format($ongoing_b2->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b2->other); ?></td>
                                    <td><?php echo number_format($ongoing_b2->final); ?></td>
                                    <td><?php echo number_format($ongoing_b2->total_paid); ?></td>
                                    <td><?php echo number_format($ongoing_b2->balance); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes` 
                                    WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II')  
                                    AND component_category_id IN (12)";
                                $ongoing_b3 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B3: Laser Leveling Service </th>
                                    <td><?php echo $ongoing_b3->total; ?></td>
                                    <td><?php echo number_format($ongoing_b3->sactioned_cost); ?></td>
                                    <td><?php echo number_format($ongoing_b3->first); ?></td>
                                    <td><?php echo number_format($ongoing_b3->second) ?></td>
                                    <td><?php echo number_format($ongoing_b3->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b3->other); ?></td>
                                    <td><?php echo number_format($ongoing_b3->final); ?></td>
                                    <td><?php echo number_format($ongoing_b3->total_paid); ?></td>
                                    <td><?php echo number_format($ongoing_b3->balance); ?></td>
                                </tr>

                            </tbody>
                            <tfoot style="background-color: white;">

                                <tr>
                                    <th>Total</th>
                                    <th><?php echo $ongoing->total; ?></th>
                                    <th><?php echo number_format($ongoing->sactioned_cost); ?></th>
                                    <th><?php echo number_format($ongoing->first); ?></th>
                                    <th><?php echo number_format($ongoing->second) ?></th>
                                    <th><?php echo number_format($ongoing->first_second); ?></th>
                                    <th><?php echo number_format($ongoing->other); ?></th>
                                    <th><?php echo number_format($ongoing->final); ?></th>
                                    <th><?php echo number_format($ongoing->total_paid); ?></th>
                                    <th><?php echo number_format($ongoing->balance); ?></th>
                                </tr>
                            </tfoot>
                        </table>


                    </div>

                </div>
                <div class="col-md-12">
                    <div class="alert alert-success" id="messenger">
                        <h4>Completed Schemes
                            <small class="pull-right">
                                <button onclick="get_schemes_summary('Completed')" class="btn btn-success btn-sm">Category Wise <i class="fa fa-expand"></i></button>

                            </small>
                        </h4>
                        <hr />
                        <table class="table table-bordered table_s mall table-striped" style="color: black !important;">
                            <thead>
                                <tr>
                                    <th>Components</th>
                                    <th>Total No. of Schemes</th>
                                    <th>ICR-I (Paid)</th>
                                    <th>ICR-II (Paid)</th>
                                    <th>ICR-I&II (Paid)</th>
                                    <th>OTHER (Paid)</th>
                                    <th>FCR (Paid)</th>
                                    <th>TOTAL (Paid)</th>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed') 
                    AND component_category_id IN (1,2,3,4,5,6,7,8)";
                                $ongoing_a = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>A: Water Courses</th>
                                    <td><?php echo $ongoing_a->total; ?></td>
                                    <td><?php echo number_format($ongoing_a->first); ?></td>
                                    <td><?php echo number_format($ongoing_a->second) ?></td>
                                    <td><?php echo number_format($ongoing_a->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_a->other); ?></td>
                                    <td><?php echo number_format($ongoing_a->final); ?></td>
                                    <td><?php echo number_format($ongoing_a->total_paid); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed') 
                    AND component_category_id IN (10)";
                                $ongoing_b1 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B1: HEIS</th>
                                    <td><?php echo $ongoing_b1->total; ?></td>
                                    <td><?php echo number_format($ongoing_b1->first); ?></td>
                                    <td><?php echo number_format($ongoing_b1->second) ?></td>
                                    <td><?php echo number_format($ongoing_b1->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b1->other); ?></td>
                                    <td><?php echo number_format($ongoing_b1->final); ?></td>
                                    <td><?php echo number_format($ongoing_b1->total_paid); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed') 
                    AND component_category_id IN (11)";
                                $ongoing_b2 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B2: Water Storage Tank </th>
                                    <td><?php echo $ongoing_b2->total; ?></td>
                                    <td><?php echo number_format($ongoing_b2->first); ?></td>
                                    <td><?php echo number_format($ongoing_b2->second) ?></td>
                                    <td><?php echo number_format($ongoing_b2->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b2->other); ?></td>
                                    <td><?php echo number_format($ongoing_b2->final); ?></td>
                                    <td><?php echo number_format($ongoing_b2->total_paid); ?></td>
                                </tr>
                                <?php
                                $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed') 
                    AND component_category_id IN (12)";
                                $ongoing_b3 = $this->db->query($query)->row();
                                ?>
                                <tr>
                                    <th>B3: Laser Leveling Service </th>
                                    <td><?php echo $ongoing_b3->total; ?></td>
                                    <td><?php echo number_format($ongoing_b3->first); ?></td>
                                    <td><?php echo number_format($ongoing_b3->second) ?></td>
                                    <td><?php echo number_format($ongoing_b3->first_second); ?></td>
                                    <td><?php echo number_format($ongoing_b3->other); ?></td>
                                    <td><?php echo number_format($ongoing_b3->final); ?></td>
                                    <td><?php echo number_format($ongoing_b3->total_paid); ?></td>
                                </tr>

                            </tbody>
                            <tfoot style="background-color: white;">
                                <tr>
                                    <th>Total</th>
                                    <th><?php echo $scheme->total; ?></th>
                                    <th><?php echo number_format($completed->first); ?></th>
                                    <th><?php echo number_format($completed->second) ?></th>
                                    <th><?php echo number_format($completed->first_second); ?></th>
                                    <th><?php echo number_format($completed->other); ?></th>
                                    <th><?php echo number_format($completed->final); ?></th>
                                    <th><?php echo number_format($completed->total_paid); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <script>
                title = '<?php echo $description . ' ' . date('d-m-Y m:h:s'); ?>';
                $(document).ready(function() {
                    $('#data_table').DataTable({
                        dom: 'Bfrtip',
                        paging: false,
                        title: title,
                        "order": [],
                        "ordering": true,
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
                            // {
                            //     extend: 'pdfHtml5',
                            //     title: title,
                            //     pageSize: 'A4',
                            //     //orientation: 'landscape',
                            //     messageTop: '<?php echo $title; ?>'

                            // }
                        ]
                    });
                });
            </script>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<button onclick="downloadPDF()">Download PDF</button>

<script>
    function downloadPDF() {
        const element = document.getElementById("contentToDownload");

        const opt = {
            margin: 0.5,
            filename: 'downloaded-content.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        // Download the PDF
        html2pdf().set(opt).from(element).save();
    }
</script>