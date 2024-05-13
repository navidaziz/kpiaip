<?php
$start_time = microtime(true);
?>
<div class="jumbotron" style="padding: 2px;">
    <?php
    $fy_id = $this->input->post('fy_ids');
    $query = "SELECT * FROM financial_years WHERE financial_year_id IN ?";
    $financial_years = $this->db->query($query, array($fy_id))->result_array();
    $f_year = array();
    foreach ($financial_years as $financial_year) {
        $f_year[] = $financial_year['financial_year'];
    } ?>

    <?php

    $ongoing = [];
    $not_approved = [];
    $initiated = [];
    $disputed = [];
    $completed = [];
    $total = [];

    $fy_scheme_targets = [];



    $query = "SELECT c.component_name as category, c.component_id FROM `component_categories` 
    INNER JOIN components as c ON(c.component_id = `component_categories`.component_id)
    GROUP BY  c.component_id";
    $categories = $this->db->query($query)->result_array();

    foreach ($categories as $category) {
        $query = "SELECT SUM(anual_target) as anual_target FROM `annual_work_plans`
                  WHERE component_id = ? AND financial_year_id IN ?";
        $awp_target = $this->db->query($query, array($category['component_id'], $fy_id))->row_array();

        $target = $awp_target ? (int) $awp_target['anual_target'] : 0;
        $fy_scheme_targets[] = [$category['category'], $target];

        $query = "SELECT COUNT(scheme_id) as total,
            SUM(CASE WHEN scheme_status = 'Ongoing' THEN 1 ELSE 0 END) AS ongoing,
            SUM(CASE WHEN scheme_status = 'Not Approved' THEN 1 ELSE 0 END) AS not_approved,
            SUM(CASE WHEN scheme_status = 'Initiated' THEN 1 ELSE 0 END) AS initiated,
            SUM(CASE WHEN scheme_status = 'Disputed' THEN 1 ELSE 0 END) AS disputed,
            SUM(CASE WHEN scheme_status = 'Completed' THEN 1 ELSE 0 END) AS completed
            FROM schemes  
            INNER JOIN component_categories as cc ON(cc.component_category_id = schemes.component_category_id)
            INNER JOIN components as c ON(c.component_id = `cc`.component_id)
            WHERE c.component_id = ? AND financial_year_id IN ?";
        $schemes = $this->db->query($query, array($category['component_id'], $fy_id))->row_array();

        if ($schemes) {
            $ongoing[] = [$category['category'], (int) $schemes['ongoing']];
            $not_approved[] = [$category['category'], (int) $schemes['not_approved']];
            $initiated[] = [$category['category'], (int) $schemes['initiated']];
            $disputed[] = [$category['category'], (int) $schemes['disputed']];
            $completed[] = [$category['category'], (int) $schemes['completed']];
            $total_scheme[] = [$category['category'], (int) $schemes['total']];
            //$cat[$category['category']]['color'] = '#FE2371';
        } else {
            $ongoing[] = [$category['category'], 0];
            $not_approved[] = [$category['category'], 0];
            $initiated[] = [$category['category'], 0];
            $disputed[] = [$category['category'], 0];
            $completed[] = [$category['category'], 0];
            $total_scheme[] = [$category['category'], 0];
        }
    }

    ?>


    <div id="componentsTargets" style="height: 300px;"></div>

    <script>
        var fy_scheme_targets = <?php echo json_encode($fy_scheme_targets); ?>;
        var not_approved = <?php echo json_encode($not_approved); ?>;
        var initiated = <?php echo json_encode($initiated); ?>;
        var ongoing = <?php echo json_encode($ongoing); ?>;
        var disputed = <?php echo json_encode($disputed); ?>;
        var completed = <?php echo json_encode($completed); ?>;
        var total_scheme = <?php echo json_encode($total_scheme); ?>;

        // Add upper case country code
        for ([key, value] of Object.entries(fy_scheme_targets)) {
            value.ucCode = key.toUpperCase();
        }

        getData = data => data.map(point => ({
            name: point[0],
            y: point[1],
            //color: fy_scheme_targets[point[0]].color
        }));

        chart = Highcharts.chart('componentsTargets', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Schemes Target Vs Achievements For FY: <?php echo implode(", ", $f_year) ?>',
                align: 'left',
                style: {
                    fontSize: '12px' // Set the font size of data labels
                }
            },
            subtitle: {
                text: 'Comparing targets and achievements across Components',
                align: 'left',
                style: {
                    fontSize: '10px' // Set the font size of data labels
                }
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
                enabled: true,
                itemStyle: {
                    fontSize: '9px'
                }

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
                    name: 'FY Targets',
                    color: 'rgba(158, 159, 163, 0.5)',
                    data: fy_scheme_targets.slice(),
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
                    name: 'Total',
                    // color: 'rgba(158, 159, 140, 9)',
                    color: '#2371FE',
                    data: getData(total_scheme).slice(),
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
                    data: getData(ongoing).slice(),
                    stack: 'schemes' // Stack "Achived" series
                },

                {
                    name: 'Completed',
                    // color: 'rgba(158, 200, 163, 9)',
                    color: '#01DC8E',
                    data: getData(completed).slice(),
                    stack: 'schemes' // Stack "Approved" series
                }, {
                    name: 'Disputed',
                    // color: 'rgba(158, 200, 163, 9)',
                    color: '#FFD700',
                    data: getData(disputed).slice(),
                    stack: 'schemes' // Stack "Approved" series
                }
            ],
            exporting: {
                allowHTML: true
            }
        });
    </script>

    <?php
    $end_time = microtime(true); // Record the end time in seconds with microseconds

    $execution_time = $end_time - $start_time; // Calculate the execution time

    echo "<small style='font-size:9px !important'>Execution Time: " . $execution_time . " seconds </small>";
    ?>
</div>