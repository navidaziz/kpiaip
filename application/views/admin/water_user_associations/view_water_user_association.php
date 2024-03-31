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

    .table_s_small>thead>tr>th,
    .table_s_small>tbody>tr>th,
    .table_s_small>tfoot>tr>th,
    .table_s_small>thead>tr>td,
    .table_s_small>tbody>tr>td,
    .table_s_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px !important;
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
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/"); ?>"><?php echo $this->lang->line('Water User Associations'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
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
    <div class="col-md-5">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-users"></i> <?php echo $title; ?></h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table_small">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo $this->lang->line('district_name'); ?></th>
                                <td>
                                    <?php echo $water_user_association->district_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('tehsil_name'); ?></th>
                                <td>
                                    <?php echo $water_user_association->tehsil_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('union_council'); ?></th>
                                <td>
                                    <?php echo $water_user_association->union_council; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('address'); ?></th>
                                <td>
                                    <?php echo $water_user_association->address; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('bank_account_title'); ?></th>
                                <td>
                                    <?php echo $water_user_association->bank_account_title; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('bank_account_number'); ?></th>
                                <td>
                                    <?php echo $water_user_association->bank_account_number; ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('bank_branch_code'); ?></th>
                                <td>
                                    <?php echo $water_user_association->bank_branch_code; ?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <td>
                                    <?php echo status($water_user_association->status); ?>
                                </td>
                            </tr> -->
                            <tr>
                                <th>Attachement</th>
                                <td>
                                    <?php
                                    echo file_type(base_url("assets/uploads/" . $water_user_association->attachement));
                                    ?>
                                </td>
                            </tr>


                        </tbody>
                    </table>


                    <table class="table table_s_small " style="font-size: 8px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Member</th>
                                <th>Name / Father Name</th>
                                <th>Gender</th>
                                <th>Contact / CNIC</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT * FROM wua_members WHERE water_user_association_id = '" . $water_user_association->water_user_association_id . "'";
                            $wua_members = $this->db->query($query)->result();
                            foreach ($wua_members as $wua_member) : ?>

                                <tr>

                                    <td><a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/delete_member/" . $water_user_association->water_user_association_id . "/" . $water_user_association->water_user_association_id); ?>"><i class="fa fa-trash-o"></i></a> </td>
                                    </td>
                                    <td><?php echo $count++; ?></td>

                                    <td>
                                        <?php echo $wua_member->member_type; ?>
                                    </td>
                                    <td>
                                        <?php echo $wua_member->member_name; ?>
                                        <br />
                                        <?php echo $wua_member->member_father_name; ?>
                                    </td>
                                    <td>
                                        <?php echo $wua_member->member_gender; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($wua_member->contact_no) {
                                            echo $wua_member->contact_no . "<br />";
                                        } ?>
                                        <?php echo $wua_member->member_cnic; ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo file_type(base_url("assets/uploads/" . $wua_member->attachment), false, 20, 20);
                                        ?>
                                    </td>

                                    <td>
                                        <a class="llink llink-edit" href="#" onclick="awa_member_form(<?php echo $wua_member->wua_member_id; ?>)"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="9" style="text-align: center;">
                                    <button onclick="awa_member_form(0)" class="btn btn-primary">Add WUA Member</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        function awa_member_form(wua_member_id) {
                            $.ajax({
                                    method: "POST",
                                    url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/awa_member_form'); ?>",
                                    data: {
                                        wua_member_id: wua_member_id,
                                        water_user_association_id: <?php echo $water_user_association->water_user_association_id; ?>,
                                    },
                                })
                                .done(function(respose) {
                                    $('#modal').modal('show');
                                    $('#modal_title').html('Add WUA Member');
                                    $('#modal_body').html(respose);
                                });
                        }
                    </script>

                </div>


            </div>

        </div>
    </div>
    <div class="col-md-7">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Schemes</h4>

            </div>



            <div class="box-body">

                <div class="table-responsive">


                    <table class="table table-bordered table_small">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Scheme Code</th>
                                <th>Scheme Title</th>
                                <th>Category</th>
                                <th>Sanctioned Cost</th>
                                <th>Paid</th>
                                <th>Paid %</th>
                                <th>Remaining</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT * FROM schemes 
                                      WHERE water_user_association_id = '" . $water_user_association->water_user_association_id . "'";
                            $schemes = $this->db->query($query)->result();
                            foreach ($schemes as $scheme) : ?>

                                <tr>
                                    <td></a>
                                    </td>
                                    <td><?php echo $count++; ?></td>
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
                                    $query = "SELECT SUM(e.gross_pay) as gross_pay,
                                        SUM(e.whit_tax) as whit_tax,
                                        SUM(e.whst_tax) as whst_tax,
                                        SUM(e.st_duty_tax) as st_duty_tax,
                                        SUM(e.rdp_tax) as rdp_tax,
                                        SUM(e.misc_deduction) as misc_deduction,
                                        SUM(e.net_pay) as net_pay
                                        FROM expenses as e 
                                        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                                        INNER JOIN districts as d ON(d.district_id = e.district_id)
                                        WHERE scheme_id = $scheme->scheme_id";
                                    $expense_summary = $this->db->query($query)->row();
                                    ?>

                                    <th><?php if ($expense_summary->net_pay) echo number_format($expense_summary->net_pay);
                                        else echo "0.00" ?></th>
                                    <th><?php if ($scheme->sanctioned_cost > 0) echo round((($expense_summary->net_pay * 100) / $scheme->sanctioned_cost), 2) . " %"; ?></th>
                                    <th><?php echo number_format($scheme->sanctioned_cost - $expense_summary->net_pay); ?></th>

                                    <td>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_scheme_detail/" . $water_user_association->water_user_association_id . "/" . $scheme->scheme_id); ?>"><i class="fa fa-eye"></i></a>
                                        <span style="margin-left: 10px;"></span>
                                        <a class="llink llink-edit" href="#" onclick="scheme_form(<?php echo $scheme->scheme_id; ?>)"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">
                                    <button onclick="scheme_form(0)" class="btn btn-primary">Add New Scheme</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        function scheme_form(scheme_id) {

                            $.ajax({
                                    method: "POST",
                                    url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/scheme_form'); ?>",
                                    data: {
                                        scheme_id: scheme_id,
                                        water_user_association_id: <?php echo $water_user_association->water_user_association_id; ?>,
                                    },
                                })
                                .done(function(respose) {
                                    $('#modal').modal('show');
                                    $('#modal_title').html('Add Scheme');
                                    $('#modal_body').html(respose);
                                });
                        }
                    </script>

                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>