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
        font-size: 12px !important;
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
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "payment_notesheets/index"); ?>">Payment Notsheets</a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "payment_notesheets/view_payment_notesheets/" . $payment_notesheet->id); ?>"><?php echo $payment_notesheet->payment_notesheet_code; ?></a>
                </li>
                <li>Scheme Invoice Detail</li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-4">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description">Scheme Code: <strong><?php echo $scheme->scheme_code; ?></strong> <br />
                        <?php if ($scheme->phy_completion === 'Yes') { ?>
                            <strong>Physically Completed: <?php echo $scheme->phy_completion; ?></strong>
                        <?php } else { ?>
                            <strong>Physically Completed: No</strong>
                        <?php } ?>
                        <br />
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
                            <br />
                        </strong>
                        <small> Address: <?php echo $scheme->region; ?> / <?php echo $scheme->district_name; ?> / <?php echo $scheme->tehsil; ?> / <?php echo $scheme->uc; ?> / <?php echo $scheme->villege; ?></small>

                    </div>
                </div>

                <div class="col-md-8">
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
                        <table class="table table-bordered table-striped ">
                            <tr>
                                <td rowspan="2" style="vertical-align: middle;">
                                    <a class="btn btn-danger" target="_blank" href="<?php echo site_url(ADMIN_DIR . "vouchers/print_scheme_detail/" . $scheme->scheme_id); ?>"><i class="fa fa-print" aria-hidden="true"></i> Print Scheme Detail</a>
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





    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-tasks"></i> Scheme Invoice Detail</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">


                    <h4 style="margin-bottom: 20px;">Payment Vouchers
                        <span class="pull-right"><button onclick="get_voucher_form('0')" class="btn btn-success btn-sm">Create New Payment Voucher</button>
                            <script>
                                function get_voucher_form(voucher_id) {
                                    $.ajax({
                                            method: "POST",
                                            url: "<?php echo site_url(ADMIN_DIR . 'vouchers/get_voucher_form'); ?>",
                                            data: {
                                                voucher_id: voucher_id,
                                                scheme_id: '<?php echo $scheme->scheme_id; ?>'
                                            },
                                        })
                                        .done(function(respose) {
                                            $('#modal').modal('show');
                                            $('#modal_title').html('Vouchers');
                                            $('#modal_body').html(respose);
                                        });
                                }
                            </script>
                        </span>
                    </h4>
                    <div style="border: 1px solid #54789B; border-radius:5px; padding:5px; margin-bottom:5px; background-color: #F2F2F2;">
                        <table class="table table-bordered table_small" id="vendors_taxes" style="background-color: white;">
                            <thead>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * FROM vouchers WHERE scheme_id = ?";
                                $vouchers = $this->db->query($query, [$scheme->scheme_id])->result();
                                foreach ($vouchers as $voucher) { ?>


                                    <tr>
                                        <th colspan="18">
                                            <h5>
                                                <span class="pull-left">
                                                    <strong> Voucher ID: <?php echo $voucher->voucher_id; ?></strong> - <strong> Tracking ID: <?php echo $voucher->tracking_id; ?></strong>
                                                    <br />
                                                    Type: <?php echo $voucher->voucher_type; ?>, <?php echo $voucher->voucher_detail; ?>
                                                </span>
                                                <span class="pull-right">
                                                    <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'Final') { ?>
                                                        <button onclick="get_voucher_form('<?php echo $voucher->voucher_id; ?>')" class="btn btn-success btn-sm">Edit Voucher</button>
                                                        <button onclick="get_vendor_taxe_form('0', '<?php echo $voucher->voucher_id ?>')" class="btn btn-danger btn-sm">Add
                                                            Invoice</button>
                                                    <?php } ?>
                                                </span>
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Vendor</th>
                                        <th>Invoice Id</th>
                                        <th>Invoice Date</th>
                                        <th>Nature Of Payment</th>
                                        <th>Payment Section Code</th>
                                        <th>Invoice Gross Total</th>
                                        <th>ST Charged</th>
                                        <th>SST Charged</th>
                                        <th>WHIT</th>

                                        <th>WHST</th>
                                        <th>KPRA</th>
                                        <th>St.Duty</th>
                                        <th>RDP</th>
                                        <th>Misc.Dedu.</th>
                                        <th>Total Deduction</th>
                                        <th>Action</th>
                                    </tr>

                                    <?php
                                    $count = 1;
                                    $query = "SELECT vendors_taxes.*, vendors.TaxPayer_Name, vendors.Vendor_Type  
                                        FROM vendors_taxes 
                                        INNER JOIN vendors ON(vendors.vendor_id = vendors_taxes.vendor_id)
                                        WHERE scheme_id = '" . $scheme->scheme_id . "'
                                        AND voucher_id = '" . $voucher->voucher_id . "'";
                                    $rows = $this->db->query($query)->result();
                                    foreach ($rows as $row) { ?>
                                        <tr>
                                            <td><a href="<?php echo site_url(ADMIN_DIR . 'vouchers/delete_vendors_invoice/' . $row->id); ?>"
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
                                            <td><?php echo number_format($row->invoice_gross_total, 2); ?></td>
                                            <td><?php echo number_format($row->st_charged, 2); ?></td>
                                            <td><?php echo number_format($row->sst_charged, 2); ?></td>
                                            <td><?php echo number_format($row->whit_tax, 2); ?></td>

                                            <td><?php echo number_format($row->whst_tax, 2); ?></td>
                                            <td><?php echo number_format($row->kpra_tax, 2); ?></td>
                                            <td><?php echo number_format($row->st_duty_tax, 2); ?></td>
                                            <td><?php echo number_format($row->rdp_tax, 2); ?></td>
                                            <td><?php echo number_format($row->misc_deduction, 2); ?></td>
                                            <td><?php echo number_format($row->total_deduction, 2); ?></td>
                                            <td><button class="btn btn-primary btn-sm" onclick="get_vendor_taxe_form('<?php echo $row->id; ?>', '<?php echo $row->voucher_id; ?>')">Edit Invoice</button>
                                            </td>
                                        </tr>
                                    <?php }
                                    $query = "SELECT SUM(`invoice_gross_total`) as invoice_gross_total,
                                        SUM(`whit_tax`) as whit_tax,
                                        SUM(`whst_tax`) as whst_tax,
                                        SUM(`st_charged`) as st_charged,
                                         SUM(`sst_charged`) as sst_charged,
                                        SUM(`st_duty_tax`) as st_duty_tax,
                                        SUM(`rdp_tax`) as rdp_tax,
                                        SUM(`kpra_tax`) as kpra_tax,
                                        SUM(`misc_deduction`) as misc_deduction,
                                        SUM(`total_deduction`) as total_deduction
                                        FROM vendors_taxes 
                                        WHERE scheme_id = '" . $scheme->scheme_id . "'
                                        AND voucher_id = '" . $voucher->voucher_id . "'";
                                    $row = $this->db->query($query)->row(); ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Sub Total:</th>
                                        <th><?php echo number_format($row->invoice_gross_total, 2); ?></th>
                                        <th><?php echo number_format($row->st_charged, 2); ?></th>
                                        <th><?php echo number_format($row->sst_charged, 2); ?></th>
                                        <th><?php echo number_format($row->whit_tax, 2); ?></th>

                                        <th><?php echo number_format($row->whst_tax, 2); ?></th>
                                        <th><?php echo number_format($row->kpra_tax, 2); ?></th>
                                        <th><?php echo number_format($row->st_duty_tax, 2); ?></th>
                                        <th><?php echo number_format($row->rdp_tax, 2); ?></th>
                                        <th><?php echo number_format($row->misc_deduction, 2); ?></th>
                                        <th><?php echo number_format($row->total_deduction, 2); ?></th>
                                        <th></th>
                                    </tr>



                                <?php } ?>
                                <?php
                                $query = "SELECT SUM(`invoice_gross_total`) as invoice_gross_total,
                                SUM(`whit_tax`) as whit_tax,
                                SUM(`whst_tax`) as whst_tax,
                                SUM(`st_charged`) as st_charged,
                                SUM(`sst_charged`) as sst_charged,
                                SUM(`st_duty_tax`) as st_duty_tax,
                                SUM(`rdp_tax`) as rdp_tax,
                                SUM(`kpra_tax`) as kpra_tax,
                                SUM(`misc_deduction`) as misc_deduction,
                                SUM(`total_deduction`) as total_deduction
                                FROM vendors_taxes
                                WHERE scheme_id = '" . $scheme->scheme_id . "'";
                                $row = $this->db->query($query)->row(); ?>
                                <tr>
                                    <th colspan="17">
                                        <h5>
                                            <strong>Grand Total Vouchers Invoices</strong>


                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Grand Total:</th>
                                    <th><?php echo number_format($row->invoice_gross_total, 2); ?></th>
                                    <th><?php echo number_format($row->st_charged, 2); ?></th>
                                    <th><?php echo number_format($row->sst_charged, 2); ?></th>
                                    <th><?php echo number_format($row->whit_tax, 2); ?></th>

                                    <th><?php echo number_format($row->whst_tax, 2); ?></th>
                                    <th><?php echo number_format($row->kpra_tax, 2); ?></th>
                                    <th><?php echo number_format($row->st_duty_tax, 2); ?></th>
                                    <th><?php echo number_format($row->rdp_tax, 2); ?></th>

                                    <th><?php echo number_format($row->misc_deduction, 2); ?></th>
                                    <th><?php echo number_format($row->total_deduction, 2); ?></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h4 style="margin-bottom: 20px;">Payments

                        <span class="pull-right">
                            <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'Final') { ?>

                                <!-- <button onclick="expense_form2(0,'Programme Cost')" class="btn btn-danger btn-sm">Add Payment 2</button> -->

                                <button style="display: none;" onclick="expense_form(0,'Programme Cost')" class="btn btn-danger btn-sm">Add
                                    Payment</button>
                            <?php } ?>

                        </span>
                    </h4>

                    <table class="table table-bordered " id="db_table">
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
                            <th>KPRA</th>
                            <th>St.Duty</th>
                            <th>RDP</th>


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
                                    <td><a href="<?php echo site_url(ADMIN_DIR . 'vouchers/delete_expense_record/' . $expense->expense_id); ?>"
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
                                    <td><?php echo number_format($expense->kpra_tax); ?></td>
                                    <td><?php echo number_format($expense->st_duty_tax); ?></td>
                                    <td><?php echo number_format($expense->rdp_tax); ?></td>
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
                                    <th><?php if ($expense_summary->kpra_tax) echo number_format($expense_summary->kpra_tax);
                                        else echo "0.00" ?></th>
                                    <th><?php if ($expense_summary->st_duty_tax) echo number_format($expense_summary->st_duty_tax);
                                        else echo "0.00" ?></th>
                                    <th><?php if ($expense_summary->rdp_tax) echo number_format($expense_summary->rdp_tax);
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
                                        <strong><?php if ($expense_summary->gross_pay) echo number_format($expense_summary->gross_pay);
                                                else echo "0.00" ?></strong>
                                        <br />
                                        Total Remaining (Rs):
                                        <strong>
                                            <?php echo number_format($scheme->sanctioned_cost - $expense_summary->gross_pay); ?>
                                        </strong>
                                    </h5>
                                </td>
                            </tr>


                        </tfoot>
                    </table>
                    <div style="text-align: center;">
                        <?php if ($scheme->scheme_status == 'Ongoing' or $scheme->scheme_status == 'ICR-I' or $scheme->scheme_status == 'ICR-II' or $scheme->scheme_status == 'Final') { ?>

                        <?php } else { ?>
                            <div class="alert alert-success">Scheme Status: <?php echo  $scheme->scheme_status; ?></div>
                        <?php } ?>
                    </div>



                </div>



            </div>
            <script>
                function get_vendor_taxe_form(id, voucher_id) {
                    $.ajax({
                            method: "POST",
                            url: "<?php echo site_url(ADMIN_DIR . 'vouchers/get_vendor_taxe_form'); ?>",
                            data: {
                                id: id,
                                scheme_id: '<?php echo $scheme->scheme_id; ?>',
                                voucher_id: voucher_id
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

<?php $this->load->view(ADMIN_DIR . "water_user_associations/expense_reference"); ?>

</div>

<script>
    function expense_form2(expense_id, purpose) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'vouchers/scheme_expense_form2'); ?>",
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
                url: "<?php echo site_url(ADMIN_DIR . 'vouchers/scheme_expense_form'); ?>",
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