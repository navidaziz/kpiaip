<style>
    .formControl {
        width: 100%;
    }

    .col-form-label {
        font-size: 10px;
    }
</style>
<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input type="hidden" class="form-control" id="scheme_id" name="scheme_id" value="<?php echo $scheme->scheme_id; ?>" required>
    <input type="hidden" class="form-control" id="water_user_association_id" name="water_user_association_id" value="<?php echo $scheme->water_user_association_id; ?>" required>
    <input type="hidden" class="form-control" id="component_category_id" name="component_category_id" value="<?php echo $scheme->component_category_id; ?>" required>

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <h5>Water Assosiation Detail</h5>
                    <div style="padding:5px; border:1px solid #54789B; border-radius:5px">
                        <div class="form-group row">
                            <label for="wua_name" class="col-sm-4 col-form-label label-required label-required">WUA Name</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="wua_name" name="wua_name" value="<?php echo $wua->wua_name; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file_number" class="col-sm-4 col-form-label label-required">File / REF No.</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="file_number" name="file_number" value="<?php echo $wua->file_number; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wua_registration_no" class="col-sm-4 col-form-label label-required">WUA REG. No</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="wua_registration_no" name="wua_registration_no" value="<?php echo $wua->wua_registration_no; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wua_registration_date" class="col-sm-4 col-form-label label-required">WUA REG. Date</label>
                            <div class="col-sm-8">
                                <input type="date" req uired id="wua_registration_date" name="wua_registration_date" value="<?php echo $wua->wua_registration_date; ?>" class="formControl">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h5>Location Detail</h5>
                    <div style="padding:5px; border:1px solid #54789B; border-radius:5px">

                        <div class="form-group row">
                            <label for="tehsil_name" class="col-sm-4 col-form-label label-required">Tehsil Name</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="tehsil_name" name="tehsil_name" value="<?php echo $wua->tehsil_name; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="union_council" class="col-sm-4 col-form-label label-required">UC/ VC</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="union_council" name="union_council" value="<?php echo $wua->union_council; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label label-required">Address</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="address" name="address" value="<?php echo $wua->address; ?>" class="formControl">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h5>Chairman Detail</h5>
                    <div style="padding:5px; border:1px solid #54789B; border-radius:5px">
                        <div class="form-group row">
                            <label for="cm_name" class="col-sm-4 col-form-label label-required">Name</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="cm_name" name="cm_name" value="<?php echo $wua->cm_name; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cm_father_name" class="col-sm-4 col-form-label label-required">Father Name</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="cm_father_name" name="cm_father_name" value="<?php echo $wua->cm_father_name; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cm_gender" class="col-sm-4 col-form-label label-required">Gender</label>
                            <div class="col-sm-8">
                                <?php $options = array("Male", "Female");
                                foreach ($options as $option) {
                                    $checked = "";
                                    if ($option == $wua->cm_gender) {
                                        $checked = "checked";
                                    }
                                ?>
                                    <span style="margin-left:5px"></span>
                                    <input <?php echo $checked ?> type="radio" req uired id="<?php echo $option; ?>" name="cm_gender" value="<?php echo $option; ?>" class="">
                                    <span style="margin-left:3px"></span> <?php echo $option;  ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cm_cnic" class="col-sm-4 col-form-label label-required">CNIC</label>
                            <div class="col-sm-8">
                                <input pattern="\d{5}-\d{7}-\d{1}" onkeyup="nic_dash1(this)" type="text" req uired id="cm_cnic" name="cm_cnic" value="<?php echo $wua->cm_cnic; ?>" class="formControl">
                            </div>
                            <script language="javascript">
                                function nic_dash1(t)

                                {
                                    var donepatt = /^(\d{5})\/(\d{7})\/(\d{1})$/;

                                    var patt = /(\d{5}).*(\d{7}).*(\d{1})/;

                                    var str = t.value;

                                    if (!str.match(donepatt))

                                    {
                                        result = str.match(patt);

                                        if (result != null)

                                        {
                                            t.value = t.value.replace(/[^\d]/gi, '');

                                            str = result[1] + '-' + result[2] + '-' + result[3];

                                            t.value = str;

                                        } else {

                                            if (t.value.match(/[^\d]/gi))

                                                t.value = t.value.replace(/[^\d]/gi, '');

                                        }
                                    }
                                }
                            </script>

                        </div>
                        <div class="form-group row">
                            <label for="cm_contact_no" class="col-sm-4 col-form-label label-required">Contact No</label>
                            <div class="col-sm-8">
                                <input pattern="03[0-9]{9}" title="Must start with 03 and be 11 digits long" type="number" req uired id="cm_contact_no" name="cm_contact_no" value="<?php echo $wua->cm_contact_no; ?>" class="formControl">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5>WUA Bank Detail</h5>
                    <div style="padding:5px; border:1px solid #54789B; border-radius:5px;">
                        <div class="form-group row">
                            <label for="bank_account_title" class="col-sm-4 col-form-label label-required">Account Title</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="bank_account_title" name="bank_account_title" value="<?php echo $wua->bank_account_title; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_account_number" class="col-sm-4 col-form-label label-required">Account No.</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="bank_account_number" name="bank_account_number" value="<?php echo convertToExactNumber($wua->bank_account_number); ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-4 col-form-label label-required">Bank Name</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="bank_name" name="bank_name" value="<?php echo $wua->bank_name; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_branch_code" class="col-sm-4 col-form-label label-required">Branch Code</label>
                            <div class="col-sm-8">
                                <input type="text" req uired id="bank_branch_code" name="bank_branch_code" value="<?php echo $wua->bank_branch_code; ?>" class="formControl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box border blue" id="messenger" style="padding: 5px; ">
                <div class="row">
                    <div class="col-md-8">
                        <h4>
                            Scheme Code:<strong> <?php echo $scheme->scheme_code; ?> </strong><br />
                            Scheme Name:<strong> <?php echo $scheme->scheme_name ?></strong><br />

                        </h4>
                        <h4>
                            <small>Address: Region: <?php echo $scheme->region; ?>, District: <?php echo $scheme->district; ?>, Tehsil: <?php echo $scheme->tehsil ?>, UC: <?php echo $scheme->uc ?>, Address: <?php echo $scheme->villege ?><br />
                            </small>
                        </h4>

                    </div>
                    <div class="col-md-4">
                        <h4>
                            Scheme Category:<strong> <?php echo $scheme->category; ?> </strong><br />
                            <?php echo $scheme->category_detail; ?>
                        </h4>

                        <p>Scheme Status: <strong> <?php echo $scheme->scheme_status ?> </strong></p>
                    </div>

                </div>

            </div>
            <hr />
            <div class="row">
                <div class="col-md-3">
                    <div class="box border blue" id="messenger" style="padding: 5px; ">

                        <div class="form-group row">
                            <label for="tehsil" class="col-sm-3 col-form-label">Tehsil</label>
                            <div class="col-sm-9">
                                <input type="text" required id="tehsil" name="tehsil" value="<?php echo $scheme->tehsil; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uc" class="col-sm-3 col-form-label">UC</label>
                            <div class="col-sm-9">
                                <input type="text" required id="uc" name="uc" value="<?php echo $scheme->uc; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="villege" class="col-sm-3 col-form-label">Villege</label>
                            <div class="col-sm-9">
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

                        <div class="form-group row">
                            <label for="male_beneficiaries" class="col-sm-7 col-form-label">Male Beneficiaries</label>
                            <div class="col-sm-5">
                                <input type="text" required id="male_beneficiaries" name="male_beneficiaries" value="<?php echo $scheme->male_beneficiaries; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="female_beneficiaries" class="col-sm-7 col-form-label">Female Beneficiaries</label>
                            <div class="col-sm-5">
                                <input type="text" required id="female_beneficiaries" name="female_beneficiaries" value="<?php echo $scheme->female_beneficiaries; ?>" class="formControl">
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
                            <label for="top_date" class="col-sm-6 col-form-label">Top Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="top_date" name="top_date" value="<?php echo $scheme->top_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="survey_date" class="col-sm-6 col-form-label">Survey Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="survey_date" name="survey_date" value="<?php echo $scheme->survey_date; ?>" class="formControl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="design_date" class="col-sm-6 col-form-label">Design Date</label>
                            <div class="col-sm-6">
                                <input type="date" required id="design_date" name="design_date" value="<?php echo $scheme->design_date; ?>" class="formControl">
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

                        <div class="form-group row">
                            <label for="verified_by_tpv" class="col-sm-6 col-form-label">Verified By TPV</label>
                            <div class="col-sm-6">

                                <input onclick="$('#tpv_date_div').hide(); $('#verification_by_tpv_date').prop('required', false)"
                                    <?php if ($scheme->verified_by_tpv == 'No') { ?> checked <?php } ?>
                                    type="radio" required id="verified_by_tpv_no" name="verified_by_tpv" value="No" />
                                No
                                <span style="margin-left: 5px;"></span>
                                <input onclick="$('#tpv_date_div').show(); $('#verification_by_tpv_date').prop('required', true)"
                                    <?php if ($scheme->verified_by_tpv == 'Yes') { ?> checked <?php } ?>
                                    type="radio" required id="verified_by_tpv_yes" name="verified_by_tpv" value="Yes" />
                                Yes
                            </div>
                        </div>

                        <div id="tpv_date_div" class="form-group row" style="display: <?php echo ($scheme->verified_by_tpv == 'Yes') ? 'block' : 'none'; ?>;">
                            <label for="verification_by_tpv_date" class="col-sm-6 col-form-label">Verification by TPV Date</label>
                            <div class="col-sm-6">
                                <input type="date" id="verification_by_tpv_date" name="verification_by_tpv_date"
                                    value="<?php echo $scheme->verification_by_tpv_date; ?>" class="formControl"
                                    <?php if ($scheme->verified_by_tpv == 'Yes') { ?> required <?php } ?>>
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
                        <div class="form-group row">
                            <label for="cca" class="col-sm-8 col-form-label">CCA

                                <strong style="color:green"> (acre)</strong><br />
                                <small>(Culturable Command Area)</small>
                            </label>
                            <div class="col-sm-4">
                                <input min="2" type="number" step="any" required id="cca" name="cca" value="<?php echo $scheme->cca; ?>"
                                    class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gca" class="col-sm-8 col-form-label">GCA
                                <strong style="color:green"> (acre)</strong><br />
                                <small>(Gross Command Area)</small>
                            </label>
                            <div class="col-sm-4">
                                <input min="2" type="number" step="any" required id="gca" name="gca" value="<?php echo $scheme->gca; ?>"
                                    class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cca" class="col-sm-8 col-form-label">ACCA
                                <strong style="color:green"> (acre)</strong><br />
                                <small>(Additional Culturable Command Area)</small>
                            </label>
                            <div class="col-sm-4">
                                <input min="0" type="number" step="any" required id="acca" name="acca" value="<?php echo $scheme->acca; ?>"
                                    class="formControl">
                            </div>
                        </div>

                    </div>


                    <?php if ($scheme->funding_source) {
                        $funding_source = $scheme->funding_source;
                    } else {
                        $funding_source = 'KPIAIP';
                    } ?>
                    <input type="hidden" required id="funding_source" name="funding_source" value="<?php echo $funding_source; ?>" class="formControl">


                    <div class="box border blue" id="messenger" style="padding: 5px; ">

                        <input type="hidden" id="pre_additional" name="pre_additional"
                            value="0" class="formControl">

                        <div class="form-group row">
                            <label for="pre" class="col-sm-6 col-form-label">Pre Water Losses

                                <strong style="color: green;">(%)</strong>
                            </label>
                            <div class="col-sm-6">
                                <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="pre_water_losses" name="pre_water_losses" value="<?php echo $scheme->pre_water_losses; ?>"
                                    class="formControl">
                            </div>
                        </div>


                        <div class="form-group row" style="display:none">
                            <label for="pre_additional" class="col-sm-6 col-form-label">Pre Additional</label>
                            <div class="col-sm-6">
                                <input type="text" id="pre_additional" name="pre_additional" value="<?php echo $scheme->pre_additional; ?>" class="formControl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post" class="col-sm-6 col-form-label">Post Water Losses

                                <strong style="color: green;">(%)</strong></label>
                            <div class="col-sm-6">
                                <input onkeyup="calculate_water_losses_saving()" min="0" max="100" type="text" required id="post_water_losses" name="post_water_losses" value="<?php echo $scheme->post_water_losses; ?>"
                                    class="formControl">
                            </div>
                        </div>

                        <?php if ($scheme->saving_water_losses) { ?>
                            <div class="form-group row">
                                <label for="saving" class="col-sm-6 col-form-label">Water Saving

                                    <strong style="color: green;">(%)</strong></label>
                                <div class="col-sm-6">
                                    <strong id="saving_water_losses"> <?php echo $scheme->saving_water_losses; ?> </strong> %
                                </div>
                            </div>
                        <?php } ?>

                    </div>



                </div>
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
                                            class="formControl" onkeyup="updateLWH()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                        <label for="width" class="col-form-label">Width <strong style="color: green;">(m)</strong></label>
                                        <input type="number" step="any" required id="width" name="width" value="<?php echo $scheme->width; ?>"
                                            class="formControl" onkeyup="updateLWH()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                        <label for="height" class="col-form-label">Height <strong style="color: green;">(m)</strong></label>
                                        <input type="number" step="any" required id="height" name="height" value="<?php echo $scheme->height; ?>"
                                            class="formControl" onkeyup="updateLWH()">
                                    </div>
                                </div>
                                <div class="col-md-3" style="display: none;">
                                    <div class="form-group" style="margin-left: 0px; margin-right: 0px;">
                                        <label for="lwh" class="col-form-label">LWH</label>
                                        <input readonly type="text" required id="lwh" name="lwh" value="<?php echo $scheme->lwh; ?>"
                                            class="formControl">
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
                        <div class="box border blue" id="messenger" style="padding: 5px;">
                            <div class="form-group row">
                                <label for="total" class="col-sm-6 col-form-label">Total Lenght <strong style="color:green">(m)</strong></label>
                                <div class="col-sm-6">
                                    <input type="number" step="any" required id="total_lenght" name="total_lenght" value="<?php echo $scheme->total_lenght; ?>"
                                        class="formControl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lining" class="col-sm-6 col-form-label">Lining Length <strong style="color:green">(m)</strong></label>
                                <div class="col-sm-6">
                                    <input type="text" required id="lining_length" name="lining_length" value="<?php echo $scheme->lining_length; ?>"
                                        class="formControl">
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
                                    <select required class="formControl" id="type_of_lining" name="type_of_lining">
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
                                        class="formControl">
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
                                        value="<?php echo $scheme->nacca_pannel; ?>" class="formControl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="culvert" class="col-sm-6 col-form-label">Culvert</label>
                                <div class="col-sm-6">
                                    <input type="text" required id="culvert" name="culvert" value="<?php echo $scheme->culvert; ?>"
                                        class="formControl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="risers_pipe" class="col-sm-6 col-form-label">Risers Pipe</label>
                                <div class="col-sm-6">
                                    <input type="text" required id="risers_pipe" name="risers_pipe"
                                        value="<?php echo $scheme->risers_pipe; ?>" class="formControl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="risers_pond" class="col-sm-6 col-form-label">Risers Pond</label>
                                <div class="col-sm-6">
                                    <input type="text" required id="risers_pond" name="risers_pond"
                                        value="<?php echo $scheme->risers_pond; ?>" class="formControl">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="others" class="col-sm-6 col-form-label">Others</label>
                                <div class="col-sm-6">
                                    <input type="text" id="others" name="others" value="<?php echo $scheme->others; ?>"
                                        class="formControl">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div style="text-align: center;">
        <div id="result_response"></div>
        <button class="btn btn-success">Update Scheme Data</button>
    </div>
</form>
<script>
    $('#data_form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "sft/update_scheme_sft_data"); ?>', // URL to submit form data
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