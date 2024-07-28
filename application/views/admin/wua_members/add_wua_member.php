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
                    <a href="<?php echo site_url(ADMIN_DIR . "wua_members/view/"); ?>"><?php echo $this->lang->line('Wua Members'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "wua_members/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "wua_members/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR . "wua_members/save_data", $add_form_attr);
                ?>

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
                        echo form_dropdown("project_id", $projects, "", "class=\"form-control\" required style=\"\"");
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
                        echo form_dropdown("district_id", $districts, "", "class=\"form-control\" required style=\"\"");
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
                    echo form_label($this->lang->line('tehsil_name'), "Tehsil Id", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        echo form_dropdown("tehsil_id", $tehsils, "", "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("tehsil_id", "<p class=\"text-danger\">", "</p>"); ?>
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
                        echo form_dropdown("water_user_association_id", $water_user_associations, "", "class=\"form-control\" required style=\"\"");
                        ?>
                    </div>
                    <?php echo form_error("water_user_association_id", "<p class=\"text-danger\">", "</p>"); ?>
                </div>


                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('member_type'), "member_type", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "member_type",
                            "id"            =>  "member_type",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('member_type'),
                            "value"         =>  set_value("member_type"),
                            "placeholder"   =>  $this->lang->line('member_type')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("member_type", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
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
                            "value"         =>  set_value("member_name"),
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
                        "class" => "col-md-2 control-label",
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
                            "value"         =>  set_value("member_father_name"),
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
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('member_gender'), "member_gender", $label);
                    ?>

                    <div class="col-md-8">
                        <?php
                        $options = array("Yes" => "Yes", "No" => "No");
                        foreach ($options as $option_value => $options_name) {

                            $data = array(
                                "name"        => "member_gender",
                                "id"          => "member_gender",
                                "value"       => $option_value,
                                "style"       => "", "required"      => "required",
                                "class"       => "uniform"
                            );
                            echo form_radio($data) . "<label for=\"member_gender\" style=\"margin-left:10px;\">$options_name</label><br />";
                        }
                        ?>
                        <?php echo form_error("member_gender", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>
                </div>


                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('member_cnic'), "member_cnic", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "member_cnic",
                            "id"            =>  "member_cnic",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('member_cnic'),
                            "value"         =>  set_value("member_cnic"),
                            "placeholder"   =>  $this->lang->line('member_cnic')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("member_cnic", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('attachment'), "attachment", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $file = array(
                            "type"          =>  "file",
                            "name"          =>  "attachment",
                            "id"            =>  "attachment",
                            "class"         =>  "form-control",
                            "style"         =>  "", "title"         =>  $this->lang->line('attachment'),
                            "value"         =>  set_value("attachment"),
                            "placeholder"   =>  $this->lang->line('attachment')
                        );
                        echo  form_input($file);
                        ?>
                        <?php echo form_error("attachment", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="col-md-offset-2 col-md-10">
                    <?php
                    $submit = array(
                        "type"  =>  "submit",
                        "name"  =>  "submit",
                        "value" =>  $this->lang->line('Save'),
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