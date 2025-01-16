<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class='buttons'>

    <?php
    // PHP code to fetch data from the database and prepare it for JavaScript
    $query = "SELECT * FROM financial_years WHERE financial_year_id = 4";
    $financial_years = $this->db->query($query)->result_array();

    foreach ($financial_years as $financial_year) {
        $year = substr($financial_year['financial_year'], 0, 4); ?>
        <button id='<?php echo $year; ?>'><?php echo $year; ?></button>

    <?php

        $ongoing[$year] = [];
        $not_approved[$year] = [];
        $initiated[$year] = [];
        $disputed[$year] = [];
        $completed[$year] = [];
        $total[$year] = [];

        $fy_scheme_targets[$year] = [];



        $query = "SELECT * FROM `component_categories` LIMIT 15";
        $categories = $this->db->query($query)->result_array();

        foreach ($categories as $category) {
            $query = "SELECT * FROM `annual_work_plans`
                  WHERE component_category_id = ? AND financial_year_id = ?";
            $awp_target = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            $target = $awp_target ? (int) $awp_target['anual_target'] : 0;
            $fy_scheme_targets[$year][] = [$category['category'], $target];

            $query = "SELECT COUNT(scheme_id) as total,
            SUM(CASE WHEN scheme_status = 'Ongoing' THEN 1 ELSE 0 END) AS ongoing,
            SUM(CASE WHEN scheme_status = 'Not-Approved' THEN 1 ELSE 0 END) AS not_approved,
            SUM(CASE WHEN scheme_status = 'Initiated' THEN 1 ELSE 0 END) AS initiated,
            SUM(CASE WHEN scheme_status = 'Disputed' THEN 1 ELSE 0 END) AS disputed,
            SUM(CASE WHEN scheme_status = 'Completed' THEN 1 ELSE 0 END) AS completed
            FROM schemes WHERE 
            component_category_id = ? AND financial_year_id = ?";
            $schemes = $this->db->query($query, array($category['component_category_id'], $financial_year['financial_year_id']))->row_array();

            if ($schemes) {
                $ongoing[$year][] = [$category['category'], (int) $schemes['ongoing']];
                $not_approved[$year][] = [$category['category'], (int) $schemes['not_approved']];
                $initiated[$year][] = [$category['category'], (int) $schemes['initiated']];
                $disputed[$year][] = [$category['category'], (int) $schemes['disputed']];
                $completed[$year][] = [$category['category'], (int) $schemes['completed']];
                $total_scheme[$year][] = [$category['category'], (int) $schemes['total']];
                //$cat[$category['category']]['color'] = '#FE2371';
            } else {
                $ongoing[$year][] = [$category['category'], 0];
                $not_approved[$year][] = [$category['category'], 0];
                $initiated[$year][] = [$category['category'], 0];
                $disputed[$year][] = [$category['category'], 0];
                $completed[$year][] = [$category['category'], 0];
                $total_scheme[$year][] = [$category['category'], 0];
            }
        }
    }
    ?>
</div>

<div id="container"></div>

<script>
    const fy_scheme_targets = <?php echo json_encode($fy_scheme_targets); ?>;
    const not_approved = <?php echo json_encode($not_approved); ?>;
    const initiated = <?php echo json_encode($initiated); ?>;
    const ongoing = <?php echo json_encode($ongoing); ?>;
    const disputed = <?php echo json_encode($disputed); ?>;
    const completed = <?php echo json_encode($completed); ?>;
    const total_scheme = <?php echo json_encode($total_scheme); ?>;

    // Add upper case country code
    for (const [key, value] of Object.entries(fy_scheme_targets)) {
        value.ucCode = key.toUpperCase();
    }

    const getData = data => data.map(point => ({
        name: point[0],
        y: point[1],
        //color: fy_scheme_targets[point[0]].color
    }));

    const chart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Schemes Target Vs Achievements For FY: 2023-24',
            align: 'left'
        },
        subtitle: {
            text: 'Comparing targets and achievements across categories',
            align: 'left'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '7px' // Set the font size of data labels
                    }
                },
                grouping: false
            }
        },
        legend: {
            enabled: true // Enabled legend to distinguish between "Achived" and "Approved" series
        },
        tooltip: {
            shared: true,
            headerFormat: '<span style="font-size: 15px">{point.key}</span><br/>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y} Schemes</b><br/>'
        },
        xAxis: {
            type: 'category',
            accessibility: {
                description: 'Categories'
            },
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Schemes'
            },
            showFirstLabel: true
        },
        series: [{
                name: 'FY Schemes Targets',
                color: 'rgba(158, 159, 163, 0.5)',
                data: fy_scheme_targets[2023].slice(),
                //pointPlacement: -0.2,
                type: 'line',
                //pointWidth: 20
                dataLabels: {
                    enabled: true,
                    align: 'center', // Align data labels to center
                    verticalAlign: 'bottom', // Position data labels above the column
                    inside: false
                }
            },
            {
                name: 'Total Schemes',
                // color: 'rgba(158, 159, 140, 9)',
                color: '#2371FE',
                data: getData(total_scheme[2023]).slice(),
                type: 'spline', // Stack "Achived" series,
                dataLabels: {
                    enabled: true,
                    align: 'center', // Align data labels to center
                    verticalAlign: 'bottom', // Position data labels above the column
                    inside: false
                }
            },

            {
                name: 'Ongoing',
                // color: 'rgba(158, 159, 140, 9)',
                color: '#FE2371',
                data: getData(ongoing[2023]).slice(),
                stack: 'schemes' // Stack "Achived" series
            },

            {
                name: 'Completed',
                // color: 'rgba(158, 200, 163, 9)',
                color: '#01DC8E',
                data: getData(completed[2023]).slice(),
                stack: 'schemes' // Stack "Approved" series
            }, {
                name: 'Disputed',
                // color: 'rgba(158, 200, 163, 9)',
                color: '#FFD700',
                data: getData(disputed[2023]).slice(),
                stack: 'schemes' // Stack "Approved" series
            }
        ],
        exporting: {
            allowHTML: true
        }
    });
</script>