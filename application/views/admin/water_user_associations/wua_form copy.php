 <form id="water_user_associations" class="form-horizontal" enctype="multipart/form-data" method="post">
     <input type="hidden" name="water_user_association_id" value="<?php echo $input->water_user_association_id; ?>" />
     <div class="form-group row">
         <label for="project_id" class="col-sm-4 col-form-label">Project Id</label>
         <div class="col-sm-8">
             <input type="text" required id="project_id" name="project_id" value="<?php echo $input->project_id; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="district_id" class="col-sm-4 col-form-label">District Id</label>
         <div class="col-sm-8">
             <input type="text" required id="district_id" name="district_id" value="<?php echo $input->district_id; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="tehsil_name" class="col-sm-4 col-form-label">Tehsil Name</label>
         <div class="col-sm-8">
             <input type="text" required id="tehsil_name" name="tehsil_name" value="<?php echo $input->tehsil_name; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="union_council" class="col-sm-4 col-form-label">Union Council</label>
         <div class="col-sm-8">
             <input type="text" required id="union_council" name="union_council"
                 value="<?php echo $input->union_council; ?>" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="address" class="col-sm-4 col-form-label">Address</label>
         <div class="col-sm-8">
             <input type="text" required id="address" name="address" value="<?php echo $input->address; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="file_number" class="col-sm-4 col-form-label">File Number</label>
         <div class="col-sm-8">
             <input type="text" required id="file_number" name="file_number" value="<?php echo $input->file_number; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="wua_registration_no" class="col-sm-4 col-form-label">Wua Registration No</label>
         <div class="col-sm-8">
             <input type="number" required id="wua_registration_no" name="wua_registration_no"
                 value="<?php echo $input->wua_registration_no; ?>" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="wua_name" class="col-sm-4 col-form-label">Wua Name</label>
         <div class="col-sm-8">
             <input type="text" required id="wua_name" name="wua_name" value="<?php echo $input->wua_name; ?>"
                 class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="bank_account_title" class="col-sm-4 col-form-label">Bank Account Title</label>
         <div class="col-sm-8">
             <input type="text" required id="bank_account_title" name="bank_account_title"
                 value="<?php echo $input->bank_account_title; ?>" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="bank_account_number" class="col-sm-4 col-form-label">Bank Account Number</label>
         <div class="col-sm-8">
             <input type="text" required id="bank_account_number" name="bank_account_number"
                 value="<?php echo $input->bank_account_number; ?>" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="bank_branch_code" class="col-sm-4 col-form-label">Bank Branch Code</label>
         <div class="col-sm-8">
             <input type="text" required id="bank_branch_code" name="bank_branch_code"
                 value="<?php echo $input->bank_branch_code; ?>" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="attachement" class="col-sm-4 col-form-label">Attachement</label>
         <div class="col-sm-8">
             <input type="text" required id="attachement" name="attachement" value="<?php echo $input->attachement; ?>"
                 class="form-control">
         </div>
     </div>

     <div class="form-group row" style="text-align:center">
         <div id="result_response"></div>
         <?php if ($input->water_user_association_id == 0) { ?>
         <button type="submit" class="btn btn-primary">Add Data</button>
         <?php }else{ ?>
         <button type="submit" class="btn btn-primary">Update Data</button>
         <?php } ?>
     </div>
 </form>
 </div>

 <script>
$('#water_user_associations').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "water_user_association/add_water_user_association"); ?>', // URL to submit form data
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