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
                    <a href="<?php echo site_url(ADMIN_DIR . "financial_years/view/"); ?>"><?php echo $this->lang->line('Financial Years'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "financial_years/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "financial_years/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                echo form_open_multipart(ADMIN_DIR . "financial_years/save_data", $add_form_attr);
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
                    echo form_label($this->lang->line('start_date'), "start_date", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $date = array(
                            "type"          =>  "date",
                            "name"          =>  "start_date",
                            "id"            =>  "start_date",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "required"      => "required",
                            "title"         =>  $this->lang->line('start_date'),
                            "value"         =>  set_value("start_date"),
                            "placeholder"   =>  $this->lang->line('start_date')
                        );
                        echo  form_input($date);
                        ?>
                        <?php echo form_error("start_date", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('end_date'), "end_date", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $date = array(
                            "type"          =>  "date",
                            "name"          =>  "end_date",
                            "id"            =>  "end_date",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "required"      => "required",
                            "title"         =>  $this->lang->line('end_date'),
                            "value"         =>  set_value("end_date"),
                            "placeholder"   =>  $this->lang->line('end_date')
                        );
                        echo  form_input($date);
                        ?>
                        <?php echo form_error("end_date", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('financial_year'), "financial_year", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "financial_year",
                            "id"            =>  "financial_year",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "required"      => "required",
                            "title"         =>  $this->lang->line('financial_year'),
                            "value"         =>  set_value("financial_year"),
                            "placeholder"   =>  $this->lang->line('financial_year')
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("financial_year", "<p class=\"text-danger\">", "</p>"); ?>
                    </div>



                </div>

                <div class="form-group">

                    <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label('Forex', "forex", $label);      ?>

                    <div class="col-md-8">
                        <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "forex",
                            "id"            =>  "forex",
                            "class"         =>  "form-control",
                            "style"         =>  "",
                            "required"      => "required",
                            "title"         =>  'Forex',
                            "value"         =>  set_value("forex"),
                            "placeholder"   =>  'Forex'
                        );
                        echo  form_input($text);
                        ?>
                        <?php echo form_error("forex", "<p class=\"text-danger\">", "</p>"); ?>
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