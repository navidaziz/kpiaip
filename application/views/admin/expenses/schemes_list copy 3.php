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



                                <table class="table table-bordered table_small" id="db_table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>District</th>
                                            <th>WUA Reg.</th>
                                            <th>WUA Asso.</th>
                                            <th>Scheme Code</th>
                                            <th>Scheme Title</th>
                                            <th>Category</th>
                                            <th>Sanctioned Cost</th>
                                            <th>Paid</th>
                                            <th>Paid %</th>
                                            <th>Remaining</th>
                                            <th>Cheque's</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;

                                        foreach ($schemes as $scheme) : ?>

                                            <tr>
                                                <td></td>
                                                <td><?php echo $count++; ?></td>
                                                <td>
                                                    <?php
                                                    $query = "SELECT district_name FROM districts 
                    WHERE district_id='" . $scheme->district_id . "'";
                                                    $district = $this->db->query($query)->row();
                                                    if ($district) {
                                                        echo $district->district_name;
                                                    } else {
                                                        echo 'Not Define';
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                                if ($scheme->water_user_association_id > 0) {
                                                    $query = "SELECT wau.wua_registration_no as wua_reg_no,
                        wau.wua_name
                        FROM `water_user_associations` as wau
                         WHERE wau.water_user_association_id = $scheme->water_user_association_id";
                                                    $wua = $this->db->query($query)->row();
                                                ?>
                                                    <td><?php echo $wua->wua_reg_no; ?></td>
                                                    <td><?php echo $wua->wua_name; ?></td>
                                                <?php } else { ?>
                                                    <td></td>
                                                    <td></td>
                                                <?php } ?>


                                                <td>
                                                    <?php echo $scheme->scheme_code; ?>
                                                </td>
                                                <td>
                                                    <?php echo $scheme->scheme_name; ?>
                                                </td>
                                                <td>
                                                    <?php $query = "SELECT * FROM `component_categories` 
                                    WHERE component_category_id=$scheme->component_category_id";
                                                    $category = $this->db->query($query)->row();
                                                    if ($category) {
                                                        echo $category->category . " <small>(" . $category->category_detail . ")</small>";
                                                    } else {
                                                        echo "Undefine";
                                                    }
                                                    ?>
                                                </td>
                                                <th>
                                                    <?php if ($scheme->sanctioned_cost) echo number_format($scheme->sanctioned_cost); ?>
                                                </th>

                                                <?php
                                                $query = "SELECT 
                    SUM(e.net_pay) as net_pay
                    FROM expenses as e WHERE scheme_id = $scheme->scheme_id";
                                                $expense_summary = $this->db->query($query)->row();
                                                ?>

                                                <th><?php if ($expense_summary->net_pay) echo number_format($expense_summary->net_pay);
                                                    else echo "0.00" ?></th>
                                                <th><?php if ($scheme->sanctioned_cost > 0) echo round((($expense_summary->net_pay * 100) / $scheme->sanctioned_cost)) . " %"; ?></th>
                                                <th><?php echo number_format($scheme->sanctioned_cost - $expense_summary->net_pay); ?></th>
                                                <th>
                                                    <?php $query = "SELECT COUNT(*) as payment_count 
                                  FROM expenses
                                  WHERE scheme_id = '" . $scheme->scheme_id . "'";
                                                    echo $this->db->query($query)->row()->payment_count;           ?>
                                                </th>
                                                <th><?php echo $scheme->scheme_status; ?></th>
                                                <td>
                                                    <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "expenses/view_scheme_detail/" . $scheme->scheme_id); ?>"><i class="fa fa-eye"></i></a>
                                                    <span style="margin-left: 10px;"></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>



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