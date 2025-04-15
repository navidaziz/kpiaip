<form id="payment_notesheets" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php echo $input->id; ?>" />

    <div class="form-group row">
        <label for="puc_tracking_id" class="col-sm-4 col-form-label">PUC Tracking Id</label>
        <div class="col-sm-8">
            <input type="text" required id="puc_tracking_id" name="puc_tracking_id" value="<?php echo $input->puc_tracking_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="district_id" class="col-sm-4 col-form-label">District</label>
        <div class="col-sm-8">

            <?php
            // Fetch districts from the database
            $query = "SELECT * FROM districts";
            $districts = $this->db->query($query)->result();
            ?>

            <select name="district_id" id="district_id" class="form-control">

                <option value="">Select District</option>
                <?php foreach ($districts as $district) { ?>
                    <option value="<?php echo $district->district_id; ?>" <?php if ($district->district_id == $input->district_id) {
                                                                                echo "selected";
                                                                            } ?>>
                        <?php echo $district->district_name; ?>
                    </option>
                <?php } ?>

            </select>
            <?php echo form_error("district_id", "<p class=\"text-danger\">", "</p>"); ?>

        </div>
    </div>

    <div class="form-group row">
        <label for="puc_title" class="col-sm-12 col-form-label">PUC Title</label>
        <div class="col-sm-12">

            <textarea rows="5" class="form-control" id="puc_title" name="puc_title"><?php echo $input->puc_title; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="puc_detail" class="col-sm-12 col-form-label">PUC Detail</label>
        <div class="col-sm-12">
            <textarea rows="5" class="form-control" id="puc_detail" name="puc_detail"><?php echo $input->puc_detail; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="puc_date" class="col-sm-4 col-form-label">PUC Date</label>
        <div class="col-sm-8">
            <input type="date" required id="puc_date" name="puc_date" value="<?php echo $input->puc_date; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#payment_notesheets').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "payment_notesheets/add_payment_notesheet"); ?>', // URL to submit form data
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