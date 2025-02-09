<style>
    .formControl {
        width: 100%;
    }
</style>
<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="box-body">
        <?php echo form_hidden("expense_id", $expense->expense_id); ?>
        <?php echo form_hidden("purpose", 'Operational Cost '); ?>
        <?php echo form_hidden("scheme_id", NULL); ?>
        <?php echo form_hidden("district_id", '31'); ?>
        <?php echo form_hidden("category", 'Remuneration'); ?>
        <?php echo form_hidden("component_category_id", '16'); ?>

        <div class="table-responsive">
            <table class="table table_s_small table-bordered" id="employees">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Voucher Number</th>
                        <th>Cheque No.</th>
                        <th>Date</th>
                        <th>Gross Paid</th>
                        <th>Whit Tax</th>
                        <th>Whst Tax</th>
                        <th>St Duty Tax</th>
                        <th>Rdp Tax</th>
                        <th>Kpra Tax</th>
                        <th>Misc Dedu.</th>
                        <th>Net Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $query = "SELECT * FROM employees WHERE status=1";
                    $rows = $this->db->query($query)->result();
                    foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td>
                                <strong><?php echo $row->name; ?></strong>
                                <input type="hidden" name="employees[<?php echo $row->employee_id; ?>][payee_name]" value="<?php echo $row->name; ?>" class="formControl" style="" required="required" placeholder="Payee Name">
                            </td>

                            <td>
                                <input type="text" name="employees[<?php echo $row->employee_id; ?>][voucher_number]" value="<?php echo $expense->voucher_number; ?>" class="formControl voucher_number" style="width:100px" required="required" placeholder="Voucher Number">
                            </td>
                            <td>
                                <input type="number" name="employees[<?php echo $row->employee_id; ?>][cheque]" value="" class="formControl cheque" style="width:100px" required="required" placeholder="Cheque No.">
                            </td>
                            <td> <input type="date" name="employees[<?php echo $row->employee_id; ?>][date]" value="" class="formControl date" style="" required="required" placeholder="Date">
                            </td>
                            <td> <?php echo $row->gross_pay; ?>
                                <input type="hidden" min="1" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][gross_pay]" value="<?php echo $row->gross_pay; ?>" class="formControl" style="" required="required" placeholder="Gross Paid">
                            </td>
                            <td>
                                <?php echo $row->whit_tax; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][whit_tax]" value="<?php echo $row->whit_tax; ?>" class="formControl" style="" required="required" placeholder="WHIT Tax">
                            </td>
                            <td>
                                <?php echo $row->whst_tax; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][whst_tax]" value="<?php echo $row->whst_tax; ?>" class="formControl" style="" required="required" placeholder="WHST Tax">
                            </td>
                            <td>
                                <?php echo $row->st_duty_tax; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][st_duty_tax]" value="<?php echo $row->st_duty_tax; ?>" class="formControl" style="" required="required" placeholder="St.Duty Tax">
                            </td>
                            <td>
                                <?php echo $row->rdp_tax; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][rdp_tax]" value="<?php echo $row->rdp_tax; ?>" class="formControl" style="" required="required" placeholder="RDP Tax">
                            </td>
                            <td>
                                <?php echo $row->kpra_tax; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][kpra_tax]" value="<?php echo $row->kpra_tax; ?>" class="formControl" style="" required="required" placeholder="KPRA Tax">
                            </td>
                            <td>
                                <?php echo $row->misc_deduction; ?>
                                <input type="hidden" onkeyup="calculate_net_pay()" step="any" name="employees[<?php echo $row->employee_id; ?>][misc_deduction]" value="<?php echo $row->misc_deduction; ?>" class="formControl" style="" required="required" placeholder="Misc.Dedu.">
                            </td>
                            <td>
                                <?php echo $row->net_pay; ?>
                                <input readonly min="1" type="hidden" step="any" name="employees[<?php echo $row->employee_id; ?>][net_pay]" value="<?php echo $row->net_pay; ?>" class="formControl" style="" required="required" placeholder="Net Paid">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <script>
                // Function to update cheque numbers
                function updateVoucherNumber() {
                    var VoucherNumber = parseInt(document.querySelector('.voucher_number').value);
                    var rows = document.querySelectorAll('#employees tbody tr');
                    rows.forEach(function(row, index) {
                        row.querySelector('.voucher_number').value = VoucherNumber;
                    });
                }


                function updateChequeNumbers() {
                    var chequeNumber = parseInt(document.querySelector('.cheque').value);
                    var rows = document.querySelectorAll('#employees tbody tr');
                    rows.forEach(function(row, index) {
                        row.querySelector('.cheque').value = chequeNumber + index;
                    });
                }



                // Function to update dates
                function updateDates() {
                    var selectedDate = document.querySelector('.date').value;
                    var dateInputs = document.querySelectorAll('.date');
                    dateInputs.forEach(function(input) {
                        input.value = selectedDate;
                    });
                }

                // Event listener for cheque number input
                document.querySelector('.cheque').addEventListener('input', updateChequeNumbers);
                document.querySelector('.voucher_number').addEventListener('input', updateVoucherNumber);

                // Event listener for date input
                document.querySelector('.date').addEventListener('input', updateDates);
            </script>




            <div class="col-md-12" id="result_response"></div>

            <div style="text-align: center;" class="col-md-12">
                <?php
                if ($expense->expense_id == 0) {
                    $submit = array(
                        "type"  =>  "submit",
                        "name"  =>  "submit",
                        "value" =>  "Add Expense",
                        "class" =>  "btn btn-primary",
                        "style" =>  ""
                    );
                } else {
                    $submit = array(
                        "type"  =>  "submit",
                        "name"  =>  "submit",
                        "value" =>  "Update Expense",
                        "class" =>  "btn btn-success",
                        "style" =>  ""
                    );
                }
                echo form_submit($submit);
                ?>



            </div>

            <div style="clear:both;">
            </div>

        </div>
</form>
<script>
    $('#data_form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "expenses/add_monthly_salaries") ?>', // URL to submit form data
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