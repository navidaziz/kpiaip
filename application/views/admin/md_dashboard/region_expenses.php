<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="region_expense_div" style="width:100%; height:400px;"></div>
    <script>
        Highcharts.chart('region_expense_div', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Region Wise Expenses'
            },
            subtitle: {
                text: 'Expense on Region Max to Min'
            },
            xAxis: {
                type: 'category',
                labels: {
                    autoRotation: [-45, -90],
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
            },
            series: [{
                name: 'Population',
                colors: [
                    '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
                    '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
                    '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
                    '#03c69b', '#00f194'
                ],
                colorByPoint: true,
                groupPadding: 0,
                data: [
                    <?php
                    $query = "SELECT d.region, SUM(e.net_pay) as total FROM expenses as e
                    INNER JOIN districts as d ON(d.district_id = e.district_id)
                    and d.is_district =1
                    GROUP BY d.region ORDER BY total DESC";
                    $districts = $this->db->query($query)->result();
                    foreach ($districts as $district) { ?>['<?php echo htmlspecialchars($district->region); ?>', <?php echo round($district->total / 1000000, 3); ?>], <?php } ?>
                ],
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',

                }
            }]
        });
    </script>


    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>