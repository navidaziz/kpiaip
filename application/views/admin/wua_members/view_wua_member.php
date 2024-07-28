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
                    <a href="<?php echo site_url(ADMIN_DIR . "wua_members/view/"); ?>"><?php echo $this->lang->line('Wua Members'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "wua_members/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "wua_members/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                            <?php foreach ($wua_members as $wua_member) : ?>


                                <tr>
                                    <th><?php echo $this->lang->line('member_type'); ?></th>
                                    <td>
                                        <?php echo $wua_member->member_type; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('member_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->member_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('member_father_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->member_father_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('member_gender'); ?></th>
                                    <td>
                                        <?php echo $wua_member->member_gender; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('member_cnic'); ?></th>
                                    <td>
                                        <?php echo $wua_member->member_cnic; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Attachment</th>
                                    <td>
                                        <?php
                                        echo file_type(base_url("assets/uploads/" . $wua_member->attachment));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('project_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->project_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('district_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->district_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('tehsil_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->tehsil_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('wua_name'); ?></th>
                                    <td>
                                        <?php echo $wua_member->wua_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                    <td>
                                        <?php echo status($wua_member->status); ?>
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