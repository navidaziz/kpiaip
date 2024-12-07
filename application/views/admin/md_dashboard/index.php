<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mockup</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Highcharts library from CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


</head>
<style>
    .table_small2>tbody>tr>td,
    .table_small2>tbody>tr>th,
    .table_small2>tfoot>tr>td,
    .table_small2>tfoot>tr>th,
    .table_small2>thead>tr>td,
    .table_small2>thead>tr>th {
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 10px;
        text-align: center;
        border: 0px !important;
    }

    .table_small>tbody>tr>td,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>td,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>thead>tr>th {
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px;
        text-align: center;
        border: 0.1px solid gray !important;
        font-weight: bold !important;
        color: black !important;
    }

    .table_medium2>tbody>tr>td,
    .table_medium2>tbody>tr>th,
    .table_medium2>tfoot>tr>td,
    .table_medium2>tfoot>tr>th,
    .table_medium2>thead>tr>td,
    .table_medium2>thead>tr>th {
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 16px;
        text-align: center;
        border: 0.1px solid gray !important;
        font-weight: bold !important;
        color: black !important;

    }
    .table_medium>tbody>tr>td,
    .table_medium>tbody>tr>th,
    .table_medium>tfoot>tr>td,
    .table_medium>tfoot>tr>th,
    .table_medium>thead>tr>td,
    .table_medium>thead>tr>th {
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 13px;
        text-align: center;
        border: 0.1px solid gray !important;
        font-weight: bold !important;
        color: black !important;

    }

    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
        max-width: 100%;
    }

    .female {
        background-color: #FFB1CB;
        width: 100%;
        display: block;
        margin-top: 2px;
        padding: 2px;
        color: #fff;

    }

    .male {
        background-color: #01A6EA;
        width: 100%;
        display: block;
        margin-top: 2px;
        padding: 2px;
        color: #fff;
    }

    .female_male {
        background-color: #FFCC10;
        width: 100%;
        display: block;
        margin-top: 1px;
        padding: 2px;
        color: #fff;
    }
