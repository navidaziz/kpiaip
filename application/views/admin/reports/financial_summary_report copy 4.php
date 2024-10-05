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
                                <th>Net Pay</th>
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
                                <th>Gross Pay</th>
                                <th>Reconciliation</th>
                                <th>Tax Paid</th>
                                <th>Remaining Taxes</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                                        $query = "SELECT 
                                    f.financial_year_id AS fy_id, -- ID of the financial year
                                    f.financial_year AS fy,        -- Name of the financial year
                                    f.status AS fy_status,         -- Status of the financial year
                                    SUM(e.net_pay) AS net_pay,    -- Total net payment
                                    SUM(e.whit_tax) AS whit_tax,   -- Total withholding tax
                                    SUM(e.whst_tax) AS whst_tax,   -- Total withholding tax on salary
                                    SUM(e.st_duty_tax) AS st_duty_tax, -- Total stamp duty tax
                                    SUM(e.rdp_tax) AS rdp_tax,     -- Total RDP tax
                                    SUM(e.kpra_tax) AS kpra_tax,   -- Total KPRA tax
                                    SUM(e.gur_ret) AS gur_ret,     -- Total government retention
                                    SUM(e.misc_deduction) AS misc_deduction, -- Total miscellaneous deductions
                                    SUM(e.whit_tax) + SUM(e.whst_tax) + SUM(e.st_duty_tax) + SUM(e.rdp_tax) + SUM(e.kpra_tax) + SUM(e.gur_ret) + SUM(e.misc_deduction) AS deduction, -- Total deductions
                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction + e.net_pay) AS inclusive, -- Total including net pay
                                    SUM(e.gross_pay) AS gross_pay,  -- Total gross payment
                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction + e.net_pay - e.gross_pay) AS reconciliation, -- Reconciliation of payments
                                    (
                                    SELECT SUM(ex.net_pay) 
                                    FROM expenses AS ex 
                                    WHERE ex.component_category_id IN (29,30,31,33,235,256,274,275) 
                                    AND ex.financial_year_id = f.financial_year_id
                                    ) AS tax_paid, -- Total taxes paid for specific component categories

                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction) - (
                                    SELECT SUM(ex.net_pay) 
                                    FROM expenses AS ex 
                                    WHERE ex.component_category_id IN (29,30,31,33,235,256,274,275) 
                                    AND ex.financial_year_id = f.financial_year_id
                                    ) AS remaining_taxes -- Remaining taxes after accounting for paid taxes

                                    FROM 
                                    expenses AS e 
                                    INNER JOIN 
                                    financial_years AS f ON f.financial_year_id = e.financial_year_id -- Joining expenses with financial years
                                    GROUP BY 
                                    f.financial_year_id; -- Grouping results by financial year ID, name, and status";
                                $total_taxes=0;
                            $f_years = $this->db->query($query)->result();
                            foreach ($f_years as $f_year) {  ?>
                            <tr <?php if ($f_year->fy_status == 1) { ?>
                                style="background-color:#CAF7B7; font-weight:bold;" <?php } ?>>
                                <th><?php echo $count++; ?></th>
                                <th nowrap>
                                    <?php echo $f_year->fy; ?><?php if ($f_year->fy_status == 1) { ?> *
                                    <?php } ?></th>

                                <td><?php if($f_year->net_pay!=0){ echo $f_year->net_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year->whst_tax!=0){ echo $f_year->whst_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('29', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->whst_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->whit_tax!=0){ echo $f_year->whit_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('30', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->whit_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->kpra_tax!=0){ echo $f_year->kpra_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('31', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->kpra_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->st_duty_tax!=0){ echo $f_year->st_duty_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('33', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->st_duty_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->rdp_tax!=0){ echo $f_year->rdp_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('235', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->rdp_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td>0

                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('256', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-0;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>

                                </td>
                                <td><?php if($f_year->gur_ret!=0){ echo $f_year->gur_ret; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('274', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->gur_ret;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->misc_deduction!=0){ echo $f_year->misc_deduction; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('275', $f_year->fy_id);
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->misc_deduction;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
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


                            <?php 
                               $count = 1;
                                        $query = "SELECT 
                                    SUM(e.net_pay) AS net_pay,    -- Total net payment
                                    SUM(e.whit_tax) AS whit_tax,   -- Total withholding tax
                                    SUM(e.whst_tax) AS whst_tax,   -- Total withholding tax on salary
                                    SUM(e.st_duty_tax) AS st_duty_tax, -- Total stamp duty tax
                                    SUM(e.rdp_tax) AS rdp_tax,     -- Total RDP tax
                                    SUM(e.kpra_tax) AS kpra_tax,   -- Total KPRA tax
                                    SUM(e.gur_ret) AS gur_ret,     -- Total government retention
                                    SUM(e.misc_deduction) AS misc_deduction, -- Total miscellaneous deductions
                                    SUM(e.whit_tax) + SUM(e.whst_tax) + SUM(e.st_duty_tax) + SUM(e.rdp_tax) + SUM(e.kpra_tax) + SUM(e.gur_ret) + SUM(e.misc_deduction) AS deduction,
                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction + e.net_pay) AS inclusive, -- Total including net pay
                                    SUM(e.gross_pay) AS gross_pay,  -- Total gross payment
                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction + e.net_pay - e.gross_pay) AS reconciliation, -- Reconciliation of payments
                                    (
                                    SELECT SUM(ex.net_pay) 
                                    FROM expenses AS ex 
                                    WHERE ex.component_category_id IN(29,30,31,33,235,256,274,275)
                                     )AS tax_paid, -- Total taxes paid for specific component categories

                                    SUM(e.whit_tax + e.whst_tax + e.st_duty_tax + e.rdp_tax + e.kpra_tax + e.gur_ret + e.misc_deduction) - (
                                    SELECT SUM(ex.net_pay) 
                                    FROM expenses AS ex 
                                    WHERE ex.component_category_id IN (29,30,31,33,235,256,274,275)) AS remaining_taxes -- Remaining taxes after accounting for paid taxes

                                    FROM 
                                    expenses AS e -- Grouping results by financial year ID, name, and status";
                                
                            $f_year = $this->db->query($query)->row();
                            ?>
                            <tr>
                                <th></th>
                                <th nowrap>Total</th>

                                <td><?php if($f_year->net_pay!=0){ echo $f_year->net_pay; }else{ echo 0; }?>
                                </td>
                                <td><?php if($f_year->whst_tax!=0){ echo $f_year->whst_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('29');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->whst_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->whit_tax!=0){ echo $f_year->whit_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('30');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->whit_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->kpra_tax!=0){ echo $f_year->kpra_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('31');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->kpra_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->st_duty_tax!=0){ echo $f_year->st_duty_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('33');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->st_duty_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->rdp_tax!=0){ echo $f_year->rdp_tax; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('235');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->rdp_tax;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td>0

                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('256');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-0;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>

                                </td>
                                <td><?php if($f_year->gur_ret!=0){ echo $f_year->gur_ret; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('274');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->gur_ret;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
                                    </span>
                                </td>
                                <td><?php if($f_year->misc_deduction!=0){ echo $f_year->misc_deduction; }else{ echo 0; }?>
                                    <br />
                                    <span style="color: green;">
                                        <?php $taxpaid = taxPaid('275');
                                    if($taxpaid!=0){ echo $taxpaid; }else{ echo 0; }
                                    ?>
                                    </span>
                                    <br />
                                    <span style="color: red;">
                                        <?php $tax_diff = $taxpaid-$f_year->misc_deduction;
                                    if($tax_diff!=0){ echo $tax_diff; }else{ echo $tax_diff; }
                                    ?>
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

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<?php 

function taxPaid($tax_id, $f_year_id=NULL) {
    echo $tax_id."-";
    $CI = &get_instance();
    $query="SELECT SUM(net_pay) as tax_paid FROM expenses as e 
                                            WHERE e.component_category_id='".$tax_id."'";
    if($f_year_id){
        $query.=" AND financial_year_id ='".$f_year_id."' ";
    }                                        
    $tax_paid = $CI->db->query($query)->row(); 
    if ($tax_paid) {
        if($tax_paid->tax_paid){
            return $tax_paid->tax_paid;
        }else{
            return (double) 0.00;
        }
        
    } else {
        return (double) 0.00;
    }
}

$table_title = 'Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
title = 'Finacial Report';
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
                messageTop: '<?php echo $table_title; ?>'

            },
            {
                extend: 'excelHtml5',
                title: title,
                messageTop: '<?php echo $table_title; ?>'

            },
            {
                extend: 'pdfHtml5',
                title: title,
                pageSize: 'legal',
                orientation: 'landscape',
                messageTop: '<?php echo $table_title; ?>'

            }
        ]
    });
});
</script>