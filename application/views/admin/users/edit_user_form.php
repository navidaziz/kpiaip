<script>
$("form#user_form_data").submit(function(e) {

    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: site_url + '/users/update_user_data',
        type: 'POST',
        data: formData,
        success: function(data) {
            //alert(data);
            if (data == 'success') {
                location.reload();
                return false;
            } else {
                $('#open_model_body').html(data);
            }
            //$('.modal-body').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
<?php
             $edit_form_attr = array("class" => "form-horizontal",
						"id" => "user_form_data");
                echo form_open_multipart("#", $edit_form_attr);
            ?>
<?php echo form_hidden("user_id", $user->user_id); ?>

<input type="hidden" name="restaurant_id" id="restaurant_id" value="<?php echo $restaurant_id; ?>" />
<input type="hidden" name="role_id" id="role_id" value="<?php echo $user->role_id; ?>" />
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('user_title'), "user_title", $label);      ?>
    <div class="col-md-8">
        <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_title",
                        "id"            =>  "user_title",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('user_title'),
                        "value"         =>  set_value("user_title", $user->user_title),
                        "placeholder"   =>  $this->lang->line('user_title')
                    );
                    echo  form_input($text);
                ?>
        <?php echo form_error("user_title", "<p class=\"text-danger\">", "</p>"); ?> </div>
</div>
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('user_email'), "user_email", $label);      ?>
    <div class="col-md-8">
        <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_email",
                        "id"            =>  "user_email",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('user_email'),
                        "value"         =>  set_value("user_email", $user->user_email),
                        "placeholder"   =>  $this->lang->line('user_email')
                    );
                    echo  form_input($text);
                ?>
        <?php echo form_error("user_email", "<p class=\"text-danger\">", "</p>"); ?> </div>
</div>
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('user_mobile_number'), "user_mobile_number", $label);      ?>
    <div class="col-md-8">
        <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_mobile_number",
                        "id"            =>  "user_mobile_number",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('user_mobile_number'),
                        "value"         =>  set_value("user_mobile_number", $user->user_mobile_number),
                        "placeholder"   =>  $this->lang->line('user_mobile_number')
                    );
                    echo  form_input($text);
                ?>
        <?php echo form_error("user_mobile_number", "<p class=\"text-danger\">", "</p>"); ?> </div>
</div>
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('user_name'), "user_name", $label);      ?>
    <div class="col-md-8">
        <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_name",
                        "id"            =>  "user_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('user_name'),
                        "value"         =>  set_value("user_name", $user->user_name),
                        "placeholder"   =>  $this->lang->line('user_name')
                    );
                    echo  form_input($text);
                ?>
        <?php echo form_error("user_name", "<p class=\"text-danger\">", "</p>"); ?> </div>
</div>
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('user_password'), "user_password", $label);      ?>
    <div class="col-md-8">
        <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_password",
                        "id"            =>  "user_password",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('user_password'),
                        "value"         =>  set_value("user_password", $user->user_password),
                        "placeholder"   =>  $this->lang->line('user_password')
                    );
                    echo  form_input($text);
                ?>
        <?php echo form_error("user_password", "<p class=\"text-danger\">", "</p>"); ?> </div>
</div>
<div class="form-group">
    <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    );  echo form_label($this->lang->line('user_image')."<br />".file_type(base_url("assets/uploads/".$user->user_image)), "user_image", $label);     ?>
    <div class="col-md-8">
        <?php
                    
                    $file = array(
                        "type"          =>  "file",
                        "name"          =>  "user_image",
                        "id"            =>  "user_image",
                        "class"         =>  "form-control",
                        "style"         =>  "",

                        "title"         =>  $this->lang->line('user_image'),
                        "value"         =>  set_value("user_image", $user->user_image),
                        "placeholder"   =>  $this->lang->line('user_image')
                    );
                    echo  form_input($file);
                ?>
        <!--<?php echo file_type(base_url("assets/uploads/$user->user_image")); ?>-->

        <?php echo form_error("user_image", "<p class=\"text-danger\">", "</p>"); ?>
    </div>
</div>


<div class="col-md-12">
    <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  $this->lang->line('Update'),
                    "class" =>  "btn btn-primary pull-right",
                    "style" =>  ""
                );
                echo form_submit($submit); 
            ?>

</div>
<div style="clear:both;"></div>
<?php echo form_close(); ?>