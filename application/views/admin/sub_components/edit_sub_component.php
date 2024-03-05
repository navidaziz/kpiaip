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
                    <a href="<?php echo site_url(ADMIN_DIR . "sub_components/view/"); ?>"><?php echo $this->lang->line('Sub Components'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "sub_components/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "sub_components/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                echo form_open_multipart(ADMIN_DIR . "sub_components/update_data/$sub_component->sub_component_id", $edit_form_attr);
                ?>
                <?php echo form_hidden("sub_component_id", $sub_component->sub_component_id); ?>

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
                        echo form_dropdown("project_id", $projects, $sub_component->project_id, "class=\"form-control\" required style=\"\"");
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
                        echo form_dropdown("component_id", $components, $sub_component->component_id, "class=\"form-control\" required style=\"\"");
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
                    echo form_label($this->lang->line('sub_component_name'), "sub_component_name", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "sub_component_name",
                            "id"            =>  "sub_component_name",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('sub_component_name'),
                            "value"         =>  set_value("sub_component_name", $sub_component->sub_component_name),
                            "placeholder"   =>  $this->lang->line('sub_component_name')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("sub_component_name", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('sub_component_detail'), "sub_component_detail", $label);
                    ?>

                    <div class="col-md-8">
                        <?php

                        $textarea = array(
                            "name"          =>  "sub_component_detail",
                            "id"            =>  "sub_component_detail",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "title"         =>  $this->lang->line('sub_component_detail'), "required"      => "required",
                            "rows"          =>  "",
                            "cols"          =>  "",
                            "value"         => set_value("sub_component_detail", $sub_component->sub_component_detail),
                            "placeholder"   =>  $this->lang->line('sub_component_detail')
                        );
                        echo form_textarea($textarea);
                        ?>
                        <?php echo form_error("sub_component_detail", "<p class=\"text-danger\">", "</p>"); ?>
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