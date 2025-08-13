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
            <div class="row">
                <div class="col-md-3">
                    <div class="box border blue" style="padding: 5px;">
                        <div class="form-group row">
                            <label for="farmer_name" class="col-sm-6 col-form-label">Farmer Name</label>
                            <div class="col-sm-6">
                                <input required type="text" class="formControl" id="farmer_name" name="farmer_name" value="<?php echo htmlspecialchars($scheme->farmer_name); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_no" class="col-sm-6 col-form-label">Contact No</label>
                            <div class="col-sm-6">
                                <input required type="text" class="formControl" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($scheme->contact_no); ?>" pattern="0[0-9]{10}" required title="Please enter an 11-digit mobile number starting with '0'" placeholder="03240000000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nic_no" class="col-sm-6 col-form-label">CNIC No.</label>
                            <div class="col-sm-6">
                                <input required type="text" class="formControl" id="nic_no" name="nic_no" value="<?php echo htmlspecialchars($scheme->nic_no); ?>" pattern="\d{5}-\d{7}-\d{1}" required onkeyup="nic_dash1(this)" placeholder="xxxxx-xxxxxxx-x">
                            </div>
                        </div>
                    </div>
                    <div class="box border blue" id="messenger" style="padding: 5px; ">

                        <div class="form-group row">
                            <label for="tehsil" class="col-sm-6 col-form-label">Tehsil</label>
                            <div class="col-sm-6">
                                <input type="text" required id="tehsil" name="tehsil" value="<?php echo $scheme->tehsil; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uc" class="col-sm-6 col-form-label">UC</label>
                            <div class="col-sm-6">
                                <input type="text" required id="uc" name="uc" value="<?php echo $scheme->uc; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="villege" class="col-sm-6 col-form-label">Villege</label>
                            <div class="col-sm-6">
                                <input type="text" required id="villege" name="villege" value="<?php echo $scheme->villege; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="na" class="col-sm-6 col-form-label">NA</label>
                            <div class="col-sm-6">
                                <input type="text" required id="na" name="na" value="<?php echo $scheme->na; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pk" class="col-sm-6 col-form-label">PK</label>
                            <div class="col-sm-6">
                                <input type="text" required id="pk" name="pk" value="<?php echo $scheme->pk; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="latitude" class="col-sm-6 col-form-label">Latitude</label>
                            <div class="col-sm-6">
                                <input type="text" required id="latitude" name="latitude" value="<?php echo $scheme->latitude; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longitude" class="col-sm-6 col-form-label">Longitude</label>
                            <div class="col-sm-6">
                                <input type="text" required id="longitude" name="longitude" value="<?php echo $scheme->longitude; ?>" class="formControl">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box border blue" id="messenger" style="padding: 5px; ">
                        <div class="form-group row">
                            <label for="registration_date" class="col-sm-6 col-form-label">Registration Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="registration_date" name="registration_date" value="<?php echo $scheme->registration_date; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="survey_date" class="col-sm-6 col-form-label">Survey Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="survey_date" name="survey_date" value="<?php echo $scheme->survey_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="design_referred_date" class="col-sm-6 col-form-label">Design Referred Date</label>
                            <div class="col-sm-6">
                                <input type="date" id="design_referred_date" name="design_referred_date" value="<?php echo htmlspecialchars($scheme->design_referred_date); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="design_referred_by" class="col-sm-6 col-form-label">Design Referred By</label>
                            <div class="col-sm-6">
                                <input type="text" id="design_referred_by" name="design_referred_by" value="<?php echo htmlspecialchars($scheme->design_referred_by); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="design_approved_by" class="col-sm-6 col-form-label">Design Approved By</label>
                            <div class="col-sm-6">
                                <input type="text" id="design_approved_by" name="design_approved_by" value="<?php echo htmlspecialchars($scheme->design_approved_by); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agreement_signed_date" class="col-sm-6 col-form-label">Agreement Signed Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="agreement_signed_date" name="agreement_signed_date" value="<?php echo $scheme->agreement_signed_date; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feasibility_checked_by" class="col-sm-6 col-form-label">Feasibility Checked By</label>
                            <div class="col-sm-6">
                                <input type="text" id="feasibility_checked_by" name="feasibility_checked_by" value="<?php echo htmlspecialchars($scheme->feasibility_checked_by); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feasibility_date" class="col-sm-6 col-form-label">Feasibility Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="feasibility_date" name="feasibility_date" value="<?php echo $scheme->feasibility_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="work_order_date" class="col-sm-6 col-form-label">Work Order Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="work_order_date" name="work_order_date" value="<?php echo $scheme->work_order_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scheme_initiation_date" class="col-sm-6 col-form-label">Scheme Initiation Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date" value="<?php echo $scheme->scheme_initiation_date; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="technical_sanction_date" class="col-sm-6 col-form-label">Technical Sanction Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="technical_sanction_date" name="technical_sanction_date" value="<?php echo $scheme->technical_sanction_date; ?>" class="formControl">
                            </div>
                        </div>








                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box border blue" id="messenger" style="padding: 5px; ">
                        <div class="form-group row">
                            <label for="estimated_cost" class="col-sm-6 col-form-label">Estimated Cost</label>
                            <div class="col-sm-6">
                                <input type="text" required id="estimated_cost" name="estimated_cost" value="<?php echo $scheme->estimated_cost; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="estimated_cost_date" class="col-sm-6 col-form-label">Estimated Cost Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="estimated_cost_date" name="estimated_cost_date" value="<?php echo $scheme->estimated_cost_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="approved_cost" class="col-sm-6 col-form-label">Approved Cost</label>
                            <div class="col-sm-6">
                                <input type="text" required id="approved_cost" name="approved_cost" value="<?php echo $scheme->approved_cost; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="approval_date" class="col-sm-6 col-form-label">Approval Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="approval_date" name="approval_date" value="<?php echo $scheme->approval_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="revised_cost" class="col-sm-6 col-form-label">Revised Cost</label>
                            <div class="col-sm-6">
                                <input type="text" min="0" required id="revised_cost" name="revised_cost" value="<?php echo $scheme->revised_cost; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="revised_cost_date" class="col-sm-6 col-form-label">Revised Cost Date</label>
                            <div class="col-sm-6">
                                <input type="date" id="revised_cost_date" name="revised_cost_date" value="<?php echo $scheme->revised_cost_date; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="completion_cost" class="col-sm-6 col-form-label">Completion Cost</label>
                            <div class="col-sm-6">
                                <input type="text" required id="completion_cost" name="completion_cost" value="<?php echo $scheme->completion_cost; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="completion_date" class="col-sm-6 col-form-label">Completion Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="completion_date" name="completion_date" value="<?php echo $scheme->completion_date; ?>" class="formControl">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">


                    <div class="box border blue" id="messenger" style="padding: 5px; ">
                        <div class="form-group row" style="display:none">
                            <label for="funding_source" class="col-sm-6 col-form-label">Funding Source</label>
                            <div class="col-sm-6">
                                <?php
                                $options = array();
                                $options['KPIAIP'] = 'KPIAIP';
                                //$options['World Bank'] = 'World Bank';
                                //$options['Project Funds'] = 'Project Funds';

                                foreach ($options as $index => $value) {
                                ?>
                                    <input <?php if ($scheme->funding_source == $index or 1 == 1) { ?> checked <?php } ?> type="radio" required
                                        id="funding_source" name="funding_source" value="<?php echo $value; ?>" />
                                    <?php echo $value; ?><span style="margin-left: 10px;"></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="water_source" class="col-sm-4 col-form-label">Water Source</label>
                            <div class="col-sm-8">
                                <?php
                                $options = [
                                    'Mangal Stream',
                                    'Beer Katha',
                                    'Bore Well',
                                    'Spring',
                                    'Spring/Bore Well',
                                    'Stream',
                                    'Water Storage Tank (WST)',
                                    'Stream (Lift Pump)',
                                    'Solar Tube Well',
                                    'Tube Well',
                                    'Tube Well (TW)',
                                    'Civil Canal',
                                    'Canal',
                                    'Tube Well/Watercourse (TW/WC)',
                                    'Lift Irrigation (L/Irrigation)',
                                    'Water Storage Tank/Watercourse (WST/WC)',
                                    'Dug Well',
                                    'Pressure Pump',
                                    'Natural Spring',
                                    'Water Tank',
                                    'Bama Lift Canal',
                                    'Tube Well + Canal',
                                    'River',
                                    'Others'
                                ];
                                ?>
                                <select required class="formControl" id="water_source" name="water_source">
                                    <option value="">Select Water Source</option>
                                    <?php foreach ($options as $index => $value) { ?>
                                        <option <?php if ($scheme->water_source == $value) { ?> selected <?php } ?>
                                            value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>


                            </div>
                        </div>


                    </div>

                    <div class="box border blue" style="padding: 5px;">
                        <div class="form-group row">
                            <label for="government_share" class="col-sm-6 col-form-label">Government Share</label>
                            <div class="col-sm-6">
                                <input required type="number" step="0.01" id="government_share" name="government_share" value="<?php echo htmlspecialchars($scheme->government_share); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="farmer_share" class="col-sm-6 col-form-label">Farmer Share</label>
                            <div class="col-sm-6">
                                <input required type="number" step="0.01" id="farmer_share" name="farmer_share" value="<?php echo htmlspecialchars($scheme->farmer_share); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="per_acre_cost" class="col-sm-6 col-form-label">Per Acre Cost</label>
                            <div class="col-sm-6">
                                <input type="number" step="0.01" id="per_acre_cost" name="per_acre_cost" value="<?php echo htmlspecialchars($scheme->per_acre_cost); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ssc" class="col-sm-6 col-form-label">SSC</label>
                            <div class="col-sm-6">
                                <input required type="text" class="formControl" id="ssc" name="ssc" value="<?php echo htmlspecialchars($scheme->ssc); ?>">
                            </div>
                        </div>

                    </div>

                    <div class="box border blue" id="messenger" style="padding: 5px; ">

                        <div class="form-group row">
                            <label for="scheme_area" class="col-sm-6 col-form-label">Scheme Area</label>
                            <div class="col-sm-6">
                                <input type="text" id="scheme_area" name="scheme_area" value="<?php echo htmlspecialchars($scheme->scheme_area); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="crop" class="col-sm-6 col-form-label">Crop</label>
                            <div class="col-sm-6">
                                <input type="text" id="crop" name="crop" value="<?php echo htmlspecialchars($scheme->crop); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="crop_category" class="col-sm-6 col-form-label">Crop Category</label>
                            <div class="col-sm-6">
                                <input type="text" id="crop_category" name="crop_category" value="<?php echo htmlspecialchars($scheme->crop_category); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="system_type" class="col-sm-6 col-form-label">System Type</label>
                            <div class="col-sm-6">
                                <input type="text" id="system_type" name="system_type" value="<?php echo htmlspecialchars($scheme->system_type); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="soil_type" class="col-sm-6 col-form-label">Soil Type</label>
                            <div class="col-sm-6">
                                <input type="text" id="soil_type" name="soil_type" value="<?php echo htmlspecialchars($scheme->soil_type); ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="power_source" class="col-sm-6 col-form-label">Power Source</label>
                            <div class="col-sm-6">
                                <input type="text" id="power_source" name="power_source" value="<?php echo htmlspecialchars($scheme->power_source); ?>" class="formControl">
                            </div>
                        </div>




                    </div>
                    <?php if ($scheme->funding_source) {
                        $funding_source = $scheme->funding_source;
                    } else {
                        $funding_source = 'KPIAIP';
                    } ?>
                    <input type="hidden" required id="funding_source" name="funding_source" value="<?php echo $funding_source; ?>" class="formControl">




                </div>
            </div>
            <!-- Form Section -->
            <div class="row">



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
            url: '<?php echo site_url(ADMIN_DIR . "sft/update_b1_scheme_sft_data"); ?>', // URL to submit form data
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