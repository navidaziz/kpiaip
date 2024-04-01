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

                    <table class="table table-bordered table_small" id="db_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th><?php echo $this->lang->line('district_name'); ?></th>
                                <th><?php echo $this->lang->line('wua_registration_no'); ?></th>
                                <th><?php echo $this->lang->line('wua_name'); ?></th>
                                <th>Total Schemes</th>

                                <th><?php echo $this->lang->line('tehsil_name'); ?></th>
                                <th><?php echo $this->lang->line('union_council'); ?></th>
                                <th><?php echo $this->lang->line('address'); ?></th>

                                <th><?php echo $this->lang->line('Action'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($water_user_associations as $water_user_association) : ?>

                                <tr>
                                    <td><a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/delete_member/" . $water_user_association->water_user_association_id . "/" . $water_user_association->water_user_association_id); ?>"><i class="fa fa-trash-o"></i></a> </td>
                                    <td><?php echo $count++; ?></td>
                                    <td>
                                        <?php echo $water_user_association->district_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $water_user_association->wua_registration_no; ?>
                                    </td>
                                    <td>
                                        <?php echo $water_user_association->wua_name; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $query = "SELECT COUNT(*) as total FROM schemes 
                                        WHERE water_user_association_id = '" . $water_user_association->water_user_association_id . "'";
                                        echo $total = $this->db->query($query)->row()->total;
                                        ?>
                                    </td>



                                    <td>
                                        <?php echo $water_user_association->tehsil_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $water_user_association->union_council; ?>
                                    </td>
                                    <td>
                                        <?php echo $water_user_association->address; ?>
                                    </td>


                                    <td>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/" . $water_user_association->water_user_association_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                        <span style="margin-left: 10px;"></span>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/edit/" . $water_user_association->water_user_association_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>

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
    title = "Water User Assosiation List";
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