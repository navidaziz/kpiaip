<h5>Search Result:<span class="pull-right" style="cursor: pointer;"
        onclick="$('#search_result').slideUp('slow', function() {$(this).html(''); }).slideDown('slow');">Clear Search
        Result <i class="fa fa-times" aria-hidden="true"></i></span>
</h5>
<table class="table table-bordered ">
    <thead>
        <th>#</th>
        <th class="district">District</th>
        <th class="category">Component</th>
        <th>Scheme</th>
        <th>FY</th>
        <th>Cheque</th>
        <th class="date">Date</th>
        <th>Payee Name</th>
        <th>Scheme Name</th>
        <th>Gross Paid</th>
        <th>Net Paid</th>
        <th>Installment</th>
        <th></th>
    </thead>
    <tbody>
        <?php 
        if($expenses){
        $count = 1; foreach ($expenses as $expense) : ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td class="district"><?php echo $expense->district_name; ?></td>
            <td class="category"><?php echo $expense->category; ?></td>
            <td><?php echo $expense->scheme_name; ?></td>
            <td><?php echo $expense->financial_year; ?></td>
            <td><?php echo $expense->cheque; ?></td>
            <td class="date"><?php echo date('d-m-Y', strtotime($expense->date)); ?>
            </td>
            <td><b><i><?php echo $expense->payee_name; ?></i></b></td>
            <td><b><i><?php echo $expense->schemeName; ?></i></b></td>
            <td><?php echo $expense->gross_pay > 0 ? number_format($expense->gross_pay, 2) : 0; ?>
            </td>
            <td><?php echo $expense->net_pay > 0 ? number_format($expense->net_pay, 2) : 0; ?>
            </td>
            <td><?php echo $expense->installment; ?>
            </td>
            <td>
                <?php if($expense->scheme_name){ ?>
                <?php echo $expense->scheme_code; ?>
                <button onclick="correct_cheque(<?php echo $expense->expense_id ?>)">Edit</button>
                <?php }else{?>
                <button onclick="correct_cheque(<?php echo $expense->expense_id ?>)">Add in Scheme</button>
                <?php } ?>

            </td>
        </tr>
        <?php endforeach; ?>
        <?php }else{?>
        <tr>
            <td colspan="26" style="color: red;">Record Not Found</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
function correct_cheque(expense_id) {

    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'temp/change_cheque_scheme'); ?>",
            data: {
                expense_id: expense_id,
                scheme_id: <?php echo $scheme_id ?>,
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Cheque Correction');
            $('#modal_body').html(respose);
        });
}
</script>