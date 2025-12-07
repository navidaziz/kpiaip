<style>
    .formControl {
        width: 100%;
    }

    .col-form-label {
        font-size: 10px;
    }
</style>
<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input required type="hidden" class="form-c ontrol" id="scheme_id" name="scheme_id" value="<?php echo $scheme->scheme_id; ?>" required>
    <input required type="hidden" class="form-c ontrol" id="water_user_association_id" name="water_user_association_id" value="<?php echo $scheme->water_user_association_id; ?>" required>
    <input required type="hidden" class="form-c ontrol" id="component_category_id" name="component_category_id" value="<?php echo $scheme->component_category_id; ?>" required>

    <div class="row">
        <div class="col-md-12">
            <!-- Scheme Information Section -->
            <div class="box border blue" style="padding: 5px;">
                <div class="row">
                    <div class="col-md-8">
                        <h4>
                            Scheme Code: <strong><?php echo htmlspecialchars($scheme->scheme_code); ?></strong><br />
                            Scheme Name: <strong><?php echo htmlspecialchars($scheme->scheme_name); ?></strong><br />
                        </h4>
                        <h4>
                            <small>
                                Address: Region: <?php echo htmlspecialchars($scheme->region); ?>, District: <?php echo htmlspecialchars($scheme->district); ?>, Tehsil: <?php echo htmlspecialchars($scheme->tehsil); ?>, UC: <?php echo htmlspecialchars($scheme->uc); ?>, Address: <?php echo htmlspecialchars($scheme->villege); ?>
                            </small>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>
                            Scheme Category: <strong><?php echo htmlspecialchars($scheme->category); ?></strong><br />
                            <?php echo htmlspecialchars($scheme->category_detail); ?>
                        </h4>
                        <p>Scheme Status: <strong><?php echo htmlspecialchars($scheme->scheme_status); ?></strong></p>
                    </div>
                </div>
            </div>
            <hr />

            <!-- Form Section -->
            <div class="row">
                <div class="col-md-3">
                    <!-- Address Details -->
                    <div class="box border blue" style="padding: 5px;">
                        <div class="form-group row">
                            <label for="tehsil" class="col-sm-3 col-form-label">Tehsil</label>
                            <div class="col-sm-9">
                                <input required type="text" required id="tehsil" name="tehsil" value="<?php echo htmlspecialchars($scheme->tehsil); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uc" class="col-sm-3 col-form-label">UC</label>
                            <div class="col-sm-9">
                                <input required type="text" required id="uc" name="uc" value="<?php echo htmlspecialchars($scheme->uc); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="villege" class="col-sm-3 col-form-label">Village</label>
                            <div class="col-sm-9">
                                <input required type="text" required id="villege" name="villege" value="<?php echo htmlspecialchars($scheme->villege); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="na" class="col-sm-5 col-form-label">NA</label>
                            <div class="col-sm-7">
                                <input required type="text" required id="na" name="na" value="<?php echo htmlspecialchars($scheme->na); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pk" class="col-sm-5 col-form-label">PK</label>
                            <div class="col-sm-7">
                                <input required type="text" required id="pk" name="pk" value="<?php echo htmlspecialchars($scheme->pk); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Cost Details -->
                    <div class="box border blue" style="padding: 5px;">
                        <div class="form-group row">
                            <label for="approved_cost" class="col-sm-5 col-form-label">Approved Cost</label>
                            <div class="col-sm-7">
                                <input required type="text" required id="approved_cost" name="approved_cost" value="<?php echo htmlspecialchars($scheme->approved_cost); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="approval_date" class="col-sm-5 col-form-label">Approval Date</label>
                            <div class="col-sm-7">
                                <input required type="date" required id="approval_date" name="approval_date" value="<?php echo htmlspecialchars($scheme->approval_date); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="revised_cost" class="col-sm-5 col-form-label">Revised Cost</label>
                            <div class="col-sm-7">
                                <input type="text" min="0" required id="revised_cost" name="revised_cost" value="<?php echo htmlspecialchars($scheme->revised_cost); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="revised_cost_date" class="col-sm-5 col-form-label">Revised Cost Date</label>
                            <div class="col-sm-7">
                                <input type="date" id="revised_cost_date" name="revised_cost_date" value="<?php echo htmlspecialchars($scheme->revised_cost_date); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="completion_cost" class="col-sm-5 col-form-label">Completion Cost</label>
                            <div class="col-sm-7">
                                <input required type="text" required id="completion_cost" name="completion_cost" value="<?php echo htmlspecialchars($scheme->completion_cost); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="completion_date" class="col-sm-5 col-form-label">Completion Date</label>
                            <div class="col-sm-7">
                                <input required type="date" required id="completion_date" name="completion_date" value="<?php echo htmlspecialchars($scheme->completion_date); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Farmer and Equipment Details -->
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="farmer_name" class="col-sm-5 col-form-label">Farmer Name</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="farmer_name" name="farmer_name" value="<?php echo htmlspecialchars($scheme->farmer_name); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contact_no" class="col-sm-5 col-form-label">Contact No</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($scheme->contact_no); ?>" pattern="0[0-9]{10}" required title="Please enter an 11-digit mobile number starting with '0'" placeholder="03240000000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nic_no" class="col-sm-5 col-form-label">CNIC No.</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="nic_no" name="nic_no" value="<?php echo htmlspecialchars($scheme->nic_no); ?>" pattern="\d{5}-\d{7}-\d{1}" required onkeyup="nic_dash1(this)" placeholder="xxxxx-xxxxxxx-x">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="government_share" class="col-sm-5 col-form-label">Government Share</label>
                                    <div class="col-sm-7">
                                        <input required type="number" step="0.01" class="form-control" id="government_share" name="government_share" value="<?php echo htmlspecialchars($scheme->government_share); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="farmer_share" class="col-sm-5 col-form-label">Farmer Share</label>
                                    <div class="col-sm-7">
                                        <input required type="number" step="0.01" class="form-control" id="farmer_share" name="farmer_share" value="<?php echo htmlspecialchars($scheme->farmer_share); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ssc" class="col-sm-5 col-form-label">SSC</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="ssc" name="ssc" value="<?php echo htmlspecialchars($scheme->ssc); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ssc_category" class="col-sm-5 col-form-label">SSC Category</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="ssc_category" name="ssc_category">
                                            <option value="Imported" <?php if ($scheme->ssc_category == 'Imported') echo 'selected'; ?>>Imported</option>
                                            <option value="Local" <?php if ($scheme->ssc_category == 'Local') echo 'selected'; ?>>Local</option>
                                            <option value="Imported+Local" <?php if ($scheme->ssc_category == 'Imported+Local') echo 'selected'; ?>>Imported + Local</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transmitter and Receiver Details -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="transmitter_make" class="col-sm-5 col-form-label">Transmitter Make</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="transmitter_make" name="transmitter_make" value="<?php echo htmlspecialchars($scheme->transmitter_make); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="transmitter_model" class="col-sm-5 col-form-label">Transmitter Model</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="transmitter_model" name="transmitter_model" value="<?php echo htmlspecialchars($scheme->transmitter_model); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="transmitter_sr_no" class="col-sm-5 col-form-label">Transmitter Serial No</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="transmitter_sr_no" name="transmitter_sr_no" value="<?php echo htmlspecialchars($scheme->transmitter_sr_no); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="receiver_make" class="col-sm-5 col-form-label">Receiver Make</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="receiver_make" name="receiver_make" value="<?php echo htmlspecialchars($scheme->receiver_make); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="receiver_model" class="col-sm-5 col-form-label">Receiver Model</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="receiver_model" name="receiver_model" value="<?php echo htmlspecialchars($scheme->receiver_model); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="receiver_sr_no" class="col-sm-5 col-form-label">Receiver Serial No</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="receiver_sr_no" name="receiver_sr_no" value="<?php echo htmlspecialchars($scheme->receiver_sr_no); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="control_box_make" class="col-sm-5 col-form-label">Control Box Make</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="control_box_make" name="control_box_make" value="<?php echo htmlspecialchars($scheme->control_box_make); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="control_box_model" class="col-sm-5 col-form-label">Control Box Model</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="control_box_model" name="control_box_model" value="<?php echo htmlspecialchars($scheme->control_box_model); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="control_box_sr_no" class="col-sm-5 col-form-label">Control Box Serial No</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="control_box_sr_no" name="control_box_sr_no" value="<?php echo htmlspecialchars($scheme->control_box_sr_no); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="box border blue" style="padding: 5px;">
                                <div class="form-group row">
                                    <label for="scrapper_sr_no" class="col-sm-5 col-form-label">Scrapper Serial No</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="scrapper_sr_no" name="scrapper_sr_no" value="<?php echo htmlspecialchars($scheme->scrapper_sr_no); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="scrapper_blade_width" class="col-sm-5 col-form-label">Scrapper Blade Width</label>
                                    <div class="col-sm-7">
                                        <input required type="number" step="0.01" class="form-control" id="scrapper_blade_width" name="scrapper_blade_width" value="<?php echo htmlspecialchars($scheme->scrapper_blade_width); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="scrapper_weight" class="col-sm-5 col-form-label">Scrapper Weight</label>
                                    <div class="col-sm-7">
                                        <input required type="number" step="0.01" class="form-control" id="scrapper_weight" name="scrapper_weight" value="<?php echo htmlspecialchars($scheme->scrapper_weight); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="box border blue" style="padding: 5px;">

                                <div class="form-group row">
                                    <label for="fcr_approving_expert" class="col-sm-5 col-form-label">FCR Approving Expert</label>
                                    <div class="col-sm-7">
                                        <input required type="text" class="form-control" id="fcr_approving_expert" name="fcr_approving_expert" value="<?php echo htmlspecialchars($scheme->fcr_approving_expert); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="distribution_date" class="col-sm-5 col-form-label">Distribution Date</label>
                                    <div class="col-sm-7">
                                        <input required type="date" class="form-control" id="distribution_date" name="distribution_date" value="<?php echo htmlspecialchars($scheme->distribution_date); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Update Button -->
                <div style="text-align: center;">

                    <button class="btn btn-success">Update Scheme Data</button>

                    <div id="result_response"></div>
                </div>
            </div>
        </div>

        <script>
            function nic_dash1(t) {
                var donepatt = /^(\d{5})-(\d{7})-(\d{1})$/;
                var patt = /(\d{5}).*(\d{7}).*(\d{1})/;
                var str = t.value;
                if (!str.match(donepatt)) {
                    var result = str.match(patt);
                    if (result != null) {
                        t.value = result[1] + '-' + result[2] + '-' + result[3];
                    } else {
                        t.value = t.value.replace(/[^\d]/gi, '');
                    }
                }
            }
        </script>
</form>
<script>
    $('#data_form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "sft/update_b3_scheme_sft_data"); ?>', // URL to submit form data
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

    function calculate_water_losses_saving() {
        // Get the values of pre and post water losses
        let pre_water_losses = parseFloat($('#pre_water_losses').val());
        let post_water_losses = parseFloat($('#post_water_losses').val());
        if (post_water_losses) {
            // Check if values are valid numbers to avoid NaN issues
            // if (isNaN(pre_water_losses) || isNaN(post_water_losses)) {
            //     $('#saving_water_losses').val('0');
            //     $('#saving_water_losses').val("Invalid input");
            //     return;
            // }

            // Calculate saving water losses as a percentage
            let saving_water_losses = ((pre_water_losses - post_water_losses) * 100) / pre_water_losses;
            //alert(saving_water_losses);

            // Set the calculated value in the target input
            $('#saving_water_losses').html(saving_water_losses.toFixed(2));
        }
    }
    calculate_water_losses_saving();
</script>