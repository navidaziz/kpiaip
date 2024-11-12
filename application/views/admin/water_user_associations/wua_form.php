  <form id="water_user_associations" class="form-horizontal" enctype="multipart/form-data" method="post">
      <input type="hidden" name="water_user_association_id" value="<?php echo $input->water_user_association_id; ?>" />
      <div class="row">
          <div class="col-md-6">
              <h5>Water Assosiation Detail</h5>
              <div style="padding:5px; border:1px solid #54789B; border-radius:5px">
                  <div class="form-group row">
                      <label for="wua_name" class="col-sm-4 col-form-label label-required label-required">WUA Name</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="wua_name" name="wua_name" value="<?php echo $input->wua_name; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="file_number" class="col-sm-4 col-form-label label-required">File / REF No.</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="file_number" name="file_number" value="<?php echo $input->file_number; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="wua_registration_no" class="col-sm-4 col-form-label label-required">WUA REG. No</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="wua_registration_no" name="wua_registration_no" value="<?php echo $input->wua_registration_no; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="wua_registration_date" class="col-sm-4 col-form-label label-required">WUA REG. Date</label>
                      <div class="col-sm-8">
                          <input type="date" req uired id="wua_registration_date" name="wua_registration_date" value="<?php echo $input->wua_registration_date; ?>" class="form-control">
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-md-6">
              <h5>Location Detail</h5>
              <div style="padding:5px; border:1px solid #54789B; border-radius:5px">
                  <div class="form-group row">
                      <label for="district_id" class="col-sm-4 col-form-label label-required">District</label>
                      <div class="col-sm-8">

                          <?php


                            $query = "SELECT * FROM districts WHERE is_district = 1 
                          AND district_id = '" . $user_district_id . "'";

                            $districts = $this->db->query($query)->result();
                            ?>
                          <select class="form-control" name="district_id">
                              <?php foreach ($districts as $district) { ?>
                                  <option class="<?php echo $district->district_id ?>"><?php echo $district->district_name; ?></option>
                              <?php } ?>
                          </select>

                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="tehsil_name" class="col-sm-4 col-form-label label-required">Tehsil Name</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="tehsil_name" name="tehsil_name" value="<?php echo $input->tehsil_name; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="union_council" class="col-sm-4 col-form-label label-required">UC/ VC</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="union_council" name="union_council" value="<?php echo $input->union_council; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="address" class="col-sm-4 col-form-label label-required">Address</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="address" name="address" value="<?php echo $input->address; ?>" class="form-control">
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
              <h5>Chairman Detail</h5>
              <div style="padding:5px; border:1px solid #54789B; border-radius:5px">
                  <div class="form-group row">
                      <label for="cm_name" class="col-sm-4 col-form-label label-required">Name</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="cm_name" name="cm_name" value="<?php echo $input->cm_name; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cm_father_name" class="col-sm-4 col-form-label label-required">Father Name</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="cm_father_name" name="cm_father_name" value="<?php echo $input->cm_father_name; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cm_gender" class="col-sm-4 col-form-label label-required">Gender</label>
                      <div class="col-sm-8">
                          <?php $options = array("Male", "Female");
                            foreach ($options as $option) {
                                $checked = "";
                                if ($option == $input->cm_gender) {
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
                          <input pattern="\d{5}-\d{7}-\d{1}" onkeyup="nic_dash1(this)" type="text" req uired id="cm_cnic" name="cm_cnic" value="<?php echo $input->cm_cnic; ?>" class="form-control">
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
                          <input pattern="03[0-9]{9}" title="Must start with 03 and be 11 digits long" type="number" req uired id="cm_contact_no" name="cm_contact_no" value="<?php echo $input->cm_contact_no; ?>" class="form-control">
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6">
              <h5>WUA Bank Detail</h5>
              <div style="padding:5px; border:1px solid #54789B; border-radius:5px; min-height: 246px;">
                  <div class="form-group row">
                      <label for="bank_account_title" class="col-sm-4 col-form-label label-required">Account Title</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="bank_account_title" name="bank_account_title" value="<?php echo $input->bank_account_title; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="bank_account_number" class="col-sm-4 col-form-label label-required">Account No.</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="bank_account_number" name="bank_account_number" value="<?php echo $input->bank_account_number; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="bank_name" class="col-sm-4 col-form-label label-required">Bank Name</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="bank_name" name="bank_name" value="<?php echo $input->bank_name; ?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="bank_branch_code" class="col-sm-4 col-form-label label-required">Branch Code</label>
                      <div class="col-sm-8">
                          <input type="text" req uired id="bank_branch_code" name="bank_branch_code" value="<?php echo $input->bank_branch_code; ?>" class="form-control">
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div style="padding:5px; border-radius:5px; text-align:center">
          <div id="result_response"></div>
          <?php if ($input->water_user_association_id == 0) { ?>
              <button type="submit" class="btn btn-success">Add New WUA</button>
          <?php } else { ?>
              <button type="submit" class="btn btn-primary">Update WUA Record</button>
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
  <style>
      .label-required::after {
          content: " *";
          color: red;
          font-weight: bold;
          margin-left: 4px;
      }
  </style>