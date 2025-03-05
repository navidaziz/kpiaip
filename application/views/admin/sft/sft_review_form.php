<style>
    .formControl {
        width: 100%;
    }

    .col-form-label {
        font-size: 12px;
    }
</style>
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


        <div class="form-group row">
            <label for="water_source" class="col-sm-6 col-form-label">Water Source</label>
            <div class="col-sm-6">
                <input type="text" required id="water_source" name="water_source" value="<?php echo $scheme->water_source; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="cca" class="col-sm-6 col-form-label">CCA</label>
            <div class="col-sm-6">
                <input type="text" required id="cca" name="cca" value="<?php echo $scheme->cca; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="acca" class="col-sm-6 col-form-label">ACCA</label>
            <div class="col-sm-6">
                <input type="text" required id="acca" name="acca" value="<?php echo $scheme->acca; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="gca" class="col-sm-6 col-form-label">GCA</label>
            <div class="col-sm-6">
                <input type="text" required id="gca" name="gca" value="<?php echo $scheme->gca; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="pre_water_losses" class="col-sm-6 col-form-label">Pre Water Losses</label>
            <div class="col-sm-6">
                <input type="text" required id="pre_water_losses" name="pre_water_losses" value="<?php echo $scheme->pre_water_losses; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="pre_additional" class="col-sm-6 col-form-label">Pre Additional</label>
            <div class="col-sm-6">
                <input type="text" required id="pre_additional" name="pre_additional" value="<?php echo $scheme->pre_additional; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="post_water_losses" class="col-sm-6 col-form-label">Post Water Losses</label>
            <div class="col-sm-6">
                <input type="text" required id="post_water_losses" name="post_water_losses" value="<?php echo $scheme->post_water_losses; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="saving_water_losses" class="col-sm-6 col-form-label">Saving Water Losses</label>
            <div class="col-sm-6">
                <input type="text" required id="saving_water_losses" name="saving_water_losses" value="<?php echo $scheme->saving_water_losses; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="total_lenght" class="col-sm-6 col-form-label">Total Lenght</label>
            <div class="col-sm-6">
                <input type="text" required id="total_lenght" name="total_lenght" value="<?php echo $scheme->total_lenght; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="lining_length" class="col-sm-6 col-form-label">Lining Length</label>
            <div class="col-sm-6">
                <input type="text" required id="lining_length" name="lining_length" value="<?php echo $scheme->lining_length; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="lwh" class="col-sm-6 col-form-label">Lwh</label>
            <div class="col-sm-6">
                <input type="text" required id="lwh" name="lwh" value="<?php echo $scheme->lwh; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="length" class="col-sm-6 col-form-label">Length</label>
            <div class="col-sm-6">
                <input type="text" required id="length" name="length" value="<?php echo $scheme->length; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="width" class="col-sm-6 col-form-label">Width</label>
            <div class="col-sm-6">
                <input type="text" required id="width" name="width" value="<?php echo $scheme->width; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="height" class="col-sm-6 col-form-label">Height</label>
            <div class="col-sm-6">
                <input type="text" required id="height" name="height" value="<?php echo $scheme->height; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="type_of_lining" class="col-sm-6 col-form-label">Type Of Lining</label>
            <div class="col-sm-6">
                <input type="text" required id="type_of_lining" name="type_of_lining" value="<?php echo $scheme->type_of_lining; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="nacca_pannel" class="col-sm-6 col-form-label">Nacca Pannel</label>
            <div class="col-sm-6">
                <input type="text" required id="nacca_pannel" name="nacca_pannel" value="<?php echo $scheme->nacca_pannel; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="culvert" class="col-sm-6 col-form-label">Culvert</label>
            <div class="col-sm-6">
                <input type="text" required id="culvert" name="culvert" value="<?php echo $scheme->culvert; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="risers_pipe" class="col-sm-6 col-form-label">Risers Pipe</label>
            <div class="col-sm-6">
                <input type="text" required id="risers_pipe" name="risers_pipe" value="<?php echo $scheme->risers_pipe; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="risers_pond" class="col-sm-6 col-form-label">Risers Pond</label>
            <div class="col-sm-6">
                <input type="text" required id="risers_pond" name="risers_pond" value="<?php echo $scheme->risers_pond; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="design_discharge" class="col-sm-6 col-form-label">Design Discharge</label>
            <div class="col-sm-6">
                <input type="text" required id="design_discharge" name="design_discharge" value="<?php echo $scheme->design_discharge; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="others" class="col-sm-6 col-form-label">Others</label>
            <div class="col-sm-6">
                <input type="text" required id="others" name="others" value="<?php echo $scheme->others; ?>" class="form-control">
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



    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="remarks" class="col-sm-6 col-form-label">Remarks</label>
            <div class="col-sm-6">
                <input type="text" required id="remarks" name="remarks" value="<?php echo $scheme->remarks; ?>" class="form-control">
            </div>

        </div>
        <div class="form-group row">
            <label for="scheme_note" class="col-sm-6 col-form-label">Scheme Note</label>
            <div class="col-sm-6">
                <input type="number" required id="scheme_note" name="scheme_note" value="<?php echo $scheme->scheme_note; ?>" class="form-control">
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
</div>