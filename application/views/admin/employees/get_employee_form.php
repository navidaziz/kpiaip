<form id="employees" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="employee_id" value="<?php echo $input->employee_id; ?>" />
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Name</label>
        <div class="col-sm-8">
            <input type="text" required id="name" name="name" value="<?php echo $input->name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="father_name" class="col-sm-4 col-form-label">Father Name</label>
        <div class="col-sm-8">
            <input type="text" required id="father_name" name="father_name" value="<?php echo $input->father_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="gender" class="col-sm-4 col-form-label">Gender</label>
        <div class="col-sm-8">
            <?php $options = array("Male", "Female");
            foreach ($options as $option) {
                $checked = "";
                if ($option == $input->gender) {
                    $checked = "checked";
                }
            ?>
                <span style="margin-left:5px">
                    <input <?php echo $checked ?> type="radio" required id="<?php echo $option; ?>" name="gender" value="<?php echo $option; ?>" class="">
                    <span style="margin-left:3px"></span> <?php echo $option;  ?>
                    <span style="margin-left:3px">

                    <?php } ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="cnic" class="col-sm-4 col-form-label">Cnic</label>
        <div class="col-sm-8">
            <input type="text" required id="cnic" name="cnic" value="<?php echo $input->cnic; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="personal_no" class="col-sm-4 col-form-label">Personal No</label>
        <div class="col-sm-8">
            <input type="number" required id="personal_no" name="personal_no" value="<?php echo $input->personal_no; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="mobile_no" class="col-sm-4 col-form-label">Mobile No</label>
        <div class="col-sm-8">
            <input type="number" required id="mobile_no" name="mobile_no" value="<?php echo $input->mobile_no; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="employee_type" class="col-sm-4 col-form-label">Employee Type</label>
        <div class="col-sm-8">
            <input type="text" required id="employee_type" name="employee_type" value="<?php echo $input->employee_type; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="designation" class="col-sm-4 col-form-label">Designation</label>
        <div class="col-sm-8">
            <input type="text" required id="designation" name="designation" value="<?php echo $input->designation; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="basi_pay_scale" class="col-sm-4 col-form-label">Basi Pay Scale</label>
        <div class="col-sm-8">
            <input type="number" required id="basi_pay_scale" name="basi_pay_scale" value="<?php echo $input->basi_pay_scale; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="joining_date" class="col-sm-4 col-form-label">Joining Date</label>
        <div class="col-sm-8">
            <input type="date" required id="joining_date" name="joining_date" value="<?php echo $input->joining_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="gross_pay" class="col-sm-4 col-form-label">Gross Paid</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="gross_pay" name="gross_pay" value="<?php echo $input->gross_pay; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="whit_tax" class="col-sm-4 col-form-label">Whit Tax</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="whit_tax" name="whit_tax" value="<?php echo $input->whit_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="whst_tax" class="col-sm-4 col-form-label">Whst Tax</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="whst_tax" name="whst_tax" value="<?php echo $input->whst_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="st_duty_tax" class="col-sm-4 col-form-label">St Duty Tax</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="st_duty_tax" name="st_duty_tax" value="<?php echo $input->st_duty_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="rdp_tax" class="col-sm-4 col-form-label">Rdp Tax</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="rdp_tax" name="rdp_tax" value="<?php echo $input->rdp_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="kpra_tax" class="col-sm-4 col-form-label">Kpra Tax</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="kpra_tax" name="kpra_tax" value="<?php echo $input->kpra_tax; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="misc_deduction" class="col-sm-4 col-form-label">Misc Deduction</label>
        <div class="col-sm-8">
            <input type="number" onkeyup="calculate_net_pay()" step="any" required id="misc_deduction" name="misc_deduction" value="<?php echo $input->misc_deduction; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="net_pay" class="col-sm-4 col-form-label">Net Paid</label>
        <div class="col-sm-8">
            <input readonly type="number" required id="net_pay" name="net_pay" value="<?php echo $input->net_pay; ?>" class="form-control">
        </div>
    </div>
    <script>
            function calculate_net_pay() {
                var gross_pay = parseFloat($('#gross_pay').val());
                if (gross_pay == "") {
                    $('#gross_pay').val("0");
                }
                var whit_tax = parseFloat($('#whit_tax').val());
                var whst_tax = parseFloat($('#whst_tax').val());
                var st_duty_tax = parseFloat($('#st_duty_tax').val());
                var rdp_tax = parseFloat($('#rdp_tax').val());
                var misc_deduction = parseFloat($('#misc_deduction').val());
                var net_pay = gross_pay - whit_tax - whst_tax - st_duty_tax - rdp_tax - misc_deduction;
                $('#net_pay').val(net_pay);
            }
        </script>
    <?php if ($input->employee_id != 0) { 
        $hide='display:none';
        ?>
        <div class="form-group row">
            <label for="leaved_date" class="col-sm-4 col-form-label">Employee leaved</label>
            <div class="col-sm-8">
                <span style="margin-left:5px"></span>
                <input onclick="$('#leaved_div').show(); $('#leaved_date').attr('required', true)" <?php if ($input->status==0) { echo "checked"; $hide=""; } ?> type="radio" value="0" name="status" /> <span style="margin-left:3px"></span> Yes
                <span style="margin-left:5px"> </span>
                <input onclick="$('#leaved_div').hide(); $('#leaved_date').attr('required',false)" <?php if ($input->status==1) { echo "checked";  } ?> type="radio" value="1" name="status" /> <span style="margin-left:3px"></span> No
            </div>
        </div>
        <div class="form-group row" id="leaved_div" style="<?php echo $hide; ?>">
            <label for="leaved_date" class="col-sm-4 col-form-label">Leaved Date</label>
            <div class="col-sm-8">
                <input type="date" id="leaved_date" name="leaved_date" value="<?php echo $input->leaved_date; ?>" class="form-control">
            </div>
        </div>
    <?php } ?>
    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->employee_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#employees').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "employees/add_employee"); ?>', // URL to submit form data
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