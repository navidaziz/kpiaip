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


<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <?php
                        $query = "SELECT COUNT(*) AS completed_schemes FROM scheme_lists 
                        WHERE scheme_status = 'Completed'";
                        $completed_schemes = $this->db->query($query)->row()->completed_schemes;
                        ?>
                        <h5><?php echo $description; ?> of Completed Schemes: <?php echo $completed_schemes; ?></h5>
                    </div>
                    <?php $query = "SELECT * FROM sub_components as sc
                                    WHERE sc.sub_component_id IN(1,2,3,4,5,6,7,8)";
                    $sub_components = $this->db->query($query)->result(); ?>
                    <table class="table table_small table-bordered" id="taxes">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <?php foreach ($sub_components as $sub_component) { ?>
                                    <th><?php echo $sub_component->sub_component_name; ?></th>
                                    <th></th>
                                    <th></th>
                                <?php } ?>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <?php foreach ($sub_components as $sub_component) { ?>
                                    <th>Total Schemes</th>
                                    <th>Total Cost</th>
                                    <th>Avg Cost</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $districts = $this->db->query("SELECT * FROM districts WHERE is_district=1 ORDER BY district_name")->result();
                            $count = 1;
                            foreach ($districts as $district) {  ?>
                                <tr>
                                    <th><?php echo $count++; ?></th>
                                    <th><?php echo $district->district_name ?></th>
                                    <?php foreach ($sub_components as $sub_component) { ?>

                                        <?php
                                        $query = "
                                            SELECT 
                                            COUNT(*) AS total_schemes,
                                            SUM(paid) AS total_cost,
                                            AVG(paid) AS avg_cost
                                            FROM 
                                            scheme_lists AS s
                                            INNER JOIN component_categories as cc ON(cc.component_category_id = s.component_category_id)
                                            WHERE cc.sub_component_id = '" . intval($sub_component->sub_component_id) . "'
                                            AND s.scheme_status = 'Completed'
                                            AND s.district_id = $district->district_id";

                                        $scheme = $this->db->query($query)->row();
                                        ?>
                                        <th><?php echo $scheme->total_schemes > 0 ? number_format(round($scheme->total_schemes, 2)) : ''; ?></th>
                                        <th><?php echo $scheme->total_cost > 0 ? number_format(round($scheme->total_cost, 2)) : ''; ?></th>

                                        <th><?php echo $scheme->avg_cost > 0 ? number_format(round($scheme->avg_cost, 2)) : ''; ?></th>

                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Total:</th>
                                <?php foreach ($sub_components as $sub_component) { ?>

                                    <?php
                                    $query = "
                                            SELECT 
                                            COUNT(*) AS total_schemes,
                                            SUM(paid) AS total_cost,
                                            AVG(paid) AS avg_cost
                                            FROM 
                                            scheme_lists AS s
                                            INNER JOIN component_categories as cc ON(cc.component_category_id = s.component_category_id)
                                            WHERE cc.sub_component_id = '" . intval($sub_component->sub_component_id) . "'
                                            AND s.scheme_status = 'Completed'
                                            AND s.district_id = $district->district_id";

                                    $scheme = $this->db->query($query)->row();
                                    ?>
                                    <td><?php echo $scheme->total_schemes > 0 ? number_format(round($scheme->total_schemes, 2)) : ''; ?></td>
                                    <td><?php echo $scheme->total_cost > 0 ? number_format(round($scheme->total_cost, 2)) : ''; ?></td>

                                    <td><?php echo $scheme->avg_cost > 0 ? number_format(round($scheme->avg_cost, 2)) : ''; ?></td>

                                <?php } ?>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $description . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#taxes').DataTable({
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