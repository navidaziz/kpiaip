 <!-- <div class="row">
 <div class="row">

     <div class="col-md-3">
         <ul class="breadcrumb">
             <li>
                 <i class="fa fa-home"></i>
                 <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
             </li>
             <li><?php echo $title; ?></li>
         </ul>

     </div>



 </div>


 </div>
 </div>
 </div> -->

 <div class="row">

     <div class="col-md-12">
         <div class="box border blue" id="messenger">
             <div class="box-title">
                 <h4><i class="fa fa-home"></i>Application Module list</h4>

             </div>
             <div class="box-body">

                 <style>
                     .panel:hover {
                         transform: translateY(-5px);
                         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                         transition: all 0.3s ease;
                         color: #5E87AF;
                     }

                     .panel.active {
                         background-color: #007bff;
                         color: #fff;
                         border-color: #007bff;
                     }

                     .panel.active .menu-text {
                         color: #fff;
                     }

                     .panel.active i {
                         color: #fff;
                     }
                 </style>
                 <div class="row">
                     <?php foreach ($menu_arr as $controller_id => $controller_data): ?>
                         <?php $cn_class = ($controller_name == $controller_data['controller_uri']) ? "active" : ""; ?>
                         <a href="<?php echo site_url(ADMIN_DIR . $controller_data['controller_uri'] . "/" . $action['action_uri']); ?>" class="text-decoration-none text-dark">
                             <div class="col-md-3 col-sm-6">
                                 <div class="panel panel-default <?= $cn_class ?>">
                                     <div class="panel-body text-center">

                                         <i class="fa <?= $controller_data['controller_icon'] ?> fa-3x mb-3" style="color: #5E87AF;"></i>
                                         <h4 class="menu-text" style=" font-weight:bold; color: #5E87AF; margin-top: 10px;"><?= $controller_data['controller_title'] ?></h4>
                                         <span class="arrow text-muted"><i class="fa fa-arrow-right"></i></span>

                                     </div>
                                 </div>
                         </a>
                 </div>
             <?php endforeach; ?>
             </div>


         </div>
     </div>
 </div>
 </div>