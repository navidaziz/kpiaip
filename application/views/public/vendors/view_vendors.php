<!-- PAGE HEADER-->
<div class="breadcrumb-box">
  <div class="container">
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url("Home"); ?>">Home</a>
					<span class="divider">/</span>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url("vendors/view/"); ?>">Vendors</a>
				<span class="divider">/</span>
			</li><li ><?php echo $title; ?> </li>
				</ul>
			</div>
		</div>
		<!-- .breadcrumb-box --><section id="main">
			  <header class="page-header">
				<div class="container">
				  <h1 class="title"><?php echo $title; ?></h1>
				</div>
			  </header>
			  <div class="container">
			  <div class="row">
			  <?php $this->load->view(PUBLIC_DIR."components/nav"); ?><div class="content span9 pull-right">
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					  <?php foreach($vendors as $vendors): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('Vendor_Type'); ?></th>
                <td>
                    <?php echo $vendors->Vendor_Type; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_NTN'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_NTN; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_CNIC'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_CNIC; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_Name'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_Name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_City'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_City; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_Address'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_Address; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_Status'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_Status; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('TaxPayer_Business_Name'); ?></th>
                <td>
                    <?php echo $vendors->TaxPayer_Business_Name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('Focal_Person'); ?></th>
                <td>
                    <?php echo $vendors->Focal_Person; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('Contact_No'); ?></th>
                <td>
                    <?php echo $vendors->Contact_No; ?>
                </td>
            </tr>
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			</div>
		</div>
	 </div>
  <!-- .container --> 
</section>
<!-- #main -->
