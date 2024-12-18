<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 11px !important;
        color: black;
        margin: 0px !important;
    }

    .table_v_small>thead>tr>th,
    .table_v_small>tbody>tr>th,
    .table_v_small>tfoot>tr>th,
    .table_v_small>thead>tr>td,
    .table_v_small>tbody>tr>td,
    .table_v_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 6px !important;
        color: black;
        margin: 0px !important;
    }

    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: #f0ad4e;
        z-index: 3;
        color: black;
        font-weight: bold;
    }
</style>
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
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-3">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-9">
                  
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
                <h4> <i class="fa fa-list"></i></h4>

            </div>
            <div class="box-body">

<h4>
    <table class="table table-bordered">
        <tr>
            <th>Description</th>
            <th>Total</th>
            <th>Work Done</th>
            <th>Percentage</th>
        </tr>
        <tr>
            <th>Schemes</th>
            <td><?php 
            $query = "SELECT COUNT(*) as total FROM schemes as s 
            WHERE s.scheme_status IN ('Completed', 'Par-Completed')
            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
            
            echo $scheme_total = $this->db->query($query)->row()->total;
            ?><br />
        <small>Par-Completed</small>    
        </td>
            <td><?php 
            $query = "SELECT COUNT(*) as total FROM schemes as s 
            WHERE s.scheme_status IN ('Completed')
            AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
            
            echo $completed = $this->db->query($query)->row()->total;
            ?>
        <br />
        <small>Completed</small>    
        </td>
            <td><?php 
            echo round((($completed*100)/$scheme_total),2)."%"; 
            ?>
        </td>
            
        </tr>
        <tr>
            <th>Cheques</th>
            <td><?php 
            $query = "SELECT COUNT(*) as total FROM expenses as e
            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
            $total_cheques = $this->db->query($query)->row()->total;
            echo $total_cheques;
            ?>  
        </td>
            <td><?php 
            $query = "SELECT COUNT(*) as total FROM expenses as e
            WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
            AND e.scheme_id IS NOT NULL";
            $completed_cheques = $this->db->query($query)->row()->total;
            
            echo $completed_cheques;
            ?>
     
        </td>
            <td><?php 
            echo round((($completed_cheques*100)/$total_cheques),2)."%"; 
            ?>
        </td>
            
        </tr>
    </table>
</h4>


<?php
 //$schemes_status = array("Registered", "Initiated", "Ongoing", "ICR-I", "ICR-II", "FCR", "Par-Completed", "Completed");
 $schemes_status = array("Par-Completed", "Completed");
                        
 ?>
               
                    <h4>District Wise Data Reconciliation</h4>
                    <table class="table table-bordered ">
                        
                    
                       

                        <?php 
                        $query="SELECT region FROM districts WHERE is_district=1 GROUP BY region";
                        $regions = $this->db->query($query)->result();
                        foreach($regions as $region){
                            
                        ?>
                        <tr>
                        <tr><th colspan="20" style="text-align: center;">
                       <h4><?php echo $region->region; ?> Region </h4> </th></tr>
                       <tr>
                            <th colspan="3"></th>
                            <th colspan="3" style="text-align:center">Schemes</th>
                            <th></th>
                            <th colspan="3" style="text-align:center">Cheques</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>Total</th>
                            <th>Work Done</th>
                            <th>Percentage</th>
                            <th></th>
                            <th>Total</th>
                            <th>Work Done</th>
                            <th>Percentage</th>
                        </tr>

                        

                        <?php
                        // Query all component categories
                        $count = 1;
                        $query = "SELECT *, COUNT(e.expense_id) as total FROM districts as d  
                        INNER JOIN expenses as e ON(e.district_id = d.district_id )
                        WHERE d.is_district = 1 
                        AND region = '".$region->region."'
                        GROUP BY d.district_name ORDER BY total ASC";
                        $districts = $this->db->query($query)->result();
                        foreach ($districts as $district) { ?>
                            <tr>

                                <th><?php echo $count++; ?></th>
                                <th><?php echo $district->region; ?></th>
                                <th><?php echo $district->district_name; ?></th>
                                <td><?php 
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.scheme_status IN ('Completed', 'Par-Completed')
                                    AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                    AND s.district_id = '".$district->district_id."'";
                                    
                                    echo $scheme_total = $this->db->query($query)->row()->total;
                                    ?>  
                                </td>
                                    <td><?php 
                                    $query = "SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.scheme_status IN ('Completed')
                                    AND s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                    AND s.district_id = '".$district->district_id."'";
                                    
                                    echo $completed = $this->db->query($query)->row()->total;
                                    ?>
                                </td>
                                <td><?php 
                                    echo round((($completed*100)/$scheme_total),2)."%"; 
                                    ?>
                                </td>
                                <th></th>
                                <td><?php 
                                    $query = "SELECT COUNT(*) as total FROM expenses as e
                                    WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                    AND e.district_id = '".$district->district_id."'";
                                    $total_cheques = $this->db->query($query)->row()->total;
                                    echo $total_cheques;
                                    ?>  
                                </td>
                                    <td><?php 
                                    $query = "SELECT COUNT(*) as total FROM expenses as e
                                    WHERE e.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                    AND e.scheme_id IS NOT NULL
                                    AND e.district_id = '".$district->district_id."'";
                                    $completed_cheques = $this->db->query($query)->row()->total;
                                    
                                    echo $completed_cheques;
                                    ?>
                            
                                </td>
                                    <td><?php 
                                    echo round((($completed_cheques*100)/$total_cheques),2)."%"; 
                                    ?>
                                </td>
            
                            </tr>
                        <?php } ?>

                    
                        
                        <?php }
                        ?>
                        
                    </table>

               

            </div>



        </div>
    </div>
    <!-- /MESSENGER -->
</div>