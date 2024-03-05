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
                    <a href="<?php echo site_url(ADMIN_DIR . "component_categories/view/"); ?>"><?php echo $this->lang->line('Component Categories'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "component_categories/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "component_categories/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                            <?php foreach ($component_categories as $component_category) : ?>


                                <tr>
                                    <th><?php echo $this->lang->line('category'); ?></th>
                                    <td>
                                        <?php echo $component_category->category; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('category_detail'); ?></th>
                                    <td>
                                        <?php echo $component_category->category_detail; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('target_unit'); ?></th>
                                    <td>
                                        <?php echo $component_category->target_unit; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('target'); ?></th>
                                    <td>
                                        <?php echo $component_category->target; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('material_cost'); ?></th>
                                    <td>
                                        <?php echo $component_category->material_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('labor_cost'); ?></th>
                                    <td>
                                        <?php echo $component_category->labor_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('farmer_share'); ?></th>
                                    <td>
                                        <?php echo $component_category->farmer_share; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('total_cost'); ?></th>
                                    <td>
                                        <?php echo $component_category->total_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('project_name'); ?></th>
                                    <td>
                                        <?php echo $component_category->project_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('component_name'); ?></th>
                                    <td>
                                        <?php echo $component_category->component_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('sub_component_name'); ?></th>
                                    <td>
                                        <?php echo $component_category->sub_component_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                    <td>
                                        <?php echo status($component_category->status); ?>
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