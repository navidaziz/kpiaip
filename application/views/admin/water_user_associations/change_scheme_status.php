<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <input type="hidden" value="<?php echo $scheme_id ?>" name="scheme_id" />
        <?php
        $schemestatus = array(
            "Completed",
            "Final",
            "ICR-II",
            "ICR-I",
            "Ongoing",
            "Initiated",
            "Registered",
            "Par-Completed",
            "Disputed",
            "Not Approved"
        );
        foreach ($schemestatus as $scheme_status) { ?>
            <input type="radio" name="scheme_status" value="<?php echo $scheme_status; ?>" />
            <span style="margin: 10px;"></span> <?php echo $scheme_status; ?>
            <br />
        <?php } ?>
        <div id="result_response"></div>

        <div class=" col-md-12" style="text-align: center;">
            <?php
            $submit = array(
                "type"  =>  "submit",
                "name"  =>  "submit",
                "value" =>  $this->lang->line('Update'),
                "class" =>  "btn btn-primary",
                "style" =>  ""
            );
            echo form_submit($submit);
            ?>



            <?php
            $reset = array(
                "type"  =>  "reset",
                "name"  =>  "reset",
                "value" =>  $this->lang->line('Reset'),
                "class" =>  "btn btn-default",
                "style" =>  ""
            );
            echo form_reset($reset);
            ?>
        </div>
        <div style="clear:both;"></div>

    </form>

</div>

<script>
    $('#data_form').submit(function(e) {

        e.preventDefault(); // Prevent default form submission

        // Create FormData object
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_scheme_statu2") ?>', // URL to submit form data
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