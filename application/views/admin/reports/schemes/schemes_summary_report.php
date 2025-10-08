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

    @media print {

        /* Hide the download button when printing */
        .no-print,
        button,
        a,
        .sidebar,
        .page-header,
        .navbar {
            display: none !important;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb" style="margin-bottom: 10px;">
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
    <div class="col-sm-12">
        <div id="contentToDownload">
            <div class="row">
                <div class="col-md-2">
                    <div style="margin-top: 5px; text-align: center;">
                        <img style="width: 118px" src="<?php echo site_url("assets/logo.jpeg") ?>" />
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
                    WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')";
                        $ongoing = $this->db->query($query)->row(); ?>
                        <table class="table table-bordered table-striped" style="color: black !important;">
                            <tr>
                                <th>Total No.</th>
                                <th>Sactioned Cost (Rs.)</th>
                                <th>Total (Rs.)</th>
                                <th>Balance (Rs.)</th>
                            </tr>
                            <tr>
                                <th><?php echo number_format($ongoing->total); ?></th>
                                <th><?php echo tomillions($ongoing->sactioned_cost); ?></th>
                                <th><?php echo tomillions($ongoing->total_paid); ?></th>
                                <th><?php echo tomillions($ongoing->balance); ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-success" id="messenger">
                        <h4>Completed Schemes <small><a target="_blank" class="label label-danger pull-right" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_by_status/Completed"); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download</a></small></h4>
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
                                <th>Total No.</th>
                                <th>Total (Rs.)</th>
                            </tr>
                            <tr>
                                <th><?php echo number_format($completed->total); ?></th>
                                <th><?php echo tomillions($completed->total_paid); ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="alert alert-warning" id="messenger">
                        <h4>Sanctioned Schemes</h4>
                        <h6>Since Inception</h6>
                        <hr />
                        <h3 style="font-weight: bolder; color:black"> Total <?php echo number_format($ongoing->total + $completed->total); ?><br />
                            <small> Schemes So far</small>
                        </h3>
                        <p style="text-align: center;">
                            <a target="_blank" class="label label-danger" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_by_status/"); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download All Schemes</a>
                        </p>
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
                <div class="col-md-8">
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
                                        <strong style="color: black;">Phy. Completed:
                                            <?php
                                            $query = "SELECT scheme_status, COUNT(*) as total FROM schemes 
                                            WHERE scheme_status ='" . $scheme_status . "'
                                            AND phy_completion IS NOT NULL 
                                            AND phy_completion_date IS NOT NULL";
                                            $phy_completed = $this->db->query($query)->row();
                                            echo $phy_completed->total;
                                            ?>
                                        </strong>
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
                    <div class="alert alert-danger" style="padding: 5px; background-color: #f9f9f9;">
                        <h6 style="text-align: center;"><strong>Ongoing Schemes</strong></h6>
                        <div class="row">
                            <?php
                            $query = "SELECT scheme_status, COUNT(*) as total 
                            FROM schemes 
                            WHERE scheme_status IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')";
                            $scheme = $this->db->query($query)->row();
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="dashboard-box" style="background-color: #DFEFD8;">
                                    <h5 style="font-weight: bold; color:black">Ongoing Schemes</h5>
                                    <h2 style="font-weight: bold; color:black"><?php echo $scheme->total ?></h2>

                                    <p style="text-align: center;">
                                        <strong style="color: black;">Phy. Completed:
                                            <?php
                                            $query = "SELECT scheme_status, COUNT(*) as total FROM schemes 
                                            WHERE scheme_status IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                            AND phy_completion IS NOT NULL 
                                            AND phy_completion_date IS NOT NULL";
                                            $phy_completed = $this->db->query($query)->row();
                                            echo $phy_completed->total;
                                            ?>
                                        </strong>
                                        <button onclick="get_list('current_ongoing')" class="label label-success" style="border: 0px !important;"><i class="fa fa-list"></i> View List </button>
                                        <a target="_blank" class="label label-warning" href="<?php echo site_url(ADMIN_DIR . "reports/export_scheme_list_by_status/current_ongoing"); ?>"> <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    </p>

                                </div>
                            </div>

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
                                        <h2 style="font-weight: bold; color:black"><?php echo number_format(($scheme->total + $phy_completed->total)) ?></h2>
                                        <p style="text-align: left; font-size:9px; color:black">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td>Physically</td>
                                                <td>Financially</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;"><?php echo number_format($phy_completed->total); ?></th>
                                                <th style="text-align: center;"><?php echo number_format($scheme->total); ?></th>
                                            </tr>
                                        </table>



                                        </p>
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



                        <small class="pull-right">
                            <!-- <button onclick="get_schemes_summary('Ongoing')" class="btn btn-danger btn-sm">Category Wise <i class="fa fa-expand"></i></button>-->
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
                        <div style="padding: 10px; background-color:white;">
                            <table class="table table-bordered table_s mall tabl e-striped" style="color: black !important; background-color:white !important; ">
                                <thead>
                                    <th colspan="11">
                                        <h4>Ongoing Schemes (Sanctioned, Initiated, ICR-I, ICR-II, ICRI&II) </h4>
                                        <hr />
                                    </th>
                                    <tr>
                                        <th>#</th>
                                        <th>Components</th>
                                        <th>NO. OF SCHEMES</th>
                                        <th>SC/FCR (M)</th>
                                        <th>ICR-I (M)</th>
                                        <th>ICR-II (M)</th>
                                        <th>ICR-I&II (M)</th>
                                        <th>OTHER (M)</th>
                                        <th>FCR (M)</th>
                                        <th>TOTAL (M)</th>
                                        <th>TOTAL PAYABLE (M)</th>
                                </thead>
                                <tbody>

                                    <?php
                                    $query = "SELECT 
                                    component_id, component_name, component_detail,
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes`
                                    WHERE `sft_schemes`.`scheme_status`
                                     IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II') 
                                     GROUP BY component_id";
                                    $components = $this->db->query($query)->result();
                                    foreach ($components as $component) { ?>
                                        <tr>
                                            <th colspan="11">
                                                Component <?php echo $component->component_name; ?> : (<?php echo $component->component_detail; ?>)
                                            </th>
                                        </tr>

                                        <?php

                                        $query = "SELECT cc.* FROM component_categories as cc 
                                        INNER JOIN sub_components sc ON(sc.sub_component_id = cc.sub_component_id)
                                        WHERE cc.component_id = ?";
                                        $component_categories = $this->db->query($query, [$component->component_id])->result();


                                        $category_count = 1;
                                        foreach ($component_categories as $component_category) {
                                            $query = "SELECT category,category_detail,
                                            COUNT(0) AS `total`,
                                            SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                            SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                            SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                            SUM(`sft_schemes`.`1st`) AS `first`,
                                            SUM(`sft_schemes`.`2nd`) AS `second`,
                                            SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                            SUM(`sft_schemes`.`other`) AS `other`,
                                            SUM(`sft_schemes`.`final`) AS `final` 
                                            FROM `sft_schemes`
                                            WHERE `sft_schemes`.`scheme_status`
                                            IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II') 
                                            AND component_category_id = $component_category->component_category_id";
                                            $category = $this->db->query($query)->row();
                                        ?>
                                            <tr>
                                                <th><?php echo $category_count++; ?></th>
                                                <th><?php echo $component_category->category; ?>:
                                                    <small><?php echo $component_category->category_detail; ?>
                                                        <?php if ($component_category->category != 'B-2') {  ?> (No.) <?php } else { ?> (Acre) <?php } ?>
                                                    </small>
                                                </th>
                                                <th style="text-align: center;"><?php echo number_format($category->total); ?></th>
                                                <td><?php echo tomillions($category->sactioned_cost); ?></td>
                                                <td><?php echo tomillions($category->first); ?></td>
                                                <td><?php echo tomillions($category->second) ?></td>
                                                <td><?php echo tomillions($category->first_second); ?></td>
                                                <td><?php echo tomillions($category->other); ?></td>
                                                <td><?php echo tomillions($category->final); ?></td>
                                                <td><?php echo tomillions($category->total_paid); ?></td>
                                                <th><?php echo tomillions($category->balance); ?></th>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">SUB TOTAL</th>
                                            <th style="text-align: center;"><?php echo number_format($component->total); ?></th>
                                            <th><?php echo tomillions($component->sactioned_cost); ?></th>
                                            <th><?php echo tomillions($component->first); ?></th>
                                            <th><?php echo tomillions($component->second) ?></th>
                                            <th><?php echo tomillions($component->first_second); ?></th>
                                            <th><?php echo tomillions($component->other); ?></th>
                                            <th><?php echo tomillions($component->final); ?></th>
                                            <th><?php echo tomillions($component->total_paid); ?></th>
                                            <th><?php echo tomillions($component->balance); ?></th>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                                <?php
                                $query = "SELECT 
                                component_id, component_name,
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes`
                                    WHERE `sft_schemes`.`scheme_status`
                                     IN ('Sanctioned','Initiated', 'ICR-I', 'ICR-II')";
                                $component_total = $this->db->query($query)->row();
                                ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="11">GRAND TOTAL</th>
                                    </tr>

                                    <tr>
                                        <th colspan="2" style="text-align: right;"></th>
                                        <th style="text-align: center;"><?php echo number_format($component_total->total); ?></th>
                                        <th><?php echo tomillions($component_total->sactioned_cost); ?></th>
                                        <th><?php echo tomillions($component_total->first); ?></th>
                                        <th><?php echo tomillions($component_total->second) ?></th>
                                        <th><?php echo tomillions($component_total->first_second); ?></th>
                                        <th><?php echo tomillions($component_total->other); ?></th>
                                        <th><?php echo tomillions($component_total->final); ?></th>
                                        <th><?php echo tomillions($component_total->total_paid); ?></th>
                                        <th><?php echo tomillions($component_total->balance); ?></th>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>


                    </div>

                </div>
                <div class="col-md-12">
                    <div class="alert alert-success" id="messenger">


                        <div style="padding: 10px; background-color:white;">
                            <table class="table table-bordered table_s mall tabl e-striped" style="color: black !important; background-color:white !important; ">
                                <thead>
                                    <th colspan="9">
                                        <h4>Completed Schemes </h4>
                                        <hr />
                                    </th>
                                    <tr>
                                        <th>#</th>
                                        <th>Components</th>
                                        <th>NO. OF SCHEMES</th>
                                        <th>ICR-I (M)</th>
                                        <th>ICR-II (M)</th>
                                        <th>ICR-I&II (M)</th>
                                        <th>OTHER (M)</th>
                                        <th>FCR (M)</th>
                                        <th>TOTAL (M)</th>
                                </thead>
                                <tbody>

                                    <?php
                                    $query = "SELECT 
                                    component_id, component_name, component_detail,
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes`
                                    WHERE `sft_schemes`.`scheme_status`
                                     IN ('Completed') 
                                     GROUP BY component_id";
                                    $components = $this->db->query($query)->result();
                                    foreach ($components as $component) { ?>
                                        <tr>
                                            <th colspan="9">
                                                Component <?php echo $component->component_name; ?> : (<?php echo $component->component_detail; ?>)
                                            </th>
                                        </tr>

                                        <?php

                                        $query = "SELECT cc.* FROM component_categories as cc 
                                        INNER JOIN sub_components sc ON(sc.sub_component_id = cc.sub_component_id)
                                        WHERE cc.component_id = ?";
                                        $component_categories = $this->db->query($query, [$component->component_id])->result();


                                        $category_count = 1;
                                        foreach ($component_categories as $component_category) {
                                            $query = "SELECT category,category_detail,
                                            COUNT(0) AS `total`,
                                            SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                            SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                            SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                            SUM(`sft_schemes`.`1st`) AS `first`,
                                            SUM(`sft_schemes`.`2nd`) AS `second`,
                                            SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                            SUM(`sft_schemes`.`other`) AS `other`,
                                            SUM(`sft_schemes`.`final`) AS `final` 
                                            FROM `sft_schemes`
                                            WHERE `sft_schemes`.`scheme_status`
                                            IN ('Completed') 
                                            AND component_category_id = $component_category->component_category_id";
                                            $category = $this->db->query($query)->row();
                                        ?>
                                            <tr>
                                                <th><?php echo $category_count++; ?></th>
                                                <th><?php echo $component_category->category; ?>:
                                                    <small><?php echo $component_category->category_detail; ?>
                                                        <?php if ($component_category->category != 'B-2') {  ?> (No.) <?php } else { ?> (Acre) <?php } ?>
                                                    </small>
                                                </th>
                                                <th style="text-align: center;"><?php echo number_format($category->total); ?></th>
                                                <td><?php echo tomillions($category->first); ?></td>
                                                <td><?php echo tomillions($category->second) ?></td>
                                                <td><?php echo tomillions($category->first_second); ?></td>
                                                <td><?php echo tomillions($category->other); ?></td>
                                                <td><?php echo tomillions($category->final); ?></td>
                                                <td><?php echo tomillions($category->total_paid); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">SUB TOTAL</th>
                                            <th style="text-align: center;"><?php echo number_format($component->total); ?></th>
                                            <th><?php echo tomillions($component->first); ?></th>
                                            <th><?php echo tomillions($component->second) ?></th>
                                            <th><?php echo tomillions($component->first_second); ?></th>
                                            <th><?php echo tomillions($component->other); ?></th>
                                            <th><?php echo tomillions($component->final); ?></th>
                                            <th><?php echo tomillions($component->total_paid); ?></th>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                                <?php
                                $query = "SELECT 
                                component_id, component_name,
                                    COUNT(0) AS `total`,
                                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                    SUM(COALESCE(sft_schemes.sanctioned_cost, 0))  - SUM(COALESCE(sft_schemes.total_paid, 0)) AS balance,
                                    SUM(`sft_schemes`.`1st`) AS `first`,
                                    SUM(`sft_schemes`.`2nd`) AS `second`,
                                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                                    SUM(`sft_schemes`.`other`) AS `other`,
                                    SUM(`sft_schemes`.`final`) AS `final` 
                                    FROM `sft_schemes`
                                    WHERE `sft_schemes`.`scheme_status`
                                     IN ('Completed')";
                                $component_total = $this->db->query($query)->row();
                                ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="11">GRAND TOTAL</th>
                                    </tr>

                                    <tr>
                                        <th colspan="2" style="text-align: right;"></th>
                                        <th style="text-align: center;"><?php echo number_format($component_total->total); ?></th>
                                        <th><?php echo tomillions($component_total->first); ?></th>
                                        <th><?php echo tomillions($component_total->second) ?></th>
                                        <th><?php echo tomillions($component_total->first_second); ?></th>
                                        <th><?php echo tomillions($component_total->other); ?></th>
                                        <th><?php echo tomillions($component_total->final); ?></th>
                                        <th><?php echo tomillions($component_total->total_paid); ?></th>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>


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