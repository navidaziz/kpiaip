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
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a
                        href="<?php echo site_url(ADMIN_DIR . "water_user_associations/view/"); ?>"><?php echo $this->lang->line('Water User Associations'); ?></a>
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
                        <a class="btn btn-primary btn-sm"
                            href="<?php echo site_url(ADMIN_DIR . "water_user_associations/add"); ?>"><i
                                class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm"
                            href="<?php echo site_url(ADMIN_DIR . "water_user_associations/trashed"); ?>"><i
                                class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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

            </div>
            <div class="box-body">

                <?php
                $edit_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR . "water_user_associations/update_data/$water_user_association->water_user_association_id", $edit_form_attr);
                ?>
                <?php echo form_hidden("water_user_association_id", $water_user_association->water_user_association_id); ?>

                <?php echo form_hidden("project_id", $water_user_association->project_id); ?>

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="file_number" class="col-md-4 control-label" style="">File / Reference No.</label>
                        <div class="col-md-8">
                            <input type="text" name="file_number"
                                value="<?php echo $water_user_association->file_number ?>" id="file_number"
                                class="form-control" style="" required="required" title="File / Reference No."
                                placeholder="File / Reference No.">
                        </div>



                    </div>
                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-4 control-label",
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

                            <?php if ($this->session->flashdata('wua_registration_no')): ?>
                            <p class="text-danger">
                                <?php echo $this->session->flashdata('wua_registration_no'); ?>
                            </p>
                            <?php endif; ?>

                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                            $label = array(
                                "class" => "col-md-4 control-label",
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
                                "class" => "col-md-4 control-label",
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
                            "class" => "col-md-4 control-label",
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
                            "class" => "col-md-4 control-label",
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
                                "class" => "col-md-4 control-label",
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
                </div>
                <div class="col-md-4">
                    <h4>WUA Bank Detail</h4>
                    <div class="form-group">

                        <?php
                    $label = array(
                        "class" => "col-md-4 control-label",
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
                        "class" => "col-md-4 control-label",
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
                        "class" => "col-md-4 control-label",
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
                        "class" => "col-md-4 control-label",
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


                </div>
                <div class="col-md-4">

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-4 control-label",
                            "style" => "",
                        );
                        echo form_label('Chairman Name', "cm_name", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "cm_name",
                                "id"            =>  "cm_name",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('cm_name'),
                                "value"         =>  set_value("cm_name", $water_user_association->cm_name),
                                "placeholder"   =>  $this->lang->line('cm_name')
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("cm_name", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                            $label = array(
                                "class" => "col-md-4 control-label",
                                "style" => "",
                            );
                            echo form_label('Father Name', "cm_father_name", $label);      ?>

                        <div class="col-md-8">
                            <?php

                                $text = array(
                                    "type"          =>  "text",
                                    "name"          =>  "cm_father_name",
                                    "id"            =>  "cm_father_name",
                                    "class"         =>  "form-control",
                                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('cm_father_name'),
                                    "value"         =>  set_value("cm_father_name", $water_user_association->cm_father_name),
                                    "placeholder"   =>  $this->lang->line('cm_father_name')
                                );
                                echo  form_input($text);
                                ?>
                            <?php echo form_error("cm_father_name", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">
                        <?php
                            $label = array(
                                "class" => "col-md-4 control-label",
                                "style" => "",
                            );
                            echo form_label('Gender', "cm_gender", $label);
                            ?>

                        <div class="col-md-8">
                            <?php
                                $options = array("Male" => "Male", "Female" => "Female");
                                foreach ($options as $option_value => $options_name) {

                                    $data = array(
                                        "name"        => "cm_gender",
                                        "id"          => "cm_gender",
                                        "value"       => $option_value,
                                        "style"       => "", "required"      => "required",
                                        "class"       => "uniform"
                                    );
                                    if ($option_value == $water_user_association->cm_gender) {
                                        $data["checked"] = TRUE;
                                    }
                                    echo form_radio($data) . "<label for=\"cm_gender\" style=\"margin-left:10px;\">$options_name</label>";
                                }
                                ?>
                            <?php echo form_error("cm_gender", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>
                    </div>


                    <div class="form-group">

                        <?php
                            $label = array(
                                "class" => "col-md-4 control-label",
                                "style" => "",
                            );
                            echo form_label('CNIC', "cm_cnic", $label);      ?>

                        <div class="col-md-8">
                            <?php

                                $text = array(
                                    "type"          =>  "text",
                                    "name"          =>  "cm_cnic",
                                    "id"            =>  "cm_cnic",
                                    "pattern"       => "\d{5}-\d{7}-\d{1}",
                                    "onKeyUp"       => "nic_dash1(this)",
                                    "class"         =>  "form-control",
                                    "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('cm_cnic'),
                                    "value"         =>  set_value("cm_cnic", $water_user_association->cm_cnic),
                                    "placeholder"   =>  $this->lang->line('cm_cnic')
                                );
                                echo  form_input($text);
                                ?>
                            <?php echo form_error("cm_cnic", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>
                        <script language="javascript">
                        function nic_dash1(t)

                        {
                            var donepatt = /^(\d{5})\/(\d{7})\/(\d{1})$/;

                            var patt = /(\d{5}).*(\d{7}).*(\d{1})/;

                            var str = t.value;

                            if (!str.match(donepatt))

                            {
                                result = str.match(patt);

                                if (result != null)

                                {
                                    t.value = t.value.replace(/[^\d]/gi, '');

                                    str = result[1] + '-' + result[2] + '-' + result[3];

                                    t.value = str;

                                } else {

                                    if (t.value.match(/[^\d]/gi))

                                        t.value = t.value.replace(/[^\d]/gi, '');

                                }
                            }
                        }
                        </script>


                    </div>

                    <div class="form-group">

                        <?php
                            $label = array(
                                "class" => "col-md-4 control-label",
                                "style" => "",
                            );
                            echo form_label('Contact No', "cm_contact_no", $label);      ?>

                        <div class="col-md-8">
                            <?php

                                $text = array(
                                    "type"          =>  "text",
                                    "name"          =>  "cm_contact_no",
                                    "id"            =>  "cm_contact_no",
                                    "class"         =>  "form-control",
                                    "pattern" => "0[0-9]{10}",
                                    "style"         =>  "",
                                    "required"      => "required",
                                    "title"         =>  "Please enter an 11-digit mobile number starting with '0'",
                                    "value"         =>  set_value("cm_contact_no", $water_user_association->cm_contact_no),
                                    "placeholder"   =>  '032400000000'
                                );
                                echo  form_input($text);
                                ?>
                            <?php echo form_error("cm_contact_no", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                </div>







                <div style="clear:both;"></div>
                <div style="text-align: center;">
                    <?php
                    $submit = array(
                        "type"  =>  "submit",
                        "name"  =>  "submit",
                        "value" =>  'Update Water User Assosiation',
                        "class" =>  "btn btn-primary",
                        "style" =>  ""
                    );
                    echo form_submit($submit);
                    ?>
                </div>

                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>