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
            <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                    <h4><strong>Approved Cost: <?php echo $input->approved_cost; ?> (PKR)</strong></h4>
                </div>
            </div>
            <div class="form-group row">

                <label for="estimated_cost" class="col-sm-6 col-form-label">Estimated Cost</label>
                <div class="col-sm-6">
                    <input min="1" max="<?php echo $input->approved_cost; ?>" onkeyup="convertNumberToWords('estimated_cost')" type="number" step="any" required id="estimated_cost"
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
                <label for="verified_by_tpv" class="col-sm-6 col-form-label">Reviewed By Consultant</label>
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
                        //let saving_water_losses = pre_water_losses - post_water_losses;
                        // Set the calculated value in the target input
                        $('#saving_water_losses').val(saving_water_losses.toFixed(2));
                    }
                }
            </script>
            <div class="form-group row">
                <label for="saving" class="col-sm-6 col-form-label"> Water Saving

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
                            <option value="">Select Lining Type</option>
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