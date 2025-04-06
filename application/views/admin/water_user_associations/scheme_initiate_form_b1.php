<h4>Scheme Technical Detail</h4>
<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />

    <div class="row">
        <div class="col-md-6">
            <div class="box border blue" style="padding: 5px;">
                <div class="form-group row">
                    <label for="farmer_name" class="col-sm-6 col-form-label">Farmer Name</label>
                    <div class="col-sm-6">
                        <input required type="text" class="form-control" id="farmer_name" name="farmer_name" value="<?php echo htmlspecialchars($input->farmer_name); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contact_no" class="col-sm-6 col-form-label">Contact No</label>
                    <div class="col-sm-6">
                        <input required type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($input->contact_no); ?>" pattern="0[0-9]{10}" required title="Please enter an 11-digit mobile number starting with '0'" placeholder="03240000000">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nic_no" class="col-sm-6 col-form-label">CNIC No.</label>
                    <div class="col-sm-6">
                        <input required type="text" class="form-control" id="nic_no" name="nic_no" value="<?php echo htmlspecialchars($input->nic_no); ?>" pattern="\d{5}-\d{7}-\d{1}" required onkeyup="nic_dash1(this)" placeholder="xxxxx-xxxxxxx-x">
                    </div>
                </div>
            </div>
            <div class="box border blue" id="messenger" style="padding: 5px; ">


                <div class="form-group row">
                    <label for="survey_date" class="col-sm-6 col-form-label">Survey Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="survey_date" name="survey_date" value="<?php echo $input->survey_date; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="design_referred_date" class="col-sm-6 col-form-label">Design Referred Date</label>
                    <div class="col-sm-6">
                        <input type="date" id="design_referred_date" name="design_referred_date" value="<?php echo htmlspecialchars($input->design_referred_date); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="desing_referred_by" class="col-sm-6 col-form-label">Design Referred By</label>
                    <div class="col-sm-6">
                        <input type="text" id="desing_referred_by" name="desing_referred_by" value="<?php echo htmlspecialchars($input->desing_referred_by); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="design_approved_by" class="col-sm-6 col-form-label">Design Approved By</label>
                    <div class="col-sm-6">
                        <input type="text" id="design_approved_by" name="design_approved_by" value="<?php echo htmlspecialchars($input->design_approved_by); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="feasibility_checked_by" class="col-sm-6 col-form-label">Feasibility Checked By</label>
                    <div class="col-sm-6">
                        <input type="text" id="feasibility_checked_by" name="feasibility_checked_by" value="<?php echo htmlspecialchars($input->feasibility_checked_by); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="feasibility_date" class="col-sm-6 col-form-label">Feasibility Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="feasibility_date" name="feasibility_date" value="<?php echo $input->feasibility_date; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="agreement_signed_date" class="col-sm-6 col-form-label">Agreement Signed Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="agreement_signed_date" name="agreement_signed_date" value="<?php echo $input->agreement_signed_date; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="work_order_date" class="col-sm-6 col-form-label">Work Order Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="work_order_date" name="work_order_date" value="<?php echo $input->work_order_date; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="scheme_initiation_date" class="col-sm-6 col-form-label">Scheme Initiation Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date" value="<?php echo $input->scheme_initiation_date; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="technical_sanction_date" class="col-sm-6 col-form-label">Technical Sanction Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="technical_sanction_date" name="technical_sanction_date" value="<?php echo $input->technical_sanction_date; ?>" class="form-control">
                    </div>
                </div>








            </div>


            <div class="box border blue" id="messenger" style="padding: 5px;">

                <div class="form-group row">
                    <label for="estimated_cost" class="col-sm-6 col-form-label">Estimated Cost</label>
                    <div class="col-sm-6">
                        <input min="1" onkeyup="convertNumberToWords('estimated_cost')" type="number" step="any" required id="estimated_cost"
                            name="estimated_cost" value="<?php if ($input->estimated_cost > 0) {
                                                                echo $input->estimated_cost;
                                                            } ?>" class="form-control" />

                    </div>
                </div>

                <div style="border-bottom: 1px solid lightgray; min-height:25px; margin-bottom:8px" id="resultWords"></div>

                <div class="form-group row">
                    <label for="estimated_cost_date" class="col-sm-6 col-form-label">Estimated Cost Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="estimated_cost_date" name="estimated_cost_date"
                            value="<?php echo $input->estimated_cost_date; ?>" class="form-control">
                    </div>
                </div>



            </div>
        </div>

        <div class="col-md-6">


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
                            <input <?php if ($input->funding_source == $index or 1 == 1) { ?> checked <?php } ?> type="radio" required
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
                        <select required class="form-control" id="water_source" name="water_source">
                            <option value="">Select Water Source</option>
                            <?php foreach ($options as $index => $value) { ?>
                                <option <?php if ($input->water_source == $value) { ?> selected <?php } ?>
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
                        <input required type="number" step="0.01" id="government_share" name="government_share" value="<?php echo htmlspecialchars($input->government_share); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="farmer_share" class="col-sm-6 col-form-label">Farmer Share</label>
                    <div class="col-sm-6">
                        <input required type="number" step="0.01" id="farmer_share" name="farmer_share" value="<?php echo htmlspecialchars($input->farmer_share); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="per_acre_cost" class="col-sm-6 col-form-label">Per Acre Cost</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" id="per_acre_cost" name="per_acre_cost" value="<?php echo htmlspecialchars($input->per_acre_cost); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ssc" class="col-sm-6 col-form-label">SSC</label>
                    <div class="col-sm-6">
                        <input required type="text" class="form-control" id="ssc" name="ssc" value="<?php echo htmlspecialchars($input->ssc); ?>">
                    </div>
                </div>

            </div>

            <div class="box border blue" id="messenger" style="padding: 5px; ">

                <div class="form-group row">
                    <label for="scheme_area" class="col-sm-6 col-form-label">Scheme Area</label>
                    <div class="col-sm-6">
                        <input type="text" id="scheme_area" name="scheme_area" value="<?php echo htmlspecialchars($input->scheme_area); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="crop" class="col-sm-6 col-form-label">Crop</label>
                    <div class="col-sm-6">
                        <input type="text" id="crop" name="crop" value="<?php echo htmlspecialchars($input->crop); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="crop_category" class="col-sm-6 col-form-label">Crop Category</label>
                    <div class="col-sm-6">
                        <input type="text" id="crop_category" name="crop_category" value="<?php echo htmlspecialchars($input->crop_category); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="system_type" class="col-sm-6 col-form-label">System Type</label>
                    <div class="col-sm-6">
                        <input type="text" id="system_type" name="system_type" value="<?php echo htmlspecialchars($input->system_type); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="soil_type" class="col-sm-6 col-form-label">Soil Type</label>
                    <div class="col-sm-6">
                        <input type="text" id="soil_type" name="soil_type" value="<?php echo htmlspecialchars($input->soil_type); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="power_source" class="col-sm-6 col-form-label">Power Source</label>
                    <div class="col-sm-6">
                        <input type="text" id="power_source" name="power_source" value="<?php echo htmlspecialchars($input->power_source); ?>" class="form-control">
                    </div>
                </div>




            </div>
            <?php if ($input->funding_source) {
                $funding_source = $input->funding_source;
            } else {
                $funding_source = 'KPIAIP';
            } ?>
            <input type="hidden" required id="funding_source" name="funding_source" value="<?php echo $funding_source; ?>" class="form-control">




        </div>

    </div>



    <input required type="hidden" name="scheme_status" value="Initiated">


    <div class="form-group row text-center mt-3">
        <div id="result_response"></div>

        <button type="submit" class="btn btn-danger">Initiate Scheme</button>

    </div>
</form>
</div>

<script>
    $('#schemes').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/initiate_scheme"); ?>', // URL to submit form data
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