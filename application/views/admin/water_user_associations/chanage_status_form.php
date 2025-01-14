<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("scheme_id", $scheme_id); ?>
        <?php echo form_hidden("status_form", $status_form); ?>
        <?php if ($status_form == 'Complete') { ?>
            <div class="col-md-12">
                <h4>Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br />
                    Scheme Approved Cost: <?php echo $scheme->approved_cost; ?><br />
                    Scheme Revised Cost: <?php echo $scheme->revised_cost; ?><br />
                    Scheme Completion Cost: <?php echo $scheme->completion_cost; ?><br />
                    Scheme Sanctioned Cost: <?php echo $scheme->sanctioned_cost; ?><br /></h4>
                <p>This scheme is currently Ongoing. </p>

            </div>

            <div class="col-md-12" style="margin-bottom: 20px;">
                <strong style="color:green">Would you like to mark this as a physically completed scheme? <br />
                    <span style="color:red">Once the scheme is marked as physically completed, the 'Social and Physical Data' cannot be modified.</span></strong>
                <input <?php if ($scheme->phy_completion == 'Yes') { ?> checked <?php } ?> required type="radio" name="ongoing" value="yes" /> <span style="margin-left: 5xp;"> Yes</span>
            </div>
            <div class="form-group">
                <label for="completion_cost" class="col-md-4 control-label" style="">Final Completion Cost</label>
                <div class="col-md-8">
                    <input max="<?php echo $scheme->sanctioned_cost; ?>" type="number" name="completion_cost" value="<?php echo $scheme->completion_cost; ?>"
                        id="completion_cost" class="form-control" style="" required="required" title="Completion Cost"
                        placeholder="Completion Cost">
                </div>
            </div>
            <div class="form-group">
                <label for="completion_date" class="col-md-4 control-label" style="">Physical Completion Date</label>
                <div class="col-md-8">
                    <input type="date" name="phy_completion_date" value="<?php echo $scheme->completion_date; ?>"
                        id="phy_completion_date" class="form-control" style="" required="required" title="Physical Completion Date"
                        placeholder="Physical Completion Date">
                </div>
            </div>

        <?php } ?>

        <?php if ($status_form == 'Ongoing') { ?>
            <div class="col-md-12">
                <h4>Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br /></h4>
                <p>This scheme is currently marked as disputed. </p>
                <strong><?php echo $scheme->scheme_status; ?> Reason.</strong>
                <p><?php echo $scheme->remarks; ?></p>
            </div>

            <div class="col-md-12" style="margin-bottom: 20px;">
                <strong>Would you like to change its status to ongoing?</strong>
                <input required type="radio" name="ongoing" value="yes" /> <span style="margin-left: 5xp;"> Yes</span>
            </div>

        <?php } ?>
        <?php if ($status_form == 'Dispute') { ?>
            <div class="col-md-12">
                <h4>Please provide the reason why the scheme is disputed.<br />
                    Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br /></h4>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px;">
                <strong>Remarks</strong>
                <textarea required style="width: 100%;" name="remarks" value="<?php echo $scheme->remarks; ?>"></textarea>

            </div>
        <?php } ?>
        <?php if ($status_form == 'Not Approve') { ?>
            <div class="col-md-12">
                <h4>Please provide the reason why the scheme was not approved.<br />
                    Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br /></h4>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px;">
                <strong>Remarks</strong>
                <textarea required style="width: 100%;" name="remarks" value="<?php echo $scheme->remarks; ?>"></textarea>

            </div>
        <?php } ?>
        <?php if ($status_form == 'Approval') { ?>
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
                echo form_label($this->lang->line('approved_cost'), "approved_cost", $label);      ?>

                <div class="col-md-8">
                    <?php

                    $number = array(
                        "type"          =>  "number",
                        "name"          =>  "approved_cost",
                        "id"            =>  "approved_cost",
                        "class"         =>  "form-control",
                        "style"         =>  "",
                        "required"      => "required",
                        "title"         =>  $this->lang->line('approved_cost'),
                        "value"         =>  set_value("approved_cost", $scheme->approved_cost),
                        "placeholder"   =>  $this->lang->line('approved_cost'),
                        "onkeyup" => "convertNumberToWords('approved_cost')"
                    );
                    echo  form_input($number);
                    ?>
                    <p id="resultWords"></p>
                    <?php echo form_error("approved_cost", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="approval_date" class="col-md-4 control-label" style="">Approval Date</label>
                <div class="col-md-8">
                    <input type="date" name="approval_date" value="<?php echo $scheme->approval_date; ?>" id="approval_date"
                        class="form-control" style="" required="required" title="Approval Date" placeholder="Approval Date">
                </div>



            </div>
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
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_scheme_status") ?>', // URL to submit form data
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