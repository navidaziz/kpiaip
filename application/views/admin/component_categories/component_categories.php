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

                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th><?php echo $this->lang->line('category'); ?></th>
                                <th><?php echo $this->lang->line('category_detail'); ?></th>
                                <th><?php echo $this->lang->line('target_unit'); ?></th>
                                <th><?php echo $this->lang->line('target'); ?></th>
                                <th><?php echo $this->lang->line('material_cost'); ?></th>
                                <th><?php echo $this->lang->line('labor_cost'); ?></th>
                                <th><?php echo $this->lang->line('farmer_share'); ?></th>
                                <th><?php echo $this->lang->line('total_cost'); ?></th>
                                <th><?php echo $this->lang->line('project_name'); ?></th>
                                <th><?php echo $this->lang->line('component_name'); ?></th>
                                <th><?php echo $this->lang->line('sub_component_name'); ?></th>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($component_categories as $component_category) : ?>

                                <tr>


                                    <td>
                                        <?php echo $component_category->category; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->category_detail; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->target_unit; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->target; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->material_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->labor_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->farmer_share; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->total_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->project_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->component_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $component_category->sub_component_name; ?>
                                    </td>
                                    <td>
                                        <?php echo status($component_category->status,  $this->lang); ?>
                                        <?php

                                        //set uri segment
                                        if (!$this->uri->segment(4)) {
                                            $page = 0;
                                        } else {
                                            $page = $this->uri->segment(4);
                                        }

                                        if ($component_category->status == 0) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "component_categories/publish/" . $component_category->component_category_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Publish') . "</a>";
                                        } elseif ($component_category->status == 1) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "component_categories/draft/" . $component_category->component_category_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Draft') . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "component_categories/view_component_category/" . $component_category->component_category_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "component_categories/edit/" . $component_category->component_category_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "component_categories/trash/" . $component_category->component_category_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
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