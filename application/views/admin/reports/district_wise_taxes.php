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
FROM `district_financial_summary`
";
$district_total = $this->db->query($query)->row();
$query = "SELECT * FROM district_financial_summary";
$districts = $this->db->query($query)->result();
?>

<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <h5><?php echo $title; ?></h5>
                    </div>

                    <table class="table table_small table-bordered" id="taxes">
                        <thead>

                            <tr>
                                <th></th>
                                <th>District</th>
                                <th>Net Paid</th>
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
                                <th>Deduction
                                </th>
                                <th>Gross Paid</th>
                                <th>Reconciliation</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($districts as $district) {  ?>


                                <!-- First row: Total -->
                                <tr>
                                    <th><?php echo $count++; ?></th>
                                    <th nowrap><?php echo $district->district_name; ?></th>
                                    <th><?php echo $district->net_pay ? $district->net_pay : 0; ?></th>
                                    <th class="tax"><?php echo $district->whst_tax; ?></th>
                                    <th class="tax"><?php echo $district->whit_tax; ?></th>
                                    <th class="tax"><?php echo $district->kpra_tax; ?></th>
                                    <th class="tax"><?php echo $district->st_duty_tax; ?></th>
                                    <th class="tax"><?php echo $district->rdp_tax; ?></th>
                                    <th class="tax"><?php echo $district->wht; ?></th>
                                    <th class="tax"><?php echo $district->gur_ret; ?></th>
                                    <th class="tax"><?php echo $district->misc_deduction; ?></th>
                                    <th><?php echo $district->deduction ? $district->deduction : 0; ?></th>
                                    <th><?php echo $district->gross_pay ? $district->gross_pay : 0; ?></th>
                                    <th><?php echo $district->reconciliation ? $district->reconciliation : 0; ?></th>

                                </tr>

                                <!-- Second row: Paid -->
                                <tr>
                                    <th></th>
                                    <th nowrap></th>
                                    <th class="tax_paid">Paid</th>
                                    <td class="tax_paid"><?php echo $district->whst_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->whit_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->kpra_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->st_duty_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->rdp_tax_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->wht_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->gur_ret_paid; ?></td>
                                    <td class="tax_paid"><?php echo $district->misc_deduction_paid; ?></td>
                                    <td><?php echo $district->tax_paid ? $district->tax_paid : 0; ?></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <!-- Third row: Unpaid -->
                                <tr>
                                    <th></th>
                                    <th nowrap></th>
                                    <th class="tax_unpaid">Unpaid</th>
                                    <td class="tax_unpaid"><?php echo $district->whst_tax - $district->whst_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $district->whit_tax - $district->whit_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $district->kpra_tax - $district->kpra_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $district->st_duty_tax - $district->st_duty_tax_paid; ?>
                                    </td>
                                    <td class="tax_unpaid"><?php echo $district->rdp_tax - $district->rdp_tax_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $district->wht - $district->wht_paid; ?></td>
                                    <td class="tax_unpaid"><?php echo $district->gur_ret - $district->gur_ret_paid; ?></td>
                                    <td class="tax_unpaid">
                                        <?php echo $district->misc_deduction - $district->misc_deduction_paid; ?></td>
                                    <td><?php echo $district->remaining_taxes ? $district->remaining_taxes : 0; ?></td>
                                    <td></td>
                                    <td></td>

                                </tr>


                            <?php } ?>
                        </tbody>
                        <tfoot>


                            <!-- First row: Total -->
                            <tr>
                                <th></th>
                                <th nowrap>Total:</th>
                                <th><?php echo $district_total->net_pay ? $district_total->net_pay : 0; ?></th>
                                <th class="tax"><?php echo $district_total->whst_tax; ?></th>
                                <th class="tax"><?php echo $district_total->whit_tax; ?></th>
                                <th class="tax"><?php echo $district_total->kpra_tax; ?></th>
                                <th class="tax"><?php echo $district_total->st_duty_tax; ?></th>
                                <th class="tax"><?php echo $district_total->rdp_tax; ?></th>
                                <th class="tax"><?php echo $district_total->wht; ?></th>
                                <th class="tax"><?php echo $district_total->gur_ret; ?></th>
                                <th class="tax"><?php echo $district_total->misc_deduction; ?></th>
                                <th><?php echo $district_total->deduction ? $district_total->deduction : 0; ?></th>
                                <th><?php echo $district_total->gross_pay ? $district_total->gross_pay : 0; ?></th>
                                <th><?php echo $district_total->reconciliation ? $district_total->reconciliation : 0; ?>
                                </th>

                            </tr>

                            <!-- Second row: Paid -->
                            <tr>
                                <th></th>
                                <th nowrap></th>
                                <th class="tax_paid">Paid</th>
                                <td class="tax_paid"><?php echo $district_total->whst_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->whit_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->kpra_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->st_duty_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->rdp_tax_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->wht_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->gur_ret_paid; ?></td>
                                <td class="tax_paid"><?php echo $district_total->misc_deduction_paid; ?></td>
                                <td><?php echo $district_total->tax_paid ? $district_total->tax_paid : 0; ?></td>
                                <td></td>
                                <td></td>

                            </tr>

                            <!-- Third row: Unpaid -->
                            <tr>
                                <th></th>
                                <th nowrap></th>
                                <th class="tax_unpaid">Unpaid</th>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->whst_tax - $district_total->whst_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->whit_tax - $district_total->whit_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->kpra_tax - $district_total->kpra_tax_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->st_duty_tax - $district_total->st_duty_tax_paid; ?>
                                </td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->rdp_tax - $district_total->rdp_tax_paid; ?></td>
                                <td class="tax_unpaid"><?php echo $district_total->wht - $district_total->wht_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->gur_ret - $district_total->gur_ret_paid; ?></td>
                                <td class="tax_unpaid">
                                    <?php echo $district_total->misc_deduction - $district_total->misc_deduction_paid; ?>
                                </td>
                                <td><?php echo $district_total->remaining_taxes ? $district_total->remaining_taxes : 0; ?>
                                </td>
                                <td></td>
                                <td></td>

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