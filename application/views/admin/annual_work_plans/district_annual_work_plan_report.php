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
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/add"); ?>"><i class="fa fa-plus"></i> Add Annual Work Plan</a>
                        <!-- <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
                     -->
                    </div>
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
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 10px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <th colspan="5"></th>
                    <?php
                    $query = "SELECT * FROM financial_years";
                    $f_years = $this->db->query($query)->result();
                    foreach ($f_years as $f_year) {
                    ?>
                        <strong><?php echo $f_year->financial_year; ?></strong>

                        <table class="table table_small table-bordered" id="db_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <?php
                                    $query = "SELECT 
                                    cs.component_category_id,
                                    cs.category,
                                    cs.category_detail,
                                    c.component_name,
                                    sc.sub_component_name
                                    FROM component_categories  as cs
                                    INNER JOIN components as c ON(c.component_id = cs.component_id)
                                    INNER JOIN sub_components as sc ON(sc.sub_component_id = cs.sub_component_id)
                                    WHERE cs.status IN (0,1) 
                                    ORDER BY c.component_id ASC, sc.sub_component_id ASC";
                                    $component_categories = $this->db->query($query)->result();

                                    $count = 1;
                                    foreach ($component_categories as $component_category) { ?>
                                        <th style="text-wrap: nowrap;"><?php echo $component_category->category; ?></th>
                                    <?php } ?>



                                </tr>
                                <tr>
                                    <th></th>
                                    <?php foreach ($component_categories as $component_category) { ?>
                                        <?php
                                        $query = "SELECT anual_target 
                                                      FROM annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id = '" . $f_year->financial_year_id . "'";
                                        $category_target = $this->db->query($query)->row();
                                        //echo $category_target;
                                        ?>
                                        <td><?php echo ($category_target != NULL) ? $category_target->anual_target : '0'  ?></td>
                                    <?php } ?>

                                </tr>
                                <?php
                                $query = "SELECT * FROM districts";
                                $districts = $this->db->query($query)->result();
                                foreach ($districts as $district) { ?>
                                    <tr>
                                        <th><?php echo $district->district_name; ?></th>
                                        <?php foreach ($component_categories as $component_category) { ?>
                                            <?php
                                            $query = "SELECT anual_target 
                                                      FROM district_annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id = '" . $f_year->financial_year_id . "'
                                                      AND district_id = '" . $district->district_id . "'";
                                            $district_category_target = $this->db->query($query)->row();
                                            //echo $category_target;
                                            ?>
                                            <td><?php echo ($district_category_target != NULL) ? $district_category_target->anual_target : '0'  ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </thead>
                        </table>
                    <?php } ?>





                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>