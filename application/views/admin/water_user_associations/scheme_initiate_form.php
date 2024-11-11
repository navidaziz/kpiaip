<h4>Scheme Technical Detail</h4>
<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
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
                    <label for="technical_sanction_date" class="col-sm-6 col-form-label">Technical Sanction Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="technical_sanction_date" name="technical_sanction_date"
                            value="<?php echo $input->technical_sanction_date; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="work_order_date" class="col-sm-6 col-form-label">Work Order Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="work_order_date" name="work_order_date"
                            value="<?php echo $input->work_order_date; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="scheme_initiation_date" class="col-sm-6 col-form-label">Scheme Initiation Date</label>
                    <div class="col-sm-6">
                        <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date"
                            value="<?php echo $input->scheme_initiation_date; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="estimated_cost" class="col-sm-6 col-form-label">Estimated Cost</label>
                    <div class="col-sm-6">
                        <input onkeyup="convertNumberToWords('estimated_cost')" type="text" required id="estimated_cost"
                            name="estimated_cost" value="<?php echo $input->estimated_cost; ?>" class="form-control">

                    </div>
                    <div class="col-sm-12">
                        <p id="resultWords"></p>
                    </div>
                </div>
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
                        <?php
                        $options['Yes'] = 'Yes';
                        $options['No'] = 'No';
                        foreach ($options as $index => $value) {
                        ?>
                            <input <?php if ($input->verified_by_tpv == $index) { ?> checked <?php } ?> type="radio" required
                                id="verified_by_tpv" name="verified_by_tpv" value="<?php echo $value; ?>" />
                            <?php echo $value; ?><span style="margin-left: 10px;"></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="box border blue" id="messenger" style="padding: 5px;">
                <div class="form-group row">
                    <label for="funding_source" class="col-sm-6 col-form-label">Funding Source</label>
                    <div class="col-sm-6">
                        <?php
                        $options = array();
                        $options['KPIAIP'] = 'KPIAIP';
                        //$options['World Bank'] = 'World Bank';
                        //$options['Project Funds'] = 'Project Funds';

                        foreach ($options as $index => $value) {
                        ?>
                            <input <?php if ($input->funding_source == $index) { ?> checked <?php } ?> type="radio" required
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
                    <label for="cca" class="col-sm-6 col-form-label">CCA</label>
                    <div class="col-sm-6">
                        <input type="text" required id="cca" name="cca" value="<?php echo $input->cca; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gca" class="col-sm-6 col-form-label">GCA</label>
                    <div class="col-sm-6">
                        <input type="text" required id="gca" name="gca" value="<?php echo $input->gca; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pre" class="col-sm-6 col-form-label">Pre</label>
                    <div class="col-sm-6">
                        <input type="text" required id="pre" name="pre" value="<?php echo $input->pre; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pre_additional" class="col-sm-6 col-form-label">Pre Additional</label>
                    <div class="col-sm-6">
                        <input type="text" required id="pre_additional" name="pre_additional"
                            value="<?php echo $input->pre_additional; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="post" class="col-sm-6 col-form-label">Post</label>
                    <div class="col-sm-6">
                        <input type="text" required id="post" name="post" value="<?php echo $input->post; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="saving" class="col-sm-6 col-form-label">Saving</label>
                    <div class="col-sm-6">
                        <input type="text" required id="saving" name="saving" value="<?php echo $input->saving; ?>"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="box border blue" id="messenger" style="padding: 5px;">

                <div class="form-group row">
                    <label for="saving_utilisation_to_intensity" class="col-sm-6 col-form-label">Saving Utilisation To
                        Intensity</label>
                    <div class="col-sm-6">
                        <input type="text" required id="saving_utilisation_to_intensity"
                            name="saving_utilisation_to_intensity"
                            value="<?php echo $input->saving_utilisation_to_intensity; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="saving_utilization_to_change_in_cropping_pattern" class="col-sm-6 col-form-label">Saving
                        Utilization
                        To Change In Cropping Pattern</label>
                    <div class="col-sm-6">
                        <input type="text" required id="saving_utilization_to_change_in_cropping_pattern"
                            name="saving_utilization_to_change_in_cropping_pattern"
                            value="<?php echo $input->saving_utilization_to_change_in_cropping_pattern; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="water_productivity_for_wheat_and_maize" class="col-sm-6 col-form-label">Water
                        Productivity
                        For Wheat
                        And Maize</label>
                    <div class="col-sm-6">
                        <input type="text" required id="water_productivity_for_wheat_and_maize"
                            name="water_productivity_for_wheat_and_maize"
                            value="<?php echo $input->water_productivity_for_wheat_and_maize; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="any_increase_in_productivity_after_the_list_crop_cycle"
                        class="col-sm-6 col-form-label">Any
                        Increase
                        In Productivity After The List Crop Cycle</label>
                    <div class="col-sm-6">
                        <input type="text" required id="any_increase_in_productivity_after_the_list_crop_cycle"
                            name="any_increase_in_productivity_after_the_list_crop_cycle"
                            value="<?php echo $input->any_increase_in_productivity_after_the_list_crop_cycle; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total" class="col-sm-6 col-form-label">Total</label>
                    <div class="col-sm-6">
                        <input type="text" required id="total" name="total" value="<?php echo $input->total; ?>"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box border blue" id="messenger" style="padding: 5px;">
                <div class="form-group row">
                    <label for="lining" class="col-sm-6 col-form-label">Lining</label>
                    <div class="col-sm-6">
                        <input type="text" required id="lining" name="lining" value="<?php echo $input->lining; ?>"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lwh" class="col-sm-6 col-form-label">Lwh</label>
                    <div class="col-sm-6">
                        <input type="text" required id="lwh" name="lwh" value="<?php echo $input->lwh; ?>"
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
                            'None',
                            'PCC + Pipe Lining',
                            'Pipe',
                            'Pipe Lining',
                            'Plum Concrete',
                            'Precast Concrete Pipes (PCPS)',
                            'PVC',
                            'Plain Cement Concrete (PCC)',
                            'Water Storage Tank (WST)',
                            'WST (8.25x8.25x1.4) m',
                            'WST (8.5x8.5x1.4) m',
                            'WST (9x9x1.4) m',
                            'WST (10x10x1.4) m'
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
                        <input type="text" required id="others" name="others" value="<?php echo $input->others; ?>"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->scheme_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
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