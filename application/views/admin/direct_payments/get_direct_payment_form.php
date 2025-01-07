<form id="direct_payments" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php echo $input->id; ?>" />
    <div class="form-group row">
        <label for="payee_name" class="col-sm-4 col-form-label">Payee Name</label>
        <div class="col-sm-8">
            <input type="text" required id="payee_name" name="payee_name" value="<?php echo $input->payee_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="iban_no" class="col-sm-4 col-form-label">IBAN No</label>
        <div class="col-sm-8">
            <input type="text" required id="iban_no" name="iban_no" value="<?php echo $input->iban_no; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="bank_name" class="col-sm-4 col-form-label">Bank Name</label>
        <div class="col-sm-8">
            <input type="text" required id="bank_name" name="bank_name" value="<?php echo $input->bank_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="branch_code" class="col-sm-4 col-form-label">Branch Code</label>
        <div class="col-sm-8">
            <input type="text" required id="branch_code" name="branch_code" value="<?php echo $input->branch_code; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-4 col-form-label">Address</label>
        <div class="col-sm-8">
            <input type="text" required id="address" name="address" value="<?php echo $input->address; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="country_state" class="col-sm-4 col-form-label">Country State</label>
        <div class="col-sm-8">
            <input type="text" required id="country_state" name="country_state" value="<?php echo $input->country_state; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="mode_of_payment" class="col-sm-4 col-form-label">Mode Of Payment</label>
        <div class="col-sm-8">
            <div class="col-sm-8">
                <?php
                $currency = array('Swift' => 'Swift', 'OTHER' => 'OTHER');
                echo form_dropdown('mode_of_payment', $currency, $input->currency, 'class="form-control" required');
                ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="wa_ref_no" class="col-sm-4 col-form-label">Wa's Ref No</label>
        <div class="col-sm-8">
            <input type="number" required id="wa_ref_no" name="wa_ref_no" value="<?php echo $input->wa_ref_no; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="purpose_of_payment" class="col-sm-4 col-form-label">Purpose Of Payment</label>
        <div class="col-sm-8">
            <input type="text" required id="purpose_of_payment" name="purpose_of_payment" value="<?php echo $input->purpose_of_payment; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="Category" class="col-sm-4 col-form-label">Component Category</label>
        <div class="col-sm-8">

            <select name="component_category_id" class="form-control searchable" required="">
                <option value="">Select Component Category</option>
                <?php
                $query = "select cc.*, sc.sub_component_name, c.component_name FROM component_categories as cc
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        AND cc.status=1
                        AND c.component_id  IN(3)
                        ORDER BY c.component_id ASC, sc.sub_component_name ASC, cc.category ASC;";
                //AND c.component_id NOT IN(1,2,7)
                $component_catagories = $this->db->query($query)->result();
                foreach ($component_catagories as $component_catagory) { ?>
                    <option
                        <?php if ($component_catagory->component_category_id == $input->component_category_id) { ?>
                        selected <?php } ?> value="<?php echo $component_catagory->component_category_id ?>">

                        <?php echo $component_catagory->category ?>
                        <?php echo $component_catagory->category_detail ?>
                        <?php echo $component_catagory->main_heading ?>

                        (<?php echo @$component_catagory->sub_component_name ?> -
                        <?php echo @$component_catagory->component_name ?>)</option>
                <?php } ?>
            </select>
        </div>
    </div>


    <div class="form-group row">
        <label for="currency" class="col-sm-4 col-form-label">Currency</label>
        <div class="col-sm-8">
            <?php
            $currency = array('USD' => 'USD', 'PKR' => 'PKR', 'OTHER' => 'OTHER');
            echo form_dropdown('currency', $currency, $input->currency, 'class="form-control" required');
            ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="forex" class="col-sm-4 col-form-label">Forex</label>
        <div class="col-sm-8">
            <input type="text" required id="forex" name="forex" value="<?php echo $input->forex; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="amount_usd" class="col-sm-4 col-form-label">Amount USD</label>
        <div class="col-sm-8">
            <input type="number" step="any" required id="amount_usd" name="amount_usd" value="<?php echo $input->amount_usd; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="amount_pkr" class="col-sm-4 col-form-label">Amount PKR</label>
        <div class="col-sm-8">
            <input type="number" step="any" required id="amount_pkr" name="amount_pkr" value="<?php echo $input->amount_pkr; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="amount_other" class="col-sm-4 col-form-label">Amount OTHER</label>
        <div class="col-sm-8">
            <input type="number" step="any" required id="amount_other" name="amount_other" value="<?php echo $input->amount_other; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="amount_other" class="col-sm-4 col-form-label">Payment Date</label>
        <div class="col-sm-8">
            <input type="date" required id="payment_date" name="payment_date" value="<?php echo $input->payment_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Direct Payment Detail</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Direct Payment Detail</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#direct_payments').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "direct_payments/add_direct_payment"); ?>', // URL to submit form data
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