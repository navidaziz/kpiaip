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
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . 'annual_work_plans/index'); ?>">Annual Work Plans</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
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
                <div class="tabbable header-tabs">

                    <ul class="nav nav-tabs">
                        <?php
                        $query = "SELECT * FROM financial_years ORDER BY financial_year_id DESC";
                        $f_years = $this->db->query($query)->result();
                        foreach ($f_years as $f_year) {
                        ?>
                            <li <?php if ($f_year->financial_year_id == $fy->financial_year_id) { ?> class="active" <?php } ?>>
                                <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/district_annual_work_plan_report?fy=" . $f_year->financial_year_id) ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <i class="fa fa-check" aria-hidden="true"></i><?php echo $f_year->financial_year; ?></a>
                            </li>
                        <?php } ?>





                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="box_tab3">

                            <div class="table-responsive">

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
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            <?php } ?>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <?php
                                            foreach ($component_categories as $component_category) { ?>
                                                <th style="text-wrap: nowrap;" colspan="5"><?php echo $component_category->category; ?></th>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <?php
                                            foreach ($component_categories as $component_category) { ?>
                                                <th style="text-align: center; ">Targets</th>
                                                <th style="text-align: center;">Material Cost</th>
                                                <th style="text-align: center;">Labor Cost</th>
                                                <th style="text-align: center;">Farmer Share</th>
                                                <th style="text-align: center;">Total Cost</th>
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
                                                    $query = "SELECT * 
                                                      FROM district_annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id = '" . $fy->financial_year_id . "'
                                                      AND district_id = '" . $district->district_id . "'";
                                                    $district_category_target = $this->db->query($query)->row();
                                                    //echo $category_target;
                                                    ?>
                                                    <td><?php echo ($district_category_target != NULL) ? $district_category_target->anual_target : '0'  ?></td>
                                                    <td><?php echo ($district_category_target != NULL) ? $district_category_target->material_cost : '0'  ?></td>
                                                    <td><?php echo ($district_category_target != NULL) ? $district_category_target->labor_cost : '0'  ?></td>
                                                    <td><?php echo ($district_category_target != NULL) ? $district_category_target->farmer_share : '0'  ?></td>
                                                    <td><?php echo ($district_category_target != NULL) ? $district_category_target->total_cost : '0'  ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th>Total</th>
                                            <?php foreach ($component_categories as $component_category) { ?>
                                                <?php
                                                $query = "SELECT SUM(anual_target) as anual_target,
                                                        SUM(material_cost) as material_cost,
                                                        SUM(labor_cost) as labor_cost,
                                                        SUM(farmer_share) as farmer_share,
                                                        SUM(total_cost) as total_cost
                                                      FROM district_annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id = '" . $fy->financial_year_id . "'";
                                                $category_target = $this->db->query($query)->row();
                                                //echo $category_target;
                                                ?>
                                                <td><?php echo ($category_target != NULL) ? $category_target->anual_target : '0'  ?></td>
                                                <td><?php echo ($category_target != NULL) ? $category_target->material_cost : '0'  ?></td>
                                                <td><?php echo ($category_target != NULL) ? $category_target->labor_cost : '0'  ?></td>
                                                <td><?php echo ($category_target != NULL) ? $category_target->farmer_share : '0'  ?></td>
                                                <td><?php echo ($category_target != NULL) ? $category_target->total_cost : '0'  ?></td>
                                            <?php } ?>

                                        </tr>
                                    </tbody>
                                </table>






                            </div>

                            <hr class="margin-bottom-0">

                        </div>


                    </div>
                </div>




            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>