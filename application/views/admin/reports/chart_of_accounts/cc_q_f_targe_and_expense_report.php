
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->

            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>


            </div>


        </div>
    </div>
</div>
<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px !important;
        color: black;
        margin: 0px !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        /* border: 1px solid black !important; */
    }

    .table_s_small>thead>tr>th,
    .table_s_small>tbody>tr>th,
    .table_s_small>tfoot>tr>th,
    .table_s_small>thead>tr>td,
    .table_s_small>tbody>tr>td,
    .table_s_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">

    <div class="col-md-12">
        <div style="background-color: white; padding:5px">
            <div class="table-responsive">
                <?php 
                $query = "SELECT * FROM `financial_years`";
                $financial_years = $this->db->query($query)->result();
                ?>

                <table class="table table_small  table-bordered" id="report">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td></td>
                                 <?php if($financial_year->status==1){ ?>
                                   <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                                 <th></th>
                            <?php } ?>
                           
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <th style="text-align:center" ><?php echo $financial_year->financial_year;  ?></th>
                                <?php if($financial_year->status==1){ ?>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                <?php } ?>
                                <th></th>
                            <?php } ?>
                            
                                <th></th>
                                <th></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <th>Components Category</th>
                            <th>Total Budget</th>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td>Budget</td>
                                    <?php if($financial_year->status==1){ ?>
                                        <th>Q-1</th>
                                        <th>Q-2</th>
                                        <th>Q-3</th>
                                        <th>Q-4</th>
                                    <?php } ?>
                                <td>Expense</td>
                            <?php } ?>
                            
                                <td>Total Expense</td>
                                <td>Remaing</td>
                        </tr>
                        <?php 
                        $query = "SELECT cc.* FROM `component_categories` as cc
                        INNER JOIN expenses as e ON(e.component_category_id = cc.component_category_id)
                        GROUP BY component_category_id
                        ";
                        $component_categories = $this->db->query($query)->result();
                        foreach ($component_categories as $component_category) { ?>
                        <tr>
                            <th><?php echo $component_category->category;  ?></th>
                            <th class="values"><?php 
                            $query="SELECT SUM(material_cost) as total FROM `annual_work_plans` 
                                    WHERE component_category_id='".$component_category->component_category_id."';";
                            $f_budget = $this->db->query($query)->row();
                            if($f_budget){
                                if($f_budget->total){
                                echo round($f_budget->total,3);
                                }
                            }      
                            ?></th>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td class="values"><?php 
                                    $query="SELECT SUM(material_cost) as total FROM `annual_work_plans` 
                                            WHERE component_category_id='".$component_category->component_category_id."'
                                            AND financial_year_id = '".$financial_year->financial_year_id."';";
                                    $fy_budget = $this->db->query($query)->row();
                                    if($fy_budget){
                                        echo $fy_budget->total;
                                    }      
                                    ?>
                                </td>
                                <?php if($financial_year->status==1){ ?>
                                    <th class="values">
                                        <?php 
                                        $year_start = date('Y',strtotime($financial_year->start_date));
                                        $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                        WHERE component_category_id='".$component_category->component_category_id."'
                                        AND financial_year_id = '".$financial_year->financial_year_id."'
                                        AND DATE(date) BETWEEN '".$year_start."-07-01' AND '".$year_start."-09-30';";
                                        $fy_q_expense = $this->db->query($query)->row();
                                        if($fy_q_expense){
                                        echo $fy_q_expense->total;
                                        }      
                                        ?>
                                    </th>
                                    <th class="values"><?php 
                                        $year_start = date('Y',strtotime($financial_year->start_date));
                                        $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                        WHERE component_category_id='".$component_category->component_category_id."'
                                        AND financial_year_id = '".$financial_year->financial_year_id."'
                                        AND DATE(date) BETWEEN '".$year_start."-10-01' AND '".$year_start."-12-31';";
                                        $fy_q_expense = $this->db->query($query)->row();
                                        if($fy_q_expense){
                                        echo $fy_q_expense->total;
                                        }      
                                        ?></th>
                                    <th class="values"><?php 
                                        $year_end = date('Y',strtotime($financial_year->end_date));
                                        $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                        WHERE component_category_id='".$component_category->component_category_id."'
                                        AND financial_year_id = '".$financial_year->financial_year_id."'
                                        AND DATE(date) BETWEEN '".$year_end."-01-01' AND '".$year_end."-03-31';";
                                        $fy_q_expense = $this->db->query($query)->row();
                                        if($fy_q_expense){
                                        echo $fy_q_expense->total;
                                        }      
                                        ?></th>
                                    <th class="values"><?php 
                                        $year_end = date('Y',strtotime($financial_year->end_date));
                                        $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                        WHERE component_category_id='".$component_category->component_category_id."'
                                        AND financial_year_id = '".$financial_year->financial_year_id."'
                                        AND DATE(date) BETWEEN '".$year_end."-04-01' AND '".$year_end."-06-30';";
                                        $fy_q_expense = $this->db->query($query)->row();
                                        if($fy_q_expense){
                                        echo $fy_q_expense->total;
                                        }      
                                        ?></th>
                                <?php } ?>
                                <?php 
                                    $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                            WHERE component_category_id='".$component_category->component_category_id."'
                                            AND financial_year_id = '".$financial_year->financial_year_id."';";
                                    $fy_expense = $this->db->query($query)->row(); ?>
                                <td class="values" <?php if($fy_expense->total>$fy_budget->total){ ?> style="color:red" <?php  } ?> >
                                    <?php if($fy_expense){
                                          echo $fy_expense->total;
                                        }      
                                    ?>
                                </td>
                                 
                            <?php } ?>
                            <th class="values">
                                    <?php 
                                    $query="SELECT SUM(gross_pay) as total FROM `expenses` 
                                            WHERE component_category_id='".$component_category->component_category_id."';";
                                    $total_expense = $this->db->query($query)->row();
                                    if($total_expense){
                                        echo $total_expense->total;
                                    }      
                                    ?>
                                </th>
                                <th class="values" <?php  if($total_expense->total>$f_budget->total){ ?> style="color:red" <?php } ?>>
                                    <?php  echo $f_budget->total-$total_expense->total; ?></th>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
