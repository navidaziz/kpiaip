<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class='buttons'>

    <?php
    // PHP code to fetch data from the database and prepare it for JavaScript
    $query = "SELECT * FROM financial_years";
    $financial_years = $this->db->query($query)->result_array();

    $dataPrev = [];
    $data = [];

    foreach ($financial_years as $financial_year) {
        $year = substr($financial_year['financial_year'], 0, 4); ?>
        <button id='<?php echo $year; ?>'><?php echo $year; ?></button>

    <?php
        $dataPrev[$year] = [];
        $data[$year] = [];
        $cat = [];

        $query = "SELECT * FROM `component_categories` LIMIT 5";
        $categories = $this->db->query($query)->result_array();

        foreach ($categories as $category) {
            $query = "SELECT * FROM `annual_work_plans`
                  WHERE component_category_id = ? AND financial_year_id = ?";
            $awp_target = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            $target = $awp_target ? (int) $awp_target['anual_target'] : 0;

            $dataPrev[$year][] = [$category['category'], $target];

            $query = "SELECT COUNT(DISTINCT scheme_id) as total FROM expenses WHERE scheme_id > 0
                  AND component_category_id = ? AND financial_year_id = ?";
            $schemes = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            $target = $schemes ? (int) $schemes['total'] : 0;
            $data[$year][] = [$category['category'], $target];
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
            labels: {
                useHTML: true,
                animate: true,
                format: '{chart.options.cat.(value).ucCode}<br>' +
                    '<span class="f32">' +
                    '<span style="display:inline-block;height:32px;vertical-align:text-top;" ' +
                    'class="flag {value}"></span></span>',
                style: {
                    textAlign: 'center'
                }
            }
        },
        yAxis: [{
            title: {
                text: 'Categories'
            },
            showFirstLabel: false
        }],
        series: [{
            color: 'rgba(158, 159, 163, 0.5)',
            pointPlacement: -0.2,
            linkedTo: 'main',
            data: dataPrev[2023].slice(),
            name: '2023'
        }, {
            name: '2023',
            id: 'main',
            dataSorting: {
                enabled: true,
                matchByName: true
            },
            dataLabels: [{
                enabled: true,
                inside: true,
                style: {
                    fontSize: '16px'
                }
            }],
            data: getData(data[2023]).slice()
        }],
        exporting: {
            allowHTML: true
        }
    });
</script>