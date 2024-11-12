<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="region_schemes_div" style="width:100%; height:400px;"></div>

    <script>
        Highcharts.chart('region_schemes_div', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Ferry passengers by vehicle type 2024',
                align: 'left'
            },
            xAxis: {
                categories: [
                    <?php
                    $query = "SELECT d.region, COUNT(*) as total FROM schemes as s
                            INNER JOIN districts as d ON(d.district_id = s.district_id)
                            and d.is_district =1
                            GROUP BY d.region ORDER BY total DESC";
                    $regions = $this->db->query($query)->result();
                    $count = 1;
                    foreach ($regions as $region) { ?> '<?php echo $region->region; ?>', <?php } ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [
                <?php
                $schemes = array(
                    "Not Approved",
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
                foreach ($schemes as $scheme_status) { ?> {
                        name: '<?php echo $scheme_status; ?>',
                        data: [
                            <?php foreach ($regions as $region) {
                                $query = "SELECT COUNT(*) as total FROM schemes as s
                                INNER JOIN districts as d ON(d.district_id = s.district_id) 
                                WHERE d.region = '" . $region->region . "'
                                AND s.scheme_status IN('" . $scheme_status . "')";
                                $scheme = $this->db->query($query)->row();
                                $s_status = 0;
                                if ($scheme and $scheme->total > 0) {
                                    $s_status = $scheme->total;
                                }
                            ?>
                                <?php echo $s_status; ?>,
                            <?php } ?>
                        ]
                    },
                <?php } ?>
            ]
        });
    </script>



    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>