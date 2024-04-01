<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 5px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px !important;
        color: black;
        margin: 0px !important;
    }

    .table_v_small>thead>tr>th,
    .table_v_small>tbody>tr>th,
    .table_v_small>tfoot>tr>th,
    .table_v_small>thead>tr>td,
    .table_v_small>tbody>tr>td,
    .table_v_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 6px !important;
        color: black;
        margin: 0px !important;
    }
</style>
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
                    <div class="description"><?php echo $description;
                                                ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                <h4><i class="fa fa-users"></i> <?php echo $description; ?></h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table_small table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>District Name</th>
                                <th>Tehsil Name</th>
                                <th>Union Council</th>
                                <th>Address</th>
                                <th>WUA Reg. No.</th>
                                <th>WUA Name</th>
                                <th>Total Schemes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#datatable").DataTable({

                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?php echo base_url(ADMIN_DIR . "water_user_associations/fetch_data2"); ?>",
                                    "type": "POST"
                                },
                                "columns": [{
                                        "data": null,
                                        "render": function(data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                                        }
                                    },
                                    {
                                        "data": "district_name"
                                    },

                                    {
                                        "data": "tehsil_name"
                                    },

                                    {
                                        "data": "union_council"
                                    },

                                    {
                                        "data": "address"
                                    },

                                    {
                                        "data": "wua_registration_no"
                                    },

                                    {
                                        "data": "wua_name"
                                    },
                                    {
                                        "data": "total_schemes"
                                    },
                                    {
                                        "data": null,
                                        "render": function(data, type, row) {
                                            return '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trash/"); ?>' + row.water_user_association_id + '/' + '" onclick="return confirm(\'Are you sure? you want to delete the record.\')"><i class="fa fa-trash-o"></i></a><span style="margin-left: 10px;"></span>' +
                                                '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/"); ?>' + row.water_user_association_id + '/' + '"><i class="fa fa-eye"></i></a><span style="margin-left: 10px;"></span>' +
                                                '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/edit/"); ?>' + row.water_user_association_id + '/' + '"><i class="fa fa-pencil-square-o"></i></a>';
                                        }
                                    }


                                ],

                                "lengthMenu": [
                                    [15, 25, 50, -1],
                                    [15, 25, 50, "All"]
                                ],
                                "order": [
                                    [0, "desc"]
                                ],
                                "searching": true,
                                "paging": true,
                                "info": true,
                                dom: 'Bfrtip',

                                buttons: ['excel', 'pageLength']
                            });
                        });
                    </script>

                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<script>
    $(document).ready(function() {
        document.title = "Water User Assosiation List (Date:<?php echo date('d-m-Y h:m:s') ?>)";
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