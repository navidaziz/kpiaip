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
                <h4><i class="fa fa-users"></i> <?php echo $title; ?></h4>
            </div>
            <div class="box-body">

                <?php
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR . "water_user_associations/save_data", $add_form_attr);
                ?>

                <input type="hidden" name="project_id" value="1" />

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="file_number" class="col-md-4 control-label" style="">File / Reference No.</label>
                        <div class="col-md-8">
                            <input type="text" name="file_number" value="<?php echo set_value('file_number') ?>"
                                id="file_number" class="form-control" style="" required="required"
                                title="File / Reference No." placeholder="File / Reference No.">
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
                            "value"         =>  set_value("wua_registration_no"),
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
                            "value"         =>  set_value("wua_name"),
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
                        echo form_dropdown("district_id", array("" => "Select District") + $districts, "", "class=\"form-control\" required style=\"\"");
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
                    echo form_label($this->lang->line('tehsil_name'), "Tehsil Name", $label);
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
                            "value"         =>  set_value("tehsil_name"),
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
                            "value"         =>  set_value("union_council"),
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
                            "value"         =>  set_value("address"),
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
                            echo form_label("Bank Name", "bank_name", $label);      ?>

                        <div class="col-md-8">
                            <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "bank_name",
                            "id"            =>  "bank_name",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", 
                            "title"         =>  "Bank Name",
                            "value"         =>  set_value("bank_name"),
                            "placeholder"   =>  "Bank Name"
                        );
                        echo  form_input($text);
                        ?>
                            <?php echo form_error("bank_name", "<p class=\"text-danger\">", "</p>"); ?>
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
                            "value"         =>  set_value("bank_branch_code"),
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
                            echo form_label($this->lang->line('bank_account_title'), "bank_account_title", $label);      ?>

                        <div class="col-md-8">
                            <?php

                        $text = array(
                            "type"          =>  "text",
                            "name"          =>  "bank_account_title",
                            "id"            =>  "bank_account_title",
                            "class"         =>  "form-control",
                            "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('bank_account_title'),
                            "value"         =>  set_value("bank_account_title"),
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
                            "value"         =>  set_value("bank_account_number"),
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
                            echo form_label("WUA ".$this->lang->line('attachement'), "attachement", $label);      ?>

                        <div class="col-md-8">
                            <?php

                        $file = array(
                            "type"          =>  "file",
                            "name"          =>  "attachement",
                            "id"            =>  "attachement",
                            "class"         =>  "form-control",
                            "style"         =>  "", "title"         =>  $this->lang->line('attachement'),
                            "value"         =>  set_value("attachement"),
                            "placeholder"   =>  $this->lang->line('attachement')
                        );
                        echo  form_input($file);
                        ?>
                            <?php echo form_error("attachement", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>


                    </div>

                </div>

                <div class="col-md-4">
                    <h4>WUA Chairman Detail</h4>
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
                            "style"         =>  "", 
                            "required"      => "required", 
                            "title"         =>  'Chairman Name',
                            "value"         =>  set_value("cm_name"),
                            "placeholder"   =>  'Chairman Name'
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
                            "style"         =>  "", 
                            "required"      => "required", 
                            "title"         =>  'Father Name',
                            "value"         =>  set_value("cm_father_name"),
                            "placeholder"   =>  'Father Name'
                        );
                        echo  form_input($text);
                        ?>
                            <?php echo form_error("cm_father_name", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">
                        <label for="cm_gender" class="col-md-4 control-label" style="">Gender</label>
                        <div class="col-md-8">
                            <input type="radio" name="cm_gender" value="Male" id="cm_gender" style=""
                                required="required" class="uniform">
                            <label for="cm_gender" style="margin-left:10px;">Male</label>
                            <input type="radio" name="cm_gender" value="Female" id="cm_gender" style=""
                                required="required" class="uniform">
                            <label for="cm_gender" style="margin-left:10px;">Female</label>
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
                            "class"         =>  "form-control",
                            "style"         =>  "", 
                            "required"      => "required", 
                            "title"         =>  'CNIC',
                            "value"         =>  set_value("cm_cnic"),
                            "pattern" => '\d{5}-\d{7}-\d{1}',
                            "placeholder"   =>  'CNIC',
                            "onkeyup" => "nic_dash1(this)"
                        );
                        echo  form_input($text);
                        ?>
                            <?php echo form_error("cm_cnic", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



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
                            "style"         =>  "", 
                            "required"      => "required", 
                            "title"         =>  "Please enter an 11-digit mobile number starting with '0'",
                            "value"         =>  set_value("cm_contact_no"),
                            "placeholder"   =>  '032400000000',
                            "pattern" => '0[0-9]{10}'
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
                        "value" =>  'Add Water User Assosiation',
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


</div>
</div>
<!-- /MESSENGER -->
</div>