<h4>Scheme Technical Detail</h4>
<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
    <?php if ($input->component_category_id == 12) { ?>
        <!-- For B3 -->

        <div class="row">
            <div class="col-md-12">
                <div class="box border blue messenger-box" style="padding: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="farmer_name">Farmer Name</label>
                                <input type="text" class="form-control" id="farmer_name" value="<?php echo $input->farmer_name; ?>" name="farmer_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="contact_no">Contact No</label>
                                <input type="text" class="form-control" id="contact_no" value="<?php echo $input->contact_no; ?>" name="contact_no">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="nic_no">NIC No</label>
                                <input type="text" class="form-control" id="nic_no" value="<?php echo $input->nic_no; ?>" name="nic_no">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box border blue messenger-box" style="padding: 5px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="government_share">Government Share</label>
                                <input type="number" step="0.01" class="form-control" id="government_share" value="<?php echo $input->government_share; ?>" name="government_share">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                <label for="farmer_share">Farmer Share</label>
                                <input type="number" step="0.01" class="form-control" id="farmer_share" value="<?php echo $input->farmer_share; ?>" name="farmer_share">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="ssc">SSC</label>
                        <input type="text" class="form-control" id="ssc" name="ssc" value="<?php echo $input->ssc; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="category">SSC Category</label>
                        <select class="form-control" id="ssc_category" name="ssc_category">
                            <option <?php if ($input->ssc_category == 'Imported') { ?> selected <?php } ?> value="Imported">Imported</option>
                            <option <?php if ($input->ssc_category == 'Local') { ?> selected <?php } ?> value="Local">Local</option>
                            <option <?php if ($input->ssc_category == 'Imported+Local') { ?> selected <?php } ?> value="Imported+Local">Imported + Local</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_make">Transmitter Make</label>
                        <input type="text" class="form-control" id="transmitter_make" name="transmitter_make" value="<?php echo $input->transmitter_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_model">Transmitter Model</label>
                        <input type="text" class="form-control" id="transmitter_model" name="transmitter_model" value="<?php echo $input->transmitter_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="transmitter_sr_no">Transmitter Serial No</label>
                        <input type="text" class="form-control" id="transmitter_sr_no" name="transmitter_sr_no" value="<?php echo $input->transmitter_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_make">Receiver Make</label>
                        <input type="text" class="form-control" id="receiver_make" name="receiver_make" value="<?php echo $input->receiver_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_model">Receiver Model</label>
                        <input type="text" class="form-control" id="receiver_model" name="receiver_model" value="<?php echo $input->receiver_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="receiver_sr_no">Receiver Serial No</label>
                        <input type="text" class="form-control" id="receiver_sr_no" name="receiver_sr_no" value="<?php echo $input->receiver_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_make">Control Box Make</label>
                        <input type="text" class="form-control" id="control_box_make" name="control_box_make" value="<?php echo $input->control_box_make; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_model">Control Box Model</label>
                        <input type="text" class="form-control" id="control_box_model" name="control_box_model" value="<?php echo $input->control_box_model; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="control_box_sr_no">Control Box Serial No</label>
                        <input type="text" class="form-control" id="control_box_sr_no" name="control_box_sr_no" value="<?php echo $input->control_box_sr_no; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_sr_no">Scrapper Serial No</label>
                        <input type="text" class="form-control" id="scrapper_sr_no" name="scrapper_sr_no" value="<?php echo $input->scrapper_sr_no; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_blade_width">Scrapper Blade Width</label>
                        <input type="number" step="0.01" class="form-control" id="scrapper_blade_width" name="scrapper_blade_width" value="<?php echo $input->scrapper_blade_width; ?>">
                    </div>

                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                        <label for="scrapper_weight">Scrapper Weight</label>
                        <input type="number" step="0.01" class="form-control" id="scrapper_weight" name="scrapper_weight" value="<?php echo $input->scrapper_weight; ?>">
                    </div>
                </div>
            </div>
        </div>



        <!-- For B3 End here -->
    <?php } else { ?>
        <div class="row">
            <div class="col-md-6">

                <div class="box border blue" id="messenger" style="padding: 5px;">
                    <div class="form-group row">
                        <label for="feasibility_date" class="col-sm-6 col-form-label">Feasibility Date</label>
                        <div class="col-sm-6">
                            <input type="date" required id="feasibility_date" name="feasibility_date"
                                value="<?php echo $input->feasibility_date; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="survey_date" class="col-sm-6 col-form-label">TOP Date</label>
                        <div class="col-sm-6">
                            <input type="date" required id="top_date" name="top_date"
                                value="<?php echo $input->top_date; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="survey_date" class="col-sm-6 col-form-label">Survey Date</label>
                        <div class="col-sm-6">
                            <input type="date" required id="survey_date" name="survey_date"
                                value="<?php echo $input->survey_date; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="design_date" class="col-sm-6 col-form-label">Design Date</label>
                        <div class="col-sm-6">
                            <input type="date" required id="design_date" name="design_date"
                                value="<?php echo $input->design_date; ?>" class="form-control">
                        </div>
                    </div>
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

                    <div class="form-group row">
                        <label for="verified_by_tpv" class="col-sm-6 col-form-label">Verified By TPV</label>
                        <div class="col-sm-6">
                            <input onclick="$('#tpv_date_div').hide(); $('#verification_by_tpv_date').prop('required', false)"
                                <?php if ($input->verified_by_tpv == 'No') { ?> checked <?php } ?>
                                type="radio" required id="verified_by_tpv_no" name="verified_by_tpv" value="No" />
                            No
                            <span style="margin-left: 10px;"></span>
                            <input onclick="$('#tpv_date_div').show(); $('#verification_by_tpv_date').prop('required', true)"
                                <?php if ($input->verified_by_tpv == 'Yes') { ?> checked <?php } ?>
                                type="radio" required id="verified_by_tpv_yes" name="verified_by_tpv" value="Yes" />
                            Yes
                        </div>
                    </div>

                    <div id="tpv_date_div" class="form-group row" style="display: <?php echo ($input->verified_by_tpv == 'Yes') ? 'block' : 'none'; ?>;">
                        <label for="verification_by_tpv_date" class="col-sm-6 col-form-label">Verification by TPV Date</label>
                        <div class="col-sm-6">
                            <input type="date" id="verification_by_tpv_date" name="verification_by_tpv_date"
                                value="<?php echo $input->verification_by_tpv_date; ?>" class="form-control"
                                <?php if ($input->verified_by_tpv == 'Yes') { ?> required <?php } ?>>
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
                    <div class="form-group row">
                        <label for="cca" class="col-sm-8 col-form-label">CCA

                            <strong style="color:green"> (acre)</strong><br />
                            <small>(Culturable Command Area)</small>
                        </label>
                        <div class="col-sm-4">
                            <input min="2" type="number" step="any" required id="cca" name="cca" value="<?php echo $input->cca; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gca" class="col-sm-8 col-form-label">GCA
                            <strong style="color:green"> (acre)</strong><br />
                            <small>(Gross Command Area)</small>
                        </label>
                        <div class="col-sm-4">
                            <input min="2" type="number" step="any" required id="gca" name="gca" value="<?php echo $input->gca; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cca" class="col-sm-8 col-form-label">ACCA
                            <strong style="color:green"> (acre)</strong><br />
                            <small>(Additional Culturable Command Area)</small>
                        </label>
                        <div class="col-sm-4">
                            <input min="0" type="number" step="any" required id="acca" name="acca" value="<?php echo $input->acca; ?>"
                                class="form-control">
                        </div>
                    </div>

                </div>

                <div class="box border blue" id="messenger" style="padding: 5px; ">

                    <input type="hidden" id="pre_additional" name="pre_additional"
                        value="0" class="form-control">

                    <div class="form-group row">
                        <label for="pre" class="col-sm-6 col-form-label">Pre Water Losses

                            <strong style="color: green;">(%)</strong>
                        </label>
                        <div class="col-sm-6">
                            <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="pre_water_losses" name="pre_water_losses" value="<?php echo $input->pre_water_losses; ?>"
                                class="form-control">
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="post" class="col-sm-6 col-form-label">Post Water Losses

                            <strong style="color: green;">(%)</strong></label>
                        <div class="col-sm-6">
                            <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="post_water_losses" name="post_water_losses" value="<?php echo $input->post_water_losses; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <script>
                        function calculate_water_losses_saving() {
                            // Get the values of pre and post water losses
                            let pre_water_losses = parseFloat($('#pre_water_losses').val());
                            let post_water_losses = parseFloat($('#post_water_losses').val());
                            if (post_water_losses) {
                                // Check if values are valid numbers to avoid NaN issues
                                if (isNaN(pre_water_losses) || isNaN(post_water_losses)) {
                                    $('#saving_water_losses').val('0');
                                    $('#saving_water_losses').val("Invalid input");
                                    return;
                                }

                                // Calculate saving water losses as a percentage
                                let saving_water_losses = ((pre_water_losses - post_water_losses) * 100) / pre_water_losses;

                                // Set the calculated value in the target input
                                $('#saving_water_losses').val(saving_water_losses.toFixed(2));
                            }
                        }
                    </script>
                    <div class="form-group row">
                        <label for="saving" class="col-sm-6 col-form-label">Saving Water Losses

                            <strong style="color: green;">(%)</strong></label>
                        <div class="col-sm-6">
                            <input readonly type="text" required id="saving_water_losses" name="saving_water_losses" value="<?php echo $input->saving_water_losses; ?>"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php if ($input->component_category_id == 11) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="box border blue" id="messenger" style="padding: 5px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                    <label for="length" class="col-form-label">Length <strong style="color: green;">(m)</strong></label>
                                    <input type="number" step="any" required id="length" name="length" value="<?php echo $input->length; ?>"
                                        class="form-control" onkeyup="updateLWH()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-left: 0px; margin-right: 0px;" style="margin-left: 0px; margin-right: 0px;">
                                    <label for="width" class="col-form-label">Width <strong style="color: green;">(m)</strong></label>
                                    <input type="number" step="any" required id="width" name="width" value="<?php echo $input->width; ?>"
                                        class="form-control" onkeyup="updateLWH()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-left: 0px; margin-right: 0px;" style="margin-left: 0px; margin-right: 0px;">
                                    <label for="height" class="col-form-label">Height <strong style="color: green;">(m)</strong></label>
                                    <input type="number" step="any" required id="height" name="height" value="<?php echo $input->height; ?>"
                                        class="form-control" onkeyup="updateLWH()">
                                </div>
                            </div>
                            <div class="col-md-3" style="display: none;">
                                <div class="form-group" style="margin-left: 0px; margin-right: 0px;" style="margin-left: 0px; margin-right: 0px;">
                                    <label for="lwh" class="col-form-label">LWH</label>
                                    <input readonly type="text" required id="lwh" name="lwh" value="<?php echo $input->lwh; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                function updateLWH() {
                    // Get the values from the input fields
                    let length = document.getElementById('length').value;
                    let width = document.getElementById('width').value;
                    let height = document.getElementById('height').value;

                    // Concatenate values into "length X width X height" format
                    let lwh = `${length} X ${width} X ${height}`;

                    // Set the result in the LWH field
                    document.getElementById('lwh').value = lwh;
                }
            </script>

        <?php } ?>
        <?php if ($input->component_category_id <= 9) { ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="box border blue" id="messenger" style="padding: 5px; min-height:258px">
                        <div class="form-group row">
                            <label for="total" class="col-sm-6 col-form-label">Total Lenght <strong style="color:green">(m)</strong></label>
                            <div class="col-sm-6">
                                <input type="number" step="any" required id="total_lenght" name="total_lenght" value="<?php echo $input->total_lenght; ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lining" class="col-sm-6 col-form-label">Lining Length <strong style="color:green">(m)</strong></label>
                            <div class="col-sm-6">
                                <input type="text" required id="lining_length" name="lining_length" value="<?php echo $input->lining_length; ?>"
                                    class="form-control">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="type_of_lining" class="col-sm-4 col-form-label">Type Of Lining</label>
                            <div class="col-sm-8">
                                <?php

                                $liningTypes = [
                                    'Brick Lining',
                                    'Bricks',
                                    'Bricks Lining',
                                    'HDPE Pipe',
                                    'HDPE Pipe 4" Dia',
                                    'HDPE Pipe & PCC',
                                    'HDPE Pipe PN8',
                                    'HDPE Pipe PN8 110mm',
                                    'HDPE Pipe PN8 90mm',
                                    'HDPE PN8 Pipe 90mm',
                                    'MS Pipe',
                                    'PCC + Pipe Lining',
                                    'Pipe',
                                    'Pipe Lining',
                                    'Plum Concrete',
                                    'Precast Concrete Pipes (PCPS)',
                                    'Pre Cast Parabolic Segment PCPS',
                                    'PVC',
                                    'Plain Cement Concrete (PCC)',
                                    'Water Storage Tank (WST)',
                                    'WST (8.25x8.25x1.4) m',
                                    'WST (8.5x8.5x1.4) m',
                                    'WST (9x9x1.4) m',
                                    'WST (10x10x1.4) m',
                                    'Others',
                                ];

                                ?>
                                <select required class="form-control" id="type_of_lining" name="type_of_lining">
                                    <option value="">Select Water Source</option>
                                    <?php foreach ($liningTypes as $index => $value) { ?>
                                        <option <?php if ($input->type_of_lining == $value) { ?> selected <?php } ?>
                                            value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>


                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="lining" class="col-sm-6 col-form-label">Design Discharge <strong style="color:green">(cusec)</strong></label>
                            <div class="col-sm-6">
                                <input step="any" placeholder="0.000" type="number" step="any" required id="design_discharge" name="design_discharge" value="<?php echo $input->design_discharge; ?>"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box border blue" id="messenger" style="padding: 5px;">

                        <div class="form-group row">
                            <label for="nacca_pannel" class="col-sm-6 col-form-label">Nacca Pannel</label>
                            <div class="col-sm-6">
                                <input type="text" required id="nacca_pannel" name="nacca_pannel"
                                    value="<?php echo $input->nacca_pannel; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="culvert" class="col-sm-6 col-form-label">Culvert</label>
                            <div class="col-sm-6">
                                <input type="text" required id="culvert" name="culvert" value="<?php echo $input->culvert; ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="risers_pipe" class="col-sm-6 col-form-label">Risers Pipe</label>
                            <div class="col-sm-6">
                                <input type="text" required id="risers_pipe" name="risers_pipe"
                                    value="<?php echo $input->risers_pipe; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="risers_pond" class="col-sm-6 col-form-label">Risers Pond</label>
                            <div class="col-sm-6">
                                <input type="text" required id="risers_pond" name="risers_pond"
                                    value="<?php echo $input->risers_pond; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="others" class="col-sm-6 col-form-label">Others</label>
                            <div class="col-sm-6">
                                <input type="text" id="others" name="others" value="<?php echo $input->others; ?>"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    <?php } ?>

    <div style="border: 1px solid #CCCCCC; padding:5px; border-radius: 5px; margin-bottom:10px">
        <strong><span style="color: red;">Scheme is New or Ongoing? </span>
            <input required onclick="$('#ongoing_scheme').hide(); $('.ongoing').prop('required', false)" type="radio" name="scheme_status" value="Initiated"> New
            <span style="margin-left: 15px;"></span>
            <input required onclick="$('#ongoing_scheme').show(); $('.ongoing').prop('required', true)" type="radio" name="scheme_status" value="Ongoing"> Ongoing
        </strong>
    </div>

    <div id="ongoing_scheme" style="display: none;">
        <div class="row">
            <div class="col-md-12">
                <div class="box border blue" id="messenger" style="padding: 15px;">
                    <div class="form-group row">
                        <!-- Approved Cost -->
                        <div class="col-md-3">
                            <label for="approved_cost" class="col-form-label">Approved / Saction Cost</label>
                            <input type="text" id="approved_cost" name="approved_cost"
                                value="<?php if ($input->approved_cost) {
                                            echo $input->approved_cost;
                                        } ?>" class="form-control ongoing" placeholder="Enter approved cost">
                        </div>

                        <!-- Technical Sanction Date -->
                        <div class="col-md-3">
                            <label for="technical_sanction_date" class="col-form-label">Technical Sanction Date</label>
                            <input type="date" id="technical_sanction_date" name="technical_sanction_date"
                                value="<?php echo $input->technical_sanction_date; ?>" class="form-control ongoing">
                        </div>

                        <!-- Work Order Date -->
                        <div class="col-md-3">
                            <label for="work_order_date" class="col-form-label">Work Order Date</label>
                            <input type="date" id="work_order_date" name="work_order_date"
                                value="<?php echo $input->work_order_date; ?>" class="form-control ongoing">
                        </div>

                        <!-- Scheme Initiation Date -->
                        <div class="col-md-3">
                            <label for="scheme_initiation_date" class="col-form-label">Scheme Initiation Date</label>
                            <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date"
                                value="<?php echo $input->scheme_initiation_date; ?>" class="form-control ongoing">
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <div class="form-group row text-center mt-3">
        <div id="result_response"></div>
        <?php if ($input->scheme_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Scheme Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-danger">Update Scheme Data</button>
        <?php } ?>
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