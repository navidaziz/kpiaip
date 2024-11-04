<div class="box-body">
    <table class="table table-bordered">
        <tr>
            <th>Scheme Detail</th>
            <th>Cheque Detail</th>
        </tr>
        <tr>
            <td>
                Scheme Code: <?php echo $scheme->scheme_code ?><br />
                Scheme Name: <?php echo $scheme->scheme_name; ?><br />
                Category: <?php echo $scheme->category; ?><br />
                District: <?php echo $scheme->district_name; ?><br />
                WUA: <?php echo $scheme->wua_name; ?><br />
                Chairman: <?php echo $scheme->cm_name; ?><br />


            </td>
            <td>
               Cheque No: <?php echo $expense->cheque; ?> - Cheque Date:
                <?php echo date("d M, Y", strtotime($expense->date)); ?><br />
                Payee Name: <?php echo $expense->payee_name; ?><br />
                Scheme Name: <?php echo $expense->schemeName; ?><br />
                Scheme Code: <?php echo $expense->schemeName; ?><br />
                Category: <?php echo $expense->category; ?><br />
                District: <?php echo $expense->district_name; ?><br />
                Installment: <?php echo $expense->installment; ?><br />
            
            </td>
        </tr>
    </table>
    <?php if(!$expense->scheme_name){ ?>
    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("expense_id", $expense->expense_id); ?>

        <?php echo form_hidden("scheme_id", $scheme->scheme_id); ?>


        <div class="form-group">
            <label for="Net Paid" class="col-md-4 control-label" style="">Confirm Cheque Installment</label>
            <div class="col-md-8"><?php
        $installments['1st'] = '1st';
        $installments['2nd'] = '2nd';
        $installments['1st_2nd'] = '1st_2nd';
        $installments['Final'] = 'Final';
        $this->data['installments'] = $installments; 
                foreach($installments as $installment){ ?>
                <input <?php if(str_replace(' & ', '_', trim($expense->installment))==$installment){?> checked
                    <?php } ?> required type="radio" name="installment" id="installment"
                    value="<?php echo $installment; ?>" />
                <?php echo $installment; ?>
                <span style="margin-left: 10px;"></span>
                <?php } ?>
            </div>
        </div>

        <div class=" col-md-12" style="text-align: center;">


            <?php
            $submit = array(
                "type"  =>  "submit",
                "name"  =>  "submit",
                "value" =>  "Change Scheme",
                "class" =>  "btn btn-primary",
                "style" =>  ""
            );
            echo form_submit($submit);
            ?>



        </div>
        <div style="clear:both;"></div>

    </form>

    <script>
    $('#data_form').submit(function(e) {

        e.preventDefault(); // Prevent default form submission

        // Create FormData object
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "temp/update_cheque_scheme") ?>', // URL to submit form data
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set contentType
            success: function(response) {
                // Display response
                if (response == 'success') {
                    //location.reload();
                    $('#result_response').html('Update Successfully');
                    search();
                    $('#modal').modal('hide');

                } else {
                    $('#result_response').html(response);
                }
            }
        });
    });
    </script>
    <?php }else{ ?>

    <h4>Remove <br /> 
    <strong>
    Cheque No: <?php echo $expense->cheque; ?> - Dated:
        <?php echo date("d M, Y", strtotime($expense->date)); ?> 
        <br />
        <br />
        From Scheme:<br />
    
        <strong>
        Scheme Code: <?php echo $scheme->scheme_code ?><br />
        Scheme Name: <?php echo $scheme->scheme_name; ?> <br />
         Scheme Name: <?php echo $scheme->scheme_status; ?> <br />
       
    </strong>
    </h4>

    <form id="remove_cheque" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("expense_id", $expense->expense_id); ?>
        <?php echo form_hidden("scheme_id", $expense->scheme_id); ?>


        <div class=" col-md-12" style="text-align: center;">


            <?php
            $submit = array(
                "type"  =>  "submit",
                "name"  =>  "submit",
                "value" =>  "Remove Scheme Cheque",
                "class" =>  "btn btn-danger",
                "style" =>  ""
            );
            echo form_submit($submit);
            ?>



        </div>
        <div style="clear:both;"></div>

    </form>
    <script>
    $('#remove_cheque').submit(function(e) {

        e.preventDefault(); // Prevent default form submission

        // Create FormData object
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "temp/remove_cheque_scheme") ?>', // URL to submit form data
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set contentType
            success: function(response) {
                // Display response
                if (response == 'success') {
                    //location.reload();
                    $('#result_response').html('Update Successfully');
                    search();
                    $('#modal').modal('hide');

                } else {
                    $('#result_response').html(response);
                }
            }
        });
    });
    </script>


    <?php } ?>

</div>