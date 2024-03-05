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
                    <a href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/"); ?>"><?php echo $this->lang->line('Water User Associations'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                echo form_open_multipart(ADMIN_DIR . "water_user_associations/update_data/$water_user_association->water_user_association_id", $edit_form_attr);
                ?>
                <?php echo form_hidden("water_user_association_id", $water_user_association->water_user_association_id); ?>

                <?php echo form_hidden("project_id", $water_user_association->project_id); ?>
                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('wua_registration_no'), "wua_registration_no", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "wua_registration_no",
                            "id"            =>  "wua_registration_no",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('wua_registration_no'),
                            "value"         =>  set_value("wua_registration_no", $water_user_association->wua_registration_no),
                            "placeholder"   =>  $this->lang->line('wua_registration_no')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("wua_registration_no", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('wua_name'), "wua_name", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "wua_name",
                            "id"            =>  "wua_name",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('wua_name'),
                            "value"         =>  set_value("wua_name", $water_user_association->wua_name),
                            "placeholder"   =>  $this->lang->line('wua_name')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("wua_name", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



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
                        echo form_dropdown("district_id", $districts, $water_user_association->district_id, "class=\"form-control\" required style=\"\"");
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

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "tehsil_name",
                            "id"            =>  "tehsil_name",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "required"      => "required",
                            "title"         =>  $this->lang->line('tehsil_name'),
                            "value"         =>  set_value("tehsil_name", $water_user_association->tehsil_name),
                            "placeholder"   =>  $this->lang->line('tehsil_name')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("tehsil_name", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>

                </div>


                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('union_council'), "union_council", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "union_council",
                            "id"            =>  "union_council",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('union_council'),
                            "value"         =>  set_value("union_council", $water_user_association->union_council),
                            "placeholder"   =>  $this->lang->line('union_council')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("union_council", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('address'), "address", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "address",
                            "id"            =>  "address",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('address'),
                            "value"         =>  set_value("address", $water_user_association->address),
                            "placeholder"   =>  $this->lang->line('address')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("address", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>



                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('bank_account_title'), "bank_account_title", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "bank_account_title",
                            "id"            =>  "bank_account_title",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('bank_account_title'),
                            "value"         =>  set_value("bank_account_title", $water_user_association->bank_account_title),
                            "placeholder"   =>  $this->lang->line('bank_account_title')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("bank_account_title", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('bank_account_number'), "bank_account_number", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "bank_account_number",
                            "id"            =>  "bank_account_number",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('bank_account_number'),
                            "value"         =>  set_value("bank_account_number", $water_user_association->bank_account_number),
                            "placeholder"   =>  $this->lang->line('bank_account_number')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("bank_account_number", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('bank_branch_code'), "bank_branch_code", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "bank_branch_code",
                            "id"            =>  "bank_branch_code",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('bank_branch_code'),
                            "value"         =>  set_value("bank_branch_code", $water_user_association->bank_branch_code),
                            "placeholder"   =>  $this->lang->line('bank_branch_code')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("bank_branch_code", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('attachement') . "<br />" . file_type(base_url("assets/uploads/" . $water_user_association->attachement)), "attachement", $label);     ?>

                    <div class="col-md-8">
                        <?php

                        $file = array(
                            "type"          =>  "file",
                            "name"          =>  "attachement",
                            "id"            =>  "attachement",
                            "class"         =>  "form-control",
                            "style"         =>  "", "title"         =>  $this->lang->line('attachement'),
                            "value"         =>  set_value("attachement", $water_user_association->attachement),
                            "placeholder"   =>  $this->lang->line('attachement')
                        );
                        echo  form_input($file);
                        ?>
                        <!--<?php echo file_type(base_url("assets/uploads/$water_user_association->attachement")); ?>-->

                        <?php echo form_error("attachement", "<p class=\"text-danger\">", "</p>"); ?>
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