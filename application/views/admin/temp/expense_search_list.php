<h5>Search Result:<span class="pull-right" style="cursor: pointer;"
        onclick="$('#search_result').slideUp('slow', function() {$(this).html(''); }).slideDown('slow');">Clear Search
        Result <i class="fa fa-times" aria-hidden="true"></i></span>
</h5>
<?php 
$gross_paid = 0;
$net_paid = 0;
?>
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
            
        $count = 1; 
        foreach ($expenses as $expense){ 
        $gross_paid+=$expense->gross_pay;
        $net_paid+=$expense->net_pay;
        ?>
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
                <?php if($expense->component_category_id==$scheme->component_category_id){ ?>
                <?php if($expense->scheme_name){ ?>
                <?php echo $expense->scheme_code; ?>
                <button onclick="correct_cheque(<?php echo $expense->expense_id ?>)">Edit</button>
                <?php }else{?>
                <button onclick="correct_cheque(<?php echo $expense->expense_id ?>)">Add in Scheme</button>
                <?php } ?>
                <?php }else{
                    echo "<small style='color:red'>Scheme and Expense category not matched.</small><br />
                    <button onclick=\"get_change_chq_cetegory('".$expense->expense_id."')\">Change Cheque Category</button>
                    ";
                } ?>

            </td>
        </tr>
        <?php } ?>
        
        <?php }else{?>
        <tr>
            <td colspan="26" style="color: red;">Record Not Found</td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></h>
            <th></th>
            <th></th>
            <th>Total: </th>
            <th><?php echo $gross_paid; ?></th>
            <th><?php echo $net_paid; ?></th>
            <th></th>
            <th></th>

        </tr>
    </tfoot>
</table>

<div style="text-align:center">

                    <?php
                    $search_param = "%" . $this->db->escape_like_str($search) . "%";  // Properly escape $search for LIKE
                    $query = "
                    SELECT s.*, d.district_name, cc.category 
                    FROM schemes AS s 
                    INNER JOIN districts AS d ON d.district_id = s.district_id 
                    INNER JOIN component_categories AS cc ON cc.component_category_id = s.component_category_id 
                    WHERE s.scheme_name LIKE '$search_param'
                    AND s.scheme_id != '" . intval($scheme->scheme_id) . "' 
                    AND s.district_id = '" . intval($scheme->district_id) . "'
                    AND s.component_category_id = '" . intval($scheme->component_category_id) . "'
                    AND s.scheme_status != 'Completed' 
                    ORDER BY s.scheme_name ASC
                    ";
                    $schemes = $this->db->query($query)->result();

                    if($schemes){  ?>
                    <h4>Other Schemes with Similar Names</h4>
                       <table class="table table-strip table_small">
                            <?php foreach($schemes as $s){ ?>
                                <tr>
                                    <td><?php echo $s->scheme_code; ?><td>
                                        <td><a href="<?php echo site_url(ADMIN_DIR.'water_user_associations/view_scheme_detail/'.$s->water_user_association_id.'/'.$s->scheme_id); ?>">    
                                    <?php echo $s->scheme_name; ?> 
                                    </a></td>
                                    <td>
                                        <?php echo $s->category; ?> 
                            </td>
                            <td>
                                        <?php echo $s->district_name; ?> 
                            </td>
                            <td>
                                         <?php echo $s->scheme_status; ?>
                            </td>
                            </tr>
                            <?php } ?>
                            </table>
                    <?php }else{ ?>
                       
                    <?php } ?>
                </div>

<script>


function get_change_chq_cetegory(expense_id) {

    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'temp/get_change_chq_cetegory'); ?>",
            data: {
                expense_id: expense_id
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Cheque Correction');
            $('#modal_body').html(respose);
        });
}

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