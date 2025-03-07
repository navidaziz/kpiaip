<style>
    .formControl {
        width: 100%;
    }

    .col-form-label {
        font-size: 12px;
    }
</style>
<h1><?php echo $scheme->component_category_id; ?></h1>
<div class="row">
    <div class="col-md-3">


        <div class="form-group row">
            <label for="tehsil" class="col-sm-6 col-form-label">Tehsil</label>
            <div class="col-sm-6">
                <input type="text" required id="tehsil" name="tehsil" value="<?php echo $scheme->tehsil; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="uc" class="col-sm-6 col-form-label">UC</label>
            <div class="col-sm-6">
                <input type="text" required id="uc" name="uc" value="<?php echo $scheme->uc; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="villege" class="col-sm-6 col-form-label">Villege</label>
            <div class="col-sm-6">
                <input type="text" required id="villege" name="villege" value="<?php echo $scheme->villege; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="na" class="col-sm-6 col-form-label">NA</label>
            <div class="col-sm-6">
                <input type="text" required id="na" name="na" value="<?php echo $scheme->na; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="pk" class="col-sm-6 col-form-label">PK</label>
            <div class="col-sm-6">
                <input type="text" required id="pk" name="pk" value="<?php echo $scheme->pk; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="latitude" class="col-sm-6 col-form-label">Latitude</label>
            <div class="col-sm-6">
                <input type="text" required id="latitude" name="latitude" value="<?php echo $scheme->latitude; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="longitude" class="col-sm-6 col-form-label">Longitude</label>
            <div class="col-sm-6">
                <input type="text" required id="longitude" name="longitude" value="<?php echo $scheme->longitude; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="male_beneficiaries" class="col-sm-6 col-form-label">Male Beneficiaries</label>
            <div class="col-sm-6">
                <input type="text" required id="male_beneficiaries" name="male_beneficiaries" value="<?php echo $scheme->male_beneficiaries; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="female_beneficiaries" class="col-sm-6 col-form-label">Female Beneficiaries</label>
            <div class="col-sm-6">
                <input type="text" required id="female_beneficiaries" name="female_beneficiaries" value="<?php echo $scheme->female_beneficiaries; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group row">
            <label for="registration_date" class="col-sm-6 col-form-label">Registration Date</label>
            <div class="col-sm-6">
                <input type="date" required id="registration_date" name="registration_date" value="<?php echo $scheme->registration_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="top_date" class="col-sm-6 col-form-label">Top Date</label>
            <div class="col-sm-6">
                <input type="date" required id="top_date" name="top_date" value="<?php echo $scheme->top_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="survey_date" class="col-sm-6 col-form-label">Survey Date</label>
            <div class="col-sm-6">
                <input type="date" required id="survey_date" name="survey_date" value="<?php echo $scheme->survey_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="design_date" class="col-sm-6 col-form-label">Design Date</label>
            <div class="col-sm-6">
                <input type="date" required id="design_date" name="design_date" value="<?php echo $scheme->design_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="feasibility_date" class="col-sm-6 col-form-label">Feasibility Date</label>
            <div class="col-sm-6">
                <input type="date" required id="feasibility_date" name="feasibility_date" value="<?php echo $scheme->feasibility_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="work_order_date" class="col-sm-6 col-form-label">Work Order Date</label>
            <div class="col-sm-6">
                <input type="date" required id="work_order_date" name="work_order_date" value="<?php echo $scheme->work_order_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="scheme_initiation_date" class="col-sm-6 col-form-label">Scheme Initiation Date</label>
            <div class="col-sm-6">
                <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date" value="<?php echo $scheme->scheme_initiation_date; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="technical_sanction_date" class="col-sm-6 col-form-label">Technical Sanction Date</label>
            <div class="col-sm-6">
                <input type="date" required id="technical_sanction_date" name="technical_sanction_date" value="<?php echo $scheme->technical_sanction_date; ?>" class="form-control">
            </div>
        </div>



    </div>
    <div class="col-md-3">
        <div class="form-group row">
            <label for="estimated_cost" class="col-sm-6 col-form-label">Estimated Cost</label>
            <div class="col-sm-6">
                <input type="text" required id="estimated_cost" name="estimated_cost" value="<?php echo $scheme->estimated_cost; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="estimated_cost_date" class="col-sm-6 col-form-label">Estimated Cost Date</label>
            <div class="col-sm-6">
                <input type="date" required id="estimated_cost_date" name="estimated_cost_date" value="<?php echo $scheme->estimated_cost_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="approved_cost" class="col-sm-6 col-form-label">Approved Cost</label>
            <div class="col-sm-6">
                <input type="text" required id="approved_cost" name="approved_cost" value="<?php echo $scheme->approved_cost; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="approval_date" class="col-sm-6 col-form-label">Approval Date</label>
            <div class="col-sm-6">
                <input type="date" required id="approval_date" name="approval_date" value="<?php echo $scheme->approval_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="revised_cost" class="col-sm-6 col-form-label">Revised Cost</label>
            <div class="col-sm-6">
                <input type="text" required id="revised_cost" name="revised_cost" value="<?php echo $scheme->revised_cost; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="revised_cost_date" class="col-sm-6 col-form-label">Revised Cost Date</label>
            <div class="col-sm-6">
                <input type="date" required id="revised_cost_date" name="revised_cost_date" value="<?php echo $scheme->revised_cost_date; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="completion_cost" class="col-sm-6 col-form-label">Completion Cost</label>
            <div class="col-sm-6">
                <input type="text" required id="completion_cost" name="completion_cost" value="<?php echo $scheme->completion_cost; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="completion_date" class="col-sm-6 col-form-label">Completion Date</label>
            <div class="col-sm-6">
                <input type="date" required id="completion_date" name="completion_date" value="<?php echo $scheme->completion_date; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="phy_completion" class="col-sm-6 col-form-label">Phy Completion</label>
            <div class="col-sm-6">
                <input type="text" required id="phy_completion" name="phy_completion" value="<?php echo $scheme->phy_completion; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="phy_completion_date" class="col-sm-6 col-form-label">Phy Completion Date</label>
            <div class="col-sm-6">
                <input type="date" required id="phy_completion_date" name="phy_completion_date" value="<?php echo $scheme->phy_completion_date; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="verified_by_tpv" class="col-sm-6 col-form-label">Verified By TPV</label>
            <div class="col-sm-6">
                <input type="text" required id="verified_by_tpv" name="verified_by_tpv" value="<?php echo $scheme->verified_by_tpv; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="verification_by_tpv_date" class="col-sm-6 col-form-label">Verification By TPV Date</label>
            <div class="col-sm-6">
                <input type="date" required id="verification_by_tpv_date" name="verification_by_tpv_date" value="<?php echo $scheme->verification_by_tpv_date; ?>" class="form-control">
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
                    <select required class="form-control" id="water_source" name="water_source">
                        <option value="">Select Water Source</option>
                        <?php foreach ($options as $index => $value) { ?>
                            <option <?php if ($scheme->water_source == $value) { ?> selected <?php } ?>
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
                    <input min="2" type="number" step="any" required id="cca" name="cca" value="<?php echo $scheme->cca; ?>"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="gca" class="col-sm-8 col-form-label">GCA
                    <strong style="color:green"> (acre)</strong><br />
                    <small>(Gross Command Area)</small>
                </label>
                <div class="col-sm-4">
                    <input min="2" type="number" step="any" required id="gca" name="gca" value="<?php echo $scheme->gca; ?>"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="cca" class="col-sm-8 col-form-label">ACCA
                    <strong style="color:green"> (acre)</strong><br />
                    <small>(Additional Culturable Command Area)</small>
                </label>
                <div class="col-sm-4">
                    <input min="0" type="number" step="any" required id="acca" name="acca" value="<?php echo $scheme->acca; ?>"
                        class="form-control">
                </div>
            </div>

        </div>


        <?php if ($scheme->funding_source) {
            $funding_source = $scheme->funding_source;
        } else {
            $funding_source = 'KPIAIP';
        } ?>
        <input type="hidden" required id="funding_source" name="funding_source" value="<?php echo $funding_source; ?>" class="form-control">


        <div class="box border blue" id="messenger" style="padding: 5px; ">

            <input type="hidden" id="pre_additional" name="pre_additional"
                value="0" class="form-control">

            <div class="form-group row">
                <label for="pre" class="col-sm-6 col-form-label">Pre Water Losses

                    <strong style="color: green;">(%)</strong>
                </label>
                <div class="col-sm-6">
                    <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="pre_water_losses" name="pre_water_losses" value="<?php echo $scheme->pre_water_losses; ?>"
                        class="form-control">
                </div>
            </div>


            <div class="form-group row" style="display:none">
                <label for="pre_additional" class="col-sm-6 col-form-label">Pre Additional</label>
                <div class="col-sm-6">
                    <input type="text" id="pre_additional" name="pre_additional" value="<?php echo $scheme->pre_additional; ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="post" class="col-sm-6 col-form-label">Post Water Losses

                    <strong style="color: green;">(%)</strong></label>
                <div class="col-sm-6">
                    <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="post_water_losses" name="post_water_losses" value="<?php echo $scheme->post_water_losses; ?>"
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
                <label for="saving" class="col-sm-6 col-form-label">Water Saving

                    <strong style="color: green;">(%)</strong></label>
                <div class="col-sm-6">
                    <input readonly type="text" required id="saving_water_losses" name="saving_water_losses" value="<?php echo $scheme->saving_water_losses; ?>"
                        class="form-control">
                </div>
            </div>
        </div>



    </div>



    <script>
        $('#schemes').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "schemes/add_scheme"); ?>', // URL to submit form data
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
</div>
<?php if ($scheme->component_category_id == 11) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box border blue" id="messenger" style="padding: 5px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                            <label for="length" class="col-form-label">Length <strong style="color: green;">(m)</strong></label>
                            <input type="number" step="any" required id="length" name="length" value="<?php echo $scheme->length; ?>"
                                class="form-control" onkeyup="updateLWH()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                            <label for="width" class="col-form-label">Width <strong style="color: green;">(m)</strong></label>
                            <input type="number" step="any" required id="width" name="width" value="<?php echo $scheme->width; ?>"
                                class="form-control" onkeyup="updateLWH()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                            <label for="height" class="col-form-label">Height <strong style="color: green;">(m)</strong></label>
                            <input type="number" step="any" required id="height" name="height" value="<?php echo $scheme->height; ?>"
                                class="form-control" onkeyup="updateLWH()">
                        </div>
                    </div>
                    <div class="col-md-3" style="display: none;">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                            <label for="lwh" class="col-form-label">LWH</label>
                            <input readonly type="text" required id="lwh" name="lwh" value="<?php echo $scheme->lwh; ?>"
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
<?php if ($scheme->component_category_id <= 9) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box border blue" id="messenger" style="padding: 5px; min-height:258px">
                <div class="form-group row">
                    <label for="total" class="col-sm-6 col-form-label">Total Lenght <strong style="color:green">(m)</strong></label>
                    <div class="col-sm-6">
                        <input type="number" step="any" required id="total_lenght" name="total_lenght" value="<?php echo $scheme->total_lenght; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lining" class="col-sm-6 col-form-label">Lining Length <strong style="color:green">(m)</strong></label>
                    <div class="col-sm-6">
                        <input type="text" required id="lining_length" name="lining_length" value="<?php echo $scheme->lining_length; ?>"
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
                                <option <?php if ($scheme->type_of_lining == $value) { ?> selected <?php } ?>
                                    value="<?php echo $value; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>


                    </div>

                </div>

                <div class="form-group row">
                    <label for="lining" class="col-sm-6 col-form-label">Design Discharge <strong style="color:green">(cusec)</strong></label>
                    <div class="col-sm-6">
                        <input step="any" placeholder="0.000" type="number" step="any" required id="design_discharge" name="design_discharge" value="<?php echo $scheme->design_discharge; ?>"
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
                            value="<?php echo $scheme->nacca_pannel; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="culvert" class="col-sm-6 col-form-label">Culvert</label>
                    <div class="col-sm-6">
                        <input type="text" required id="culvert" name="culvert" value="<?php echo $scheme->culvert; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="risers_pipe" class="col-sm-6 col-form-label">Risers Pipe</label>
                    <div class="col-sm-6">
                        <input type="text" required id="risers_pipe" name="risers_pipe"
                            value="<?php echo $scheme->risers_pipe; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="risers_pond" class="col-sm-6 col-form-label">Risers Pond</label>
                    <div class="col-sm-6">
                        <input type="text" required id="risers_pond" name="risers_pond"
                            value="<?php echo $scheme->risers_pond; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="others" class="col-sm-6 col-form-label">Others</label>
                    <div class="col-sm-6">
                        <input type="text" id="others" name="others" value="<?php echo $scheme->others; ?>"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>