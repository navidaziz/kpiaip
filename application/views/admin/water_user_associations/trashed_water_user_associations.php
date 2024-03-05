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
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."water_user_associations/view/"); ?>"><?php echo $this->lang->line('Water User Associations'); ?></a>
			</li><li><?php echo $title; ?></li>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."water_user_associations/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."water_user_associations/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table table-table-bordered">
						<thead>
						  <tr>
							<th><?php echo $this->lang->line('union_council'); ?></th>
<th><?php echo $this->lang->line('address'); ?></th>
<th><?php echo $this->lang->line('wua_registration_no'); ?></th>
<th><?php echo $this->lang->line('wua_name'); ?></th>
<th><?php echo $this->lang->line('bank_account_title'); ?></th>
<th><?php echo $this->lang->line('bank_account_number'); ?></th>
<th><?php echo $this->lang->line('bank_branch_code'); ?></th>
<th><?php echo $this->lang->line('attachement'); ?></th>
<th><?php echo $this->lang->line('project_name'); ?></th>
<th><?php echo $this->lang->line('district_name'); ?></th>
<th><?php echo $this->lang->line('tehsil_name'); ?></th>
                            <th><?php echo $this->lang->line('Action'); ?></th>
						  </tr>
						</thead>
						<tbody>
					  <?php foreach($water_user_associations as $water_user_association): ?>
                         <tr>
                            
                            
            <td>
                <?php echo $water_user_association->union_council; ?>
            </td>
            <td>
                <?php echo $water_user_association->address; ?>
            </td>
            <td>
                <?php echo $water_user_association->wua_registration_no; ?>
            </td>
            <td>
                <?php echo $water_user_association->wua_name; ?>
            </td>
            <td>
                <?php echo $water_user_association->bank_account_title; ?>
            </td>
            <td>
                <?php echo $water_user_association->bank_account_number; ?>
            </td>
            <td>
                <?php echo $water_user_association->bank_branch_code; ?>
            </td>
            <td>
            <?php
                echo file_type(base_url("assets/uploads/".$water_user_association->attachement));
            ?>
            </td>
            <td>
                <?php echo $water_user_association->project_name; ?>
            </td>
            <td>
                <?php echo $water_user_association->district_name; ?>
            </td>
            <td>
                <?php echo $water_user_association->tehsil_name; ?>
            </td>
                            
                            <td>
                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."water_user_associations/view_water_user_association/".$water_user_association->water_user_association_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-eye"></i> </a>
                                <a class="llink llink-restore" href="<?php echo site_url(ADMIN_DIR."water_user_associations/restore/".$water_user_association->water_user_association_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-undo"></i></a>
                                <a class="llink llink-delete" href="<?php echo site_url(ADMIN_DIR."water_user_associations/delete/".$water_user_association->water_user_association_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
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
