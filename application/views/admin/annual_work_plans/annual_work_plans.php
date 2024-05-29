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

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
                </div>



            </div>


        </div>
    </div>
</div>
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
    <!-- MESSENGER -->
    <div class="col-md-12">



        <div class="col-md-12">


            <div class="box border blue">
                <div class="box-title">
                    <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
                </div>
                <div class="box-body">
                    <div class="tabbable header-tabs">

                        <ul class="nav nav-tabs">

                            <li>
                                <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/district_annual_work_plan_report") ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <i class="fa fa-check" aria-hidden="true"></i>District Wise AWP</a>
                            </li>
                            <li <?php if ($filter == 'categories') { ?>class="active" <?php } ?>>
                                <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view?filter=categories") ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <i class="fa fa-check" aria-hidden="true"></i>Components Categories</a>
                            </li>
                            <li <?php if ($filter == 'sub_components') { ?>class="active" <?php } ?>>
                                <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view?filter=sub_components") ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <i class="fa fa-check" aria-hidden="true"></i>Sub Components</a>
                            </li>
                            <li <?php if ($filter == 'components') { ?>class="active" <?php } ?>>
                                <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view?filter=components") ?>" contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                    <i class="fa fa-check" aria-hidden="true"></i>Components</a>
                            </li>




                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="box_tab3">

                                <?php
                                if ($filter == 'categories') {
                                    $this->load->view(ADMIN_DIR . "annual_work_plans/awp_categories");
                                }
                                if ($filter == 'sub_components') {
                                    $this->load->view(ADMIN_DIR . "annual_work_plans/awp_sub_components");
                                }
                                if ($filter == 'components') {
                                    $this->load->view(ADMIN_DIR . "annual_work_plans/awp_components");
                                }

                                ?>

                                <hr class="margin-bottom-0">

                            </div>


                        </div>
                    </div>
                </div>
            </div>



        </div>





    </div>
    <!-- /MESSENGER -->
</div>

<?php
$table_title = $title . ' Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
    title = '<?php echo $table_title; ?>';
    $(document).ready(function() {

        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": false,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>