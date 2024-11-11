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


<body>

    <div style="text-align: center; margin-top:10px">

        <div>Financial Years
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

    <!-- Dashboard Content -->
    <div class="container" style="padding-top: 5px;">
        <div class="row">

            <div class="col-md-3">
                <div id="budget_utilization_summary"></div>
            </div>
            <div class="col-md-3">
                <div id="budget_utilization"></div>
            </div>
            <div class="col-md-3">
                <div id="expense_purpose"></div>
            </div>
            <div class="col-md-3">
                <div id="beneficiaries"></div>
            </div>
        </div>
        <div class="row">
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
            get_report("budget_utilization");
            get_report("expense_purpose");
            get_report("beneficiaries");
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



</body>

</html>