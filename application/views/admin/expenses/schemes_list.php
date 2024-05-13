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
                <li>
                    <i class="fa fa-list"></i>

                    <a href="<?php echo site_url(ADMIN_DIR . "/expenses"); ?>">Expenses Dashboard</a>
                </li>

                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">



                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<style>
    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: #f0ad4e;
        z-index: 3;
        color: black;
        font-weight: bold;
    }
</style>
<div class="row">

    <div class="col-md-12">


        <div class="box border blue">
            <div class="box-title">
                <h4><i class="fa fa-task"></i> <?php echo $description; ?></h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">

                        <?php
                        $query = "SELECT scheme_status, COUNT(scheme_status) as total FROM schemes GROUP BY scheme_status";
                        $schemes_status = $this->db->query($query)->result();
                        foreach ($schemes_status as $scheme_status) { ?>

                            <li <?php if ($scheme_status->scheme_status == $schemestatus) { ?> class="active" <?php } ?>>

                                <a href="<?php echo site_url(ADMIN_DIR . "expenses/schemes"); ?>?scheme_status=<?php echo $scheme_status->scheme_status; ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <?php if ($scheme_status->scheme_status == 'Ongoing') { ?><i class="fa fa-spinner" aria-hidden="true"></i> <?php } ?>
                                    <?php if ($scheme_status->scheme_status == 'Completed') { ?><i class="fa fa-check" aria-hidden="true"></i> <?php } ?>
                                    <?php echo $scheme_status->scheme_status; ?> ( <?php echo $scheme_status->total; ?> )</a>
                            </li>
                        <?php } ?>



                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="box_tab3">


                            <div class="table-responsive" style=" overflow-x:auto;">
                                <table id="datatable" class="table  table_small table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>District Name</th>
                                            <th>Wua Reg Code</th>
                                            <th>Wua Name</th>
                                            <th>FY</th>
                                            <th>Scheme Code</th>
                                            <th>Scheme Name</th>
                                            <th>Component Category</th>
                                            <th>Sanctioned Cost</th>
                                            <th>Net Pay</th>
                                            <th>Paid Percentage</th>
                                            <th>Remaining</th>
                                            <th>Payment Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        document.title = "<?php echo $schemestatus; ?> Schemes lists (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                                        $("#datatable").DataTable({
                                            "processing": true,
                                            "serverSide": true,
                                            "ajax": {
                                                "url": "<?php echo base_url(ADMIN_DIR . "expenses/scheme_lists"); ?>",
                                                "type": "POST",
                                                data: {
                                                    scheme_status: '<?php echo $schemestatus; ?>',
                                                },
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
                                                    "data": "wua_reg_code"
                                                },

                                                {
                                                    "data": "wua_name"
                                                },
                                                {
                                                    "data": "financial_year"
                                                },
                                                {
                                                    "data": "scheme_code"
                                                },

                                                {
                                                    "data": "scheme_name"
                                                },

                                                {
                                                    "data": "component_category"
                                                },

                                                {
                                                    "data": "sanctioned_cost",
                                                    "render": function(data, type, row) {
                                                        // Format the number here
                                                        return parseFloat(data).toLocaleString('en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                    }
                                                },

                                                {
                                                    "data": "paid",
                                                    "render": function(data, type, row) {
                                                        // Format the number here
                                                        return parseFloat(data).toLocaleString('en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                    }
                                                },

                                                {
                                                    "data": "paid_percentage"
                                                },

                                                {
                                                    "data": "remaining",
                                                    "render": function(data, type, row) {
                                                        // Format the number here
                                                        return parseFloat(data).toLocaleString('en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                    }
                                                },

                                                {
                                                    "data": "payment_count"
                                                },


                                                {
                                                    "data": null,
                                                    "render": function(data, type, row) {
                                                        return '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "expenses/view_scheme_detail/"); ?>' + row.scheme_id + '"><i class="fa fa-eye"></i> View</a>';
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
                            <hr class="margin-bottom-0">

                        </div>


                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- /MESSENGER -->
</div>




<script>
    title = "Expenses";
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