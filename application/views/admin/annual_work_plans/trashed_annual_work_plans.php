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
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view/"); ?>"><?php echo $this->lang->line('Annual Work Plans'); ?></a>
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
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
                <!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table-table-bordered">
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
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view_annual_work_plan/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-restore" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/restore/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-undo"></i></a>
                                        <a class="llink llink-delete" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/delete/" . $annual_work_plan->annual_work_plan_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php echo $pagination; ?>

                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>