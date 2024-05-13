<div class="box-body">

    <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <?php echo form_hidden("scheme_id", $scheme->scheme_id); ?>
        <?php echo form_hidden("project_id", $scheme->project_id); ?>
        <?php echo form_hidden("district_id", $scheme->district_id); ?>
        <?php echo form_hidden("water_user_association_id", $scheme->water_user_association_id); ?>


        <div class="form-group">
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('category'), "Component Category Id", $label);
            ?>

            <div class="col-md-8">
                <?php
                echo form_dropdown("component_category_id", array("" => "Select Category") + $component_categories, $scheme->component_category_id, "class=\"form-control\" required style=\"\"");
                ?>
            </div>
            <?php echo form_error("component_category_id", "<p class=\"text-danger\">", "</p>"); ?>
        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('scheme_code'), "scheme_code", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "scheme_code",
                    "id"            =>  "scheme_code",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('scheme_code'),
                    "value"         =>  set_value("scheme_code", $scheme->scheme_code),
                    "placeholder"   =>  $this->lang->line('scheme_code')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("scheme_code", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('scheme_name'), "scheme_name", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "scheme_name",
                    "id"            =>  "scheme_name",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('scheme_name'),
                    "value"         =>  set_value("scheme_name", $scheme->scheme_name),
                    "placeholder"   =>  $this->lang->line('scheme_name')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("scheme_name", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('water_source'), "water_source", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "water_source",
                    "id"            =>  "water_source",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('water_source'),
                    "value"         =>  set_value("water_source", $scheme->water_source),
                    "placeholder"   =>  $this->lang->line('water_source')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("water_source", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('latitude'), "latitude", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "latitude",
                    "id"            =>  "latitude",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('latitude'),
                    "value"         =>  set_value("latitude", $scheme->latitude),
                    "placeholder"   =>  $this->lang->line('latitude')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("latitude", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('longitude'), "longitude", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "longitude",
                    "id"            =>  "longitude",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('longitude'),
                    "value"         =>  set_value("longitude", $scheme->longitude),
                    "placeholder"   =>  $this->lang->line('longitude')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("longitude", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>



        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('male_beneficiaries'), "male_beneficiaries", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "male_beneficiaries",
                    "id"            =>  "male_beneficiaries",
                    "class"         =>  "form-control beneficiaries",
                    "style"         =>  "",
                    "required"      => "required",
                    "title"         =>  $this->lang->line('male_beneficiaries'),
                    "value"         =>  set_value("male_beneficiaries", $scheme->male_beneficiaries),
                    "placeholder"   =>  $this->lang->line('male_beneficiaries')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("male_beneficiaries", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('female_beneficiaries'), "female_beneficiaries", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "female_beneficiaries",
                    "id"            =>  "female_beneficiaries",
                    "class"         =>  "form-control beneficiaries",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('female_beneficiaries'),
                    "value"         =>  set_value("female_beneficiaries", $scheme->female_beneficiaries),
                    "placeholder"   =>  $this->lang->line('female_beneficiaries')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("female_beneficiaries", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('estimated_cost'), "estimated_cost", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "estimated_cost",
                    "id"            =>  "estimated_cost",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('estimated_cost'),
                    "value"         =>  set_value("estimated_cost", $scheme->estimated_cost),
                    "placeholder"   =>  $this->lang->line('estimated_cost')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("estimated_cost", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>


        <div class="form-group">
            <label for="registration_date" class="col-md-4 control-label" style="">Registration Date</label>
            <div class="col-md-8">
                <input type="date" name="registration_date" value="<?php echo $scheme->registration_date; ?>" id="registration_date" class="form-control" style="" required="required" title="Registration Date" placeholder="Registration Date">
            </div>



        </div>

        <div class="form-group">
            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label('Financial Year', "Financial Year Id", $label);
            ?>

            <div class="col-md-8">
                <?php
                echo form_dropdown("financial_year_id", array("" => "Select Financial Year") + $financial_years, $scheme->financial_year_id, "class=\"form-control\" required style=\"\"");
                ?>
            </div>
            <?php echo form_error("financial_year_id", "<p class=\"text-danger\">", "</p>"); ?>
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
            url: '<?php echo site_url(ADMIN_DIR . "water_user_associations/add_scheme") ?>', // URL to submit form data
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