<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("wua_member_id", $wua_member->wua_member_id); ?>
        <?php echo form_hidden("project_id", $wua_member->project_id); ?>
        <?php echo form_hidden("district_id", $wua_member->district_id); ?>
        <?php echo form_hidden("water_user_association_id", $wua_member->water_user_association_id); ?>


        <div class="form-group">
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('member_type'), "member_type", $label);
            ?>

            <div class="col-md-8">
                <?php
                $options = array( 
                    "Member" => "Member",
                    "Vice Chairman" => "Vice Chairman",
                    "Secretary" => "Secretary"
                   
                );
                foreach ($options as $option_value => $options_name) {

                    $data = array(
                        "name"        => "member_type",
                        "id"          => "member_type",
                        "value"       => $option_value,
                        "style"       => "", "required"      => "required",
                        "class"       => "uniform"
                    );
                    if ($option_value == $wua_member->member_type) {
                        $data["checked"] = TRUE;
                    }
                    echo form_radio($data) . "<label for=\"member_type\" style=\"margin-left:10px;\">$options_name</label> <br />";
                }
                ?>
                <?php echo form_error("member_type", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
        </div>


        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('member_name'), "member_name", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "member_name",
                    "id"            =>  "member_name",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('member_name'),
                    "value"         =>  set_value("member_name", $wua_member->member_name),
                    "placeholder"   =>  $this->lang->line('member_name')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("member_name", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('member_father_name'), "member_father_name", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "member_father_name",
                    "id"            =>  "member_father_name",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('member_father_name'),
                    "value"         =>  set_value("member_father_name", $wua_member->member_father_name),
                    "placeholder"   =>  $this->lang->line('member_father_name')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("member_father_name", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('member_gender'), "member_gender", $label);
            ?>

            <div class="col-md-8">
                <?php
                $options = array("Male" => "Male", "Female" => "Female");
                foreach ($options as $option_value => $options_name) {

                    $data = array(
                        "name"        => "member_gender",
                        "id"          => "member_gender",
                        "value"       => $option_value,
                        "style"       => "", "required"      => "required",
                        "class"       => "uniform"
                    );
                    if ($option_value == $wua_member->member_gender) {
                        $data["checked"] = TRUE;
                    }
                    echo form_radio($data) . "<label for=\"member_gender\" style=\"margin-left:10px;\">$options_name</label>";
                }
                ?>
                <?php echo form_error("member_gender", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
        </div>


        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('member_cnic'), "member_cnic", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "member_cnic",
                    "id"            =>  "member_cnic",
                    "pattern"       => "\d{5}-\d{7}-\d{1}",
                    "onKeyUp"       => "nic_dash1(this)",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('member_cnic'),
                    "value"         =>  set_value("member_cnic", $wua_member->member_cnic),
                    "placeholder"   =>  $this->lang->line('member_cnic')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("member_cnic", "<p class=\"text-danger\">", "</p>"); ?>
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

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label('Contact No', "contact_no", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "contact_no",
                    "id"            =>  "contact_no",
                    "class"         =>  "form-control",
                    "pattern" => "0[0-9]{10}",
                    "style"         =>  "",
                    "required"      => "required",
                    "title"         =>  "Please enter an 11-digit mobile number starting with '0'",
                    "value"         =>  set_value("contact_no", $wua_member->contact_no),
                    "placeholder"   =>  '032400000000'
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("contact_no", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('attachment') . "<br />" . file_type(base_url("assets/uploads/" . $wua_member->attachment)), "attachment", $label);     ?>

            <div class="col-md-8">
                <?php

                $file = array(
                    "type"          =>  "file",
                    "name"          =>  "attachment",
                    "id"            =>  "attachment",
                    "class"         =>  "form-control",
                    "style"         =>  "", "title"         =>  $this->lang->line('attachment'),
                    "value"         =>  set_value("attachment", $wua_member->attachment),
                    "placeholder"   =>  $this->lang->line('attachment')
                );
                echo  form_input($file);
                ?>
                <!--<?php echo file_type(base_url("assets/uploads/$wua_member->attachment")); ?>-->

                <?php echo form_error("attachment", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>
        <div id="result_response"></div>

        <div class=" col-md-12" style="text-align: center;">
            <?php
            $submit = array(
                "type"  =>  "submit",
                "name"  =>  "submit",
                "value" =>  $this->lang->line('Update'),
                "class" =>  "btn btn-primary",
                "style" =>  ""
            );
            echo form_submit($submit);
            ?>



            <?php
            $reset = array(
                "type"  =>  "reset",
                "name"  =>  "reset",
                "value" =>  $this->lang->line('Reset'),
                "class" =>  "btn btn-default",
                "style" =>  ""
            );
            echo form_reset($reset);
            ?>
        </div>
        <div style="clear:both;"></div>

    </form>

</div>

<script>
$('#data_form').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Create FormData object
    var formData = new FormData(this);

    // Send AJAX request
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/add_wua_member") ?>', // URL to submit form data
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