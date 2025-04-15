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

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        /* border: 1px solid black !important; */
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
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
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

<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px;
        color: black;
        margin: 0px !important;
    }

    .tax_paid {
        color: green !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax_unpaid {
        color: red !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax {
        /* background-color: #f4f4f4; */
    }
</style>
<?php
$query = "SELECT 
    SUM(`net_pay`) AS net_pay, 
    SUM(`whit_tax`) AS whit_tax, 
    SUM(`whit_tax_paid`) AS whit_tax_paid, 
    SUM(`whst_tax`) AS whst_tax, 
    SUM(`whst_tax_paid`) AS whst_tax_paid, 
    SUM(`st_duty_tax`) AS st_duty_tax, 
    SUM(`st_duty_tax_paid`) AS st_duty_tax_paid, 
    SUM(`rdp_tax`) AS rdp_tax, 
    SUM(`rdp_tax_paid`) AS rdp_tax_paid, 
    SUM(`kpra_tax`) AS kpra_tax, 
    SUM(`kpra_tax_paid`) AS kpra_tax_paid, 
    SUM(`wht`) AS wht, 
    SUM(`wht_paid`) AS wht_paid, 
    SUM(`gur_ret`) AS gur_ret, 
    SUM(`gur_ret_paid`) AS gur_ret_paid, 
    SUM(`misc_deduction`) AS misc_deduction, 
    SUM(`misc_deduction_paid`) AS misc_deduction_paid, 
    SUM(`deduction`) AS deduction, 
    SUM(`inclusive`) AS inclusive, 
    SUM(`gross_pay`) AS gross_pay, 
    SUM(`reconciliation`) AS reconciliation, 
    SUM(`tax_paid`) AS tax_paid, 
    SUM(`remaining_taxes`) AS remaining_taxes
FROM `financial_summary`
";
$f_year_total = $this->db->query($query)->row();
$query = "SELECT * FROM financial_summary";
$f_years = $this->db->query($query)->result();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <h4> Khyber Pakhtunkhwa, Irrigated Agriculture Improvement Project (KP-IAIP) P163474</h4>
                        <h5><?php echo $title; ?></h5>
                    </div>

                    <table class="table table_small table-bordered" id="taxes">
                        <thead>

                            <tr>
                                <th></th>
                                <th>FY</th>
                                <th>Expenditures</th>
                                <th>WHST
                                </th>
                                <th>WHIT
                                </th>
                                <th>KPRA
                                </th>
                                <th>St.Duty
                                </th>
                                <th>RDP
                                </th>
                                <th>WHT
                                </th>
                                <th>GUR.RET
                                </th>
                                <th>Misc.Dedu
                                </th>
                                <th>Tax Deduction
                                </th>
                                <!-- <th>Gross Paid</th> -->
                                <th>Reconciliation</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($f_years as $f_year) {  ?>


                                <!-- First row: Total -->
                                <tr <?php if ($f_year->fy_status == 1) { ?>
                                    style="background-color:#CAF7B7; font-weight:bold;" <?php } ?>>
                                    <th><?php echo $count++; ?></th>
                                    <th nowrap><?php echo $f_year->fy; ?><?php if ($f_year->fy_status == 1) { ?> *
                                    <?php } ?></th>
                                    <th><?php echo $f_year->net_pay ? $f_year->net_pay : 0; ?></th>
                                    <th class="tax"><?php echo $f_year->whst_tax; ?></th>
                                    <th class="tax"><?php echo $f_year->whit_tax; ?></th>
                                    <th class="tax"><?php echo $f_year->kpra_tax; ?></th>
                                    <th class="tax"><?php echo $f_year->st_duty_tax; ?></th>
                                    <th class="tax"><?php echo $f_year->rdp_tax; ?></th>
                                    <th class="tax"><?php echo $f_year->wht; ?></th>
                                    <th class="tax"><?php echo $f_year->gur_ret; ?></th>
                                    <th class="tax"><?php echo $f_year->misc_deduction; ?></th>
                                    <th><?php echo $f_year->deduction ? $f_year->deduction : 0; ?></th>
                                    <!-- <th><?php echo $f_year->gross_pay ? $f_year->gross_pay : 0; ?></th> -->
                                    <th><?php echo $f_year->reconciliation ? $f_year->reconciliation : 0; ?></th>

                                </tr>

                                <!-- Second row: Paid -->
                                <tr>
                                    <th></th>
                                    <th nowrap></th>
                                    <th class="tax_paid">Paid</th>
                                    <td class="tax_paid"><?php echo $f_year->whst_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->whit_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->kpra_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->st_duty_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->rdp_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->wht_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->gur_ret_paid; ?></td>
                                    <td class="tax_paid"><?php echo $f_year->misc_deduction_paid; ?></td>
                                    <td><?php echo $f_year->tax_paid ? $f_year->tax_paid : 0; ?></td>
                                    <!-- <td></td> -->
                                    <!-- <td></td> -->

                                </tr>

                                <!-- Third row: Unpaid -->
                                <tr>
                                    <th></th>
                                    <th nowrap></th>
                                    <th class="tax_unpaid">Unpaid</th>
                                    <td class="tax_unpaid"><?php echo $f_year->whst_tax - $f_year->whst_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $f_year->whit_tax - $f_year->whit_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $f_year->kpra_tax - $f_year->kpra_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $f_year->st_duty_tax - $f_year->st_duty_tax_paid; ?>
                                    </td>
                                    <td class="tax_unpaid"><?php echo $f_year->rdp_tax - $f_year->rdp_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $f_year->wht - $f_year->wht_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $f_year->gur_ret - $f_year->gur_ret_paid; ?></td>
                                    <td class="tax_unpaid">
                                        <?php echo $f_year->misc_deduction - $f_year->misc_deduction_paid; ?></td>
                                    <td><?php echo $f_year->remaining_taxes ? $f_year->remaining_taxes : 0; ?></td>
                                    <!-- <td></td> -->
                                    <!-- <td></td> -->

                                </tr>


                            <?php } ?>
                        </tbody>
                        <tfoot>


                            <!-- First row: Total -->
                            <tr>
                                <th></th>
                                <th nowrap>Total:</th>
                                <th><?php echo $f_year_total->net_pay ? $f_year_total->net_pay : 0; ?></th>
                                <th class="tax"><?php echo $f_year_total->whst_tax; ?></th>
                                <th class="tax"><?php echo $f_year_total->whit_tax; ?></th>
                                <th class="tax"><?php echo $f_year_total->kpra_tax; ?></th>
                                <th class="tax"><?php echo $f_year_total->st_duty_tax; ?></th>
                                <th class="tax"><?php echo $f_year_total->rdp_tax; ?></th>
                                <th class="tax"><?php echo $f_year_total->wht; ?></th>
                                <th class="tax"><?php echo $f_year_total->gur_ret; ?></th>
                                <th class="tax"><?php echo $f_year_total->misc_deduction; ?></th>
                                <th><?php echo $f_year_total->deduction ? $f_year_total->deduction : 0; ?></th>
                                <!-- <th><?php echo $f_year_total->gross_pay ? $f_year_total->gross_pay : 0; ?></th> -->
                                <th><?php echo $f_year_total->reconciliation ? $f_year_total->reconciliation : 0; ?>
                                </th>

                            </tr>

                            <!-- Second row: Paid -->
                            <tr>
                                <th></th>
                                <th nowrap></th>
                                <th class="tax_paid">Paid</th>
                                <td class="tax_paid"><?php echo $f_year_total->whst_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->whit_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->kpra_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->st_duty_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->rdp_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->wht_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->gur_ret_paid; ?></td>
                                <td class="tax_paid"><?php echo $f_year_total->misc_deduction_paid; ?></td>
                                <td><?php echo $f_year_total->tax_paid ? $f_year_total->tax_paid : 0; ?></td>
                                <!-- <td></td> -->
                                <!-- <td></td> -->

                            </tr>

                            <!-- Third row: Unpaid -->
                            <tr>
                                <th></th>
                                <th nowrap></th>
                                <th class="tax_unpaid">Unpaid</th>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->whst_tax - $f_year_total->whst_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->whit_tax - $f_year_total->whit_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->kpra_tax - $f_year_total->kpra_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->st_duty_tax - $f_year_total->st_duty_tax_paid; ?>
                                </td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->rdp_tax - $f_year_total->rdp_tax_paid; ?></td>
                                <td class="tax_unpaid"><?php echo $f_year_total->wht - $f_year_total->wht_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->gur_ret - $f_year_total->gur_ret_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $f_year_total->misc_deduction - $f_year_total->misc_deduction_paid; ?>
                                </td>
                                <td><?php echo $f_year_total->remaining_taxes ? $f_year_total->remaining_taxes : 0; ?>
                                </td>
                                <!-- <td></td> -->
                                <!-- <td></td> -->

                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $title . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#taxes').DataTable({
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
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $title; ?>'

                }
            ]
        });
    });
</script>