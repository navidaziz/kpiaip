<div class="box-body">
    <?php
    $query = "SELECT * FROM schemes WHERE scheme_id = '" . $scheme_id . "'";
    $scheme_detail = $this->db->query($query)->row();
    ?>
    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <input type="hidden" value="<?php echo $scheme_id ?>" name="scheme_id" />
        <table class="table ">
            <tr>
                <td>
                    <?php

                    $query = "SELECT COUNT(*) as total FROM expenses WHERE scheme_id = '" . $scheme_id . "'";
                    $cheques = $this->db->query($query)->row();
                    if ($cheques->total > 0 and $cheques->total <= 3) {
                        $schemestatus[] = "Completed";
                        $schemestatus[] = "Final";
                        $schemestatus[] = "ICR-II";
                        $schemestatus[] = "ICR-I";
                    } else {

                        if ($cheques->total == 0) {
                            echo '<div class="alert alert-danger">';
                            echo "No cheques are attached. Kindly attach the required cheques.<br />";
                            echo "</div>";
                        }
                        if ($cheques->total > 3) {
                            echo '<div class="alert alert-danger">';
                            echo "More than three cheques are attached. Please review the case.<br />";
                            echo "</div>";
                        }
                    }


                    $schemestatus[] = "Ongoing";
                    $schemestatus[] = "Initiated";
                    $schemestatus[] = "Registered";
                    $schemestatus[] = "Par-Completed";
                    $schemestatus[] = "Disputed";
                    $schemestatus[] = "Not-Approved";

                    foreach ($schemestatus as $scheme_status) { ?>
                        <input required type="radio" name="scheme_status" value="<?php echo $scheme_status; ?>" />
                        <span style="margin: 10px;"></span> <?php echo $scheme_status; ?>
                        <br />
                    <?php } ?>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>Approved Cost:</td>
                            <td><input required type="number" step="any" name="approve_cost" value="<?php echo $scheme_detail->approved_cost; ?>" /></td>
                        </tr>
                        <tr>
                            <td>CCA:</td>
                            <td><input min="0" type="number" step="any" required id="cca" name="cca" value="<?php $scheme_detail->cca; ?>" /></td>
                        </tr>
                        <tr>
                            <td>GCA:</td>
                            <td><input min="0" type="number" step="any" required id="gca" name="gca" value="<?php $scheme_detail->gca; ?>" /></td>
                        </tr>
                        <td>GCA:</td>
                        <td><input min="0" type="number" step="any" required id="gca" name="gca" value="<?php $scheme_detail->gca; ?>" /></td>
            </tr>
            <td>Pre Water Losses: (%)</td>
            <td><input min="0" max="100" type="number" step="any" required id="pre_water_losses" name="pre_water_losses" value="<?php $scheme_detail->pre_water_losses; ?>" /></td>
            </tr>
            <td>Post Water Losses: (%)</td>
            <td><input min="0" max="100" type="number" step="any" required id="post_water_losses" name="post_water_losses" value="<?php $scheme_detail->post_water_losses; ?>" /></td>
            </tr>
        </table>

        </td>
        </tr>
        </table>
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