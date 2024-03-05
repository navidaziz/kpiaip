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

<div class="row">

    <div class="col-md-12">

        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-money"></i> Expenses List</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive" style=" overflow-x:auto;">

                    <table class="table table-bordered table_small" id="db_table">
                        <thead>

                            <th>#</th>
                            <th>District</th>
                            <th>WUA</th>
                            <th>Scheme Name</th>
                            <th>Total</th>
                        </thead>
                        <tbody>

                            <?php
                            $query = "
                            SELECT wua.wua_registration_no, wua.wua_name,
                            COUNT(s.water_user_association_id) as total,
                            `d`.`district_name`
                            FROM water_user_associations as wua 
                            INNER JOIN schemes as s ON(s.water_user_association_id = wua.water_user_association_id)
                            INNER JOIN districts as d ON(d.district_id = wua.district_id)
                            GROUP BY s.water_user_association_id";
                            $schemes = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($schemes as $scheme) : ?>

                                <tr>

                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $scheme->district_name; ?></td>
                                    <td><?php echo $scheme->wua_registration_no; ?></td>
                                    <td><?php echo $scheme->wua_name; ?></td>
                                    <td><?php echo $scheme->total; ?></td>



                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>




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