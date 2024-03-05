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
                    "title"         =>  $this->lang->line('category_detail'), "required"      => "required",
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

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('target'), "target", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "target",
                    "id"            =>  "target",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('target'),
                    "value"         =>  set_value("target", $component_category->target),
                    "placeholder"   =>  $this->lang->line('target')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("target", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('material_cost'), "material_cost", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "material_cost",
                    "id"            =>  "material_cost",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('material_cost'),
                    "value"         =>  set_value("material_cost", $component_category->material_cost),
                    "placeholder"   =>  $this->lang->line('material_cost')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("material_cost", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('labor_cost'), "labor_cost", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "labor_cost",
                    "id"            =>  "labor_cost",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('labor_cost'),
                    "value"         =>  set_value("labor_cost", $component_category->labor_cost),
                    "placeholder"   =>  $this->lang->line('labor_cost')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("labor_cost", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('farmer_share'), "farmer_share", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "farmer_share",
                    "id"            =>  "farmer_share",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('farmer_share'),
                    "value"         =>  set_value("farmer_share", $component_category->farmer_share),
                    "placeholder"   =>  $this->lang->line('farmer_share')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("farmer_share", "<p class=\"text-danger\">", "</p>"); ?>
            </div>



        </div>

        <div class="form-group">

            <?php
            $label = array(
                "class" => "col-md-4 control-label",
                "style" => "",
            );
            echo form_label($this->lang->line('total_cost'), "total_cost", $label);      ?>

            <div class="col-md-8">
                <?php

                $number = array(
                    "type"          =>  "number",
                    "name"          =>  "total_cost",
                    "id"            =>  "total_cost",
                    "class"         =>  "form-control",
                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('total_cost'),
                    "value"         =>  set_value("total_cost", $component_category->total_cost),
                    "placeholder"   =>  $this->lang->line('total_cost')
                );
                echo  form_input($number);
                ?>
                <?php echo form_error("total_cost", "<p class=\"text-danger\">", "</p>"); ?>
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