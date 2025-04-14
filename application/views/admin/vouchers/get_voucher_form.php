<form id="vouchers" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="voucher_id" value="<?php echo $input->voucher_id; ?>" />
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
    <div class="form-group row">
        <label for="tracking_id" class="col-sm-4 col-form-label">Tracking ID</label>
        <div class="col-sm-8">
            <input type="text" required id="tracking_id" name="tracking_id" value="<?php echo $input->tracking_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="voucher_type" class="col-sm-4 col-form-label">Voucher Type</label>
        <div class="col-sm-8">
            <input type="text" required id="voucher_type" name="voucher_type" value="<?php echo $input->voucher_type; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="voucher_detail" class="col-sm-4 col-form-label">Voucher Detail</label>
        <div class="col-sm-8">
            <input type="text" id="voucher_detail" name="voucher_detail" value="<?php echo $input->voucher_detail; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->voucher_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#vouchers').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "vouchers/add_voucher"); ?>', // URL to submit form data
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