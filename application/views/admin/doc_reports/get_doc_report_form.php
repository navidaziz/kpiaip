<form id="doc_reports" class="form-horizontal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?php echo $input->id; ?>" />
        <div class="form-group row">
                            <label for="source" class="col-sm-4 col-form-label">Source</label>
                            <div class="col-sm-8">
                            <input type="text" required  id="source" name="source" value="<?php echo $input->source; ?>" class="form-control">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                            <input type="text" required  id="type" name="type" value="<?php echo $input->type; ?>" class="form-control">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Title</label>
                            <div class="col-sm-8">
                            <input type="text" required  id="title" name="title" value="<?php echo $input->title; ?>" class="form-control">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="detail" class="col-sm-4 col-form-label">Detail</label>
                            <div class="col-sm-8">
                            <input type="text" required  id="detail" name="detail" value="<?php echo $input->detail; ?>" class="form-control">
                            </div>
                            </div>
                            <div class="form-group row">
    <label for="attachment" class="col-sm-4 col-form-label">Attachment</label>
    <div class="col-sm-8">
        <input type="file" id="attachment" name="attachment" class="form-control">
        
        <!-- If there is an existing attachment, display it as a link -->
        <?php if (!empty($input->attachment)): ?>
            <div class="mt-2">
                <a href="<?php echo base_url($input->attachment); ?>" target="_blank">View Current Attachment</a>
            </div>
        <?php endif; ?>
    </div>
</div>

                            <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                            <input type="date" required  id="date" name="date" value="<?php echo $input->date; ?>" class="form-control">
                            </div>
                            </div>
                            
        <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->id == 0) { ?>
        <button type="submit" class="btn btn-primary">Add Data</button>
        <?php }else{ ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <?php } ?>
        </div>
        </form>
        </div>
        
        <script>
    $('#doc_reports').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "doc_reports/add_doc_report"); ?>', // URL to handle the form
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Don't process data like query strings
            success: function(response) {
                // On success, check the response and act accordingly
                if (response === 'success') {
                    location.reload(); // Reload the page on success
                } else {
                    $('#result_response').html('<div class="alert alert-danger">' + response + '</div>'); // Display error message
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error 
                console.log(error);
                $('#result_response').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });
</script>
