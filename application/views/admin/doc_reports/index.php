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
            </div>
            <div class="box-body">

            <div class="table-responsive">
        <table class="table table-bordered" id="doc_reports">
            <thead>
                <tr>
                <th></th>
                <th>#</th>
                <th>Source</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Detail</th>
                    <th>Attachment</th>
                    <th>Data</th>
                    <th>Action</th>
        </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                $query = "SELECT * FROM doc_reports ORDER BY date DESC";
                $rows = $this->db->query($query)->result();
                foreach ($rows as $row) { ?>
                    <tr>
                    <td><a href="<?php echo site_url(ADMIN_DIR . 'doc_reports/delete_doc_reports/' . $row->id); ?>" onclick="return confirm('Are you sure? you want to delete the record.')">Delete</a> </td>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $row->source; ?></td>
                        <td><?php echo $row->type; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->detail; ?></td>
                        <td><a href="<?php echo base_url($row->attachment); ?>" target="_blank">View Report</a></td>
                        <td><?php echo date("d M, Y",strtotime($row->date)); ?></td>
                        <td><button onclick="get_doc_report_form('<?php echo $row->id; ?>')" >Edit<botton></td>
        </tr>
        <?php } ?>
        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <button onclick="get_doc_report_form('0')" class="btn btn-primary">Add Record</button>
                    </div>
                </div>
        <script>
            function get_doc_report_form(id) {
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . 'doc_reports/get_doc_report_form'); ?>",
                        data: {
                            id: id
                        },
                    })
                    .done(function(respose) {
                        $('#modal').modal('show');
                        $('#modal_title').html('Doc Reports');
                        $('#modal_body').html(respose);
                    });
            }
        </script>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
                                    </div>