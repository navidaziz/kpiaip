<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("scheme_id", $scheme_id); ?>
        <?php echo form_hidden("status_form", $status_form); ?>

        <div class="form-group">
            <div class="col-md-12">
                <h4>Please enter Approved Cost and Date for scheme. <br />
                    Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br />
                    Estimated Cost: <?php echo $scheme->estimated_cost; ?></h4>
            </div>
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );

            echo form_label($this->lang->line('revised_cost'), "revised_cost", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "revised_cost",
                    "id"            =>  "revised_cost",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required",
                    "title"         =>  $this->lang->line('revised_cost'),
                    "value"         =>  set_value("revised_cost", $revised_cost->revised_cost),
                    "placeholder"   =>  $this->lang->line('revised_cost')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("revised_cost", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="date" class="col-md-4 control-label" style="">Revised Cost Date</label>
            <div class="col-md-8">
                <input type="date" name="date" value="<?php echo $revised_cost->date; ?>" id="date" class="form-control" style="" required="required" title="Date" placeholder="Date">
            </div>



        </div>





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
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_revised_cost") ?>', // URL to submit form data
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