<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>
<div class="jumbotron" style="padding: 2px;">
    <div id="category_total_div" style="width:100%; height:400px;"></div>

    <script>
        Highcharts.chart('category_total_div', {
            title: {
                text: 'Histogram of Random Data'
            },
            xAxis: [{
                title: {
                    text: 'Data Value'
                },
                alignTicks: false
            }, {
                title: {
                    text: 'Frequency'
                },
                alignTicks: false,
                opposite: true
            }],

            yAxis: [{
                title: {
                    text: 'Frequency'
                }
            }],

            series: [{
                name: 'Histogram',
                type: 'histogram',
                xAxis: 0,
                yAxis: 0,
                baseSeries: 's1',
                zIndex: -1
            }, {
                name: 'Data',
                type: 'scatter',
                data: [1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 4, 5, 5, 6, 7, 8, 9, 10, 10, 10],
                id: 's1',
                marker: {
                    radius: 1.5
                }
            }]
        });
    </script>



    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>