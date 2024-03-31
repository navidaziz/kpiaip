<div class="table-responsive">
    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post">

        <input type="hidden" name="id" value="<?php echo $input->id; ?>" />
        <table class="table  table-bordered">
            <tbody>
                <tr>
                    <th>Date</th>
                    <td><input required type="date" name="date" value="<?php echo $input->date; ?>" /></td>
                </tr>
                <tr>
                    <th>US$</th>
                    <td><input onkeyup="calculateRsTotal('donor_dollar_total','donor_forex','donor_rs_total')" id="donor_dollar_total" required type="number" step="any" name="dollar_total" value="<?php echo $input->dollar_total; ?>" /></td>
                </tr>
                <tr>
                    <th>Forex</th>
                    <td><input onkeyup="calculateRsTotal('donor_dollar_total','donor_forex','donor_rs_total')" id="donor_forex" required type="number" step="any" name="forex" value="<?php echo $input->forex; ?>" /></td>
                </tr>
                <tr>
                    <th>PKRs</th>
                    <td><span id="donor_rs_total">
                            <?php echo $input->rs_total; ?>
                        </span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Add Funds" name="add_funds" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    function calculateRsTotal(dollar, forex, rs) {
        // Get the value of dollar_total and forex
        var dollarTotal = parseFloat($('#' + dollar).val());
        var forexValue = parseFloat($('#' + forex).val());

        // Check if the values are numbers
        if (!isNaN(dollarTotal) && !isNaN(forexValue)) {
            // Calculate rs_total
            var rsTotal = dollarTotal * forexValue;

            // Update the value in the span
            $('#' + rs).text(rsTotal.toFixed(2));
        } else {
            $('#' + rs).text(""); // Clear the value if inputs are not numbers
        }
    }
</script>

<script>
    $('#data_form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "funds/add_donor_funds_release"); ?>', // URL to submit form data
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