<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="box-body">


        <?php echo form_hidden("expense_id", $expense->expense_id); ?>
        <?php echo form_hidden("purpose", $expense->purpose); ?>
        <?php echo form_hidden("scheme_id", $expense->scheme_id); ?>

        <div class="form-group">
            <label for="Voucher Number" class="col-md-4 control-label" style="">Voucher Number</label>
            <div class="col-md-8">
                <input type="text" name="voucher_number" value="<?php echo $expense->voucher_number; ?>" id="voucher_number" class="form-control" style="" required="required" placeholder="Voucher Number">
            </div>
        </div>
        <div class="form-group">
            <label for="Purpose" class="col-md-4 control-label" style="">Purpose</label>
            <div class="col-md-8">
                <input type="text" name="purpose" value="<?php echo $expense->purpose; ?>" id="purpose" class="form-control" style="" required="required" placeholder="Purpose">
            </div>
        </div>
        <div class="form-group">
            <label for="District" class="col-md-4 control-label" style="">District</label>
            <div class="col-md-8">
                <select name="district_id" class="form-control" required="">
                    <option value="">Select District</option>
                    <?php foreach ($districts as $district) { ?>
                        <option <?php if ($district->district_id == $expense->district_id) { ?> selected <?php } ?> value="<?php echo $district->district_id ?>"><?php echo $district->district_name ?> (<?php echo $district->region ?>)</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="Category" class="col-md-4 control-label" style="">Component Category</label>
            <div class="col-md-8">
                <input type="hidden" name="component_category_id" value="<?php echo $component_catagory->component_category_id; ?>" />
                <?php echo $component_catagory->category ?>
                - <?php echo $component_catagory->category_detail ?>
                - <?php echo $component_catagory->main_heading ?><br />
                <div>
                    Input Value:
                    <input type="text" name="input_value" id="input_value" value="" oninput="calculateShares()" />
                    <br /><br />

                    Material Share (%):
                    <input readonly type="text" name="material_share_per" id="material_share_per" value="<?php echo $component_catagory->material_share; ?>" />
                    <br /><br />

                    Farmer Share (%):
                    <input readonly type="text" name="farmer_share_per" id="farmer_share_per" value="<?php echo $component_catagory->farmer_share; ?>" />
                    <br /><br />

                    Material Share (Rs.):
                    <input readonly type="text" name="material_share" id="material_share" value="" />
                    <br /><br />

                    Farmer Share (Rs.):
                    <input readonly type="text" name="farmer_share" id="farmer_share" value="" />
                </div>
                <script>
                    function calculateShares() {
                        // Get the input values
                        var inputValue = parseFloat(document.getElementById('input_value').value) || 0;
                        var materialSharePer = parseFloat(document.getElementById('material_share_per').value) || 0;
                        var farmerSharePer = parseFloat(document.getElementById('farmer_share_per').value) || 0;

                        // Calculate the shares
                        var materialShareRs = (inputValue * materialSharePer) / 100;
                        var farmerShareRs = (inputValue * farmerSharePer) / 100;

                        // Set the calculated values in the respective fields
                        document.getElementById('material_share').value = materialShareRs.toFixed(2);
                        document.getElementById('farmer_share').value = farmerShareRs.toFixed(2);
                    }
                </script>
            </div>
        </div>

        <div class="form-group" style="display: none;">
            <label for="Category" class="col-md-4 control-label" style="">Category</label>
            <div class="col-md-8">
                <input type="hidden" name="category" value="<?php echo $expense->category; ?>" id="category" class="form-control" style="" placeholder="Category">
            </div>
        </div>


        <div class="form-group">
            <label for="Payee Name" class="col-md-4 control-label" style="">Payee Name</label>
            <div class="col-md-8">
                <input type="text" s name="payee_name" value="<?php echo $expense->payee_name; ?>" id="payee_name" class="form-control" style="" required="required" placeholder="Payee Name">
            </div>
        </div>


        <div class="form-group">
            <label for="Cheque No." class="col-md-4 control-label" style="">Cheque No.</label>
            <div class="col-md-8">
                <input type="number" name="cheque" value="<?php echo $expense->cheque; ?>" id="cheque" class="form-control" style="" required="required" placeholder="Cheque No.">
            </div>
        </div>
        <div class="form-group">
            <label for="Date" class="col-md-4 control-label" style="">Date</label>
            <div class="col-md-8">
                <input type="date" name="date" value="<?php echo $expense->date; ?>" id="date" class="form-control" style="" required="required" placeholder="Date">
            </div>
        </div>

        <div class="form-group">
            <label for="Gross Paid" class="col-md-4 control-label" style="">Gross Paid</label>
            <div class="col-md-8">
                <input type="number" min="1" onkeyup="calculate_net_pay()" step="any" name="gross_pay" value="<?php echo $expense->gross_pay; ?>" id="gross_pay" class="form-control" style="" required="required" placeholder="Gross Paid">
            </div>
        </div>

        <div class="form-group">
            <label for="WHIT Tax" class="col-md-4 control-label" style="">WHIT Tax</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="whit_tax" value="<?php echo $expense->whit_tax; ?>" id="whit_tax" class="form-control" style="" required="required" placeholder="WHIT Tax">
            </div>
        </div>

        <div class="form-group">
            <label for="WHST Tax" class="col-md-4 control-label" style="">WHST Tax</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="whst_tax" value="<?php echo $expense->whst_tax; ?>" id="whst_tax" class="form-control" style="" required="required" placeholder="WHST Tax">
            </div>
        </div>
        <div class="form-group">
            <label for="St.Duty Tax" class="col-md-4 control-label" style="">St.Duty Tax</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="st_duty_tax" value="<?php echo $expense->st_duty_tax; ?>" id="st_duty_tax" class="form-control" style="" required="required" placeholder="St.Duty Tax">
            </div>
        </div>
        <div class="form-group">
            <label for="RDP Tax" class="col-md-4 control-label" style="">RDP Tax</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="rdp_tax" value="<?php echo $expense->rdp_tax; ?>" id="rdp_tax" class="form-control" style="" required="required" placeholder="RDP Tax">
            </div>
        </div>
        <div class="form-group">
            <label for="KPRA Tax" class="col-md-4 control-label" style="">KPRA Tax</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="kpra_tax" value="<?php echo $expense->kpra_tax; ?>" id="kpra_tax" class="form-control" style="" required="required" placeholder="KPRA Tax">
            </div>
        </div>
        <div class="form-group">
            <label for="Misc.Dedu." class="col-md-4 control-label" style="">Misc.Dedu.</label>
            <div class="col-md-8">
                <input type="number" onkeyup="calculate_net_pay()" step="any" name="misc_deduction" value="<?php echo $expense->misc_deduction; ?>" id="misc_deduction" class="form-control" style="" required="required" placeholder="Misc.Dedu.">
            </div>
        </div>

        <div class="form-group">
            <label for="Net Paid" class="col-md-4 control-label" style="">Net Paid</label>
            <div class="col-md-8">
                <input min="1" readonly type="number" step="any" name="net_pay" value="<?php echo $expense->net_pay; ?>" id="net_pay" class="form-control" style="" required="required" placeholder="Net Paid">
            </div>
        </div>
        <script>
            function calculate_net_pay() {
                var gross_pay = parseFloat($('#gross_pay').val());
                if (gross_pay == "") {
                    $('#gross_pay').val("0");
                }
                var whit_tax = parseFloat($('#whit_tax').val());
                var whst_tax = parseFloat($('#whst_tax').val());
                var st_duty_tax = parseFloat($('#st_duty_tax').val());
                var rdp_tax = parseFloat($('#rdp_tax').val());
                var misc_deduction = parseFloat($('#misc_deduction').val());
                var net_pay = gross_pay - whit_tax - whst_tax - st_duty_tax - rdp_tax - misc_deduction;
                $('#net_pay').val(net_pay);
            }
        </script>
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

    $('select').selectize({
        sortField: 'text'
    });
</script>