<form id="vendors_taxes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php echo $input->id; ?>" />
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
    <div class="form-group row">
        <label for="vendor_id" class="col-sm-4 col-form-label">Vendors</label>
        <div class="col-sm-8">
            <select name="vendor_id" class="form-control" required="">
                <option value="">Select Vendors</option>
                <?php
                $query = "SELECT * FROM vendors WHERE status=1";
                $vendors = $this->db->query($query)->result();
                if ($vendors) {
                    foreach ($vendors as $vendor) { ?>
                        <option <?php if ($vendor->vendor_id == $input->vendor_id) { ?> selected <?php } ?> value="<?php echo $vendor->vendor_id ?>">
                            <?php echo $vendor->TaxPayer_Name ?>/<?php echo $vendor->TaxPayer_City ?>/<?php echo $vendor->TaxPayer_Address ?>
                        </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="invoice_id" class="col-sm-4 col-form-label">Invoice Id</label>
        <div class="col-sm-8">
            <input type="text" required id="invoice_id" name="invoice_id" value="<?php echo $input->invoice_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="invoice_date" class="col-sm-4 col-form-label">Invoice Date</label>
        <div class="col-sm-8">
            <input type="date" required id="invoice_date" name="invoice_date" value="<?php echo $input->invoice_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="nature_of_payment" class="col-sm-4 col-form-label">Nature Of Payment</label>
        <div class="col-sm-8">
            <input type="text" required id="nature_of_payment" name="nature_of_payment" value="<?php echo $input->nature_of_payment; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="payment_section_code" class="col-sm-4 col-form-label">Payment Section Code</label>
        <div class="col-sm-8">
            <input type="text" required id="payment_section_code" name="payment_section_code" value="<?php echo $input->payment_section_code; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="invoice_gross_total" class="col-sm-4 col-form-label">Invoice Gross Total (Rs.)</label>
        <div class="col-sm-8">
            <input type="text" onkeyup="calculate_taxes()" required id="invoice_gross_total" name="invoice_gross_total" value="<?php echo $input->invoice_gross_total; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="whit_tax_per" class="col-sm-3 col-form-label">WHIT Rate (%)</label>
        <div class="col-sm-3">
            <input type="number" min="0" step="any" max="100" onkeyup="calculate_whit_tax()" required id="whit_tax_per" name="whit_tax_per" value="0.0" class="form-control">
        </div>
        <label for="whit_tax" class="col-sm-3 col-form-label">WHIT Amount (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="whit_tax" name="whit_tax" value="<?php echo $input->whit_tax; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="st_charged" class="col-sm-3 col-form-label">ST Charged (%)</label>
        <div class="col-sm-3">
            <input type="number" min="0" step="any" max="100" onkeyup="calculate_st_charged_tax()" required id="st_charged_per" name="st_charged_per" value="0.0" class="form-control">
        </div>
        <label for="whit_tax" class="col-sm-3 col-form-label">ST Charged (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="st_charged" name="st_charged" value="<?php echo $input->st_charged; ?>" class="form-control">
        </div>
    </div>


    <div class="form-group row">
        <label for="whst_tax" class="col-sm-3 col-form-label">WHST Rate (%)</label>
        <div class="col-sm-3">
            <input type="number" min="0" step="any" max="100" onkeyup="calculate_whst_tax()" required id="whst_tax_per" name="whst_tax_per" value="0.0" class="form-control">
        </div>
        <label for="whst_tax" class="col-sm-3 col-form-label">WHST Amount (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="whst_tax" name="whst_tax" value="<?php echo $input->whst_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="st_duty_tax" class="col-sm-3 col-form-label">ST Duty Rate (%)</label>
        <div class="col-sm-3">

            <input type="number" min="0" step="any" max="100" onkeyup="calculate_st_duty_tax()" required id="st_duty_tax_per" name="st_duty_tax_per" value="0.0" class="form-control">
        </div>
        <label for="st_duty_tax" class="col-sm-3 col-form-label">ST Duty Amount (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="st_duty_tax" name="st_duty_tax" value="<?php echo $input->st_duty_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="kpra_tax" class="col-sm-3 col-form-label">KPRA Rate (%)</label>
        <div class="col-sm-3">
            <input type="number" min="0" step="any" max="100" onkeyup="calculate_kpra_tax()" required id="kpra_tax_per" name="kpra_tax_per" value="0.0" class="form-control">
        </div>
        <label for="kpra_tax" class="col-sm-3 col-form-label">KPRA Amount (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="kpra_tax" name="kpra_tax" value="<?php echo $input->kpra_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="rdp_tax" class="col-sm-3 col-form-label">RDP Rate (%)</label>
        <div class="col-sm-3">

            <input type="number" min="0" step="any" max="100" onkeyup="calculate_rdp_tax()" required id="rdp_tax_per" name="rdp_tax_per" value="0.0" class="form-control">
        </div>
        <label for="rdp_tax" class="col-sm-3 col-form-label">RDP Amount (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="rdp_tax" name="rdp_tax" value="<?php echo $input->rdp_tax; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="misc_deduction" class="col-sm-3 col-form-label">MISC. Deduction Rate (%)</label>
        <div class="col-sm-3">

            <input type="number" min="0" step="any" max="100" onkeyup="calculate_misc_deduction()" required id="misc_deduction_per" name="misc_deduction_per" value="0.0" class="form-control">
        </div>
        <label for="misc_deduction" class="col-sm-3 col-form-label">MISC. Deduction (Rs.)</label>
        <div class="col-sm-3">
            <input type="number" onkeyup="total_deduction()" step="0.01" required id="misc_deduction" name="misc_deduction" value="<?php echo $input->misc_deduction; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="total_deduction" class="col-sm-4 col-form-label">Net Deduction</label>
        <div class="col-sm-8">

            <input readonly type="number" step="0.01" required id="total_deduction" name="total_deduction" value="<?php echo $input->total_deduction; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Vendor Invoice</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Vendor Invoice</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    function calculate_taxes() {
        calculate_whit_tax();
        calculate_whst_tax();
        calculate_st_duty_tax();
        calculate_kpra_tax();
        calculate_rdp_tax();
        calculate_misc_deduction();
        calculate_st_charged_tax();
    }

    function calculate_whit_tax() {
        var tax_value = parseFloat($('#whit_tax_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / 100);
        $('#whit_tax').val(tax.toFixed(2));
        total_deduction();
    }

    function calculate_st_charged_tax() {
        var tax_value = parseFloat($('#st_charged_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / (100 + tax_value));
        $('#st_charged').val(tax.toFixed(2));
        total_deduction();
    }



    function calculate_whst_tax() {
        var tax_value = parseFloat($('#whst_tax_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / 100);
        $('#whst_tax').val(tax.toFixed(2));
        total_deduction();
    }

    function calculate_st_duty_tax() {
        var tax_value = parseFloat($('#st_duty_tax_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / 100);
        $('#st_duty_tax').val(tax.toFixed(2));
        total_deduction();
    }

    function calculate_kpra_tax() {
        var tax_value = parseFloat($('#kpra_tax_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / (100 + tax_value));
        $('#kpra_tax').val(tax.toFixed(2));
        total_deduction();
    }

    function calculate_rdp_tax() {
        var tax_value = parseFloat($('#rdp_tax_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / 100);
        $('#rdp_tax').val(tax.toFixed(2));
        total_deduction();
    }

    function calculate_misc_deduction() {
        var tax_value = parseFloat($('#misc_deduction_per').val());
        var invoice_gross_total = parseFloat($('#invoice_gross_total').val());
        var tax = invoice_gross_total * (tax_value / 100);
        $('#misc_deduction').val(tax.toFixed(2));
        total_deduction();
    }

    function total_deduction() {
        var misc_deduction = parseFloat($('#misc_deduction').val());
        var rdp_tax = parseFloat($('#rdp_tax').val());
        var kpra_tax = parseFloat($('#kpra_tax').val());
        var st_duty_tax = parseFloat($('#st_duty_tax').val());
        var whst_tax = parseFloat($('#whst_tax').val());
        var whit_tax = parseFloat($('#whit_tax').val());
        var st_charged = parseFloat($('#st_charged').val());

        var total_deduction = misc_deduction + rdp_tax + kpra_tax + st_duty_tax + whst_tax + whit_tax + st_charged;
        $('#total_deduction').val(total_deduction.toFixed(2));
    }

    $('#vendors_taxes').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "expenses/add_vendor_invoice"); ?>', // URL to submit form data
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