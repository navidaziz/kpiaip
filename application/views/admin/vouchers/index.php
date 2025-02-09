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
                        <button onclick="get_voucher_form('0')" class="btn btn-primary">Create Voucher</button>
                        <script>
                            function get_voucher_form(voucher_id) {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'vouchers/get_voucher_form'); ?>",
                                        data: {
                                            voucher_id: voucher_id,
                                            scheme_id: ''
                                        },
                                    })
                                    .done(function(respose) {
                                        $('#modal').modal('show');
                                        $('#modal_title').html('Vouchers');
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
                    <table id="datatable" class="table  table_small table-bordered">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th>#</th>
                                <th>Voucher No</th>
                                <th>Voucher Type</th>
                                <th>Scheme</th>
                                <th>Voucher Detail</th>
                                <th>Invoices</th>
                                <th>Invoice Total</th>
                                <th>Invoice Deduction</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            document.title = "vouchers (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                            $("#datatable").DataTable({
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?php echo base_url(ADMIN_DIR . "vouchers/vouchers"); ?>",
                                    "type": "POST"
                                },

                                "columns": [

                                    // {
                                    //     "data": null,
                                    //     "render": function(data, type, row) {
                                    //         return '';
                                    //         // '<a class="btn btn-danger" href="<?php echo site_url(ADMIN_DIR . "doc_reports/trash/"); ?>' + row.voucher_id + '/' + '" onclick="return confirm(' +
                                    //         //     'Are you sure ? you want to delete the record.' +
                                    //         //     ')"><i class="fa fa-trash-o"></i></a><span style="margin-left: 10px;"></span>';

                                    //     }
                                    // }, 

                                    {
                                        "data": null,
                                        "render": function(data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                                        }
                                    },

                                    {
                                        "data": "voucher_no"
                                    },

                                    {
                                        "data": "voucher_type"
                                    },
                                    {
                                        "data": null,
                                        "render": function(data, type, row) {
                                            if (row.scheme_id && row.scheme_id != 0) {
                                                return '<a target="new" class="btn btn-link" href="<?php echo site_url(ADMIN_DIR . "vouchers/print_scheme_detail/"); ?>' + row.scheme_id + '">S.ID. : ' + row.scheme_id + '</a>';

                                            } else {
                                                return '-';
                                            }
                                        }
                                    },

                                    {
                                        "data": "voucher_detail"
                                    },
                                    {
                                        "data": "invoice_count"
                                    },
                                    {
                                        "data": "invoice_total"
                                    },
                                    {
                                        "data": "invoice_deduction"
                                    },


                                    {
                                        "data": null,
                                        "render": function(data, type, row) {
                                            return '<a class="btn btn-success" href="<?php echo site_url(ADMIN_DIR . "vouchers/view_voucher/"); ?>' + row.voucher_id + '/' + '">View Detail</a><span style="margin-left: 10px;"></span>' +
                                                '<button onclick="get_voucher_form(\'' + row.voucher_id + '\')" class="btn btn-warning">Edit</button>';
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
</div>