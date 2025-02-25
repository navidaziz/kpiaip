<h4>
    <strong>Scheme Code: <?php echo $scheme->scheme_code; ?><br />
        Scheme Name: <?php echo $scheme->scheme_name ?><br />
    </strong>
</h4>
<h4>
    <small>Address: Region: <?php echo $scheme->region; ?>, District: <?php echo $scheme->district; ?>, Tehsil: <?php echo $scheme->tehsil ?>, UC: <?php echo $scheme->uc ?>, Address: <?php echo $scheme->address ?><br />
    </small>
</h4>
<p>Scheme Status: <strong> <?php echo $scheme->scheme_status ?> </strong></p>

<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input type="hidden" class="form-control" id="scheme_id" name="scheme_id" value="<?php echo $scheme->scheme_id; ?>" required>

    <table class="table">
        <tr>
            <td><label for="estimated_cost">Estimated Cost</label></td>
            <td><input min="1" required type="number" class="form-control" id="estimated_cost" name="estimated_cost" value="<?php echo $scheme->estimated_cost;  ?>" /></td>
            <td><label for="estimated_cost_date">Estimated Cost Date</label></td>
            <td><input required type="date" class="form-control" id="estimated_cost_date" name="estimated_cost_date" value="<?php echo $scheme->estimated_cost_date;  ?>" /></td>
        </tr>
        <tr>
            <td><label for="approved_cost">Approved Cost / Sectioned Cost</label></td>
            <td><input min="1" required type="number" class="form-control" id="approved_cost" name="approved_cost" value="<?php echo $scheme->approved_cost;  ?>" /></td>
            <td><label for="approval_date">Approved Cost / Sectioned Cost Date</label></td>
            <td><input required type="date" class="form-control" id="approval_date" name="approval_date" value="<?php echo $scheme->approval_date;  ?>" /></td>

        </tr>

        <tr>
            <td><label for="revised_cost">Revised Cost</label></td>
            <td><input min="0" type="number" class="form-control" id="revised_cost" name="revised_cost" value="<?php echo $scheme->revised_cost;  ?>" /></td>
            <td><label for="revised_cost_date">Revised Cost Date</label></td>
            <td><input type="date" class="form-control" id="revised_cost_date" name="revised_cost_date" value="<?php echo $scheme->revised_cost_date;  ?>" /></td>

        </tr>
        <tr>
            <td><label for="completion_cost">Completion Cost</label></td>
            <td><input min="1" required type="number" class="form-control" id="completion_cost" name="completion_cost" value="<?php echo $scheme->completion_cost;  ?>" /></td>
            <td><label for="completion_date">Completion Date</label></td>
            <td><input required type="date" class="form-control" id="completion_date" name="completion_date" value="<?php echo $scheme->completion_date;  ?>" /></td>

        </tr>
        <tr>
            <td colspan="4" style="text-align: center;">

                <button class="btn btn-warning">Update Scheme Costs</button>

                <div style="margin-top: 5px;" id="result_response"></div>
            </td>
        </tr>
    </table>


</form>

<script>
    $('#data_form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_correct_scheme_costs") ?>', // URL to submit form data
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set contentType
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