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
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
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
                        <a class="btn btn-primary btn-sm"
                            href="<?php echo site_url(ADMIN_DIR . "sub_components/add"); ?>"><i class="fa fa-plus"></i>
                            <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm"
                            href="<?php echo site_url(ADMIN_DIR . "sub_components/trashed"); ?>"><i
                                class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                        $query = "SELECT * FROM `components` WHERE status=1
                        ORDER BY component_name ASC
                        ";
                        $components = $this->db->query($query)->result();
                        foreach ($components as $component) { ?>
                            <li>
                                <hr />
                                <h4><?php echo $component->component_name; ?>: <?php echo $component->component_detail; ?>
                                </h4>
                                <hr />
                            </li>
                            <?php
                            $query = "SELECT * FROM `sub_components` 
                            WHERE component_id = '" . $component->component_id . "'
                            AND status=1
                            ORDER BY sub_component_name ASC";
                            $sub_components = $this->db->query($query)->result();
                            ?>
                            <ol>
                                <?php foreach ($sub_components as $sub_component) { ?>
                                    <li>
                                        <h5>

                                            <?php echo  $sub_component->sub_component_name; ?>:
                                            <?php echo $sub_component->sub_component_detail; ?>
                                            <span class="pull-right">
                                                <span style="margin-left: 10px;"></span>
                                                <!-- <a onclick="return confirm('Are you sure you want to move this item to trash?');"
                                            class="llink llink-trash"
                                            href="<?php echo site_url(ADMIN_DIR . "sub_components/trash/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i
                                                class="fa fa-trash-o"></i></a>
                                        <span style="margin-left: 20px;"></span> -->
                                                <a class="llink llink-view"
                                                    href="<?php echo site_url(ADMIN_DIR . "sub_components/view_sub_component/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i
                                                        class="fa fa-eye"></i> </a>
                                                <!-- <span style="margin-left: 10px;"></span>
                                        <a class="llink llink-edit"
                                            href="<?php echo site_url(ADMIN_DIR . "sub_components/edit/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i
                                                class="fa fa-pencil-square-o"></i></a> -->
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
                                            <?php if (count($category_types) > 1) { ?>
                                                <li>
                                                    <h6> <?php echo $category_type->main_heading ?></h6>
                                                </li>
                                            <?php } ?>
                                            <?php $query = "SELECT * FROM `component_categories` 
                                                    WHERE component_id = " . $component->component_id . " 
                                                    AND sub_component_id = " . $sub_component->sub_component_id . "
                                                    AND main_heading = '" . $category_type->main_heading . "'
                                                    AND status=1 ORDER BY account_code ASC";
                                            $categories = $this->db->query($query)->result(); ?>

                                            <table class="table table-bordered">
                                                <?php
                                                $c_count = 1;
                                                foreach ($categories as $category) { ?>

                                                    <tr>
                                                        <td><?php echo $c_count++; ?></td>
                                                        <td><?php echo $category->category; ?>

                                                        </td>
                                                        <td><?php echo $category->category_detail;  ?>
                                                            <small
                                                                class="pull-right"><?php echo $category->component_category_id; ?></small>
                                                        </td>
                                                        <td><?php echo $category->account_code; ?></td>
                                                        <td><?php echo $category->material_share; ?> %</td>
                                                        <td><?php echo $category->farmer_share; ?> %</td>
                                                        <td><?php echo $category->target_unit; ?></td>
                                                        <th style="color: red;">

                                                            <?php
                                                            $query = "SELECT COUNT(*) as total FROM expenses 
                                                            WHERE component_category_id = " . $category->component_category_id . "";
                                                            $expense_count = $this->db->query($query)->row();
                                                            echo $expense_count->total;
                                                            ?>

                                                        </th>
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



                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>