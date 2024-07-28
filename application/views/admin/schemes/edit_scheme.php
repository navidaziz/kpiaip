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
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "schemes/view/"); ?>"><?php echo $this->lang->line('Schemes'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "schemes/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "schemes/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                echo form_open_multipart(ADMIN_DIR . "schemes/update_data/$scheme->scheme_id", $edit_form_attr);
                ?>
                <?php echo form_hidden("scheme_id", $scheme->scheme_id); ?>

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
                        echo form_dropdown("project_id", $projects, $scheme->project_id, "class=\"form-control\" required style=\"\"");
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
                    echo form_label($this->lang->line('district_name'), "District Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("district_id", $districts, $scheme->district_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("district_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">
                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('category'), "Component Category Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("component_category_id", $component_categories, $scheme->component_category_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("component_category_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
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
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('beneficiaries'), "beneficiaries", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "beneficiaries",
                            "id"            =>  "beneficiaries",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('beneficiaries'),
                            "value"         =>  set_value("beneficiaries", $scheme->beneficiaries),
                            "placeholder"   =>  $this->lang->line('beneficiaries')
                        );
                        echo  form_input($number);
                        ?>
                        <?php echo form_error("beneficiaries", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('male_beneficiaries'), "male_beneficiaries", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "male_beneficiaries",
                            "id"            =>  "male_beneficiaries",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('male_beneficiaries'),
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
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('female_beneficiaries'), "female_beneficiaries", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "female_beneficiaries",
                            "id"            =>  "female_beneficiaries",
                            "class"         =>  "form-control",
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
                        "class" => "col-md-2 control-label",
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

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('approved_cost'), "approved_cost", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "approved_cost",
                            "id"            =>  "approved_cost",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('approved_cost'),
                            "value"         =>  set_value("approved_cost", $scheme->approved_cost),
                            "placeholder"   =>  $this->lang->line('approved_cost')
                        );
                        echo  form_input($number);
                        ?>
                        <?php echo form_error("approved_cost", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('revised_cost'), "revised_cost", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "revised_cost",
                            "id"            =>  "revised_cost",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('revised_cost'),
                            "value"         =>  set_value("revised_cost", $scheme->revised_cost),
                            "placeholder"   =>  $this->lang->line('revised_cost')
                        );
                        echo  form_input($number);
                        ?>
                        <?php echo form_error("revised_cost", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('sanctioned_cost'), "sanctioned_cost", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $number = array(
                            "type"          =>  "number",
                            "name"          =>  "sanctioned_cost",
                            "id"            =>  "sanctioned_cost",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('sanctioned_cost'),
                            "value"         =>  set_value("sanctioned_cost", $scheme->sanctioned_cost),
                            "placeholder"   =>  $this->lang->line('sanctioned_cost')
                        );
                        echo  form_input($number);
                        ?>
                        <?php echo form_error("sanctioned_cost", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">
                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('wua_name'), "Water User Association Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("water_user_association_id", $water_user_associations, $scheme->water_user_association_id, "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("water_user_association_id", "<p class=\"text-danger\">", "</p>"); ?>
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