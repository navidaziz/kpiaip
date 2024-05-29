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
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "sub_components/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "sub_components/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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

                                <th>Components</th>
                                <th>Sub Components</th>
                                <th style="text-align: center;">Component Catrgories</th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sub_components as $sub_component) : ?>

                                <tr>

                                    <th>
                                        <?php echo $sub_component->component_name; ?>
                                    </th>

                                    <td>
                                        <?php echo $sub_component->sub_component_name; ?>: <?php echo $sub_component->sub_component_detail; ?>
                                    </td>

                                    <td></td>
                                    <td style="text-align: center;">
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "sub_components/view_sub_component/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <span style="margin-left: 10px;"></span>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "sub_components/edit/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="margin-left: 10px;"></span>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "sub_components/trash/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $query = "SELECT * FROM component_categories WHERE status IN (0,1) 
                            AND sub_component_id = '" . $sub_component->sub_component_id . "'
                            ORDER BY category ASC";
                                $component_categories = $this->db->query($query)->result();

                                $count = 1;
                                foreach ($component_categories as $component_category) : ?>

                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <th>
                                            <?php echo $count++; ?>. <?php echo $component_category->category; ?>: <?php echo $component_category->category_detail; ?>
                                        </th>

                                        <td></td>



                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>