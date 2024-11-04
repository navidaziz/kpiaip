<div class="box-body">
    <table class="table table-bordered">
        <tr>
            
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
    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("expense_id", $expense->expense_id); ?>
<div style="text-align:center">
        Select Component Category: 
<select class="form-control" name="component_category_id" id="component_category_id" >
<?php 
$query="SELECT * FROM component_categories as cc WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
$components_categories = $this->db->query($query)->result();  
foreach($components_categories as $components_category){?>
<option value="<?php echo $components_category->component_category_id ?>"><?php echo $components_category->category ?> - <?php echo $components_category->category_detail ?></option>
<?php } ?>
</select>
<br />

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
        </div>
    </form>

    <script>
    $('#data_form').submit(function(e) {

        e.preventDefault(); // Prevent default form submission

        // Create FormData object
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "temp/update_cheque_category") ?>', // URL to submit form data
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
   