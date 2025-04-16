<?php
$start_time = microtime(true);

// Fetch financial years
$fys = $this->db->query("SELECT * FROM financial_years")->result();

// Fetch distinct districts for x-axis
$districts = $this->db->query("SELECT *  FROM districts WHERE is_district=1")->result();

// Scheme statuses for y-axis
// $schemes = [
//     "Not-Approved", "Disputed", "Par-Completed", "Registered", "Initiated", 
//     "Ongoing", "ICR-I", "ICR-II", "Final", "Completed"
// ];

$schemes = [
    "Ongoing",
    "ICR-I",
    "ICR-II",
    //"Final"
];

// Heatmap data preparation
$heatmap_data = [];
foreach ($schemes as $y_index => $scheme_status) {
    foreach ($districts as $x_index => $district) {
        $query = "
            SELECT COUNT(s.scheme_id) AS total 
            FROM schemes AS s 
            WHERE s.district_id = ? 
            AND s.scheme_status = ?";
        $result = $this->db->query($query, [$district->district_id, $scheme_status])->row();
        $total = $result ? (int)$result->total : 0;

        $heatmap_data[] = [$x_index, $y_index, $total];
    }
}
?>

<div class="jumbotron" style="padding: 2px;">
    <div id="district_scheme_heat_map_chart" style="width:100%;"></div>
    <script>
        Highcharts.chart('district_scheme_heat_map_chart', {
            chart: {
                type: 'heatmap',
                marginTop: 40,
                marginBottom: 80,
                plotBorderWidth: 1
            },
            title: {
                text: 'District-Wise Ongoing Schemes',
                style: {
                    fontSize: '1em'
                }
            },
            xAxis: {
                categories: [
                    <?php foreach ($districts as $district): ?> '<?php echo addslashes($district->district_name); ?>',
                    <?php endforeach; ?>
                ],
                title: {
                    text: 'Districts'
                }
            },
            yAxis: {
                categories: [
                    <?php foreach ($schemes as $scheme_status): ?> '<?php
                                                                    if ($scheme_status == "Ongoing") {
                                                                        echo "ICR-0";
                                                                    } else {
                                                                        echo $scheme_status;
                                                                    } ?>',
                    <?php endforeach; ?>
                ],
                title: null,
                reversed: true
            },
            accessibility: {
                point: {
                    descriptionFormat: '{series.xAxis.categories[point.x]} ' +
                        '{series.yAxis.categories[point.y]}, {point.value}.'
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
                formatter: function() {
                    return `<b>${this.series.xAxis.categories[this.point.x]}</b><br>
                            <b>${this.point.value}</b> schemes with <br>
                            <b>${this.series.yAxis.categories[this.point.y]}</b>`;
                }
            },
            series: [{
                name: 'Scheme Status Distribution',
                borderWidth: 1,
                data: <?php echo json_encode($heatmap_data); ?>,
                dataLabels: {
                    enabled: true,
                    color: '#000000'
                }
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 100
                    },
                    chartOptions: {
                        yAxis: {
                            labels: {
                                formatter: function() {
                                    return this.value[0]; // Shorten the label to the first character
                                }
                            }
                        }
                    }
                }]
            }
        });
    </script>
    <small style="font-size:9px !important">
        Execution Time: <?php echo round(microtime(true) - $start_time, 4); ?> seconds
    </small>
</div>