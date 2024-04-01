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

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php foreach ($annual_work_plans as $annual_work_plan) : ?>


                                <tr>
                                    <th><?php echo $this->lang->line('anual_target'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->anual_target; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('material_cost'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->material_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('labor_cost'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->labor_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('farmer_share'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->farmer_share; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('total_cost'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->total_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('project_name'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->project_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('component_name'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->component_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('sub_component_name'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->sub_component_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('category'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->category; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('financial_year'); ?></th>
                                    <td>
                                        <?php echo $annual_work_plan->financial_year; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                    <td>
                                        <?php echo status($annual_work_plan->status); ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>




                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>