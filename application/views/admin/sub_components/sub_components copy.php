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

                                <th>Component</th>
                                <th>Sub Component</th>

                                <th>Detail</th>
                                <th>Catrgories</th>

                                <th><?php echo $this->lang->line('Status'); ?></th>
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
                                        <?php echo $sub_component->sub_component_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $sub_component->sub_component_detail; ?>
                                    </td>

                                    <td>
                                        <table class="table table-bordered" id="db_table">
                                            <thead>


                                                <tr>

                                                    <th>#</th>
                                                    <th> <?php echo $sub_component->component_name; ?> - <?php echo $sub_component->sub_component_name; ?>: Categories
                                                    </th>

                                                </tr>



                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "SELECT * FROM component_categories WHERE status IN (0,1) 
                            AND sub_component_id = '" . $sub_component->sub_component_id . "'
                            ORDER BY category ASC";
                                                $component_categories = $this->db->query($query)->result();

                                                $count = 1;
                                                foreach ($component_categories as $component_category) : ?>

                                                    <tr>
                                                        <td><a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "component_categories/trash/" . $component_category->component_category_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                        <td><?php echo $count++; ?></td>
                                                        <th>
                                                            <?php echo $component_category->category; ?>: <?php echo $component_category->category_detail; ?>
                                                        </th>




                                                    </tr>
                                                <?php endforeach; ?>


                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </td>

                                    <td>
                                        <?php echo status($sub_component->status,  $this->lang); ?>
                                        <?php

                                        //set uri segment
                                        if (!$this->uri->segment(4)) {
                                            $page = 0;
                                        } else {
                                            $page = $this->uri->segment(4);
                                        }

                                        if ($sub_component->status == 0) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "sub_components/publish/" . $sub_component->sub_component_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Publish') . "</a>";
                                        } elseif ($sub_component->status == 1) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "sub_components/draft/" . $sub_component->sub_component_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Draft') . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "sub_components/view_sub_component/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "sub_components/edit/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "sub_components/trash/" . $sub_component->sub_component_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
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