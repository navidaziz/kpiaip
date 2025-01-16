<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="schemes_category_heat_map" style="width:100%; height:400px;"></div>
    <script>
        // Create the chart
        Highcharts.chart('schemes_category_heat_map', {

            chart: {
                type: 'heatmap', // Heatmap chart type
                marginTop: 40,
                marginBottom: 80,
                plotBorderWidth: 1
            },

            title: {
                text: 'Scheme Status Distribution by Category',
                style: {
                    fontSize: '1em'
                }
            },

            xAxis: {
                categories: [
                    <?php
                    // Fetching distinct categories for the x-axis
                    $query = "SELECT DISTINCT sc.sub_component_name, sc.sub_component_id FROM component_categories as cc
                INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id) 
                WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                    $sub_components = $this->db->query($query)->result();
                    foreach ($sub_components as $sub_component) {
                        echo "'" . $sub_component->sub_component_name . "',";
                    }
                    ?>
                ],
                title: {
                    text: 'Category'
                }
            },

            yAxis: {
                categories: [
                    <?php
                    // Define scheme statuses for the y-axis
                    $schemes = array(
                        "Not-Approved",
                        "Disputed",
                        "Par-Completed",
                        "Registered",
                        "Initiated",
                        "Ongoing",
                        "ICR-I",
                        "ICR-II",
                        "Final",
                        "Completed"
                    );
                    foreach ($schemes as $scheme_status) {
                        echo "'" . $scheme_status . "',";
                    }
                    ?>
                ],
                title: null,
                reversed: true
            },

            accessibility: {
                point: {
                    descriptionFormat: '{series.xAxis.categories[(point.x)]} ' +
                        '{series.yAxis.categories[(point.y)]}, {value}.'
                }
            },

            colorAxis: {
                min: 0,
                minColor: '#FFFFFF',
                maxColor: Highcharts.getOptions().colors[0]
            },

            legend: {
                align: 'right',
                layout: 'vertical',
                margin: 0,
                verticalAlign: 'top',
                y: 25,
                symbolHeight: 280
            },

            tooltip: {
                format: '<b>{series.xAxis.categories[(point.x)]}</b><br>' +
                    '<b>{point.value}</b> schemes with <br>' +
                    '<b>{series.yAxis.categories[(point.y)]}</b>'
            },

            series: [{
                name: 'Scheme Status Distribution',
                borderWidth: 1,
                data: [
                    <?php
                    // Loop to generate the heatmap data with x (category), y (scheme status), and value (count of schemes)
                    foreach ($schemes as $scheme_status) {
                        foreach ($sub_components as $sub_component) {
                            // Get the count of schemes for the category and scheme status combination
                            $query = "SELECT COUNT(s.scheme_id) as total FROM sub_components as sc 
                        INNER JOIN component_categories as cc ON(cc.sub_component_id = sc.sub_component_id) 
                        INNER JOIN schemes as s ON( s.component_category_id = cc.component_category_id)
                        WHERE cc.sub_component_id = '" . $sub_component->sub_component_id . "'
                        AND s.scheme_status IN('" . $scheme_status . "')";
                            $result = $this->db->query($query)->row();
                            $total = $result ? $result->total : 0;  // If no result, set total to 0

                            // Manually find the index of sub_component_name and scheme_status
                            $x_index = 0;
                            foreach ($sub_components as $key => $sub) {
                                if ($sub->sub_component_name == $sub_component->sub_component_name) {
                                    $x_index = $key;
                                    break;
                                }
                            }

                            $y_index = 0;
                            foreach ($schemes as $key => $status) {
                                if ($status == $scheme_status) {
                                    $y_index = $key;
                                    break;
                                }
                            }

                            // Insert this data into the heatmap (category index, status index, count)
                            echo "[" . $x_index . ", " . $y_index . ", " . $total . "], ";
                        }
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    color: '#000000'
                }
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        yAxis: {
                            labels: {
                                format: '{substr value 0 1}'
                            }
                        }
                    }
                }]
            }

        });
    </script>

    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>