<!-- /MESSENGER -->
</div>


<?php $table_title = 'Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
    title = 'Khyber Pakhtunkhwa Irrigated Agriculture Improvement Project (KP-IAIP)\n<?php echo $title; ?>\n<?php echo $description ?>';
    $(document).ready(function() {
        var table = $('#report').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": false,
            searching: true,
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
                    pageSize: 'legal',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>',
                    customize: function (doc) {
                        // Set the default font size for all content
                        doc.defaultStyle.fontSize = 8;

                        // Set page margins (2 points on each side)
                        doc.pageMargins = [1, 1, 1, 1];

                        // Safely find the table and apply cell padding
                        doc.content.forEach(function(contentItem) {
                            if (contentItem.table) {
                                contentItem.table.body.forEach(function(row) {
                                    row.forEach(function(cell) {
                                        cell.margin = [1, 1, 1, 1];  // Apply padding to each cell
                                    });
                                });
                            }
                        });

                        // Apply font size adjustments if the styles exist
                        if (doc.styles) {
                            if (doc.styles.tableHeader) doc.styles.tableHeader.fontSize = 8;
                            if (doc.styles.title) doc.styles.title.fontSize = 8;
                            if (doc.styles.messageTop) doc.styles.messageTop.fontSize = 8;
                        }
                    }
                },
                {
                    text: 'Convert to Millions',
                    action: function (e, dt, node, config) {
                        // Convert values in the 'values' class to millions
                        $('.values').each(function() {
                            var currentValue = parseFloat($(this).text().replace(/,/g, '')); // Remove commas
                            if (!isNaN(currentValue)) {
                                var millionValue = currentValue / 1000000; // Convert to millions
                                $(this).text(millionValue.toFixed(3)); // Format to 2 decimal places and add 'M'
                            }
                        });

                        // Hide the convert button and show the reload button
                        dt.button('.convert-to-millions').disable(); // Disable convert button
                        $('#reload-button').show(); // Show reload button
                    },
                    className: 'convert-to-millions' // Add a class for easy identification
                }
            ]
        });

        // Create a button for reloading the page
        $('<button id="reload-button" style="display:none;">Reload Page</button>').appendTo('#report_wrapper .dt-buttons').on('click', function() {
            location.reload(); // Reload the page when clicked
        });
    });
</script>

