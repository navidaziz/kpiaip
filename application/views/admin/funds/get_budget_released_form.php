<form id="budget_released" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="budget_released_id" value="<?php echo $input->budget_released_id; ?>" />
    <div class="form-group row">
        <label for="date" class="col-sm-4 col-form-label">Date</label>
        <div class="col-sm-8">
            <input required type="date" class="form-control" id="date" name="date" value="<?php echo $input->date; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="rs_total" class="col-sm-4 col-form-label">Budget Released (Rs)</label>
        <div class="col-sm-8">
            <input required type="number" step="any" class="form-control" id="rs_total" name="rs_total" value="<?php echo $input->rs_total; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="remarks" class="col-sm-4 col-form-label">Remarks</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $input->remarks; ?>">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->budget_released_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#budget_released').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "funds/add_budget_released"); ?>', // URL to submit form data
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