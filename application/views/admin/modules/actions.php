<?php

$action_list = "";
$sn = 1;
foreach ($actions as $action) {

	$action_list .= "<tr>";
	$action_list .= "<td>" . $sn++ . "</td>";
	$action_list .= "<td>" . $action->module_title . "</td>";
	$action_list .= "<td>" . $action->module_uri . "</td>";
	$action_list .= "<td>" . $controller_name . "</td>";
	$action_list .= "<td>" . menu_status($action->module_menu_status) . "</td>";
	$action_list .= "<td>" . $action->module_icon . "</td>";
	$action_list .= "<td>" . status($action->status) . "</td>";
	$action_list .= "<td class='text-center'>
                    <a href='" . site_url(ADMIN_DIR . "modules/edit_action/" . $action->module_id) . "/" . $action->parent_id . "' class='ml10' title='Edit Action'><i class='fa fa-edit'></i><a>
                    <a href='" . site_url(ADMIN_DIR . "modules/trash_action/" . $action->module_id) . "/" . $action->parent_id . "' class='trash_btn ml10' title='Delete Action'><i class='fa fa-trash-o'></i><a>
                  </td>";
	$action_list .= "</tr>";
}


?>
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
					<a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo site_url(ADMIN_DIR . "modules/controllers"); ?>">Controllers</a>
				</li>
				<li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
			<div class='row'>

				<div class='col-md-6'>
					<div class='clearfix'>
						<h3 class='content-title pull-left'><?php echo $title; ?></h3>
					</div>
					<div class='description'><?php echo $title; ?></div>
				</div>

				<div class='col-md-6'>
					<div class='pull-right'>
						<a class='btn btn-primary btn-sm' href='<?php echo site_url(ADMIN_DIR . "modules/add_action/" . $controller_id); ?>'><i class='fa fa-plus'></i> New</a>
						<a class='btn btn-danger btn-sm' href='<?php echo site_url(ADMIN_DIR . "modules/trashed_action/" . $controller_id); ?>'><i class='fa fa-trash-o'></i> Trash</a>
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
				<h4><i class="fa fa-bell"></i><?php echo $title; ?></h4>
				<div class="tools">

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


				</div>
			</div>
			<div class="box-body">

				<div class="table-responsive">
					<table class="table table-striped">

						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>S#</th>
									<th>Title</th>
									<th>URI</th>
									<th>Controller</th>
									<th>Menu Status</th>
									<th>Icon</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php echo $action_list; ?>
							</tbody>
						</table>



					</table>
				</div>


			</div>

		</div>
	</div>
	<!-- /MESSENGER -->
</div>