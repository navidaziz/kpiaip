<form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="box-body">

        <h4 style="text-align: center;"> <?php echo $title; ?></h4>


        <?php echo form_hidden("component_category_id", $component_category->component_category_id); ?>
        <?php echo form_hidden("project_id", $component_category->project_id); ?>
        <?php echo form_hidden("component_id", $component_category->component_id); ?>
        <?php echo form_hidden("sub_component_id", $component_category->sub_component_id); ?>


        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label('Account Code', "account_code", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "account_code",
                    "id"            =>  "account_code",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", 
                    "title"         =>  'account_code',
                    "value"         =>  set_value("account_code", $component_category->account_code),
                    "placeholder"   =>  'Account Code'
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("account_code", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label('Main Heading', "main_heading", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "main_heading",
                    "id"            =>  "main_heading",
                    "class"         =>  "form-control",
                    "style"         =>  "", 
                    "required"      => "required", 
                    "title"         =>  'main_heading',
                    "value"         =>  set_value("main_heading", $component_category->main_heading),
                    "placeholder"   =>  'Main Heading'
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("main_heading", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('category'), "category", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "category",
                    "id"            =>  "category",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('category'),
                    "value"         =>  set_value("category", $component_category->category),
                    "placeholder"   =>  $this->lang->line('category')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("category", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('category_detail'), "category_detail", $label);
            ?>

            <div class="col-md-8">
                <?php

                $textarea = array(
                    "name"          =>  "category_detail",
                    "id"            =>  "category_detail",
                    "class"         =>  "form-control",
                    "style"         =>  "",
                    "title"         =>  $this->lang->line('category_detail'),

                    "rows"          =>  "",
                    "cols"          =>  "",
                    "value"         => set_value("category_detail", $component_category->category_detail),
                    "placeholder"   =>  $this->lang->line('category_detail')
                );
                echo form_textarea($textarea);
                ?>
                <?php echo form_error("category_detail", "<p class=\"text-danger\">", "</p>"); ?>
            </div>

        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('target_unit'), "target_unit", $label);      ?>

            <div class="col-md-8">
                <?php

                $text = array(
                    "type"          =>  "text",
                    "name"          =>  "target_unit",
                    "id"            =>  "target_unit",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('target_unit'),
                    "value"         =>  set_value("target_unit", $component_category->target_unit),
                    "placeholder"   =>  $this->lang->line('target_unit')
                );
                echo  form_input($text);
                ?>
                <?php echo form_error("target_unit", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>


        <div class="col-md-12" id="result_response"></div>

        <div style="text-align: center;" class="col-md-12">
            <?php
            if ($component_category->component_category_id == 0) {
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Add New Category",
                    "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
            } else {
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  "Update Category Details",
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
            url: '<?php echo site_url(ADMIN_DIR . "sub_components/add_component_category") ?>', // URL to submit form data
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