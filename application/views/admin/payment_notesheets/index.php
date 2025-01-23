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
                    <!-- <div class="description"><?php echo $title; ?></div> -->
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/download_payment_notesheet_csv'); ?>" class="btn btn-warning"><i class="fa fa-download"></i> Download</a>
                        <button onclick="get_payment_notesheet_form('0')" class="btn btn-primary">Add New Payment Note Sheet</button>

                        <script>
                            function get_payment_notesheet_form(id) {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'payment_notesheets/get_payment_notesheet_form'); ?>",
                                        data: {
                                            id: id
                                        },
                                    })
                                    .done(function(respose) {
                                        $('#modal').modal('show');
                                        $('#modal_title').html('Payment Notesheets');
                                        $('#modal_body').html(respose);
                                    });
                            }
                        </script>

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
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?> List</h4>
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


                    <table id="datatable" class="table  table_small table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Payment Notesheet Code</th>
                                <th>PUC Tracking ID</th>
                                <th>District</th>
                                <th>Schemes</th>
                                <!-- <th>PUC Title</th> -->
                                <!-- <th>PUC Detail</th>-->
                                <th>PUC Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            document.title = "payment_notesheets (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                            $("#datatable").DataTable({
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?php echo base_url(ADMIN_DIR . "payment_notesheets/payment_notesheets"); ?>",
                                    "type": "POST"
                                },
                                "columns": [{
                                        "data": null,
                                        "render": function(data, type, row) {
                                            return '<a  onclick="return confirm(\'Are you sure you want to remove this? \');" class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "payment_notesheets/trash/"); ?>' + row.id + '/' + '" onclick="return confirm(' +
                                                'Are you sure ? you want to delete the record.' +
                                                ')"><i class="fa fa-trash-o"></i></a>';
                                        }
                                    }, {
                                        "data": null,
                                        "render": function(data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                                        }
                                    },

                                    {
                                        "data": "payment_notesheet_code"
                                    },

                                    {
                                        "data": "puc_tracking_id"
                                    },

                                    {
                                        "data": "district_name"
                                    },
                                    {
                                        "data": "total_schemes"
                                    },
                                    // {
                                    //     "data": "puc_title"
                                    // },

                                    // {
                                    //     "data": "puc_detail"
                                    // },

                                    {
                                        "data": "puc_date"
                                    },


                                    {
                                        "data": null,
                                        "render": function(data, type, row) {
                                            return '<a class="btn btn-success" href="' +
                                                '<?php echo site_url(ADMIN_DIR . "payment_notesheets/view_payment_notesheets/"); ?>' +
                                                row.id +
                                                '/">View</a>' +
                                                '<span style="margin-left: 10px;"></span>' +
                                                '<button onclick="get_payment_notesheet_form(\'' + row.id + '\')" class="btn btn-primary">Edit</button>' +
                                                ' <a target="_blank" href="<?php echo site_url(ADMIN_DIR . 'reports/download_payment_notesheet_csv/'); ?>' + row.id + '" class="btn btn-warning"><i class="fa fa-download"></i></a>';
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
    </div>
    <!-- /MESSENGER -->
</div>