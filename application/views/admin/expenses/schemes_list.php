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
    font-size: 10px !important;
    color: black;
    margin: 0px !important;
}
</style>
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
                    <i class="fa fa-list"></i>

                    <a href="<?php echo site_url(ADMIN_DIR . "/expenses"); ?>">Expenses Dashboard</a>
                </li>

                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-4">
                    <div class="clearfix">

                        <h3 class="content-title pull-left"><?php echo $title ?></h3>
                    </div>
                    <div class="description"> <?php echo $description; ?></div>
                </div>

                <div class="col-md-8">
                    <table class="table table-bordered table_small" style="margin-top: -30px;">
                        <tr>
                            <th>Scheme Status</th>
                            <?php $query="SELECT * FROM component_categories as cc 
                            WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)"; 
                            $categories = $this->db->query($query)->result();
                            foreach($categories as $category){ ?>
                            <th style="text-align: center;">
                                <span class="pop-left" style="cursor: pointer;"
                                    data-content="<?php echo $category->category_detail; ?>" data-original-title=""
                                    title=""><?php echo $category->category; ?></span>
                            </th>
                            <?php } ?>
                            <th>Total</th>
                        </tr><?php
                        $query = "SELECT scheme_status, COUNT(scheme_status) as total FROM schemes ";
                        $query.=" GROUP BY scheme_status";
                        $schemes_status = $this->db->query($query)->result();
                        foreach ($schemes_status as $scheme_status) { ?>
                        <tr>
                            <th style="text-align: right;"><?php echo $scheme_status->scheme_status ?></th>
                            <?php $query="SELECT * FROM component_categories as cc 
                                    WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                    
                                    $categories = $this->db->query($query)->result();
                                    foreach($categories as $category){ ?>
                            <td class="scheme_status" style="text-align: center;"><?php 
                                    $query="SELECT COUNT(*) as total FROM schemes as s 
                                            WHERE s.component_category_id = $category->component_category_id
                                            AND s.scheme_status = '".$scheme_status->scheme_status."'";
                                            
                                            echo $this->db->query($query)->row()->total;
                                    ?></td>
                            <?php } ?>
                            <th style="text-align: center;"><?php 
                                    $query="SELECT COUNT(*) as total FROM schemes as s 
                                            WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                                            AND s.scheme_status = '".$scheme_status->scheme_status."'";
                                            
                                            echo $this->db->query($query)->row()->total;
                                    ?></th>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th>Total</th>
                            <?php $query="SELECT * FROM component_categories as cc 
                            WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)"; 
                            $categories = $this->db->query($query)->result();
                            foreach($categories as $category){ ?>
                            <td class="scheme_status_total" style="text-align: center;"><?php 
                            $query="SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id = $category->component_category_id";
                                    
                                    echo $this->db->query($query)->row()->total;
                            ?></td>
                            <?php } ?>
                            <th style="text-align: center;"><?php 
                            $query="SELECT COUNT(*) as total FROM schemes as s 
                                    WHERE s.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                                    
                                    echo $this->db->query($query)->row()->total;
                            ?></th>
                        </tr>
                    </table>
                </div>

            </div>


        </div>
    </div>
