<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <div class="row">
            <div class="col-md-8">
                <h4>
                    Scheme Code: <strong><?php echo htmlspecialchars($scheme->scheme_code); ?></strong><br />
                    Scheme Name: <strong><?php echo htmlspecialchars($scheme->scheme_name); ?></strong><br />
                </h4>

            </div>
            <div class="col-md-4">
                <h4>
                    Scheme Category: <strong><?php echo htmlspecialchars($scheme->category); ?></strong><br />
                    <?php //echo htmlspecialchars($scheme->category_detail); 
                    ?>
                </h4>
                <p>Scheme Status: <strong><?php echo htmlspecialchars($scheme->scheme_status); ?></strong></p>
            </div>
            <small>
                Address: Region: <?php echo htmlspecialchars($scheme->region); ?>, District: <?php echo htmlspecialchars($scheme->district); ?>, Tehsil: <?php echo htmlspecialchars($scheme->tehsil); ?>, UC: <?php echo htmlspecialchars($scheme->uc); ?>, Address: <?php echo htmlspecialchars($scheme->villege); ?>
            </small>

            <hr />
        </div>



        <?php echo form_hidden("scheme_id", $scheme_id); ?>
        <?php echo form_hidden("status_form", $status_form); ?>
        <?php if ($status_form == 'Complete') { ?>





        <?php } ?>

        <?php if ($status_form == 'Ongoing') { ?>
            <div class="col-md-12">
                <p>This scheme is currently marked as disputed. </p>
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
                <h4>Please provide the reason why the scheme was Not-Approved.<br />
                    Scheme Name: <?php echo $scheme->scheme_name ?><br />
                    Scheme Code: <?php echo $scheme->scheme_code; ?><br /></h4>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px;">
                <strong>Remarks</strong>
                <textarea required style="width: 100%;" name="remarks" value="<?php echo $scheme->remarks; ?>"></textarea>

            </div>
        <?php } ?>
        <?php if ($status_form == 'Approval') { ?>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Estimated Cost</th>
                    <th>Approved Cost</th>
                    <th>Revised Cost</th>
                    <th>Completion Cost</th>
                    <th>Current Sanctioned Cost</th>
                </tr>
                <tr>
                    <td><?php echo number_format($scheme->{'estimated_cost'}, 0); ?></td>
                    <td><?php echo number_format($scheme->{'approved_cost'}, 0); ?></td>
                    <td><?php echo number_format($scheme->{'revised_cost'}, 0); ?></td>
                    <td><?php echo number_format($scheme->{'completion_cost'}, 0); ?></td>
                    <td><?php echo number_format($scheme->{'sanctioned_cost'}, 0); ?></td>
                </tr>
            </table>


            <div class="row">


                <!-- Approval Cost -->
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px;">
                        <label for="approved_cost" class="col-form-label">Approval Cost <span style="color: red;">*</span></label>
                        <input type="number" step="any" id="approved_cost" name="approved_cost"
                            value="<?php echo $scheme->approved_cost; ?>" class="form-control"
                            required title="Approval Cost" placeholder="Approval Cost">
                    </div>
                </div>

                <!-- Approval Date -->
                <div class="col-md-6">
                    <div class="form-group" style="margin: 5px;">
                        <label for="approval_date" class="col-form-label">Approval Date <span style="color: red;">*</span></label>
                        <input type="date" id="approval_date" name="approval_date"
                            value="<?php echo $scheme->approval_date; ?>" class="form-control"
                            required title="Approval Date" placeholder="Approval Date">
                    </div>
                </div>
            </div>





        <?php } ?>


        <br />

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