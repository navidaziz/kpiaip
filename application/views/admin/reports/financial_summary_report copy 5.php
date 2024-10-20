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
    font-size: 12px !important;
    color: black;
    margin: 0px !important;
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
                        <h5>FINANCIAL PROGRESS -REALTIME</h5>
                    </div>

                    <table class="table table_small table-bordered" id="taxes">
                        <thead>

                            <tr>
                                <th></th>
                                <th>FY</th>
                                <th>Net Paid</th>
                                <th>WHST<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>WHIT<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>KPRA<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>St.Duty<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>RDP<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>WHT<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>GUR.RET.<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>Misc.Dedu.<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>Deduction<br />
                                    <small style="color: green;">Paid</small><br /><small
                                        style="color: red;">Unpaid</small><br />
                                </th>
                                <th>Gross Paid</th>
                                <th>Reconciliation</th>
                                <th>Tax Paid</th>
                                <th>Remaining Taxes</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($f_years as $f_year) {  ?>
                            <tr <?php if ($f_year->fy_status == 1) { ?>
                                style="background-color:#CAF7B7; font-weight:bold;" <?php } ?>>
                                <th><?php echo $count++; ?></th>
                                <th nowrap>
                                    <?php echo $f_year->fy; ?><?php if ($f_year->fy_status == 1) { ?> *
                                    <?php } ?></th>

                                <td><?php if($f_year->net_pay!=0){ echo $f_year->net_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php echo $f_year->whst_tax;?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->whst_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $f_year->whst_tax_paid-$f_year->whst_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year->whit_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->whit_tax_paid;  ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->whit_tax_paid-$f_year->whit_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year->kpra_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->kpra_tax_paid ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->kpra_tax_paid-$f_year->kpra_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year->st_duty_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->st_duty_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->st_duty_tax_paid-$f_year->st_duty_tax;?>
                                    </span>
                                </td>
                                <td><?php echo $f_year->rdp_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->rdp_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->rdp_tax_paid-$f_year->rdp_tax; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php $f_year->wht; ?>

                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->wht_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->wht_paid-$f_year->wht; ?>
                                    </span>

                                </td>
                                <td><?php echo $f_year->gur_ret; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->gur_ret_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->gur_ret_paid-$f_year->gur_ret; ?>
                                    </span>
                                </td>
                                <td><?php  echo $f_year->misc_deduction; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year->misc_deduction_paid;  ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year->misc_deduction_paid-$f_year->misc_deduction; ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->deduction!=0){ echo $f_year->deduction; }else{ echo 0; }?>
                                </td>

                                <td><?php if($f_year->gross_pay!=0){ echo $f_year->gross_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year->reconciliation!=0){ echo $f_year->reconciliation; }else{ echo 0; }?>
                                </td>
                                <td>
                                    <?php if($f_year->tax_paid!=0){ echo $f_year->tax_paid; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year->remaining_taxes!=0){ echo $f_year->remaining_taxes; }else{ echo 0; }?>

                            </tr>

                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th nowrap>Total:</th>
                                <td><?php if($f_year_total->net_pay!=0){ echo $f_year_total->net_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php echo $f_year_total->whst_tax;?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->whst_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $f_year_total->whst_tax_paid-$f_year_total->whst_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year_total->whit_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->whit_tax_paid;  ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->whit_tax_paid-$f_year_total->whit_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year_total->kpra_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->kpra_tax_paid ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->kpra_tax_paid-$f_year_total->kpra_tax; ?>
                                    </span>
                                </td>
                                <td><?php echo $f_year_total->st_duty_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->st_duty_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->st_duty_tax_paid-$f_year_total->st_duty_tax;?>
                                    </span>
                                </td>
                                <td><?php echo $f_year_total->rdp_tax; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->rdp_tax_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->rdp_tax_paid-$f_year_total->rdp_tax; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php $f_year_total->wht; ?>

                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->wht_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->wht_paid-$f_year_total->wht; ?>
                                    </span>

                                </td>
                                <td><?php echo $f_year_total->gur_ret; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->gur_ret_paid; ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->gur_ret_paid-$f_year_total->gur_ret; ?>
                                    </span>
                                </td>
                                <td><?php  echo $f_year_total->misc_deduction; ?>
                                    <br />
                                    <span style="color: green;">
                                        <?php echo $f_year_total->misc_deduction_paid;  ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php echo $f_year_total->misc_deduction_paid-$f_year_total->misc_deduction; ?>
                                    </span>
                                </td>
                                <td><?php if($f_year_total->deduction!=0){ echo $f_year_total->deduction; }else{ echo 0; }?>
                                </td>

                                <td><?php if($f_year_total->gross_pay!=0){ echo $f_year_total->gross_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year_total->reconciliation!=0){ echo $f_year_total->reconciliation; }else{ echo 0; }?>
                                </td>
                                <td>
                                    <?php if($f_year_total->tax_paid!=0){ echo $f_year_total->tax_paid; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year_total->remaining_taxes!=0){ echo $f_year_total->remaining_taxes; }else{ echo 0; }?>

                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>