</div>
<style>
.box .header-tabs .nav-tabs>li.active a,
.box .header-tabs .nav-tabs>li.active a:after,
.box .header-tabs .nav-tabs>li.active a:before {
    background: #f0ad4e;
    z-index: 3;
    color: black;
    font-weight: bold;
}
</style>
<div class="row">




    <div class="col-md-12">


        <div class="box border blue">
            <div class="box-title">
                <h4><i class="fa fa-task"></i> <?php echo $description; ?></h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">

                        <?php
                        $query = "SELECT scheme_status, COUNT(scheme_status) as total FROM schemes GROUP BY scheme_status";
                        $schemes_status = $this->db->query($query)->result();
                        foreach ($schemes_status as $scheme_status) { ?>

                        <li <?php if ($scheme_status->scheme_status == $schemestatus) { ?> class="active" <?php } ?>>

                            <a href="<?php echo site_url(ADMIN_DIR . "expenses/schemes"); ?>?scheme_status=<?php echo $scheme_status->scheme_status; ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">
                                <?php if ($scheme_status->scheme_status == 'Ongoing') { ?><i class="fa fa-spinner"
                                    aria-hidden="true"></i> <?php } ?>
                                <?php if ($scheme_status->scheme_status == 'Completed') { ?><i class="fa fa-check"
                                    aria-hidden="true"></i> <?php } ?>
                                <?php echo $scheme_status->scheme_status; ?> ( <?php echo $scheme_status->total; ?>
                                )</a>
                        </li>
                        <?php } ?>



                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="box_tab3">


                            <div class="table-responsive" style=" overflow-x:auto;">
                                <table id="datatable" class="table  table_small table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>District Name</th>
                                            <th>Wua Reg Code</th>
                                            <th>Wua Name</th>
                                            <th>FY</th>
                                            <th>Scheme Code</th>
                                            <th>Scheme Name</th>
                                            <th>Component Category</th>
                                            <th>Sanctioned Cost</th>
                                            <th>Net Paid</th>
                                            <th>Paid Percentage</th>
                                            <th>Remaining</th>
                                            <th>Payment Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <script type="text/javascript">
                                $(document).ready(function() {
                                    document.title =
                                        "<?php echo $schemestatus; ?> Schemes lists (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                                    $("#datatable").DataTable({
                                        "processing": true,
                                        "serverSide": true,
                                        "ajax": {
                                            "url": "<?php echo base_url(ADMIN_DIR . "expenses/scheme_lists"); ?>",
                                            "type": "POST",
                                            data: {
                                                scheme_status: '<?php echo $schemestatus; ?>',
                                            },
                                        },
                                        "columns": [{
                                                "data": null,
                                                "render": function(data, type, row, meta) {
                                                    return meta.row + meta.settings
                                                        ._iDisplayStart +
                                                        1; // Start index from 1
                                                }
                                            },

                                            {
                                                "data": "district_name"
                                            },

                                            {
                                                "data": "wua_reg_code"
                                            },

                                            {
                                                "data": "wua_name"
                                            },
                                            {
                                                "data": "financial_year"
                                            },
                                            {
                                                "data": "scheme_code"
                                            },

                                            {
                                                "data": "scheme_name"
                                            },

                                            {
                                                "data": "component_category"
                                            },

                                            {
                                                "data": "sanctioned_cost",
                                                "render": function(data, type, row) {
                                                    // Format the number here
                                                    return parseFloat(data).toLocaleString(
                                                        'en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                }
                                            },

                                            {
                                                "data": "paid",
                                                "render": function(data, type, row) {
                                                    // Format the number here
                                                    return parseFloat(data).toLocaleString(
                                                        'en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                }
                                            },

                                            {
                                                "data": "paid_percentage"
                                            },

                                            {
                                                "data": "remaining",
                                                "render": function(data, type, row) {
                                                    // Format the number here
                                                    return parseFloat(data).toLocaleString(
                                                        'en-US', {
                                                            minimumFractionDigits: 2
                                                        });
                                                }
                                            },

                                            {
                                                "data": "payment_count"
                                            },


                                            {
                                                "data": null,
                                                "render": function(data, type, row) {
                                                    return '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "expenses/view_scheme_detail/"); ?>' +
                                                        row.scheme_id +
                                                        '"><i class="fa fa-eye"></i> View</a>';
                                                }
                                            }

                                        ],
                                        "lengthMenu": [
                                            [15, 25, 50, -1],
                                            [15, 25, 50, "All"]
                                        ],
                                        "order": [
                                            [0, "asc"]
                                        ],
                                        "searching": true,
                                        "paging": true,
                                        "info": true,
                                        dom: "Bfrtip",

                                        buttons: ["excel", "pageLength"]
                                    });
                                });
                                </script>




                            </div>
                            <hr class="margin-bottom-0">

                        </div>


                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- /MESSENGER -->
</div>




<script>
title = "Expenses";
$(document).ready(function() {
    $('#db_table').DataTable({
        dom: 'Bfrtip',
        paging: false,
        title: title,
        "order": [],
        searching: true,
        buttons: [

            {
                extend: 'print',
                title: title,
            },
            {
                extend: 'excelHtml5',
                title: title,

            },
            {
                extend: 'pdfHtml5',
                title: title,
                pageSize: 'A4',

            }
        ]
    });
});
// Function to apply heatmap color based on value
function Heatmap(className, maxColor) {
    // Function to convert a value to a color between white and maxColor
    function valueToColor(value, min, max) {
        if (value === 0 || isNaN(value)) {
            return 'rgb(255, 255, 255)'; // White color for 0 or non-numeric values
        }
        const ratio = (value - min) / (max - min);
        const [rMax, gMax, bMax] = maxColor.match(/\w\w/g).map(hex => parseInt(hex, 16));
        const r = Math.round(255 + ratio * (rMax - 255)); // Interpolating between 255 and rMax
        const g = Math.round(255 + ratio * (gMax - 255)); // Interpolating between 255 and gMax
        const b = Math.round(255 + ratio * (bMax - 255)); // Interpolating between 255 and bMax
        return `rgb(${r}, ${g}, ${b})`;
    }

    // Get all table cells with the specified class name
    const cells = document.querySelectorAll(`td.${className}`);

    // Extract numeric values from the cells
    const values = Array.from(cells).map(cell => parseFloat(cell.textContent.trim()) || 0);

    // Determine the minimum and maximum values, excluding 0 and non-numeric values
    const nonZeroValues = values.filter(value => !isNaN(value) && value !== 0);
    const min = Math.min(...nonZeroValues);
    const max = Math.max(...nonZeroValues);

    // Apply the heatmap effect to each cell
    cells.forEach(cell => {
        const value = parseFloat(cell.textContent.trim()) || 0;
        const color = valueToColor(value, min, max);
        cell.style.backgroundColor = color;
    });
}
// Example usage
Heatmap('scheme_status', '#82B018');
Heatmap('scheme_status_total', '#82B018');
</script>