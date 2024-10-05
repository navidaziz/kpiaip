<h5>Search Result:<span class="pull-right" style="cursor: pointer;"
        onclick="$('#search_result').slideUp('slow', function() {$(this).html(''); }).slideDown('slow');">Clear Search
        Result <i class="fa fa-times" aria-hidden="true"></i></span>
</h5>
<table class="table table-bordered table_small">
    <thead>
        <th></th>
        <th>#</th>
        <th class="region">Region</th>
        <th class="district">District</th>
        <th class="category">Component Category</th>
        <th>Category Detail</th>
        <th class="purpose">Purpose</th>
        <th>WUA Reg.</th>
        <th>WUA Asso.</th>
        <th>Scheme</th>
        <th>FY</th>
        <th>Voucher Number</th>
        <th>Cheque</th>
        <th class="date">Date</th>
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
        <th></th>
    </thead>
    <tbody>
        <?php 
        if($expenses){
        $count = 1; foreach ($expenses as $expense) : ?>
        <tr>
            <td>
                <a href="<?php echo site_url(ADMIN_DIR . 'expenses/delete_expense_record/' . $expense->expense_id); ?>"
                    onclick="return confirm('Are you sure? you want to delete the record.')">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
            <td><?php echo $count++; ?></td>
            <td class="region"><?php echo $expense->region; ?></td>
            <td class="district"><?php echo $expense->district_name; ?></td>
            <td class="category"><?php echo $expense->category; ?></td>
            <td><?php echo $expense->category_detail; ?></td>
            <td class="purpose"><?php echo $expense->purpose; ?></td>
            <td><?php echo $expense->wua_registration_no; ?></td>
            <td><?php echo $expense->wua_name; ?></td>
            <td><?php echo $expense->scheme_name; ?></td>
            <td><?php echo $expense->financial_year; ?></td>
            <td><?php echo $expense->voucher_number; ?></td>
            <td><?php echo $expense->cheque; ?></td>
            <td class="date"><?php echo date('d-m-Y', strtotime($expense->date)); ?>
            </td>
            <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
            <td><?php echo $expense->gross_pay > 0 ? number_format($expense->gross_pay, 2) : 0; ?>
            </td>
            <td><?php echo $expense->whit_tax > 0 ? number_format($expense->whit_tax, 2) : 0; ?>
            </td>
            <td><?php echo $expense->whst_tax > 0 ? number_format($expense->whst_tax, 2) : 0; ?>
            </td>
            <td><?php echo $expense->st_duty_tax > 0 ? number_format($expense->st_duty_tax, 2) : 0; ?>
            </td>
            <td><?php echo $expense->rdp_tax > 0 ? number_format($expense->rdp_tax, 2) : 0; ?>
            </td>
            <td><?php echo $expense->kpra_tax > 0 ? number_format($expense->kpra_tax, 2) : 0; ?>
            </td>
            <td><?php echo $expense->gur_ret > 0 ? number_format($expense->gur_ret, 2) : 0; ?>
            </td>
            <td><?php echo $expense->misc_deduction > 0 ? number_format($expense->misc_deduction, 2) : 0; ?>
            </td>
            <td><?php echo $expense->net_pay > 0 ? number_format($expense->net_pay, 2) : 0; ?>
            </td>
            <td>
                <?php if(in_array($expense->component_category_id, $taxes_ids=array(29,30,31,33,235,256,274,275))) { ?>
                <button onclick="tax_expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
                <?php } else { ?>
                <button onclick="expense_form(<?php echo $expense->expense_id ?>)">Edit</button>
                <?php } ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php }else{?>
        <tr>
            <td colspan="25" style="color: red;">Record Not Found</td>
        </tr>
        <?php } ?>
    </tbody>
</table>