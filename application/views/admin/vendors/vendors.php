<!-- PAGE HEADER-->
<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 10px !important;
        color: black;
        margin: 0px !important;
    }
</style>

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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "vendors/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "vendors/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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

                    <table class="table table-bordered table_small" id="db_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('Vendor_Type'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_NTN'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_CNIC'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_Name'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_City'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_Address'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_Status'); ?></th>
                                <th><?php echo $this->lang->line('TaxPayer_Business_Name'); ?></th>
                                <th><?php echo $this->lang->line('Focal_Person'); ?></th>
                                <th><?php echo $this->lang->line('Contact_No'); ?></th>
                                <th><?php echo $this->lang->line('industery'); ?></th>
                                <th><?php echo $this->lang->line('business_category'); ?></th>
                                <th><?php echo $this->lang->line('nature_of_business'); ?></th>
                                <th><?php echo $this->lang->line('registration_no'); ?></th>
                                <th><?php echo $this->lang->line('registration_date'); ?></th>
                                <th><?php echo $this->lang->line('year_of_active'); ?></th>
                                <th><?php echo $this->lang->line('fee'); ?></th>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($vendors as $vendor) : ?>

                                <tr>
                                    <td><?php echo $count++; ?></td>

                                    <td>
                                        <?php echo $vendor->Vendor_Type; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_NTN; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_CNIC; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_Name; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_City; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_Address; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_Status; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->TaxPayer_Business_Name; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->Focal_Person; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->Contact_No; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->industery; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->business_category; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->nature_of_business; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->registration_no; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->registration_date; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->year_of_active; ?>
                                    </td>
                                    <td>
                                        <?php echo $vendor->fee; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($vendor->status == 0) {
                                            echo "<strong style='color:red'>Dormant</strong>";
                                        }
                                        if ($vendor->status == 1) {
                                            echo "<strong style='color:green'>Active</strong>";
                                        }
                                        // 
                                        ?>

                                    </td>
                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "vendors/view_vendor/" . $vendor->vendor_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "vendors/edit/" . $vendor->vendor_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "vendors/trash/" . $vendor->vendor_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
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

<script>
    title = "Vendors List";
    $(document).ready(function() {
        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                },
                {
                    extend: 'excelHtml5',
                    title: title,

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',

                }
            ]
        });
    });
</script>