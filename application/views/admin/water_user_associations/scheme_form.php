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
            echo form_label($this->lang->line('scheme_name'), "scheme_name", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "scheme_name",
                    "id"            =>  "scheme_name",
                    "class"         =>  "form-control",
                    "style"         =>  "",
                    "required"      => "requ ired",
                    "title"         =>  $this->lang->line('scheme_name'),
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
            <label for="tehsil" class="col-sm-4 control-label">Tehsil</label>
            <div class="col-sm-8">
                <input type="text" required id="tehsil" name="tehsil" value="<?php echo $scheme->tehsil; ?>"
                    class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="uc" class="col-sm-4 control-label">UC</label>
            <div class="col-sm-8">
                <input type="text" required id="uc" name="uc" value="<?php echo $scheme->uc; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="villege" class="col-sm-4 control-label">Village</label>
            <div class="col-sm-8">
                <input type="text" required id="villege" name="villege" value="<?php echo $scheme->villege; ?>"
                    class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="na" class="col-sm-4 control-label">NA</label>
            <div class="col-sm-8">
                <input type="number" required id="na" name="na" value="<?php echo $scheme->na; ?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="pk" class="col-sm-4 control-label">PK</label>
            <div class="col-sm-8">
                <input type="number" required id="pk" name="pk" value="<?php echo $scheme->pk; ?>" class="form-control">
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
                    "style"         =>  "",
                    "requ ired"      => "requ ired",
                    "title"         =>  $this->lang->line('latitude'),
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
                    "style"         =>  "",
                    "requ ired"      => "requ ired",
                    "title"         =>  $this->lang->line('longitude'),
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
                    "requ ired"      => "requ ired",
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
                    "style"         =>  "",
                    "requ ired"      => "requ ired",
                    "title"         =>  $this->lang->line('female_beneficiaries'),
                    "value"         =>  set_value("female_beneficiaries", $scheme->female_beneficiaries),
                    "placeholder"   =>  $this->lang->line('female_beneficiaries')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("female_beneficiaries", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>



        <div class="form-group">
            <label for="registration_date" class="col-md-4 control-label" style="">Registration Date</label>
            <div class="col-md-8">
                <input type="date" name="registration_date" value="<?php echo $scheme->registration_date; ?>"
                    id="registration_date" class="form-control" style="" required="required" title="Registration Date"
                    placeholder="Registration Date">
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

            <?php if ($scheme->scheme_id == 0) { ?>
                <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Add New Scheme",
                    "class" =>  "btn btn-danger",
                    "style" =>  ""
                );
                echo form_submit($submit);
                ?>

            <?php } else { ?>
                <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Update Scheme Detail",
                    "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
                echo form_submit($submit);
                ?>
            <?php } ?>


        </div>
        <div style="clear:both;"></div>

    </form>
    <?php $this->load->view(ADMIN_DIR . "water_user_associations/expense_reference"); ?>
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