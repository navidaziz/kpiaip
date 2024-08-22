<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">

            <div class="box-body">
                <h4><?php echo $title; ?></h4>
                <?php
                    
                    $query="SELECT * FROM component_categories as c 
                            WHERE c.component_category_id = ? ";
                    $component_category = $this->db->query($query, $annual_work_plan->component_category_id)->row();
                 ?>
                <h3><?php echo $component_category->category." ".$component_category->category_detail; ?></h3>
                <form id="data_form" class="form-horizontal" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">


                    <?php echo form_hidden("annual_work_plan_id", $annual_work_plan->annual_work_plan_id); ?>
                    <?php echo form_hidden("component_category_id", $annual_work_plan->component_category_id); ?>
                    <?php echo form_hidden("project_id", $annual_work_plan->project_id); ?>
                    <?php echo form_hidden("component_id", $annual_work_plan->component_id); ?>
                    <?php echo form_hidden("sub_component_id", $annual_work_plan->sub_component_id); ?>
                    <?php echo form_hidden("financial_year_id", $annual_work_plan->financial_year_id); ?>
                    <?php echo form_hidden("component_category_id", $annual_work_plan->component_category_id); ?>


                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-4 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('anual_target'), "anual_target", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "anual_target",
                                "id"            =>  "anual_target",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('anual_target'),
                                "value"         =>  set_value("anual_target", $annual_work_plan->anual_target),
                                "placeholder"   =>  $this->lang->line('anual_target')
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("anual_target", "<p class=\"text-danger\">", "</p>"); ?>
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

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "material_cost",
                                "id"            =>  "material_cost",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", 
                                "title"         =>  $this->lang->line('material_cost'),
                                "value"         =>  set_value("material_cost", $annual_work_plan->material_cost),
                                "placeholder"   =>  $this->lang->line('material_cost'),
                                "onkeyup" => "calculate_farmar_share()"
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("material_cost", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>
                        <script>
                        function calculate_farmar_share() {
                            // Get the material cost value from the input field
                            var material_cost = parseFloat($('#material_cost').val());

                            // Define the percentage for labor cost (25% of the total cost)
                            var labor_percentage = <?php echo $component_category->farmer_share;  ?>;

                            // Calculate the total cost based on the material cost and the percentage share for labor
                            var total_cost = material_cost / (1 - labor_percentage / 100);

                            // Calculate the labor cost as the difference between total cost and material cost
                            var labor_cost = total_cost - material_cost;

                            // Set the calculated labor cost in the corresponding input field
                            $('#labor_cost').val(labor_cost.toFixed(2));
                        }
                        </script>


                    </div>


                    <div style="text-align: center;">
                        <h4><?php echo "Farmar Share: ".$component_category->farmer_share; ?></h4>
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

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "labor_cost",
                                "id"            =>  "labor_cost",
                                "class"         =>  "form-control",
                                "style"         =>  "", 
                                "required"      => "required", 
                                "title"         =>  $this->lang->line('labor_cost'),
                                "readonly" => "readonly",
                                "value"         =>  set_value("labor_cost", $annual_work_plan->labor_cost),
                                "placeholder"   =>  $this->lang->line('labor_cost')
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("labor_cost", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>


                    <div style="text-align: center;" class="col-md-12">
                        <?php
                        if ($annual_work_plan->annual_work_plan_id == 0) {
                            $submit = array(
                                "type"  =>  "submit",
                                "name"  =>  "submit",
                                "value" =>  "Add Details",
                                "class" =>  "btn btn-primary",
                                "style" =>  ""
                            );
                        } else {
                            $submit = array(
                                "type"  =>  "submit",
                                "name"  =>  "submit",
                                "value" =>  "Update Details",
                                "class" =>  "btn btn-success",
                                "style" =>  ""
                            );
                        }
                        echo form_submit($submit);
                        ?>

                        <div id="result_response"></div>

                    </div>

                    <div style="clear:both;"></div>

                    <?php echo form_close(); ?>

            </div>

        </div>
    </div>

</div>
<script>
$('#data_form').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $(this).serialize();

    // Send AJAX request
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "annual_work_plans/add_awp") ?>', // URL to submit form data
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