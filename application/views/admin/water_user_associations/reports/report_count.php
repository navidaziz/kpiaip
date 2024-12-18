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
            <h4>District Wise Data Reconciliation</h4>
            <table class="table table-bordered" id="table_db">
                <thead>
    <tr>
        <th>#</th>
        <th>Region</th>
        <th>District</th>
        <th>Total Schemes</th>
        <th>Schemes Completed</th>
        <th>Completed Percentage</th>
        <th>Total Cheques</th>
        <th>Cheques Completed</th>
        <th>Completed Percentage</th>
    </tr>
    </thead>
    <tbody>

        <?php 
        // Get regions
        $regions = $this->db->query("SELECT DISTINCT region FROM districts WHERE is_district = 1")->result();
$count=1;
        foreach($regions as $index => $region) {
            // Get districts for each region
            $districts = $this->db->query("
                SELECT d.district_name, d.district_id, d.region
                FROM districts AS d
                WHERE d.is_district = 1 AND d.region = '{$region->region}'
                ORDER BY d.district_name
            ")->result();

            foreach ($districts as $district) {
                // Get total and completed schemes
                $scheme_total = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM schemes
                    WHERE scheme_status IN ('Completed', 'Par-Completed')
                    AND component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                $completed_schemes = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM schemes
                    WHERE scheme_status = 'Completed'
                    AND component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                // Get total and completed cheques
                $total_cheques = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM expenses
                    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                $completed_cheques = $this->db->query("
                    SELECT COUNT(*) AS total
                    FROM expenses
                    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,10,11,12)
                    AND scheme_id IS NOT NULL
                    AND district_id = '{$district->district_id}'
                ")->row()->total;

                // Calculate percentages
                $completed_scheme_percentage = ($scheme_total > 0) ? round(($completed_schemes * 100) / $scheme_total, 2) : 0;
                $completed_cheque_percentage = ($total_cheques > 0) ? round(($completed_cheques * 100) / $total_cheques, 2) : 0;
        ?>
                <tr>
                    <th><?php echo $count++; ?></th>
                    <td><?php echo $district->region; ?></td>
                    <td><?php echo $district->district_name; ?></td>
                    <td><?php echo $scheme_total; ?></td>
                    <td><?php echo $completed_schemes; ?></td>
                    <td><?php echo $completed_scheme_percentage . "%"; ?></td>
                    <td><?php echo $total_cheques; ?></td>
                    <td><?php echo $completed_cheques; ?></td>
                    <td><?php echo $completed_cheque_percentage . "%"; ?></td>
                </tr>
        <?php 
            } 
        }
        ?>
    </tbody>  
</table>

                </div>



        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<?php $table_title = 'Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
    title = 'Progress Report';
    $(document).ready(function() {
        var t = $('#table_db').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [], // No initial sorting
            "ordering": true,
            searching: true,
            columnDefs: [
                {
                    targets: [0], // Disable sorting for the first column (index 0)
                    orderable: false
                }
            ],
            buttons: [
                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'
                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'
                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'
                }
            ]
        });
    t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
    } ).draw();
    });
</script>
