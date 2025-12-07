<form id="schemes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="scheme_id" value="<?php echo $input->scheme_id; ?>" />
    <div class="form-group row">
        <label for="project_id" class="col-sm-4 col-form-label">Project Id</label>
        <div class="col-sm-8">
            <input type="text" required id="project_id" name="project_id" value="<?php echo $input->project_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="financial_year_id" class="col-sm-4 col-form-label">Financial Year Id</label>
        <div class="col-sm-8">
            <input type="text" required id="financial_year_id" name="financial_year_id" value="<?php echo $input->financial_year_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="water_user_association_id" class="col-sm-4 col-form-label">Water User Association Id</label>
        <div class="col-sm-8">
            <input type="text" required id="water_user_association_id" name="water_user_association_id" value="<?php echo $input->water_user_association_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="component_category_id" class="col-sm-4 col-form-label">Component Category Id</label>
        <div class="col-sm-8">
            <input type="text" required id="component_category_id" name="component_category_id" value="<?php echo $input->component_category_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="district_id" class="col-sm-4 col-form-label">District Id</label>
        <div class="col-sm-8">
            <input type="text" required id="district_id" name="district_id" value="<?php echo $input->district_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="tehsil" class="col-sm-4 col-form-label">Tehsil</label>
        <div class="col-sm-8">
            <input type="text" required id="tehsil" name="tehsil" value="<?php echo $input->tehsil; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="uc" class="col-sm-4 col-form-label">Uc</label>
        <div class="col-sm-8">
            <input type="text" required id="uc" name="uc" value="<?php echo $input->uc; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="villege" class="col-sm-4 col-form-label">Villege</label>
        <div class="col-sm-8">
            <input type="text" required id="villege" name="villege" value="<?php echo $input->villege; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="na" class="col-sm-4 col-form-label">Na</label>
        <div class="col-sm-8">
            <input type="text" required id="na" name="na" value="<?php echo $input->na; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="pk" class="col-sm-4 col-form-label">Pk</label>
        <div class="col-sm-8">
            <input type="text" required id="pk" name="pk" value="<?php echo $input->pk; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="scheme_code" class="col-sm-4 col-form-label">Scheme Code</label>
        <div class="col-sm-8">
            <input type="text" required id="scheme_code" name="scheme_code" value="<?php echo $input->scheme_code; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="scheme_name" class="col-sm-4 col-form-label">Scheme Name</label>
        <div class="col-sm-8">
            <input type="text" required id="scheme_name" name="scheme_name" value="<?php echo $input->scheme_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="latitude" class="col-sm-4 col-form-label">Latitude</label>
        <div class="col-sm-8">
            <input type="text" required id="latitude" name="latitude" value="<?php echo $input->latitude; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="longitude" class="col-sm-4 col-form-label">Longitude</label>
        <div class="col-sm-8">
            <input type="text" required id="longitude" name="longitude" value="<?php echo $input->longitude; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="beneficiaries" class="col-sm-4 col-form-label">Beneficiaries</label>
        <div class="col-sm-8">
            <input type="text" required id="beneficiaries" name="beneficiaries" value="<?php echo $input->beneficiaries; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="male_beneficiaries" class="col-sm-4 col-form-label">Male Beneficiaries</label>
        <div class="col-sm-8">
            <input type="text" required id="male_beneficiaries" name="male_beneficiaries" value="<?php echo $input->male_beneficiaries; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="female_beneficiaries" class="col-sm-4 col-form-label">Female Beneficiaries</label>
        <div class="col-sm-8">
            <input type="text" required id="female_beneficiaries" name="female_beneficiaries" value="<?php echo $input->female_beneficiaries; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="registration_date" class="col-sm-4 col-form-label">Registration Date</label>
        <div class="col-sm-8">
            <input type="date" required id="registration_date" name="registration_date" value="<?php echo $input->registration_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="top_date" class="col-sm-4 col-form-label">Top Date</label>
        <div class="col-sm-8">
            <input type="date" required id="top_date" name="top_date" value="<?php echo $input->top_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="survey_date" class="col-sm-4 col-form-label">Survey Date</label>
        <div class="col-sm-8">
            <input type="date" required id="survey_date" name="survey_date" value="<?php echo $input->survey_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="design_date" class="col-sm-4 col-form-label">Design Date</label>
        <div class="col-sm-8">
            <input type="date" required id="design_date" name="design_date" value="<?php echo $input->design_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="feasibility_date" class="col-sm-4 col-form-label">Feasibility Date</label>
        <div class="col-sm-8">
            <input type="date" required id="feasibility_date" name="feasibility_date" value="<?php echo $input->feasibility_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="work_order_date" class="col-sm-4 col-form-label">Work Order Date</label>
        <div class="col-sm-8">
            <input type="date" required id="work_order_date" name="work_order_date" value="<?php echo $input->work_order_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="scheme_initiation_date" class="col-sm-4 col-form-label">Scheme Initiation Date</label>
        <div class="col-sm-8">
            <input type="date" required id="scheme_initiation_date" name="scheme_initiation_date" value="<?php echo $input->scheme_initiation_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="estimated_cost" class="col-sm-4 col-form-label">Estimated Cost</label>
        <div class="col-sm-8">
            <input type="text" required id="estimated_cost" name="estimated_cost" value="<?php echo $input->estimated_cost; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="estimated_cost_date" class="col-sm-4 col-form-label">Estimated Cost Date</label>
        <div class="col-sm-8">
            <input type="date" required id="estimated_cost_date" name="estimated_cost_date" value="<?php echo $input->estimated_cost_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="approved_cost" class="col-sm-4 col-form-label">Approved Cost</label>
        <div class="col-sm-8">
            <input type="text" required id="approved_cost" name="approved_cost" value="<?php echo $input->approved_cost; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="approval_date" class="col-sm-4 col-form-label">Approval Date</label>
        <div class="col-sm-8">
            <input type="date" required id="approval_date" name="approval_date" value="<?php echo $input->approval_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="revised_cost" class="col-sm-4 col-form-label">Revised Cost</label>
        <div class="col-sm-8">
            <input type="text" required id="revised_cost" name="revised_cost" value="<?php echo $input->revised_cost; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="revised_cost_date" class="col-sm-4 col-form-label">Revised Cost Date</label>
        <div class="col-sm-8">
            <input type="date" required id="revised_cost_date" name="revised_cost_date" value="<?php echo $input->revised_cost_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sanctioned_cost" class="col-sm-4 col-form-label">Sanctioned Cost</label>
        <div class="col-sm-8">
            <input type="text" required id="sanctioned_cost" name="sanctioned_cost" value="<?php echo $input->sanctioned_cost; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="completion_cost" class="col-sm-4 col-form-label">Completion Cost</label>
        <div class="col-sm-8">
            <input type="text" required id="completion_cost" name="completion_cost" value="<?php echo $input->completion_cost; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="technical_sanction_date" class="col-sm-4 col-form-label">Technical Sanction Date</label>
        <div class="col-sm-8">
            <input type="date" required id="technical_sanction_date" name="technical_sanction_date" value="<?php echo $input->technical_sanction_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="completion_date" class="col-sm-4 col-form-label">Completion Date</label>
        <div class="col-sm-8">
            <input type="date" required id="completion_date" name="completion_date" value="<?php echo $input->completion_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="scheme_status" class="col-sm-4 col-form-label">Scheme Status</label>
        <div class="col-sm-8">
            <input type="text" required id="scheme_status" name="scheme_status" value="<?php echo $input->scheme_status; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="remarks" class="col-sm-4 col-form-label">Remarks</label>
        <div class="col-sm-8">
            <input type="text" required id="remarks" name="remarks" value="<?php echo $input->remarks; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="verified_by_tpv" class="col-sm-4 col-form-label">Verified By Tpv</label>
        <div class="col-sm-8">
            <input type="text" required id="verified_by_tpv" name="verified_by_tpv" value="<?php echo $input->verified_by_tpv; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="verification_by_tpv_date" class="col-sm-4 col-form-label">Verification By Tpv Date</label>
        <div class="col-sm-8">
            <input type="date" required id="verification_by_tpv_date" name="verification_by_tpv_date" value="<?php echo $input->verification_by_tpv_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="funding_source" class="col-sm-4 col-form-label">Funding Source</label>
        <div class="col-sm-8">
            <input type="text" required id="funding_source" name="funding_source" value="<?php echo $input->funding_source; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="water_source" class="col-sm-4 col-form-label">Water Source</label>
        <div class="col-sm-8">
            <input type="text" required id="water_source" name="water_source" value="<?php echo $input->water_source; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="cca" class="col-sm-4 col-form-label">Cca</label>
        <div class="col-sm-8">
            <input type="text" required id="cca" name="cca" value="<?php echo $input->cca; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="acca" class="col-sm-4 col-form-label">Acca</label>
        <div class="col-sm-8">
            <input type="text" required id="acca" name="acca" value="<?php echo $input->acca; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="gca" class="col-sm-4 col-form-label">Gca</label>
        <div class="col-sm-8">
            <input type="text" required id="gca" name="gca" value="<?php echo $input->gca; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="pre_water_losses" class="col-sm-4 col-form-label">Pre Water Losses</label>
        <div class="col-sm-8">
            <input type="text" required id="pre_water_losses" name="pre_water_losses" value="<?php echo $input->pre_water_losses; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="pre_additional" class="col-sm-4 col-form-label">Pre Additional</label>
        <div class="col-sm-8">
            <input type="text" required id="pre_additional" name="pre_additional" value="<?php echo $input->pre_additional; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="post_water_losses" class="col-sm-4 col-form-label">Post Water Losses</label>
        <div class="col-sm-8">
            <input type="text" required id="post_water_losses" name="post_water_losses" value="<?php echo $input->post_water_losses; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="saving_water_losses" class="col-sm-4 col-form-label">Saving Water Losses</label>
        <div class="col-sm-8">
            <input type="text" required id="saving_water_losses" name="saving_water_losses" value="<?php echo $input->saving_water_losses; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="saving_utilisation_to_intensity" class="col-sm-4 col-form-label">Saving Utilisation To Intensity</label>
        <div class="col-sm-8">
            <input type="text" required id="saving_utilisation_to_intensity" name="saving_utilisation_to_intensity" value="<?php echo $input->saving_utilisation_to_intensity; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="saving_utilization_to_change_in_cropping_pattern" class="col-sm-4 col-form-label">Saving Utilization To Change In Cropping Pattern</label>
        <div class="col-sm-8">
            <input type="text" required id="saving_utilization_to_change_in_cropping_pattern" name="saving_utilization_to_change_in_cropping_pattern" value="<?php echo $input->saving_utilization_to_change_in_cropping_pattern; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="water_productivity_for_wheat_and_maize" class="col-sm-4 col-form-label">Water Productivity For Wheat And Maize</label>
        <div class="col-sm-8">
            <input type="text" required id="water_productivity_for_wheat_and_maize" name="water_productivity_for_wheat_and_maize" value="<?php echo $input->water_productivity_for_wheat_and_maize; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="any_increase_in_productivity_after_the_list_crop_cycle" class="col-sm-4 col-form-label">Any Increase In Productivity After The List Crop Cycle</label>
        <div class="col-sm-8">
            <input type="text" required id="any_increase_in_productivity_after_the_list_crop_cycle" name="any_increase_in_productivity_after_the_list_crop_cycle" value="<?php echo $input->any_increase_in_productivity_after_the_list_crop_cycle; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="total_lenght" class="col-sm-4 col-form-label">Total Lenght</label>
        <div class="col-sm-8">
            <input type="text" required id="total_lenght" name="total_lenght" value="<?php echo $input->total_lenght; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="lining_length" class="col-sm-4 col-form-label">Lining Length</label>
        <div class="col-sm-8">
            <input type="text" required id="lining_length" name="lining_length" value="<?php echo $input->lining_length; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="lwh" class="col-sm-4 col-form-label">Lwh</label>
        <div class="col-sm-8">
            <input type="text" required id="lwh" name="lwh" value="<?php echo $input->lwh; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="length" class="col-sm-4 col-form-label">Length</label>
        <div class="col-sm-8">
            <input type="text" required id="length" name="length" value="<?php echo $input->length; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="width" class="col-sm-4 col-form-label">Width</label>
        <div class="col-sm-8">
            <input type="text" required id="width" name="width" value="<?php echo $input->width; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="height" class="col-sm-4 col-form-label">Height</label>
        <div class="col-sm-8">
            <input type="text" required id="height" name="height" value="<?php echo $input->height; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="type_of_lining" class="col-sm-4 col-form-label">Type Of Lining</label>
        <div class="col-sm-8">
            <input type="text" required id="type_of_lining" name="type_of_lining" value="<?php echo $input->type_of_lining; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="nacca_pannel" class="col-sm-4 col-form-label">Nacca Pannel</label>
        <div class="col-sm-8">
            <input type="text" required id="nacca_pannel" name="nacca_pannel" value="<?php echo $input->nacca_pannel; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="culvert" class="col-sm-4 col-form-label">Culvert</label>
        <div class="col-sm-8">
            <input type="text" required id="culvert" name="culvert" value="<?php echo $input->culvert; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="risers_pipe" class="col-sm-4 col-form-label">Risers Pipe</label>
        <div class="col-sm-8">
            <input type="text" required id="risers_pipe" name="risers_pipe" value="<?php echo $input->risers_pipe; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="risers_pond" class="col-sm-4 col-form-label">Risers Pond</label>
        <div class="col-sm-8">
            <input type="text" required id="risers_pond" name="risers_pond" value="<?php echo $input->risers_pond; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="design_discharge" class="col-sm-4 col-form-label">Design Discharge</label>
        <div class="col-sm-8">
            <input type="text" required id="design_discharge" name="design_discharge" value="<?php echo $input->design_discharge; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="others" class="col-sm-4 col-form-label">Others</label>
        <div class="col-sm-8">
            <input type="text" required id="others" name="others" value="<?php echo $input->others; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="scheme_note" class="col-sm-4 col-form-label">Scheme Note</label>
        <div class="col-sm-8">
            <input type="number" required id="scheme_note" name="scheme_note" value="<?php echo $input->scheme_note; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="phy_completion" class="col-sm-4 col-form-label">Phy Completion</label>
        <div class="col-sm-8">
            <input type="text" required id="phy_completion" name="phy_completion" value="<?php echo $input->phy_completion; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="phy_completion_date" class="col-sm-4 col-form-label">Phy Completion Date</label>
        <div class="col-sm-8">
            <input type="date" required id="phy_completion_date" name="phy_completion_date" value="<?php echo $input->phy_completion_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="updated_by" class="col-sm-4 col-form-label">Updated By</label>
        <div class="col-sm-8">
            <input type="date" required id="updated_by" name="updated_by" value="<?php echo $input->updated_by; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sft_category" class="col-sm-4 col-form-label">Sft Category</label>
        <div class="col-sm-8">
            <input type="text" required id="sft_category" name="sft_category" value="<?php echo $input->sft_category; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sft_reviewed" class="col-sm-4 col-form-label">Sft Reviewed</label>
        <div class="col-sm-8">
            <input type="text" required id="sft_reviewed" name="sft_reviewed" value="<?php echo $input->sft_reviewed; ?>" class="form-control">
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