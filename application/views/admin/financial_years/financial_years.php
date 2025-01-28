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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "financial_years/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "financial_years/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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

                    <table class="table table-bordered" id="financial_summary_table">
                        <thead>
                            <tr>

                                <th><?php echo $this->lang->line('start_date'); ?></th>
                                <th><?php echo $this->lang->line('end_date'); ?></th>
                                <th><?php echo $this->lang->line('financial_year'); ?></th>
                                <th><?php echo $this->lang->line('project_name'); ?></th>
                                <th>Forex</th>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($financial_years as $financial_year) : ?>

                                <tr>


                                    <td>
                                        <?php echo $financial_year->start_date; ?>
                                    </td>
                                    <td>
                                        <?php echo $financial_year->end_date; ?>
                                    </td>
                                    <td>
                                        <?php echo $financial_year->financial_year; ?>
                                    </td>
                                    <td>
                                        <?php echo $financial_year->project_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $financial_year->forex; ?>
                                    </td>
                                    <td>
                                        <?php //echo status($financial_year->status,  $this->lang); 
                                        ?>
                                        <?php

                                        //set uri segment
                                        if (!$this->uri->segment(4)) {
                                            $page = 0;
                                        } else {
                                            $page = $this->uri->segment(4);
                                        }

                                        if ($financial_year->status == 0) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "financial_years/publish/" . $financial_year->financial_year_id . "/" . $page) . "'> Set As Current Session</a>";
                                        } elseif ($financial_year->status == 1) {
                                            echo "Current Session";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "financial_years/view_financial_year/" . $financial_year->financial_year_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "financial_years/edit/" . $financial_year->financial_year_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "financial_years/trash/" . $financial_year->financial_year_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
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