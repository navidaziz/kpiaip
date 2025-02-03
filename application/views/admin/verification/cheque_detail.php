<?php
$query = "SELECT  
                            e.*, 
                            e.SchemeName as scheme_name_ref,
                            fy.financial_year, 
                            cc.category, 
                            cc.category_detail, 
                            s.scheme_name,
                            s.scheme_code,
                            wua.wua_registration_no,
                            wua.wua_name,
                            d.district_name, 
                            d.region  
                            FROM 
                            expenses AS e
                            LEFT JOIN 
                            financial_years AS fy ON fy.financial_year_id = e.financial_year_id
                            LEFT JOIN 
                            districts AS d ON d.district_id = e.district_id
                            LEFT JOIN 
                            component_categories AS cc ON cc.component_category_id = e.component_category_id
                            LEFT JOIN schemes AS s ON(s.scheme_id = e.scheme_id)
                            LEFT JOIN water_user_associations as wua on(wua.water_user_association_id = s.water_user_association_id)
                            WHERE  e.cheque = ?";

$expense = $this->db->query($query, [$cheque_no])->row();


?>
<?php if ($expense) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Cheque No. <strong><?php echo htmlspecialchars($cheque_no); ?></strong> - Expense Details
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Region</th>
                                <td><?php echo htmlspecialchars($expense->region); ?></td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td><?php echo htmlspecialchars($expense->district_name); ?></td>
                            </tr>
                            <tr>
                                <th>Component Category</th>
                                <td><?php echo htmlspecialchars($expense->category); ?></td>
                            </tr>
                            <tr>
                                <th>Category Detail</th>
                                <td><?php echo htmlspecialchars($expense->category_detail); ?></td>
                            </tr>
                            <tr>
                                <th>Purpose</th>
                                <td><?php echo htmlspecialchars($expense->purpose); ?></td>
                            </tr>
                            <tr>
                                <th>Scheme</th>
                                <td><?php echo htmlspecialchars($expense->scheme_name); ?></td>
                            </tr>
                            <tr>
                                <th>Scheme Code</th>
                                <td><?php echo htmlspecialchars($expense->scheme_code); ?></td>
                            </tr>
                            <tr>
                                <th>WUA Reg.</th>
                                <td><?php echo htmlspecialchars($expense->wua_registration_no); ?></td>
                            </tr>
                            <tr>
                                <th>WUA Association</th>
                                <td><?php echo htmlspecialchars($expense->wua_name); ?></td>
                            </tr>


                            <tr>
                                <th>Financial Year</th>
                                <td><?php echo htmlspecialchars($expense->financial_year); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Voucher Number</th>
                                <td><?php echo htmlspecialchars($expense->voucher_number); ?></td>
                            </tr>
                            <tr>
                                <th>Cheque</th>
                                <td><?php echo htmlspecialchars($expense->cheque); ?></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><?php echo date('d M, Y', strtotime($expense->date)); ?></td>
                            </tr>
                            <tr>
                                <th>Payee Name</th>
                                <td><?php echo htmlspecialchars($expense->payee_name); ?></td>
                            </tr>
                            <tr>
                                <th>Gross Paid</th>
                                <td><strong><?php echo number_format($expense->gross_pay, 2); ?></strong></td>
                            </tr>
                            <tr>
                                <th>WHIT</th>
                                <td><?php echo number_format($expense->whit_tax, 2); ?></td>
                            </tr>
                            <tr>
                                <th>WHST</th>
                                <td><?php echo number_format($expense->whst_tax, 2); ?></td>
                            </tr>
                            <tr>
                                <th>KPRA</th>
                                <td><?php echo number_format($expense->kpra_tax, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Stamp Duty</th>
                                <td><?php echo number_format($expense->st_duty_tax, 2); ?></td>
                            </tr>
                            <tr>
                                <th>RDP</th>
                                <td><?php echo number_format($expense->rdp_tax, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Guarantee Retention</th>
                                <td><?php echo number_format($expense->gur_ret, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Misc. Deductions</th>
                                <td><?php echo number_format($expense->misc_deduction, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Net Paid</th>
                                <td><strong><?php echo number_format($expense->net_pay, 2); ?></strong></td>
                            </tr>
                            <tr>
                                <th>Installment</th>
                                <td><?php echo htmlspecialchars($expense->installment); ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger">
        <i class="glyphicon glyphicon-exclamation-sign"></i>
        Cheque No. <strong><?php echo htmlspecialchars($cheque_no); ?></strong> not found in database.
        Please try again with a different cheque number. Thank you.
    </div>
<?php } ?>