<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->

            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Advices Dashboard</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>


            </div>


        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            <h4>Single Advice</h4>
                            <hr />

                            <form action="/search" method="GET" class="form-inline" style="text-align: right;">
                                <label for="chequeNo">Search By Cheque No.</label>
                                <div class="form-group">

                                    <input type="text" id="chequeNo" name="chequeNo" class="form-control" placeholder="Enter Cheque No." required />
                                </div>
                                <button type="submit" class="btn btn-primary ml-2">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            <h4>Bulk Advice</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $description . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                // {
                //     extend: 'pdfHtml5',
                //     title: title,
                //     pageSize: 'A4',
                //     //orientation: 'landscape',
                //     messageTop: '<?php echo $title; ?>'

                // }
            ]
        });
    });
</script>