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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                    <table class="table table_small table-bordered" id="db_table">
                        <thead>
                            <tr>
                                <th colspan="5"></th>
                                <?php
                                $query = "SELECT * FROM financial_years";
                                $f_years = $this->db->query($query)->result();
                                foreach ($f_years as $f_year) {
                                ?>
                                    <th style="text-align: center;" colspan="5"><?php echo $f_year->financial_year; ?></th>
                                <?php } ?>
                            </tr>

                            <tr>
                                <th>#</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Unit</th>
                                <?php
                                foreach ($f_years as $f_year) {
                                ?>
                                    <th style="text-align: center; ">Tar</th>
                                    <th style="text-align: center;">M-C</th>
                                    <th style="text-align: center;">L-C</th>
                                    <th style="text-align: center;">F-S</th>
                                    <th style="text-align: center;">T-C</th>
                                <?php } ?>
                                <th>View</th>
                            </tr>



                        </thead>
                        <tbody>

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
                            foreach ($component_categories as $component_category) : ?>

                                <tr>
                                    </td>
                                    <td><?php echo $count++; ?></td>
                                    <th>
                                        <?php echo $component_category->component_name; ?>
                                    </th>
                                    <th>
                                        <?php echo $component_category->sub_component_name; ?>
                                    </th>
                                    <th>
                                        <?php echo $component_category->category; ?>:
                                    </th>

                                    <td>Unit</td>
                                    <?php
                                    $query = "SELECT * FROM financial_years";
                                    $f_years = $this->db->query($query)->result();
                                    foreach ($f_years as $f_year) {
                                        $query = "SELECT * FROM annual_work_plans 
                                        WHERE financial_year_id='" . $f_year->financial_year_id . "'
                                        AND component_category_id = " . $component_category->component_category_id . "";
                                        $awp = $this->db->query($query)->row();
                                    ?>
                                        <td style="text-align: center;"><?php if ($awp) echo $awp->anual_target; ?></td>
                                        <td style="text-align: center;"><?php if ($awp) echo $awp->material_cost; ?></td>
                                        <td style="text-align: center;"><?php if ($awp) echo $awp->labor_cost; ?></td>
                                        <td style="text-align: center;"><?php if ($awp) echo $awp->farmer_share; ?></td>
                                        <td style="text-align: center;"><?php if ($awp) echo $awp->total_cost; ?></td>

                                    <?php } ?>


                                    <td style="text-align: center;">
                                        <a style="cursor: pointer;" class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view_component_category/" . $component_category->component_category_id); ?>"><i class="fa fa-eye"></i> </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                    <!-- <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th><?php echo $this->lang->line('anual_target'); ?></th>
                                <th><?php echo $this->lang->line('material_cost'); ?></th>
                                <th><?php echo $this->lang->line('labor_cost'); ?></th>
                                <th><?php echo $this->lang->line('farmer_share'); ?></th>
                                <th><?php echo $this->lang->line('total_cost'); ?></th>
                                <th><?php echo $this->lang->line('project_name'); ?></th>
                                <th><?php echo $this->lang->line('component_name'); ?></th>
                                <th><?php echo $this->lang->line('sub_component_name'); ?></th>
                                <th><?php echo $this->lang->line('category'); ?></th>
                                <th><?php echo $this->lang->line('financial_year'); ?></th>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($annual_work_plans as $annual_work_plan) : ?>

                                <tr>


                                    <td>
                                        <?php echo $annual_work_plan->anual_target; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->material_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->labor_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->farmer_share; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->total_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->project_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->component_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->sub_component_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->category; ?>
                                    </td>
                                    <td>
                                        <?php echo $annual_work_plan->financial_year; ?>
                                    </td>
                                    <td>
                                        <?php echo status($annual_work_plan->status,  $this->lang); ?>
                                        <?php

                                        //set uri segment
                                        if (!$this->uri->segment(4)) {
                                            $page = 0;
                                        } else {
                                            $page = $this->uri->segment(4);
                                        }

                                        if ($annual_work_plan->status == 0) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "annual_work_plans/publish/" . $annual_work_plan->annual_work_plan_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Publish') . "</a>";
                                        } elseif ($annual_work_plan->status == 1) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "annual_work_plans/draft/" . $annual_work_plan->annual_work_plan_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Draft') . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view_annual_work_plan/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/edit/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/trash/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table> -->

                    <?php //echo $pagination; 
                    ?>


                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>