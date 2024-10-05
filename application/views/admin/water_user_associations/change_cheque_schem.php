<div class="box-body">
    <h4>
        Cheque No: <?php echo $cheque->cheque; ?><br />
        Cheque Date: <?php echo $cheque->date; ?><br />
        Payee Name: <?php echo $cheque->payee_name; ?><br />
        Component Category: <?php $cheque->category; ?>
    </h4>
    <?php if($schemes){ ?>
    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("expense_id", $cheque->expense_id); ?>



        <div class="form-group">
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label("WUA Schemes", "WUA Schemes", $label);
            ?>

            <div class="col-md-8">
                <?php foreach($schemes as $scheme_id => $scheme){ ?>
                <input type="radio" name="scheme_id" value="<?php echo $scheme_id ?>" />
                <span style="margin-left: 10px;"></span>
                <?php echo $scheme; ?><br />
                <?php } ?>
            </div>
            <?php echo form_error("scheme_id", "<p class=\"text-danger\">", "</p>"); ?>
        </div>
        <div id="result_response"></div>

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
    <?php }else{?>
    <div class="alert alert-danger">No Scheme Found for <?php $cheque->category; ?> Component Category </div>
    <?php } ?>
</div>

<script>
$('#data_form').submit(function(e) {

    e.preventDefault(); // Prevent default form submission

    // Create FormData object
    var formData = new FormData(this);

    // Send AJAX request
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/update_cheque_scheme") ?>', // URL to submit form data
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Don't set contentType
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