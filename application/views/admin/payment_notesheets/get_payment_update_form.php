<form id="payment_notesheet_schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php echo $input->id; ?>" />

    <div class="form-group row">
        <label for="payment_type" class="col-sm-4 col-form-label">Payment Type</label>
        <div class="col-sm-8">
            <?php
            $payment_type = array(
                "ICT-I" => "ICR-I",
                "ICT_II" => "ICR-II",
                "ICR-I&II" => "ICR-I&II",
                "FINAL" => "FINAL"
            );
            foreach ($payment_type as $key => $value): ?>
                <div class="form-check">
                    <input <?php if ($input->payment_type == $key) { ?> checked <?php } ?> class="form-check-input" type="radio" name="payment_type" id="payment_type_<?php echo $key; ?>" value="<?php echo $key; ?>">
                    <label class="form-check-label" for="payment_type_<?php echo $key; ?>">
                        <?php echo $value; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <div class="form-group row">
        <label for="payment_amount" class="col-sm-4 col-form-label">Payment Amount</label>
        <div class="col-sm-8">
            <input onkeyup="calculateNetPay()" min="0" type="number" step="any" required id="payment_amount" name="payment_amount" value="<?php echo $input->payment_amount; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="whit" class="col-sm-4 col-form-label">WHIT</label>
        <div class="col-sm-8">
            <input onkeyup="calculateNetPay()" min="0" type="number" step="any" required id="whit" name="whit" value="<?php echo $input->whit; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="whst" class="col-sm-4 col-form-label">WHST</label>
        <div class="col-sm-8">
            <input onkeyup="calculateNetPay()" min="0" type="number" step="any" required id="whst" name="whst" value="<?php echo $input->whst; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="net_pay" class="col-sm-4 col-form-label">Net Pay</label>
        <div class="col-sm-8">
            <input readonly type="number" min="0" required id="net_pay" name="net_pay" value="<?php echo $input->net_pay; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </div>
</form>

<script>
    function calculateNetPay() {

        const paymentAmount = parseFloat($('#payment_amount').val()) || 0;
        const whit = parseFloat($('#whit').val()) || 0;
        const whst = parseFloat($('#whst').val()) || 0;

        // Calculate net pay
        const netPay = paymentAmount - (whst + whit);
        $('#net_pay').val(netPay.toFixed(2));

    }
</script>


<script>
    $('#payment_notesheet_schemes').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "payment_notesheets/add_payment_amount"); ?>', // URL to submit form data
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