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
                    <a href="<?php echo site_url(ADMIN_DIR . "schemes/view/"); ?>"><?php echo $this->lang->line('Schemes'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "schemes/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "schemes/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                                <th><?php echo $this->lang->line('scheme_code'); ?></th>
                                <th><?php echo $this->lang->line('scheme_name'); ?></th>
                                <th><?php echo $this->lang->line('water_source'); ?></th>
                                <th><?php echo $this->lang->line('latitude'); ?></th>
                                <th><?php echo $this->lang->line('longitude'); ?></th>
                                <th><?php echo $this->lang->line('beneficiaries'); ?></th>
                                <th><?php echo $this->lang->line('male_beneficiaries'); ?></th>
                                <th><?php echo $this->lang->line('female_beneficiaries'); ?></th>
                                <th><?php echo $this->lang->line('estimated_cost'); ?></th>
                                <th><?php echo $this->lang->line('approved_cost'); ?></th>
                                <th><?php echo $this->lang->line('revised_cost'); ?></th>
                                <th><?php echo $this->lang->line('sanctioned_cost'); ?></th>
                                <th><?php echo $this->lang->line('project_name'); ?></th>
                                <th><?php echo $this->lang->line('district_name'); ?></th>
                                <th><?php echo $this->lang->line('category'); ?></th>
                                <th><?php echo $this->lang->line('wua_name'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schemes as $scheme) : ?>
                                <tr>


                                    <td>
                                        <?php echo $scheme->scheme_code; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->scheme_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->water_source; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->latitude; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->longitude; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->beneficiaries; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->male_beneficiaries; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->female_beneficiaries; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->estimated_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->approved_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->revised_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->sanctioned_cost; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->project_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->district_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->category; ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->wua_name; ?>
                                    </td>

                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "schemes/view_scheme/" . $scheme->scheme_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-restore" href="<?php echo site_url(ADMIN_DIR . "schemes/restore/" . $scheme->scheme_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-undo"></i></a>
                                        <a class="llink llink-delete" href="<?php echo site_url(ADMIN_DIR . "schemes/delete/" . $scheme->scheme_id . "/" . $this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
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