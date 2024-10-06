<style>
.table_small>thead>tr>th,
.table_small>tbody>tr>th,
.table_small>tfoot>tr>th,
.table_small>thead>tr>td,
.table_small>tbody>tr>td,
.table_small>tfoot>tr>td {
    padding: 2px;
    line-height: 1;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font-size: 10px !important;
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
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a
                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/"); ?>"><?php echo $this->lang->line('Water User Associations'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a
                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/" . $water_user_association->water_user_association_id); ?>"><?php echo $title; ?><?php //echo $water_user_association->wua_registration_no; ?></a>
                </li>
                <li><?php echo $scheme->scheme_code; ?></li>
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
                        <?php
                        $query = "SELECT SUM(e.gross_pay) as gross_pay,
                        SUM(e.whit_tax) as whit_tax,
                        SUM(e.whst_tax) as whst_tax,
                        SUM(e.st_duty_tax) as st_duty_tax,
                        SUM(e.rdp_tax) as rdp_tax,
                        SUM(e.kpra_tax) as kpra_tax,
                        SUM(e.gur_ret) as gur_ret,
                        SUM(e.misc_deduction) as misc_deduction,
                        SUM(e.net_pay) as net_pay
                          FROM expenses as e 
                        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                        INNER JOIN districts as d ON(d.district_id = e.district_id)
                        WHERE scheme_id = $scheme->scheme_id";
                        $expense_summary = $this->db->query($query)->row();
                        ?>
                        <table class="table">
                            <tr>


                                <th>Total Sanctioned Cost</th>
                                <th>Total Paid</th>
                                <th>Payment (Percentage)</th>
                                <th>Remaining</th>
                            </tr>
                            <tr>


                                <th><?php if ($scheme->sanctioned_cost) echo number_format($scheme->sanctioned_cost);
                                    else "notmentioned" ?></th>
                                <th><?php if ($expense_summary->net_pay) echo number_format($expense_summary->net_pay);
                                    else echo "0.00" ?></th>
                                <th><?php if ($scheme->sanctioned_cost > 0) echo round((($expense_summary->net_pay * 100) / $scheme->sanctioned_cost), 2) . " %"; ?>
                                </th>
                                <th><?php echo number_format($scheme->sanctioned_cost - $expense_summary->net_pay); ?>
                                </th>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">


    <div class="col-md-3">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-users"></i> Water User Assosiation Detail</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <h5>WUA REG No: <?php echo $water_user_association->wua_registration_no; ?></h5>
                    <strong>WUA Address</strong>
                    <table class="table table-bordered table_small">
                        <thead>

                        </thead>
                        <tbody>

                            <tr>
                                <th style="width: 120px;"><?php echo $this->lang->line('district_name'); ?></th>
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
                        </tbody>
                    </table>
                    <strong>WUA Bank Detail</strong>
                    <table class="table table-bordered table_small">
                        <tbody>
                            <tr>
                                <th style="width: 120px;"><?php echo $this->lang->line('bank_account_title'); ?></th>
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

                    <strong>WUA Chairman Detail</strong>
                    <table class="table table-bordered table_small">
                        <tbody>
                            <tr>
                                <th style="width: 120px;">Chairman Name</th>
                                <td>
                                    <?php echo $water_user_association->cm_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 120px;">Father Name</th>
                                <td>
                                    <?php echo $water_user_association->cm_father_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 120px;">Gender</th>
                                <td>
                                    <?php echo $water_user_association->cm_gender; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 120px;">CNIC</th>
                                <td>
                                    <?php echo $water_user_association->cm_cnic; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 120px;">Contact</th>
                                <td>
                                    <?php echo $water_user_association->cm_contact_no; ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <strong> WUA Other Members</strong>

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

                                <td><a class="llink llink-trash"
                                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/delete_member/" . $water_user_association->water_user_association_id . "/" . $water_user_association->water_user_association_id); ?>"><i
                                            class="fa fa-trash-o"></i></a> </td>
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
                                    <a class="llink llink-edit" href="#"
                                        onclick="awa_member_form(<?php echo $wua_member->wua_member_id; ?>)"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="9" style="text-align: center;">

                                    <button style="display: none;" class="btn btn-danger btn-sm"
                                        onclick="get_water_user_association_form('<?php echo $water_user_association->water_user_association_id; ?>')">
                                        Edit WUA Detail
                                        </botton>

                                        <script>
                                        function get_water_user_association_form(water_user_association_id) {
                                            $.ajax({
                                                    method: "POST",
                                                    url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/get_water_user_association_form'); ?>",
                                                    data: {
                                                        water_user_association_id: water_user_association_id
                                                    },
                                                })
                                                .done(function(respose) {
                                                    $('#modal').modal('show');
                                                    $('#modal_title').html('Water User Associations');
                                                    $('#modal_body').html(respose);
                                                });
                                        }
                                        </script>

                                        <button onclick="awa_member_form(0)" class="btn btn-primary btn-sm">Add WUA
                                            Member</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                            .done(function(response) {

                                $('#modal').modal('show');
                                $('#modal_title').html('Add WUA Member');
                                $('#modal_body').html(response);

                                // Make the modal draggable
                                // $('#modal .modal-dialog').draggable({
                                //     handle: ".modal-header", // Ensure modal can be dragged by the header
                                //     containment: "window" // Optional: restrict dragging within the window
                                // });

                                // Ensure modal backdrop stays in place while dragging
                                // $('#modal').on('shown.bs.modal', function() {
                                //     $('.modal-backdrop').remove();
                                //     $('<div class="modal-backdrop fade show"></div>').appendTo(document
                                //         .body);
                                // });
                            });
                    }
                    </script>

                </div>


            </div>

        </div>
    </div>


    <div class="col-md-9">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Scheme Details</h4>

            </div>
            <div class="box-body">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_small">
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Component Category</th>
                                    <th><?php echo $this->lang->line('water_source'); ?></th>
                                    <th>Coordiantes</th>
                                    <th>Beneficiaries</th>
                                    <th><?php echo $this->lang->line('estimated_cost'); ?></th>
                                    <th><?php echo $this->lang->line('approved_cost'); ?></th>
                                    <th><?php echo $this->lang->line('sanctioned_cost'); ?></th>
                                    <th><?php echo $this->lang->line('revised_cost'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
                                    <td>
                                        <?php 
                                $query = "SELECT * FROM `component_categories` 
                                WHERE component_category_id=$scheme->component_category_id";
                                $category = $this->db->query($query)->row();
                                if ($category) {
                                echo $category->category . " <small>(" . $category->category_detail . ")</small>";
                                } else {
                                echo "Undefine";
                                }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $scheme->water_source; ?>
                                    </td>
                                    <td>
                                        LATI: <?php echo $scheme->latitude; ?><br />
                                        LONG: <?php echo $scheme->longitude; ?>
                                    </td>
                                    <td>
                                        Males: <?php echo $scheme->male_beneficiaries; ?><br />
                                        Females: <?php echo $scheme->female_beneficiaries; ?><br />
                                        Total: <?php echo $scheme->beneficiaries; ?> </td>
                                    <td>
                                        <?php echo $scheme->estimated_cost; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($scheme->approved_cost) {
                                            echo $scheme->approved_cost;
                                            echo "<br />";
                                            echo 'Date: '.date('d M,  Y', strtotime($scheme->approval_date));
                                            if($scheme->scheme_status !='Completed'){
                                            echo '<br /><button onclick="chanage_status_form(\'Approval\')"
                                class="btn btn-link btn-sm">Update</button>';
                                            }
                                        } else {
                                            echo 'Not Approve Yet';
                                        } ?>
                                    </td>

                                    <td><?php echo $scheme->sanctioned_cost; ?></td>
                                    <td><?php
                                        if ($scheme->revised_cost) {
                                            echo $scheme->revised_cost;
                                        } else {
                                            echo 'Not Revised';
                                        } ?>
                                    </td>

                                </tr>
                        </table>
                        <div style="text-align: center;">
                            <h4 style="text-align: center;">
                                Current Scheme Status: <?php echo scheme_status($scheme->scheme_status); ?>
                            </h4>
                            <hr />


                            <?php if ($scheme->scheme_status == 'Ongoing') { ?>
                            <button onclick="revise_cost(0)" class="btn btn-danger btn-sm">
                                <i class="fa fa-pencil-square"></i>
                                Revise Cost</button>
                            <script>
                            function revise_cost(revise_cost_id) {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/revise_cost'); ?>",
                                        data: {
                                            scheme_id: '<?php echo $scheme->scheme_id; ?>',
                                            revise_cost_id: revise_cost_id
                                        },
                                    })
                                    .done(function(respose) {
                                        $('#modal').modal('show');
                                        $('#modal_title').html('Revise Cost');
                                        $('#modal_body').html(respose);
                                    });
                            }
                            </script>
                            <?php } ?>


                            <?php if ($scheme->scheme_status == 'Initiated') { ?>
                            <button onclick="chanage_status_form('Approval')" class="btn btn-primary btn-sm"><i
                                    class="fa fa-check-circle"></i> Approve</button>
                            <button onclick="chanage_status_form('Not Approve')" class="btn btn-danger btn-sm">
                                <i class="fa fa-times-circle"></i> Not Approve</button>

                            <?php } ?>
                            <?php if ($scheme->scheme_status == 'Not Approved') { ?>
                            <button onclick="chanage_status_form('Approval')"
                                class="btn btn-primary btn-sm">Approve</button>
                            <?php } ?>

                            <?php if ($scheme->scheme_status == 'Disputed') { ?>
                            <button onclick="chanage_status_form('Ongoing')" class="btn btn-warning btn-sm">
                                <i class="fa fa-undo"></i> Mark Again as Ongoing Scheme</button>
                            <?php } ?>
                            <?php if ($scheme->scheme_status == 'Ongoing') { ?>
                            <button onclick="chanage_status_form('Dispute')" class="btn btn-warning btn-sm"> <i
                                    class="fa fa-times-circle"></i> Dispute</button>
                            <button onclick="chanage_status_form('Complete')" class="btn btn-success btn-sm"> <i
                                    class="fa fa-check-circle"></i> Complete</button>

                            <?php } ?>
                            <?php if ($scheme->scheme_status == 'Completed') { ?>
                            <div class="alert alert-success">Scheme Status: <?php echo  $scheme->scheme_status; ?></div>
                            <?php } ?>
                            <script>
                            function chanage_status_form(status_form) {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/chanage_status_form'); ?>",
                                        data: {
                                            scheme_id: '<?php echo $scheme->scheme_id; ?>',
                                            status_form: status_form
                                        },
                                    })
                                    .done(function(respose) {
                                        $('#modal').modal('show');
                                        $('#modal_title').html('Change Scheme Status');
                                        $('#modal_body').html(respose);
                                    });
                            }
                            </script>

                            <button onclick="scheme_logs()" class="btn btn-primary btn-sm">
                                <i class="fa fa-history"></i>
                                Scheme History Logs</button>

                            <script>
                            function scheme_logs() {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/scheme_logs'); ?>",
                                        data: {
                                            scheme_id: '<?php echo $scheme->scheme_id; ?>',
                                        },
                                    })
                                    .done(function(respose) {
                                        $('#modal').modal('show');
                                        $('#modal_title').html('Scheme Status Logs');
                                        $('#modal_body').html(respose);
                                    });
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Scheme Payments</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table-bordered table_small" id="wua_scheme_payment">
                        <thead>

                            <th>#</th>
                            <th>Cat.</th>
                            <th>Cheque</th>
                            <th>Date</th>
                            <th>Payee Name</th>
                            <th>Gross Pay</th>
                            <th>WHIT</th>
                            <th>WHST</th>
                            <th>St.Duty</th>
                            <th>RDP</th>
                            <th>KPRA</th>
                            <th>GUR.RET.</th>
                            <th>Misc.Dedu.</th>
                            <th>Net Pay</th>
                            <th>%</th>
                            <th></th>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT e.*,fy.financial_year, d.district_name, d.region, cc.category  FROM expenses as e 
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                            INNER JOIN districts as d ON(d.district_id = e.district_id)
                            INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                            WHERE scheme_id = $scheme->scheme_id";
                            $expenses = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($expenses as $expense) : ?>

                            <tr>

                                <td><?php echo $count++; ?></td>

                                <td><?php echo $expense->category; ?></td>
                                <td><?php echo $expense->cheque; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                                <td><?php if($expense->gross_pay>0){ echo number_format($expense->gross_pay, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->whit_tax>0){ echo number_format($expense->whit_tax, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->whst_tax>0){ echo number_format($expense->whst_tax, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->st_duty_tax>0){ echo number_format($expense->st_duty_tax, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->rdp_tax>0){ echo number_format($expense->rdp_tax, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->kpra_tax>0){ echo number_format($expense->kpra_tax, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->gur_ret>0){ echo number_format($expense->gur_ret, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->misc_deduction>0){ echo number_format($expense->misc_deduction, 2); }else{ echo 0; }?>
                                </td>
                                <td><?php if($expense->net_pay>0){ echo number_format($expense->net_pay, 2); }else{ echo 0; }?>
                                </td>
                                <th>
                                    <?php if ($scheme->sanctioned_cost) echo round(($expense->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                                </th>
                                <th><button
                                        onclick="change_cheque_schem(<?php echo $expense->expense_id ?>)">Change</button>
                                </th>
                            </tr>
                            <?php endforeach; ?>



                        </tbody>
                        <tfoot>
                            <?php

                            if ($expense_summary) {
                            ?>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php if($expense_summary->gross_pay>0){ echo number_format($expense_summary->gross_pay, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->whit_tax>0){ echo number_format($expense_summary->whit_tax, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->whst_tax>0){ echo number_format($expense_summary->whst_tax, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->st_duty_tax>0){ echo number_format($expense_summary->st_duty_tax, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->rdp_tax>0){ echo number_format($expense_summary->rdp_tax, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->kpra_tax>0){ echo number_format($expense_summary->kpra_tax, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->gur_ret>0){ echo number_format($expense_summary->gur_ret, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->misc_deduction>0){ echo number_format($expense_summary->misc_deduction, 2); }else{ echo 0; }?>
                                </th>
                                <th><?php if($expense_summary->net_pay>0){ echo number_format($expense_summary->net_pay, 2); }else{ echo 0; }?>
                                </th>
                                <th>
                                    <?php if ($scheme->sanctioned_cost) echo round(($expense_summary->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                                </th>
                                <th>
                                </th>


                            </tr>
                            <?php } ?>



                        </tfoot>
                    </table>


                </div>


            </div>

        </div>
    </div>


    <div>
        a
        <?php $this->load->view(ADMIN_DIR."water_user_associations/expense_reference"); ?>
    </div>
</div>


<script>
function change_cheque_schem(expense_id) {

    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/change_cheque_schem'); ?>",
            data: {
                expense_id: expense_id,
                scheme_id: <?php echo $scheme->scheme_id ?>,
                wua_id: <?php echo $scheme->water_user_association_id; ?>,
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Change Scheme');
            $('#modal_body').html(respose);
        });
}

title = "WUA: <?php echo $title . ' - Scheme Payments List ' . date('Y-m-d'); ?>";
$(document).ready(function() {
    $('#wua_scheme_payment').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: title,
        "order": [],
        searching: true,
        buttons: [{
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
                pageSize: 'A4', // A4 page size
                orientation: 'landscape', // Set to landscape mode
                exportOptions: {
                    columns: ':visible' // Specify columns to be exported
                },
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 10; // Adjust font size if needed
                }
            }
        ]
    });
});
</script>