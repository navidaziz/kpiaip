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

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php foreach ($schemes as $scheme) : ?>


                                <tr>
                                    <th><?php echo $this->lang->line('scheme_code'); ?></th>
                                    <td>
                                        <?php echo $scheme->scheme_code; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('scheme_name'); ?></th>
                                    <td>
                                        <?php echo $scheme->scheme_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('water_source'); ?></th>
                                    <td>
                                        <?php echo $scheme->water_source; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('latitude'); ?></th>
                                    <td>
                                        <?php echo $scheme->latitude; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('longitude'); ?></th>
                                    <td>
                                        <?php echo $scheme->longitude; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('male_beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->male_beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('female_beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->female_beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('estimated_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->estimated_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('approved_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->approved_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('revised_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->revised_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('sanctioned_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->sanctioned_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('project_name'); ?></th>
                                    <td>
                                        <?php echo $scheme->project_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('district_name'); ?></th>
                                    <td>
                                        <?php echo $scheme->district_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('category'); ?></th>
                                    <td>
                                        <?php echo $scheme->category; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('wua_name'); ?></th>
                                    <td>
                                        <?php echo $scheme->wua_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                    <td>
                                        <?php echo status($scheme->status); ?>
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