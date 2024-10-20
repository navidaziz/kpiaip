<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="box-body">



        <?php echo form_hidden("expense_id", $expense->expense_id); ?>
        <?php echo form_hidden("purpose", $expense->purpose); ?>
        <?php echo form_hidden("scheme_id", $expense->scheme_id); ?>
        <?php echo form_hidden("gross_pay", $expense->gross_pay); ?>
        <?php echo form_hidden("whit_tax", $expense->whit_tax); ?>
        <?php echo form_hidden("whst_tax", $expense->whst_tax); ?>
        <?php echo form_hidden("rdp_tax", $expense->rdp_tax); ?>
        <?php echo form_hidden("gur_ret", $expense->gur_ret); ?>
        <?php echo form_hidden("kpra_tax", $expense->kpra_tax); ?>
        <?php echo form_hidden("st_duty_tax", $expense->st_duty_tax); ?>
        <?php echo form_hidden("misc_deduction", $expense->misc_deduction); ?>
        <?php echo form_hidden("component_category_id", $expense->component_category_id); ?>
        <div class="form-group">
            <label for="Voucher Number" class="col-md-4 control-label" style="">Voucher Number</label>
            <div class="col-md-8">
                <input type="text" name="voucher_number" value="<?php echo $expense->voucher_number; ?>"
                    id="voucher_number" class="form-control" style="" required="required" placeholder="Voucher Number">
            </div>
        </div>
        <div class="form-group">
            <label for="District" class="col-md-3 control-label" style="">District</label>
            <div class="col-md-9">
                <select name="district_id" class="form-control" required="">
                    <option value="">Select District</option>
                    <?php foreach ($districts as $district) { ?>
                    <option <?php if ($district->district_id == $expense->district_id) { ?> selected <?php } ?>
                        value="<?php echo $district->district_id ?>"><?php echo $district->district_name ?>
                        (<?php echo $district->region ?>)</option>
                    <?php } ?>
                </select>
            </div>
        </div>





        <div class="form-group">
            <label for="District" class="col-md-3 control-label" style="">Category</label>
            <div class="col-md-9">
                <?php 
                $query="SELECT component_category_id, category FROM `component_categories` where sub_component_id=22;";
                $tax_heads = $this->db->query($query)->result();
                foreach($tax_heads as $tax_head){ ?>
                <input required <?php if ($expense->component_category_id == $tax_head->component_category_id) { ?>
                    checked <?php } ?> type="radio" name="component_category_id"
                    value="<?php echo $tax_head->component_category_id ?>" />
                <?php echo $tax_head->category ?>
                <span style="margin-left: 3px;"></span>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label for="Payee Name" class="col-md-3 control-label" style="">Payee Name</label>
            <div class="col-md-9">
                <input type="text" name="payee_name" value="<?php echo $expense->payee_name; ?>" id="payee_name"
                    class="form-control" style="" required="required" placeholder="Payee Name">
            </div>
        </div>


        <div class="form-group">
            <label for="Cheque No." class="col-md-3 control-label" style="">Cheque No.</label>
            <div class="col-md-9">
                <input type="number" name="cheque" value="<?php echo $expense->cheque; ?>" id="cheque"
                    class="form-control" style="" required="required" placeholder="Cheque No.">
            </div>
        </div>
        <div class="form-group">
            <label for="Date" class="col-md-3 control-label" style="">Date</label>
            <div class="col-md-9">
                <input type="date" name="date" value="<?php echo $expense->date; ?>" id="date" class="form-control"
                    style="" required="required" placeholder="Date">
            </div>
        </div>

        <div class="form-group">
            <label for="Gross Paid" class="col-md-3 control-label" style="">Gross Paid</label>
            <div class="col-md-9">
                <input type="number" min="1" onkeyup="calculate_net_pay()" step="any" name="gross_pay"
                    value="<?php echo $expense->gross_pay; ?>" id="gross_pay" class="form-control" style=""
                    required="required" placeholder="Gross Paid">
            </div>
        </div>
        <script>
        function calculate_net_pay() {
            var gross_pay = parseFloat($('#gross_pay').val()) || 0;
            $('#net_pay').val(gross_pay);

        }
        </script>

        <div class="form-group">
            <label for="Net Paid" class="col-md-3 control-label" style="">Net Paid</label>
            <div class="col-md-9">
                <input readonly min="1" type="number" step="any" name="net_pay" value="<?php echo $expense->net_pay; ?>"
                    id="net_pay" class="form-control" style="" required="required" placeholder="Net Paid">
            </div>
        </div>

        <div class="col-md-12" id="result_response"></div>

        <div style="text-align: center;" class="col-md-12">
            <?php
            if ($expense->expense_id == 0) {
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Add Expense",
                    "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
            } else {
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Update Expense",
                    "class" =>  "btn btn-success",
                    "style" =>  ""
                );
            }
            echo form_submit($submit);
            ?>



        </div>

        <div style="clear:both;">
        </div>

    </div>
</form>
<script>
$('#data_form').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $(this).serialize();

    // Send AJAX request
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "expenses/add_expense") ?>', // URL to submit form data
        data: formData,
        success: function(response) {
            // Display response
            if (response == 'success') {
                location.reload();
            } else {
                $('#result_response').html(response);
            }

        }
    });
});
</script>