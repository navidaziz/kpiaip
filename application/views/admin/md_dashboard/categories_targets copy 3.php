<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class='buttons'>

    <?php
    // PHP code to fetch data from the database and prepare it for JavaScript
    $query = "SELECT * FROM financial_years WHERE financial_year_id = 4";
    $financial_years = $this->db->query($query)->result_array();

    $dataPrev = [];
    $data = [];

    foreach ($financial_years as $financial_year) {
        $year = substr($financial_year['financial_year'], 0, 4); ?>
        <button id='<?php echo $year; ?>'><?php echo $year; ?></button>

    <?php
        $dataPrev[$year] = [];
        $data[$year] = [];
        $data2[$year] = [];
        $cat = [];

        $query = "SELECT * FROM `component_categories` LIMIT 15";
        $categories = $this->db->query($query)->result_array();

        foreach ($categories as $category) {
            $query = "SELECT * FROM `annual_work_plans`
                  WHERE component_category_id = ? AND financial_year_id = ?";
            $awp_target = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            $target = $awp_target ? (int) $awp_target['anual_target'] : '';

            $dataPrev[$year][] = [$category['category'], $target];

            $query = "SELECT COUNT(DISTINCT scheme_id) as total FROM expenses WHERE scheme_id > 0
                  AND component_category_id = ? AND financial_year_id = ?";
            $schemes = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            $target = $schemes ? (int) $schemes['total'] : 0;
            $data[$year][] = [$category['category'], $target];
            $data2[$year][] = [$category['category'], rand(1000, 10000)];
            $cat[$category['category']]['name'] = $category['category'];
            $cat[$category['category']]['color'] = '#FE2371';
        }
    }
    ?>
</div>

<div id="container"></div>


<script>
    const dataPrev = <?php echo json_encode($dataPrev); ?>;
    const data = <?php echo json_encode($data); ?>;
    const data2 = <?php echo json_encode($data2); ?>;

    const cat = <?php echo json_encode($cat); ?>;

    // Add upper case country code
    for (const [key, value] of Object.entries(cat)) {
        value.ucCode = key.toUpperCase();
    }


    const getData = data => data.map(point => ({
        name: point[0],
        y: point[1],
        color: cat[point[0]].color
    }));

    const chart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        // Custom option for templates
        cat,
        title: {
            text: 'Summer Olympics 2020 - Top 5 cat by Gold medals',
            align: 'left'
        },
        subtitle: {
            text: 'Comparing to results from Summer Olympics 2016 - Source: <a ' +
                'href="https://olympics.com/en/olympic-games/tokyo-2020/medals"' +
                'target="_blank">Olympics</a>',
            align: 'left'
        },
        plotOptions: {
            series: {
                grouping: false,
                borderWidth: 0
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            shared: true,
            headerFormat: '<span style="font-size: 15px">' +
                '{series.chart.options.cat.(point.key).name}' +
                '</span><br/>',
            pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
                '{series.name}: <b>{point.y} medals</b><br/>'
        },
        xAxis: {
            type: 'category',
            accessibility: {
                description: 'cat'
            },

        },
        yAxis: [{
            title: {
                text: 'Schemes Target Vs Achievements For FY: 2023-24'
            },
            showFirstLabel: true
        }],
        series: [{
            color: 'rgba(158, 159, 163, 0.5)',
            pointPlacement: -0.2,
            linkedTo: 'main',
            data: dataPrev[2023].slice(),
            name: 'Targets'
        }, {
            name: 'Achived',
            color: '#4572A7', // Specify color for 'Achived' series
            id: 'main',
            pointPlacement: -0.1,
            dataSorting: {
                enabled: false,
                matchByName: true
            },
            dataLabels: [{
                enabled: true,
                inside: true,
                style: {
                    fontSize: '12px'
                }
            }],
            data: getData(data[2023]).slice()
        }, {
            name: 'Approved',
            color: 'rgba(158, 200, 163, 0.5)', // Specify color for 'Approved' series
            id: 'main2',
            dataSorting: {
                enabled: false,
                matchByName: true
            },
            dataLabels: [{
                enabled: true,
                inside: true,
                style: {
                    fontSize: '12px'
                }
            }],
            data: getData(data2[2023]).slice()
        }],
        exporting: {
            allowHTML: true
        }
    });
</script>