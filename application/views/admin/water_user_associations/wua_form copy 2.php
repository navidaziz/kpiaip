 <form id="water_user_associations" class="form-horizontal" enctype="multipart/form-data" method="post">
     <input style="width:100%" type="hidden" name="water_user_association_id"
         value="<?php echo $input->water_user_association_id; ?>" />
     <input style="width:100%" type="hidden" id="project_id" name="project_id"
         value="<?php echo $input->project_id; ?>" />
     <input style="width:100%" type="hidden" id="district_id" name="district_id"
         value="<?php echo $input->district_id; ?>" />

     <table class="table small_table">
         <tr>
             <td><label for="tehsil_name">Tehsil Name</label></td>
             <td><label for="union_council">Union Council</label></td>
             <td><label for="address">Address</label></td>
         </tr>
         <tr>
             <td><input style="width:100%" type="text" id="tehsil_name" name="tehsil_name"
                     value="<?php echo $input->tehsil_name; ?>"></td>

             <td><input style="width:100%" type="text" id="union_council" name="union_council"
                     value="<?php echo $input->union_council; ?>"></td>

             <td><input style="width:100%" type="text" id="address" name="address"
                     value="<?php echo $input->address; ?>"></td>
         </tr>
         <tr>
             <td><label for="file_number">File Number</label></td>
             <td><label for="wua_registration_no">Wua Registration No</label></td>
             <td><label for="wua_name">Wua Name</label></td>
         </tr>
         <tr>
             <td><input style="width:100%" type="text" id="file_number" name="file_number"
                     value="<?php echo $input->file_number; ?>"></td>

             <td><input style="width:100%" type="text" id="wua_registration_no" name="wua_registration_no"
                     value="<?php echo $input->wua_registration_no; ?>"></td>
             <td><input readonly required style="width:100%" type="text" id="wua_name" name="wua_name"
                     value="<?php echo $input->wua_name; ?>"></td>
         </tr>
         <tr>
             <td><label for="bank_account_title">Bank Account Title</label></td>
             <td><label for="bank_account_number">Bank Account Number</label></td>
             <td><label for="bank_branch_code">Bank Branch Code</label></td>
         </tr>
         <tr>

             <td><input style="width:100%" type="text" id="bank_account_title" name="bank_account_title"
                     value="<?php echo $input->bank_account_title; ?>"></td>
             <td><input style="width:100%" type="text" id="bank_account_number" name="bank_account_number"
                     value="<?php echo $input->bank_account_number; ?>"></td>


             <td><input style="width:100%" type="text" id="bank_branch_code" name="bank_branch_code"
                     value="<?php echo $input->bank_branch_code; ?>"></td>
         </tr>
     </table>

     <div class="form-group row" style="text-align:center">
         <div id="result_response"></div>
         <?php if ($input->water_user_association_id == 0) { ?>
         <button type="submit" class="btn btn-primary">Add Data</button>
         <?php }else{ ?>
         <button type="submit" class="btn btn-primary">Update Data</button>
         <?php } ?>
     </div>
     <?php if ($input->water_user_association_id >0) { ?>
     <?php $this->load->view(ADMIN_DIR."water_user_associations/expense_reference"); ?>
     <?php } ?>

 </form>
 </div>

 <script>
$('#water_user_associations').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/add_water_user_association"); ?>', // URL to submit form data
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