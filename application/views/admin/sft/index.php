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
        font-size: 11px !important;
        color: black;
        margin: 0px !important;
    }

    .table_v_small>thead>tr>th,
    .table_v_small>tbody>tr>th,
    .table_v_small>tfoot>tr>th,
    .table_v_small>thead>tr>td,
    .table_v_small>tbody>tr>td,
    .table_v_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 6px !important;
        color: black;
        margin: 0px !important;
    }

    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: #f0ad4e;
        z-index: 3;
        color: black;
        font-weight: bold;
    }
</style>
<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-4">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description;
                                                ?></div>
                </div>

                <div class="col-md-8">
                    <?php
                    // Count the total WUA List
                    $query = "SELECT COUNT(*) as total FROM schemes WHERE scheme_status = 'Completed' and sft_reviewed=1";
                    if ($district_id) {
                        $query .= " AND district_id = $district_id";
                    }
                    $revied_schemes = $this->db->query($query)->row(); // Fetch the total count

                    // Count the total WUA List
                    $query = "SELECT COUNT(*) as total FROM schemes WHERE scheme_status = 'Completed' and sft_reviewed=0";
                    if ($district_id) {
                        $query .= " AND district_id = $district_id";
                    }
                    $review_schemes = $this->db->query($query)->row(); // Fetch the total count

                    $precentage = round(($revied_schemes->total * 100) / $review_schemes->total, 2); ?>
                    <table class="table table-bordered table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Progress</th>
                                <th>Total</th>
                                <th>Reviewed</th>
                                <th>Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td><strong style="color: #dc3545;"><?php echo $review_schemes->total; ?></strong></td>
                                <td><strong style="color: #28a745;"><?php echo $revied_schemes->total; ?></strong></td>
                                <td><strong style="color: #ffc107;"><?php echo $review_schemes->total - $revied_schemes->total; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="progress" style="height:20px!important">
                        <style>
                            .bg-danger {
                                background-color: #28a745 !important;
                                color: white;
                                font-weight: bold;
                            }
                        </style>

                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: <?php echo $precentage ?>%;" aria-valuenow="<?php echo $precentage ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $precentage ?>%</div>
                    </div>


                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4> <i class="fa fa-list"></i></h4>

            </div>
            <div class="box-body">
                <div class="header-tabs">

                    <ul class="nav nav-tabs" s>

                        <li style="font-size: 11px;" <?php if ('corrected' == $tab) { ?> class="active" <?php } ?>>
                            <a href="<?php echo site_url(ADMIN_DIR . "sft/index/corrected"); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                Reviewed (<?php echo $revied_schemes->total; ?>)
                            </a>
                        </li>
                        <!-- WUA List Tab -->
                        <li style="font-size: 11px;" <?php if ('correction' == $tab) { ?> class="active" <?php } ?>>
                            <a href="<?php echo site_url(ADMIN_DIR . "sft/index/correction"); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                Need Review (<?php echo $review_schemes->total; ?>)

                            </a>
                        </li>

                    </ul>

                    <div class="tab-content" style="margin-top: -35px;">
                        <?php $this->load->view(ADMIN_DIR . "sft/schemes_list"); ?>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>