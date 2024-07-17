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
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."vendors/view/"); ?>"><?php echo $this->lang->line('Vendors'); ?></a>
			</li><li><?php echo $title; ?></li>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."vendors/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."vendors/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
                echo form_open_multipart(ADMIN_DIR."vendors/save_data", $add_form_attr);
            ?>
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('Vendor_Type'), "Vendor_Type", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "Vendor_Type",
                        "id"            =>  "Vendor_Type",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('Vendor_Type'),
                        "value"         =>  set_value("Vendor_Type"),
                        "placeholder"   =>  $this->lang->line('Vendor_Type')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("Vendor_Type", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_NTN'), "TaxPayer_NTN", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_NTN",
                        "id"            =>  "TaxPayer_NTN",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_NTN'),
                        "value"         =>  set_value("TaxPayer_NTN"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_NTN')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_NTN", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_CNIC'), "TaxPayer_CNIC", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_CNIC",
                        "id"            =>  "TaxPayer_CNIC",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_CNIC'),
                        "value"         =>  set_value("TaxPayer_CNIC"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_CNIC')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_CNIC", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_Name'), "TaxPayer_Name", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_Name",
                        "id"            =>  "TaxPayer_Name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_Name'),
                        "value"         =>  set_value("TaxPayer_Name"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_Name')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_Name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_City'), "TaxPayer_City", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_City",
                        "id"            =>  "TaxPayer_City",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_City'),
                        "value"         =>  set_value("TaxPayer_City"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_City')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_City", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_Address'), "TaxPayer_Address", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_Address",
                        "id"            =>  "TaxPayer_Address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_Address'),
                        "value"         =>  set_value("TaxPayer_Address"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_Address')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_Address", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_Status'), "TaxPayer_Status", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_Status",
                        "id"            =>  "TaxPayer_Status",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_Status'),
                        "value"         =>  set_value("TaxPayer_Status"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_Status')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_Status", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('TaxPayer_Business_Name'), "TaxPayer_Business_Name", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "TaxPayer_Business_Name",
                        "id"            =>  "TaxPayer_Business_Name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('TaxPayer_Business_Name'),
                        "value"         =>  set_value("TaxPayer_Business_Name"),
                        "placeholder"   =>  $this->lang->line('TaxPayer_Business_Name')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("TaxPayer_Business_Name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('Focal_Person'), "Focal_Person", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "Focal_Person",
                        "id"            =>  "Focal_Person",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('Focal_Person'),
                        "value"         =>  set_value("Focal_Person"),
                        "placeholder"   =>  $this->lang->line('Focal_Person')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("Focal_Person", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('Contact_No'), "Contact_No", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "Contact_No",
                        "id"            =>  "Contact_No",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('Contact_No'),
                        "value"         =>  set_value("Contact_No"),
                        "placeholder"   =>  $this->lang->line('Contact_No')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("Contact_No", "<p class=\"text-danger\">", "</p>"); ?>
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
