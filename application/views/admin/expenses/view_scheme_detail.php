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
                    <i class="fa fa-list"></i>

                    <a href="<?php echo site_url(ADMIN_DIR . "expenses"); ?>">Expenses Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <?php
 $redirectUrl = site_url(ADMIN_DIR . "expenses/schemes/");
if (isset($_SERVER['HTTP_REFERER'])) {
    $redirectUrl = $_SERVER['HTTP_REFERER'];
}
 ?>
                    <a href="<?php echo $redirectUrl; ?>">Scheme List</a>
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
                        SUM(e.rdp_tax) as kpra_tax,
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
    <!-- MESSENGER -->
    <div class="col-md-3">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Scheme Details</h4>

            </div>
            <div class="box-body">
                <div class="box-body">

                    <div class="table-responsive">

                        <table class="table table_small">
                            <thead>

                            </thead>
                            <tbody>

                                <tr>
                                    <th><?php echo $this->lang->line('scheme_code'); ?></th>
                                    <td>
                                        <?php echo $scheme->scheme_code; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('scheme_name'); ?></th>
                                    <td>
                                        <?php echo $scheme->scheme_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>District</th>
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
                                </tr>
                                <tr>
                                    <th>Component Category</th>

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
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('water_source'); ?></th>
                                    <td>
                                        <?php echo $scheme->water_source; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('latitude'); ?></th>
                                    <td>
                                        <?php echo $scheme->latitude; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('longitude'); ?></th>
                                    <td>
                                        <?php echo $scheme->longitude; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('male_beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->male_beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('female_beneficiaries'); ?></th>
                                    <td>
                                        <?php echo $scheme->female_beneficiaries; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('estimated_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->estimated_cost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('approved_cost'); ?></th>
                                    <td>
                                        <?php
                                        if ($scheme->approved_cost) {
                                            echo $scheme->approved_cost;
                                        } else {
                                            echo 'Not Approve Yet';
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('revised_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->revised_cost; ?>
                                        <?php
                                        if ($scheme->revised_cost) {
                                            echo $scheme->revised_cost;
                                        } else {
                                            echo 'Not Revised';
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('sanctioned_cost'); ?></th>
                                    <td>
                                        <?php echo $scheme->sanctioned_cost; ?>
                                    </td>
                                </tr>



                                <tr>
                                    <th>Scheme Status</th>
                                    <td>
                                        <?php echo scheme_status($scheme->scheme_status); ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>




                    </div>


                </div>
                <div class="table-responsive">
                    <strong><?php echo $water_user_association->wua_registration_no . " - " . $water_user_association->wua_name; ?></strong>
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


                    <table class="table table-bordered table_small" style="font-size: 9px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>Contact / CNIC</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT * FROM wua_members WHERE water_user_association_id = '" . $water_user_association->water_user_association_id . "'";
                            $wua_members = $this->db->query($query)->result();
                            foreach ($wua_members as $wua_member) : ?>

                            <tr>

                                <td><?php echo $count++; ?></td>

                                <td>
                                    <?php echo $wua_member->member_type; ?>
                                </td>
                                <td>
                                    <?php echo $wua_member->member_name; ?>
                                </td>
                                <td>
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


                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>


                </div>


            </div>

        </div>
    </div>
    <div class="col-md-9">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Financial Details</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">


                    <h4 style="margin-bottom: 20px;">Vendor Invoices
                        <span class="pull-right">
                            <button onclick="get_vendor_taxe_form('0')" class="btn btn-warning btn-sm">Add Vendor
                                Invoice</button>
                        </span>
                    </h4>
                    <table class="table table-bordered table_small" id="vendors_taxes">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Invoice Id</th>
                                <th>Invoice Date</th>
                                <th>Nature Of Payment</th>
                                <th>Payment Section Code</th>
                                <th>Invoice Gross Total</th>
                                <th>WHIT</th>
                                <th>ST Charged</th>
                                <th>WHST</th>
                                <th>St.Duty</th>
                                <th>RDP</th>
                                <th>KPRA</th>

                                <th>Misc.Dedu.</th>
                                <th>Total Deduction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT vendors_taxes.*, vendors.TaxPayer_Name, vendors.Vendor_Type  
                            FROM vendors_taxes 
                            INNER JOIN vendors  ON(vendors.vendor_id = vendors_taxes.vendor_id)
                            WHERE scheme_id = '" . $scheme->scheme_id . "'";
                            $rows = $this->db->query($query)->result();
                            foreach ($rows as $row) { ?>
                            <tr>
                                <td><a href="<?php echo site_url(ADMIN_DIR . 'expenses/delete_vendors_invoice/' . $row->id); ?>"
                                        onclick="return confirm('Are you sure? you want to delete the record.')"><i
                                            class="fa fa-trash-o"></i></a> </td>
                                <td><?php echo $count++ ?></td>
                                <td><?php echo $row->TaxPayer_Name; ?><br />
                                    <?php echo $row->Vendor_Type; ?>
                                </td>
                                <td><?php echo $row->invoice_id; ?></td>
                                <td><?php echo $row->invoice_date; ?></td>
                                <td><?php echo $row->nature_of_payment; ?></td>
                                <td><?php echo $row->payment_section_code; ?></td>
                                <td><?php echo $row->invoice_gross_total; ?></td>
                                <td><?php echo $row->whit_tax; ?></td>
                                <td><?php echo $row->st_charged; ?></td>
                                <td><?php echo $row->whst_tax; ?></td>
                                <td><?php echo $row->st_duty_tax; ?></td>
                                <td><?php echo $row->rdp_tax; ?></td>
                                <td><?php echo $row->kpra_tax; ?></td>

                                <td><?php echo $row->misc_deduction; ?></td>
                                <td><?php echo $row->total_deduction; ?></td>
                                <td><button onclick="get_vendor_taxe_form('<?php echo $row->id; ?>')">Edit<botton>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <h4 style="margin-bottom: 20px;">Payments

                        <span class="pull-right">
                            <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'FCR') { ?>

                            <!-- <button onclick="expense_form2(0,'Programme Cost')" class="btn btn-danger btn-sm">Add Payment 2</button> -->

                            <button onclick="expense_form(0,'Programme Cost')" class="btn btn-danger btn-sm">Add
                                Payment</button>
                            <?php } ?>

                        </span>
                    </h4>

                    <table class="table table-bordered table_small" id="db_table">
                        <thead>
                            <th></th>
                            <th>#</th>
                            <th>Expense Category</th>
                            <th>Voucher Number</th>
                            <th>Cheque</th>
                            <th>Date</th>
                            <th>Payee Name</th>
                            <th>Gross Paid</th>
                            <th>WHIT</th>
                            <th>WHST</th>
                            <th>St.Duty</th>
                            <th>RDP</th>
                            <th>KPRA</th>

                            <th>Gre.Ret.</th>
                            <th>Misc.Dedu.</th>
                            <th>Net Paid</th>
                            <th>Installment</th>
                            <th>Payment %</th>
                            <th></th>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT e.*,fy.financial_year, d.district_name, d.region  FROM expenses as e 
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                            INNER JOIN districts as d ON(d.district_id = e.district_id)
                            WHERE scheme_id = $scheme->scheme_id";
                            $expenses = $this->db->query($query)->result();

                            $count = 1;
                            foreach ($expenses as $expense) : ?>

                            <tr>
                                <td><a href="<?php echo site_url(ADMIN_DIR . 'expenses/delete_expense_record/' . $expense->expense_id); ?>"
                                        onclick="return confirm('Are you sure? you want to delete the record.')"><i
                                            class="fa fa-trash-o"></i></a> </td>

                                <td><?php echo $count++; ?></td>

                                <?php
                                    if ($expense->component_category_id > 0) {
                                        $query = "SELECT cc.`category`, cc.category_detail 
                                                        FROM `component_categories` as cc 
                                                        WHERE cc.component_category_id=$expense->component_category_id";
                                        $c_category = $this->db->query($query)->row();
                                    ?>
                                <td><?php echo $c_category->category; ?> - <?php echo $c_category->category_detail; ?>
                                </td>
                                <?php } else { ?>
                                <td></td>

                                <?php } ?>

                                <td><?php echo $expense->voucher_number; ?></td>
                                <td><?php echo $expense->cheque; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                                <td><?php echo number_format($expense->gross_pay); ?></td>
                                <td><?php echo number_format($expense->whit_tax); ?></td>
                                <td><?php echo number_format($expense->whst_tax); ?></td>
                                <td><?php echo number_format($expense->st_duty_tax); ?></td>
                                <td><?php echo number_format($expense->rdp_tax); ?></td>
                                <td><?php echo number_format($expense->kpra_tax); ?></td>
                                <td><?php echo $expense->gur_ret; ?></td>
                                <td><?php echo number_format($expense->misc_deduction); ?></td>
                                <td><?php echo number_format($expense->net_pay); ?></td>
                                <th><?php echo $expense->installment; ?></th>
                                <th>
                                    <?php if ($scheme->sanctioned_cost) echo round(($expense->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                                </th>
                                <th>
                                    <button
                                        onclick="expense_form(<?php echo $expense->expense_id ?>,'Programme Cost')">Edit</button>
                                </th>

                            </tr>
                            <?php endforeach; ?>

                            <?php

                            if ($expense_summary) {
                            ?>
                            <tr>
                                <th colspan="7" style="text-align: right;"> Total Payment</th>
                                <th><?php if ($expense_summary->gross_pay) echo number_format($expense_summary->gross_pay);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->whit_tax) echo number_format($expense_summary->whit_tax);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->whst_tax) echo number_format($expense_summary->whst_tax);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->st_duty_tax) echo number_format($expense_summary->st_duty_tax);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->rdp_tax) echo number_format($expense_summary->rdp_tax);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->kpra_tax) echo number_format($expense_summary->kpra_tax);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->gur_ret) echo number_format($expense_summary->gur_ret);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->misc_deduction) echo number_format($expense_summary->misc_deduction);
                                        else echo "0.00" ?></th>
                                <th><?php if ($expense_summary->net_pay) echo number_format($expense_summary->net_pay);
                                        else echo "0.00" ?></th>

                                <th></th>
                                <th>
                                    <?php if ($scheme->sanctioned_cost) echo round(($expense_summary->net_pay * 100) / $scheme->sanctioned_cost, 3) . " %"   ?>
                                </th>
                                <th></th>
                            </tr>
                            <?php } ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="19" style="text-align: right;">
                                    <h5>

                                        Total Scheme Cost (Rs):
                                        <strong><?php if ($scheme->sanctioned_cost) echo number_format($scheme->sanctioned_cost) ?></strong>
                                        <br />
                                        Total Paid (Rs):
                                        <strong><?php if ($expense_summary->net_pay) echo number_format($expense_summary->net_pay);
                                                else echo "0.00" ?></strong>
                                        <br />
                                        Total Remaining (Rs):
                                        <strong>
                                            <?php echo number_format($scheme->sanctioned_cost - $expense_summary->net_pay); ?>
                                        </strong>
                                    </h5>
                                </td>
                            </tr>


                        </tfoot>
                    </table>
                    <div style="text-align: center;">
                        <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'FCR') { ?>

                        <?php } else { ?>
                        <div class="alert alert-success">Scheme Status: <?php echo  $scheme->scheme_status; ?></div>
                        <?php } ?>
                    </div>



                </div>



            </div>
            <script>
            function get_vendor_taxe_form(id) {
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . 'expenses/get_vendor_taxe_form'); ?>",
                        data: {
                            id: id,
                            scheme_id: '<?php echo $scheme->scheme_id; ?>'
                        },
                    })
                    .done(function(respose) {
                        $('#modal').modal('show');
                        $('#modal_title').html('Vendor Invoice');
                        $('#modal_body').html(respose);
                    });
            }
            </script>


        </div>

    </div>
</div>

<?php $this->load->view(ADMIN_DIR."water_user_associations/expense_reference"); ?>

</div>

<script>
function expense_form2(expense_id, purpose) {
    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'expenses/scheme_expense_form2'); ?>",
            data: {
                expense_id: expense_id,
                purpose: purpose,
                scheme_id: '<?php echo $scheme->scheme_id; ?>'
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Add Expense as ' + purpose);
            $('#modal_body').html(respose);
        });
}

function expense_form(expense_id, purpose) {
    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'expenses/scheme_expense_form'); ?>",
            data: {
                expense_id: expense_id,
                purpose: purpose,
                scheme_id: '<?php echo $scheme->scheme_id; ?>'
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Add Expense as ' + purpose);
            $('#modal_body').html(respose);
        });
}
</script>