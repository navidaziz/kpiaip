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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "projects/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "projects/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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

                <script>
                    function get_teacher_form(teacher_id) {
                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'teachers/get_teacher_form'); ?>",
                                data: {
                                    teacher_id: teacher_id
                                },
                            })
                            .done(function(respose) {
                                $('#modal').modal('show');
                                $('#modal_title').html('Teachers');
                                $('#modal_body').html(respose);
                            });
                    }
                </script>
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
                <div class="table-responsive">
                    <table id="datatable" class="table  table_small table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Teacher Designation</th>
                                <th>Cnic</th>
                                <th>Mobile Number</th>
                                <th>Acadmic Qualification</th>
                                <th>Professional Qualification</th>
                                <th>Initial Appointment Date</th>
                                <th>Current School Assumption Date</th>
                                <th>Current Post Assumption Date</th>
                                <th>Personal No</th>
                                <th>Basic Pay Scale</th>
                                <th>Current Pay</th>
                                <th>Gp Fund Number</th>
                                <th>Bank Branch</th>
                                <th>Bank Branch Code</th>
                                <th>Bank Account No</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>User Name</th>
                                <th>Password</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div style="text-align: center;">
                    <button onclick="get_teacher_form('0')" class="btn btn-primary">Add Record</button>
                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        document.title = "teachers (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                        $("#datatable").DataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": "<?php echo base_url(ADMIN_DIR . "teachers/teachers"); ?>",
                                "type": "POST"
                            },
                            "columns": [{
                                    "data": null,
                                    "render": function(data, type, row, meta) {
                                        return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                                    }
                                },

                                {
                                    "data": "teacher_name"
                                },

                                {
                                    "data": "father_name"
                                },

                                {
                                    "data": "gender"
                                },

                                {
                                    "data": "date_of_birth"
                                },

                                {
                                    "data": "teacher_designation"
                                },

                                {
                                    "data": "cnic"
                                },

                                {
                                    "data": "mobile_number"
                                },

                                {
                                    "data": "acadmic_qualification"
                                },

                                {
                                    "data": "professional_qualification"
                                },

                                {
                                    "data": "initial_appointment_date"
                                },

                                {
                                    "data": "current_school_assumption_date"
                                },

                                {
                                    "data": "current_post_assumption_date"
                                },

                                {
                                    "data": "personal_no"
                                },

                                {
                                    "data": "basic_pay_scale"
                                },

                                {
                                    "data": "current_pay"
                                },

                                {
                                    "data": "gp_fund_number"
                                },

                                {
                                    "data": "bank_branch"
                                },

                                {
                                    "data": "bank_branch_code"
                                },

                                {
                                    "data": "bank_account_no"
                                },

                                {
                                    "data": "email"
                                },

                                {
                                    "data": "address"
                                },

                                {
                                    "data": "user_name"
                                },

                                {
                                    "data": "password"
                                },


                                {
                                    "data": null,
                                    "render": function(data, type, row) {
                                        return '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "teachers/trash/"); ?>' + row.teacher_id + '/' + '" onclick="return confirm(' +
                                            ')"><i class="fa fa-trash-o"></i></a><span style="margin-left: 10px;"></span>' +
                                            '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "teachers/view_teachers/"); ?>' + row.teacher_id + '/' + '"><i class="fa fa-eye"></i></a><span style="margin-left: 10px;"></span>' +
                                            '<a class="llink llink-edit" onclick="get_teacher_form(' + row.teacher_id + ')"><i class="fa fa-pencil-square-o"></i></a>';
                                    }
                                }

                            ],
                            "lengthMenu": [
                                [15, 25, 50, -1],
                                [15, 25, 50, "All"]
                            ],
                            "order": [
                                [0, "asc"]
                            ],
                            "searching": true,
                            "paging": true,
                            "info": true,
                            dom: "Bfrtip",

                            buttons: ["excel", "pageLength"]
                        });
                    });
                </script>

            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>