</style>
<style>
        .dashboard-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 5px;
            margin: 10px 0;
            transition: transform 0.2s;
        }
        .dashboard-box:hover {
            transform: scale(1.05);
        }
        .dashboard-box h3 {
            margin: 0;
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }
        .dashboard-box p {
            font-size: 14px;
            color: #777;
        }
        .dashboard-box .count {
            font-size: 15px;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>

<body>



    <!-- Dashboard Content -->
    <div class="container" style="padding-top: 5px;">
        <div class="row">

        <div class="col-md-2">
                <div class="dashboard-box">
                    <h3>KP-IAIP Project</h3>
                    <p class="count">Data Analysis Dashboard</p>
                </div>
            </div>
    <?php 
     $schemes = array(
        "Registered",
        "Initiated",
        "Not Approved",
        "Ongoing",
        "ICR-I",
        "ICR-II",
        "Final",
        "Disputed",
        "Par-Completed",
        "Completed"
    );

    $colors = array(
        "Registered" => "#FE6A35",
        "Initiated" => "#6B8ABC",
        "Not Approved"  => "#2CAFFE",
        "Ongoing"  => "#D568FB",
        "ICR-I" => "#2EE0CA",
        "ICR-II" => "#FA4B42",
        "Final" => "#FEB56A",
        "Disputed" => "#544FC5",
        "Par-Completed" => "#00E272",
        "Completed"  => "#91E8E1"
    );
   
    foreach ($schemes as $scheme_status) {
    $query="SELECT scheme_status, COUNT(*) as total FROM schemes 
    WHERE scheme_status ='".$scheme_status."'";
    $scheme = $this->db->query($query)->row();
    ?>
            <div class="col-md-1 col-sm-3 col-xs-3">
                <div class="dashboard-box" style="background-color: <?php echo $colors[$scheme_status] ?>;">
                    <h3><?php echo $scheme_status; ?></h3>
                    <p class="count"><?php echo $scheme->total ?></p>
                </div>
            </div>
     <?php } ?>
            <div class="col-md-4">
                <div id="budget_utilization_summary"></div>
            </div>
            <div class="col-md-8">
                <div id="fy_wise_budget_utilization"></div>
            </div>

            <div class="col-md-8">
                <div id="district_expenses"></div>
            </div>
            <div class="col-md-4">
                <div id="region_expenses"></div>
            </div>
            <div class="col-md-5">
                <div id="scheme_category_heat_map"></div>
            </div>

            <div class="col-md-7">
                <div id="scheme_category_total"></div>
            </div>

             <div class="col-md-12">
                <div id="district_scheme_heat_map"></div>
            </div>

            <div class="col-md-3">
                <div id="region_schemes"></div>
            </div>

            <div class="col-md-9">
                <div id="district_schemes"></div>
            </div>
            <div class="col-md-8">
                <div id="completed_scheme_avg"></div>
            </div>
            <div class="col-md-8">
                <div id="category_totals"></div>
            </div>



        </div>
        <div class="row">
        <div class="col-md-12" >

<div style="text-align: center; margin-top:10px; border:1px solid gray; margin:10px; border-radius:5px">Financial Years Filter
    <?php
    // PHP code to fetch data from the database and prepare it for JavaScript
    $query = "SELECT * FROM financial_years";
    $financial_years = $this->db->query($query)->result();

    foreach ($financial_years as $financial_year) { ?>
        <label style="margin-left: 10px;">
            <input <?php if ($financial_year->status == 1) { ?> checked <?php }  ?> onclick="filter_data()" type="checkbox" name="fy_id[<?php echo $financial_year->financial_year_id ?>]" class="fy_id" autocomplete="off">
            <?php echo $financial_year->financial_year; ?>
        </label>
    <?php } ?>

</div>


</div>
            <div class="col-md-4">
                <div id="components_expenses"></div>
            </div>
            <div class="col-md-8">
                <div id="sub_components_expenses"></div>
            </div>
            <div class="col-md-12">
                <div id="categories_expenses"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div id="components_targets"></div>
            </div>
            <div class="col-md-8">
                <div id="sub_components_targets"></div>
            </div>
            <div class="col-md-12">
                <div id="categories_targets"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="districts_summary"></div>
            </div>

        </div>



    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function get_report(funcation_name) {
            $('#' + funcation_name).html('<h5 style="text-align: center;" class="linear-background"></h5>');
            var checkedFYIds = [];
            var checkboxes = document.querySelectorAll('.fy_id');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const fyId = checkbox.getAttribute('name').match(/\d+/)[0];
                    checkedFYIds.push(fyId);
                }
            });

            $.ajax({
                    method: "POST",
                    url: "<?php echo site_url('admin/md_dashboard/'); ?>" + funcation_name,
                    data: {
                        fy_ids: checkedFYIds
                    }
                })
                .done(function(respose) {
                    $('#' + funcation_name).html(respose);
                });
        }

        function filter_data() {

            get_report("budget_utilization_summary");
            get_report("fy_wise_budget_utilization");
            get_report("district_expenses");
            get_report("region_expenses");
            get_report("scheme_category_total");
            get_report("scheme_category_heat_map");
             get_report("district_scheme_heat_map");

            get_report("region_schemes");
            get_report("district_schemes");
            get_report("completed_scheme_avg");
            //get_report("category_totals");




            //get_report("budget_utilization");
            //get_report("expense_purpose");
            // get_report("beneficiaries");
            get_report("components_targets");
            get_report("sub_components_targets");
            get_report("categories_targets");
            get_report("components_expenses");
            get_report("sub_components_expenses");
            get_report("categories_expenses");
            get_report("districts_summary");


        }
        filter_data();
    </script>

    <script>
        function makeFullScreen(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) { // Firefox
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) { // Chrome, Safari, Opera
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) { // IE/Edge
                    element.msRequestFullscreen();
                }
            } else {
                console.warn(`Element with id "${elementId}" not found.`);
            }
        }

        
    </script>

</body>

</html>