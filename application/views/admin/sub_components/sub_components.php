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
                    <ol>
                        <?php
                        $query = "SELECT * FROM `components` WHERE status=1";
                        $components = $this->db->query($query)->result();
                        foreach ($components as $component) { ?>
                            <li>
                                <hr />
                                <h4><?php echo $component->component_name; ?>: <?php echo $component->component_detail; ?></h4>
                                <hr />
                            </li>
                            <?php
                            $query = "SELECT * FROM `sub_components` 
                            WHERE component_id = " . $component->component_id . "
                            AND status=1";
                            $sub_components = $this->db->query($query)->result();
                            ?>
                            <ol>
                                <?php foreach ($sub_components as $sub_component) { ?>
                                    <li>
                                        <h5>

                                            <?php echo  $sub_component->sub_component_name; ?>: <?php echo $sub_component->sub_component_detail; ?>
                                            <span class="pull-right">
                                                <span style="margin-left: 10px;"></span>
                                                <a onclick="return confirm('Are you sure you want to move this item to trash?');" class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "sub_components/trash/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                                <span style="margin-left: 20px;"></span>
                                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "sub_components/view_sub_component/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                                <span style="margin-left: 10px;"></span>
                                                <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "sub_components/edit/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            </span>
                                        </h5>
                                    </li>

                                    <?php $query = "SELECT main_heading
                                    FROM `component_categories` 
                                        WHERE component_id = " . $component->component_id . " 
                                        AND sub_component_id = " . $sub_component->sub_component_id . "
                                        AND status=1
                                        GROUP BY main_heading ORDER BY CAST(SUBSTR(main_heading, 1, INSTR(main_heading, '-') - 1) AS INTEGER)";
                                    $category_types = $this->db->query($query)->result();
                                    ?>
                                    <ol>
                                        <?php foreach ($category_types as $category_type) { ?>
                                            <li>
                                                <h6> <?php echo $category_type->main_heading ?></h6>
                                            </li>
                                            <?php $query = "SELECT * FROM `component_categories` 
                                                    WHERE component_id = " . $component->component_id . " 
                                                    AND sub_component_id = " . $sub_component->sub_component_id . "
                                                    AND main_heading = '" . $category_type->main_heading . "'
                                                    AND status=1";
                                            $categories = $this->db->query($query)->result(); ?>

                                            <table class="table table-bordered">
                                                <?php
                                                $c_count = 1;
                                                foreach ($categories as $category) { ?>

                                                    <tr>
                                                        <td><?php echo $c_count++; ?></td>
                                                        <td><?php echo $category->category; ?></td>
                                                        <td><?php echo $category->category_detail; ?></td>
                                                        <td><?php echo $category->account_code; ?></td>
                                                        <td><?php echo $category->target_unit; ?></td>
                                                    </tr>
                                                <?php   } ?>
                                            </table>
                                            </li>

                                        <?php   } ?>
                                    </ol>



                                <?php  } ?>
                            </ol>
                        <?php  }  ?>
                    </ol>

                    <?php

                    foreach ($sub_components as $sub_component) : ?>

                        <h4>
                            <?php echo $sub_component->component_name; ?>: <?php echo $sub_component->component_detail; ?>
                        </h4>

                        <hr />
                        <h5>
                            <?php echo $sub_component->sub_component_name; ?>: <?php echo $sub_component->sub_component_detail; ?>
                            <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "sub_components/view_sub_component/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                            <span style="margin-left: 10px;"></span>
                            <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "sub_components/edit/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                            <span style="margin-left: 10px;"></span>
                            <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "sub_components/trash/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                        </h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Account Code</th>
                                <th>Main Heading</th>
                                <th>Categories</th>
                                <th>Detail</th>
                                <th>Unit</th>
                            </tr>

                            <?php
                            $query = "SELECT * FROM component_categories WHERE status IN (0,1) 
                                AND sub_component_id = '" . $sub_component->sub_component_id . "'
                                ORDER BY category ASC";
                            $component_categories = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($component_categories as $component_category) : ?>

                                <tr>
                                    <th><?php echo $count++; ?>.</th>
                                    <td><?php echo $component_category->account_code; ?></td>
                                    <td><?php echo $component_category->main_heading; ?></td>
                                    <td><?php echo $component_category->category; ?></td>
                                    <td><?php echo $component_category->category_detail; ?></td>
                                    <td><?php echo $component_category->target_unit; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>



                    <?php endforeach; ?>



                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>