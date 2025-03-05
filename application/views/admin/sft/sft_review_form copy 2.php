<style>
    .formControl {
        width: 100%;
    }

    .col-form-label {
        font-size: 9px;
    }
</style>
<div class="row">
    <div class="col-md-2">
        <h4>Water Association Detail</h4>
        <table class="table table-bordered">
            <thead>

            </thead>
            <tbody>
                <tr>
                    <td><label for="wua_name">WUA Name</label><br>
                        <input type="text" required id="wua_name" name="wua_name" value="<?php echo $input->wua_name; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="file_number">File / REF No.</label><br>
                        <input type="text" required id="file_number" name="file_number" value="<?php echo $input->file_number; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="wua_registration_no">WUA REG. No</label><br>
                        <input type="text" required id="wua_registration_no" name="wua_registration_no" value="<?php echo $input->wua_registration_no; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="wua_registration_date">WUA REG. Date</label><br>
                        <input type="date" required id="wua_registration_date" name="wua_registration_date" value="<?php echo $input->wua_registration_date; ?>" class="formControl">
                    </td>
                </tr>
            </tbody>
        </table>
        <h4>Location Detail</h4>
        <table>
            <tbody>
                <tr>
                    <td><label for="district_id">District</label><br>
                        <select class="formControl" name="district_id">
                            <?php foreach ($districts as $district) { ?>
                                <option value="<?php echo $district->district_id ?>"><?php echo $district->district_name; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tehsil_name">Tehsil Name</label><br>
                        <input type="text" required id="tehsil_name" name="tehsil_name" value="<?php echo $input->tehsil_name; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="union_council">UC/ VC</label><br>
                        <input type="text" required id="union_council" name="union_council" value="<?php echo $input->union_council; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address</label><br>
                        <input type="text" required id="address" name="address" value="<?php echo $input->address; ?>" class="formControl">
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>Chairman Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="cm_name">Name</label><br>
                        <input type="text" required id="cm_name" name="cm_name" value="<?php echo $input->cm_name; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="cm_father_name">Father Name</label><br>
                        <input type="text" required id="cm_father_name" name="cm_father_name" value="<?php echo $input->cm_father_name; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="cm_gender">Gender</label><br>
                        <?php $options = array("Male", "Female");
                        foreach ($options as $option) {
                            $checked = ($option == $input->cm_gender) ? "checked" : "";
                        ?>
                            <input <?php echo $checked ?> type="radio" required id="<?php echo $option; ?>" name="cm_gender" value="<?php echo $option; ?>">
                            <?php echo $option; ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="cm_cnic">CNIC</label><br>
                        <input pattern="\d{5}-\d{7}-\d{1}" type="text" required id="cm_cnic" name="cm_cnic" value="<?php echo $input->cm_cnic; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="cm_contact_no">Contact No</label><br>
                        <input pattern="03[0-9]{9}" type="number" required id="cm_contact_no" name="cm_contact_no" value="<?php echo $input->cm_contact_no; ?>" class="formControl">
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>WUA Bank Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="bank_account_title">Account Title</label><br>
                        <input type="text" required id="bank_account_title" name="bank_account_title" value="<?php echo $input->bank_account_title; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="bank_account_number">Account No.</label><br>
                        <input type="text" required id="bank_account_number" name="bank_account_number" value="<?php echo $input->bank_account_number; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="bank_name">Bank Name</label><br>
                        <input type="text" required id="bank_name" name="bank_name" value="<?php echo $input->bank_name; ?>" class="formControl">
                    </td>
                </tr>
                <tr>
                    <td><label for="bank_branch_code">Branch Code</label><br>
                        <input type="text" required id="bank_branch_code" name="bank_branch_code" value="<?php echo $input->bank_branch_code; ?>" class="formControl">
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>