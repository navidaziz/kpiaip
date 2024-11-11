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
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
            <div class="col-md-4">
                <div id="components_targets"></div>
            </div>
            <div class="col-md-4">
                <div id="sub_components_targets"></div>
            </div>
            <div class="col-md-4">
                <div id="categories_targets"></div>
            </div>

        </div>


    </div>
    </div>



    <!-- Include Bootstrap JS from CDN
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.da taTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

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
            get_report("components_targets");
            //get_report("sub_components_targets");
            // get_report("categories_targets");
        }
        filter_data();
    </script>



</body>

</html>