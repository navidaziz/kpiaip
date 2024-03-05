<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "component_categories/view/"); ?>"><?php echo $this->lang->line('Component Categories'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "component_categories/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "component_categories/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
                <!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
            </div>
            <div class="box-body">

                <?php
                $edit_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR . "component_categories/update_data/$component_category->component_category_id", $edit_form_attr);
                ?>
                <?php echo form_hidden("component_category_id", $component_category->component_category_id); ?>

                <div class="form-group">
                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('project_name'), "Project Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("project_id", $projects, $component_category->project_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("project_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">
                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('component_name'), "Component Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("component_id", $components, $component_category->component_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("component_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">
                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('sub_component_name'), "Sub Component Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("sub_component_id", $sub_components, $component_category->sub_component_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("sub_component_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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

                <div class="col-md-offset-2 col-md-10">
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

                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>