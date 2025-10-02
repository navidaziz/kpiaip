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

    .table_medium>thead>tr>th,
    .table_medium>tbody>tr>th,
    .table_medium>tfoot>tr>th,
    .table_medium>thead>tr>td,
    .table_medium>tbody>tr>td,
    .table_medium>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px !important;
        color: black;
        margin: 2px !important;
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
                <!-- <li>
                    <i class="fa fa-table"></i>
                    <a
                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/Par-Completed"); ?>">

                        Schemes List

                    </a>
                </li> -->
                <li>
                    <i class="fa fa-table"></i>
                    <a
                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/$scheme->scheme_status"); ?>">

                        Schemes List ( <?php echo $scheme->scheme_status ?> )

                    </a>
                </li>
                <li><?php echo $scheme->scheme_code; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <h4>Scheme Code: <strong><?php echo $scheme->scheme_code; ?> </strong></h4>

                    <strong>Category:
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

                    </strong>
                    </h4>
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

                                <td rowspan="2" style="vertical-align: middle;">
                                    <a class="btn btn-danger" target="_blank" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/print_scheme_detail/" . $scheme->scheme_id); ?>"><i class="fa fa-print" aria-hidden="true"></i> Print Scheme Detail</a>
                                </td>

                                <th>Total Sanctioned Cost</th>
                                <th>Total Paid</th>
                                <th>Payment (Percentage)</th>
                                <th>Remaining</th>
                            </tr>
                            <tr>


                                <th><?php if ($scheme->sanctioned_cost) echo number_format($scheme->sanctioned_cost);
                                    else "notmentioned" ?></th>
                                <th><?php if ($expense_summary->gross_pay) echo number_format($expense_summary->gross_pay);
                                    else echo "0.00" ?></th>
                                <th><?php if ($scheme->sanctioned_cost > 0) echo round((($expense_summary->gross_pay * 100) / $scheme->sanctioned_cost), 2) . " %"; ?>
                                </th>
                                <th><?php echo number_format($scheme->sanctioned_cost - $expense_summary->gross_pay); ?>
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

    <?php
    if ($scheme->component_category_id != 10 and $scheme->component_category_id != 12) { ?>
        <div class="col-md-3">
            <div class="box border blue" id="messenger">
                <div class="box-title">
                    <h4><i class="fa fa-users"></i> Water User Assosiation Detail</h4>

                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <a
                            href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view_water_user_association/" . $water_user_association->water_user_association_id); ?>">

                            <h5>WUA Name: <?php echo $water_user_association->wua_name; ?></h5>
                        </a>
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
    <?php } ?>

    <div
        <?php if ($scheme->component_category_id != 10 and $scheme->component_category_id != 12) { ?>
        class="col-md-9"
        <?php } else { ?>
        class="col-md-12"
        <?php } ?>>
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Scheme Details


                </h4>
                <?php if ($scheme->scheme_status != 'Completed') { ?>
                    <span class="pull-right">

                        <?php if ($scheme->scheme_status != 'Completed') { ?>
                            <?php if ($scheme->component_category_id == 10) { ?>
                                <a class="llink llink-edit" style="color: white;" href="#"
                                    onclick="b1_scheme_form(<?php echo $scheme->scheme_id; ?>)"><i class="fa fa-pencil-square-o"></i>
                                    Edit</a>
                            <?php } else { ?>
                                <?php if ($scheme->component_category_id == 12) { ?>
                                    <a class="llink llink-edit" style="color: white;" href="#"
                                        onclick="b3_scheme_form(<?php echo $scheme->scheme_id; ?>)"><i class="fa fa-pencil-square-o"></i>
                                        Edit</a>
                                <?php } else { ?>
                                    <a class="llink llink-edit" style="color: white;" href="#"
                                        onclick="scheme_form(<?php echo $scheme->scheme_id; ?>)"><i class="fa fa-pencil-square-o"></i>
                                        Edit</a>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>
                    </span>
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

                        function b1_scheme_form(scheme_id) {

                            $.ajax({
                                    method: "POST",
                                    url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/b1_scheme_form'); ?>",
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

                        function b3_scheme_form(scheme_id) {

                            $.ajax({
                                    method: "POST",
                                    url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/b3_scheme_form'); ?>",
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
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_medium">
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Tehsil</th>
                                    <th>UC</th>
                                    <th>Village</th>
                                    <th>NA</th>
                                    <th>PK</th>
                                    <th><?php echo $this->lang->line('water_source'); ?></th>
                                    <th>Coordiantes</th>
                                    <th>Beneficiaries</th>
                                    <!-- <th><?php echo $this->lang->line('estimated_cost'); ?></th>
                                    <th><?php echo $this->lang->line('approved_cost'); ?></th>
                                    <th><?php echo $this->lang->line('sanctioned_cost'); ?></th>
                                    <th><?php echo $this->lang->line('revised_cost'); ?></th> -->
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
                                    <td><?php echo $scheme->tehsil; ?></td>
                                    <td><?php echo $scheme->uc; ?></td>
                                    <td><?php echo $scheme->villege; ?></td>
                                    <td><?php echo $scheme->na; ?></td>
                                    <td><?php echo $scheme->pk; ?></td>

                                    <td>
                                        <?php echo $scheme->water_source; ?>
                                    </td>
                                    <td>
                                        <?php if ($scheme->latitude and $scheme->longitude) { ?>
                                            lati: <?php echo $scheme->latitude; ?><br />
                                            long: <?php echo $scheme->longitude; ?>
                                            <style>
                                                /* Style for the map icon */
                                                .map-icon {
                                                    display: inline-flex;
                                                    /* Inline block with flex for alignment */
                                                    align-items: center;
                                                    /* Center align items vertically */
                                                    justify-content: center;
                                                    /* Center align items horizontally */
                                                    border: 2px solid gray;
                                                    /* Red border */
                                                    border-radius: 5px;
                                                    /* Rounded corners */
                                                    padding: 3px 5px;
                                                    /* Padding for better spacing */
                                                    background-color: white;
                                                    /* Background color */
                                                    color: gray;
                                                    /* Icon color */
                                                    font-size: 16px;
                                                    /* Font size */
                                                    cursor: pointer;
                                                    /* Pointer cursor on hover */
                                                    transition: all 0.3s;
                                                    /* Smooth transition for hover effects */
                                                    margin: 2px
                                                }

                                                /* Hover effect */
                                                .map-icon:hover {
                                                    background-color: gray;
                                                    /* Change background on hover */
                                                    color: white;
                                                    /* Change icon color on hover */
                                                    transform: scale(1.05);
                                                    /* Slightly scale the icon */
                                                }
                                            </style>
                                            <i onclick="get_google_map('<?php echo $scheme->latitude; ?>', '<?php echo $scheme->longitude; ?>')"
                                                class="fa fa-map map-icon" aria-hidden="true">
                                                Google Map
                                            </i>
                                            <script>
                                                function get_google_map(lat, long) {
                                                    $.ajax({
                                                            method: "POST",
                                                            url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/get_google_map'); ?>",
                                                            data: {
                                                                scheme_id: '<?php echo $scheme->scheme_id; ?>',
                                                                lat: lat,
                                                                long: long
                                                            },
                                                        })
                                                        .done(function(respose) {
                                                            $('#modal').modal('show');
                                                            $('#modal_title').html('Scheme Google Map View');
                                                            $('#modal_body').html(respose);
                                                        });
                                                }
                                            </script>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        Males: <?php echo $scheme->male_beneficiaries; ?><br />
                                        Females: <?php echo $scheme->female_beneficiaries; ?><br />
                                        Total: <?php echo $scheme->beneficiaries; ?> </td>
                                    <!-- <td>
                                        <?php echo $scheme->estimated_cost; ?>
                                    </td>
                                     <td>
                                        <?php
                                        if ($scheme->approved_cost) {
                                            echo $scheme->approved_cost;
                                            echo "<br />";
                                            echo 'Date: ' . date('d M,  Y', strtotime($scheme->approval_date));
                                            if ($scheme->scheme_status != 'Completed') {
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
                                    </td> -->

                                </tr>
                        </table>

                        <div class="table-responsive">
                            <table class="table table-bordered table_small" id="sche mes">
                                <thead>
                                    <tr>

                                        <th>Registration Date</th>
                                        <th>Survey Date</th>
                                        <th>Design Date</th>
                                        <th>Feasibility Date</th>
                                        <th>Work Order Date</th>
                                        <th>Scheme Initiation Date</th>
                                        <th>Estimated Cost</th>
                                        <th>Estimated Cost Date</th>
                                        <th>Approved Cost</th>
                                        <th>Approval Date</th>
                                        <th>Revised Cost</th>
                                        <th>Revised Cost Date</th>
                                        <th>Build In Cost</th>
                                        <th>Completion Cost</th>
                                        <th>Sanctioned Cost</th>
                                        <th>Technical Sanction Date</th>
                                        <th>Phy. Completion Date</th>
                                        <th>Completion Date</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $scheme->registration_date; ?></td>
                                        <td><?php echo $scheme->survey_date; ?></td>
                                        <td><?php echo $scheme->design_date; ?></td>
                                        <td><?php echo $scheme->feasibility_date; ?></td>
                                        <td><?php echo $scheme->work_order_date; ?></td>
                                        <td><?php echo $scheme->scheme_initiation_date; ?></td>
                                        <td><?php echo $scheme->estimated_cost; ?></td>
                                        <td><?php echo $scheme->estimated_cost_date; ?></td>
                                        <td><?php echo $scheme->approved_cost; ?></td>
                                        <td><?php echo $scheme->approval_date; ?></td>
                                        <td><?php echo $scheme->revised_cost; ?></td>
                                        <td><?php echo $scheme->revised_cost_date; ?></td>
                                        <td><?php echo $scheme->build_in_cost; ?></td>
                                        <td><?php echo $scheme->completion_cost; ?></td>
                                        <td><?php echo $scheme->sanctioned_cost; ?></td>
                                        <td><?php echo $scheme->technical_sanction_date; ?></td>
                                        <td><?php echo $scheme->phy_completion_date; ?></td>
                                        <td><?php echo $scheme->completion_date; ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?php if ($scheme->component_category_id == 12) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table_small">
                                    <thead>
                                        <tr>
                                            <th>Farmer Name</th>
                                            <th>Contact No</th>
                                            <th>NIC No</th>
                                            <th>Work Order No</th>
                                            <th>Government Share</th>
                                            <th>Farmer Share</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $scheme->farmer_name; ?></td>
                                            <td><?php echo $scheme->contact_no; ?></td>
                                            <td><?php echo $scheme->nic_no; ?></td>
                                            <td><?php echo $scheme->work_order_no; ?></td>
                                            <td><?php echo $scheme->government_share; ?></td>
                                            <td><?php echo $scheme->farmer_share; ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table_small">
                                    <thead>
                                        <tr>

                                            <th>SSC</th>
                                            <th>SSC Category</th>
                                            <th>Transmitter Make</th>
                                            <th>Transmitter Model</th>
                                            <th>Transmitter Serial No</th>
                                            <th>Receiver Make</th>
                                            <th>Receiver Model</th>
                                            <th>Receiver Serial No</th>
                                            <th>Control Box Make</th>
                                            <th>Control Box Model</th>
                                            <th>Control Box Serial No</th>
                                            <th>Scraper Serial No</th>
                                            <th>Scraper Blade Width</th>
                                            <th>Scraper Weight</th>
                                            <th>FCR Approving Expert</th>
                                            <th>Distribution Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td><?php echo $scheme->ssc; ?></td>
                                            <td><?php echo $scheme->ssc_category; ?></td>
                                            <td><?php echo $scheme->transmitter_make; ?></td>
                                            <td><?php echo $scheme->transmitter_model; ?></td>
                                            <td><?php echo $scheme->transmitter_sr_no; ?></td>
                                            <td><?php echo $scheme->receiver_make; ?></td>
                                            <td><?php echo $scheme->receiver_model; ?></td>
                                            <td><?php echo $scheme->receiver_sr_no; ?></td>
                                            <td><?php echo $scheme->control_box_make; ?></td>
                                            <td><?php echo $scheme->control_box_model; ?></td>
                                            <td><?php echo $scheme->control_box_sr_no; ?></td>
                                            <td><?php echo $scheme->scrapper_sr_no; ?></td>
                                            <td><?php echo $scheme->scrapper_blade_width; ?></td>
                                            <td><?php echo $scheme->scrapper_weight; ?></td>
                                            <td><?php echo $scheme->fcr_approving_expert; ?></td>
                                            <td><?php echo $scheme->distribution_date; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else {
                            if ($scheme->component_category_id == 10) { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table_small">
                                        <thead>
                                            <tr>
                                                <th>Farmer Name</th>
                                                <th>Contact No</th>
                                                <th>NIC No</th>
                                                <th>Work Order No</th>
                                                <th>Government Share</th>
                                                <th>Farmer Share</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $scheme->farmer_name; ?></td>
                                                <td><?php echo $scheme->contact_no; ?></td>
                                                <td><?php echo $scheme->nic_no; ?></td>
                                                <td><?php echo $scheme->work_order_no; ?></td>
                                                <td><?php echo $scheme->government_share; ?></td>
                                                <td><?php echo $scheme->farmer_share; ?></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table_small">
                                        <thead>
                                            <tr>

                                                <th>SSC</th>
                                                <th>Scheme Area</th>
                                                <th>Crop</th>
                                                <th>Crop Category</th>
                                                <th>System Type</th>
                                                <th>Soil Type</th>
                                                <th>Power Source</th>
                                                <th>Design Referred Date</th>
                                                <th>Desing Referred By</th>
                                                <th>Feasibility Checked By</th>
                                                <th>Design Approved By</th>
                                                <th>Per Acre Cost</th>
                                                <th>Agreement Signed Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td><?php echo $scheme->ssc; ?></td>
                                                <td><?php echo $scheme->scheme_area; ?></td>
                                                <td><?php echo $scheme->crop; ?></td>
                                                <td><?php echo $scheme->crop_category; ?></td>
                                                <td><?php echo $scheme->system_type; ?></td>
                                                <td><?php echo $scheme->soil_type; ?></td>
                                                <td><?php echo $scheme->power_source; ?></td>
                                                <td><?php echo $scheme->design_referred_date; ?></td>
                                                <td><?php echo $scheme->design_referred_by; ?></td>
                                                <td><?php echo $scheme->feasibility_checked_by; ?></td>
                                                <td><?php echo $scheme->design_approved_by; ?></td>
                                                <td><?php echo $scheme->per_acre_cost; ?></td>
                                                <td><?php echo $scheme->agreement_signed_date; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php  } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table_small" id="sch emes">
                                        <thead>
                                            <tr>

                                                <th>Verified By Tpv</th>
                                                <th>Funding Source</th>
                                                <th>Water Source</th>
                                                <th>CCA</th>
                                                <th>GCA</th>
                                                <th>Pre</th>
                                                <th>Pre Additional</th>
                                                <th>Post</th>
                                                <th>Saving</th>
                                                <!-- <th>Saving Utilisation To Intensity</th>
                                        <th>Saving Utilization To Change In Cropping Pattern</th>
                                        <th>Water Productivity For Wheat And Maize</th>
                                        <th>Any Increase In Productivity After The List Crop Cycle</th> -->
                                                <th>Total</th>
                                                <th>Lining</th>
                                                <th>Lwh</th>
                                                <th>Type Of Lining</th>
                                                <th>Nacca Pannel</th>
                                                <th>Culvert</th>
                                                <th>Risers Pipe</th>
                                                <th>Risers Pond</th>
                                                <th>Others</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>


                                                <td><?php echo $scheme->verified_by_tpv; ?></td>
                                                <td><?php echo $scheme->funding_source; ?></td>
                                                <td><?php echo $scheme->water_source; ?></td>
                                                <td><?php echo $scheme->cca; ?></td>
                                                <td><?php echo $scheme->gca; ?></td>
                                                <td><?php echo $scheme->pre_water_losses; ?></td>
                                                <td><?php echo $scheme->pre_additional; ?></td>
                                                <td><?php echo $scheme->post_water_losses; ?></td>
                                                <td><?php echo $scheme->saving_water_losses; ?></td>
                                                <!-- <td><?php echo $scheme->saving_utilisation_to_intensity; ?></td>
                                        <td><?php echo $scheme->saving_utilization_to_change_in_cropping_pattern; ?>
                                        </td>
                                        <td><?php echo $scheme->water_productivity_for_wheat_and_maize; ?></td>
                                        <td><?php echo $scheme->any_increase_in_productivity_after_the_list_crop_cycle; ?>
                                        </td> -->
                                                <td><?php echo $scheme->total_lenght; ?></td>
                                                <td><?php echo $scheme->lining_length; ?></td>
                                                <td><?php echo $scheme->lwh; ?></td>
                                                <td><?php echo $scheme->type_of_lining; ?></td>
                                                <td><?php echo $scheme->nacca_pannel; ?></td>
                                                <td><?php echo $scheme->culvert; ?></td>
                                                <td><?php echo $scheme->risers_pipe; ?></td>
                                                <td><?php echo $scheme->risers_pond; ?></td>
                                                <td><?php echo $scheme->others; ?></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                        <?php

                            }
                        } ?>

                        <div style="text-align: center;">
                            <h4 style="text-align: center;">
                                Current Scheme Status: <?php echo scheme_status($scheme->scheme_status); ?>


                                <?php if ($scheme->phy_completion === 'Yes') { ?>
                                    <span class="label label-success">
                                        <strong>Physically Completed: <?php echo $scheme->phy_completion; ?></strong>
                                    </span>
                                <?php } else { ?>
                                    <span class="label label-warning">
                                        <strong>Physically Completed: No</strong>
                                    </span>
                                <?php } ?>
                                </span>

                                <button onclick="scheme_logs()" class="btn btn-primary btn-sm"
                                    style="width: 25px; height: 25px; padding: 0; margin-left: 6px; border-radius: 50%; display: inline; align-items: center; justify-content: center;">
                                    <i class="fa fa-history"></i>
                                </button>



                            </h4>

                            <div style="font-size: 20px;">
                                <?php echo scheme_status_detail($scheme->scheme_status); ?>
                            </div>
                            <hr />


                            <?php echo $this->session->userdata('role_id'); ?>

                            <?php
                            if (($scheme->scheme_status == 'Sanctioned') and ($this->session->userdata('role_id') == 28 or $this->session->userdata('role_id') == 1)) { ?>

                                <?php if ($scheme->scheme_status == 'Sanctioned' and ($this->session->userdata('role_id') == 28 or $this->session->userdata('role_id') == 1)) { ?>
                                    <button onclick="initiate_scheme(<?php echo $scheme->scheme_id ?>)"
                                        class="btn btn-danger btn-sm"><i class="fa fa-forward"></i>
                                        Initiate Scheme
                                    </button>

                                <?php } else { ?>

                                    <?php if ($this->session->userdata('role_id') == 4) { ?>
                                        <button onclick="initiate_scheme(<?php echo $scheme->scheme_id ?>)"
                                            class="btn btn-danger btn-sm"><i class="fa fa-forward"></i>
                                            Edit Scheme Detail
                                        </button>
                                    <?php } ?>
                                <?php } ?>

                            <?php } ?>

                            <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'Final') { ?>

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

                                <button onclick="chanage_status_form('Dispute')" class="btn btn-warning btn-sm"> <i
                                        class="fa fa-times-circle"></i> Dispute</button>

                            <?php } ?>

                            <?php if (($this->session->userdata('role_id') == 4 or $this->session->userdata('role_id') == 1)) { ?>

                                <button class="bt btn-danger" onclick="change_scheme_status('<?php echo $scheme->scheme_id ?>')">Change Status</button>
                                <script>
                                    function change_scheme_status(scheme_id) {
                                        $.ajax({
                                                method: "POST",
                                                url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/change_scheme_status'); ?>",
                                                data: {
                                                    scheme_id: scheme_id,
                                                    water_user_association_id: <?php echo $scheme->water_user_association_id; ?>,
                                                },
                                            })
                                            .done(function(respose) {
                                                $('#modal').modal('show');
                                                $('#modal_title').html('Change Scheme Status');
                                                $('#modal_body').html(respose);
                                            });
                                    }
                                </script>
                                <?php if ($scheme->scheme_status == 'Registered') { ?>
                                    <button onclick="chanage_status_form('Approval')" class="btn btn-primary btn-sm"><i
                                            class="fa fa-check-circle"></i> Approve</button>
                                    <button onclick="chanage_status_form('Not Approve')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times-circle"></i> Not Approve</button>
                                <?php } ?>


                                <?php if ($scheme->scheme_status == 'Not-Approved') { ?>
                                    <button onclick="chanage_status_form('Approval')"
                                        class="btn btn-danger">Approve Again</button>
                                <?php } ?>

                                <?php if ($scheme->scheme_status == 'Disputed') { ?>
                                    <button onclick="chanage_status_form('Ongoing')" class="btn btn-warning btn-sm">
                                        <i class="fa fa-undo"></i> Mark Again as Ongoing Scheme</button>
                                <?php } ?>

                                <?php if ($scheme->scheme_status == 'Completed') { ?>
                                    <div class="alert alert-success">Scheme Status:
                                        <?php echo  $scheme->scheme_status; ?>
                                    </div>

                                <?php } ?>




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



                            <?php if (($scheme->scheme_status != 'Complete') and ($this->session->userdata('role_id') == 28   or $this->session->userdata('role_id') == 1)) { ?>

                                <?php if (!$scheme->phy_completion and ($scheme->scheme_status == 'Initiated' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II')) { ?>
                                    <button onclick="initiate_scheme(<?php echo $scheme->scheme_id ?>)"
                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                                        Edit Technical Data
                                    </button>
                                    <button onclick="initiate_scheme(<?php echo $scheme->scheme_id ?>, 'Complete')" class="btn btn-danger btn-sm"> <i
                                            class="fa fa-check-circle"></i> Marked as Physical Complete</button>
                                <?php } ?>

                            <?php } ?>
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
                            <th>Gross Paid</th>
                            <th>WHIT</th>
                            <th>WHST</th>
                            <th>St.Duty</th>
                            <th>RDP</th>
                            <th>KPRA</th>
                            <th>GUR.RET.</th>
                            <th>Misc.Dedu.</th>
                            <th>Net Paid</th>
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
                                    <td><?php if ($expense->gross_pay > 0) {
                                            echo number_format($expense->gross_pay, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->whit_tax > 0) {
                                            echo number_format($expense->whit_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->whst_tax > 0) {
                                            echo number_format($expense->whst_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->st_duty_tax > 0) {
                                            echo number_format($expense->st_duty_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->rdp_tax > 0) {
                                            echo number_format($expense->rdp_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->kpra_tax > 0) {
                                            echo number_format($expense->kpra_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->gur_ret > 0) {
                                            echo number_format($expense->gur_ret, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->misc_deduction > 0) {
                                            echo number_format($expense->misc_deduction, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <td><?php if ($expense->net_pay > 0) {
                                            echo number_format($expense->net_pay, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </td>
                                    <th>
                                        <?php if ($scheme->sanctioned_cost) echo round(($expense->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                                    </th>
                                    <th>
                                        <!-- <button onclick="change_cheque_schem(<?php echo $expense->expense_id ?>)">Change</button> -->
                                        <?php echo $expense->installment; ?>
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
                                    <th><?php if ($expense_summary->gross_pay > 0) {
                                            echo number_format($expense_summary->gross_pay, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->whit_tax > 0) {
                                            echo number_format($expense_summary->whit_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->whst_tax > 0) {
                                            echo number_format($expense_summary->whst_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->st_duty_tax > 0) {
                                            echo number_format($expense_summary->st_duty_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->rdp_tax > 0) {
                                            echo number_format($expense_summary->rdp_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->kpra_tax > 0) {
                                            echo number_format($expense_summary->kpra_tax, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->gur_ret > 0) {
                                            echo number_format($expense_summary->gur_ret, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->misc_deduction > 0) {
                                            echo number_format($expense_summary->misc_deduction, 2);
                                        } else {
                                            echo 0;
                                        } ?>
                                    </th>
                                    <th><?php if ($expense_summary->net_pay > 0) {
                                            echo number_format($expense_summary->net_pay, 2);
                                        } else {
                                            echo 0;
                                        } ?>
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

</div>
<?php
//if ($scheme->scheme_status == 'Par-Completed') {
if ($scheme->scheme_status != 'Completed' and 1 == 2) { ?>
    <?php $this->load->view(ADMIN_DIR . "temp/data_correction"); ?>
<?php } ?>
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

<script>
    function initiate_scheme(scheme_id, complete = '') {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/scheme_initiate_form'); ?>",
                data: {
                    scheme_id: scheme_id,
                    complete: complete,
                },
            })
            .done(function(respose) {
                $('#modal').modal('show');
                $('#modal_title').html('Initiate Scheme');
                $('#modal_body').html(respose);
            });
    }
</script>

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