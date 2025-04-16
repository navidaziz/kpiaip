<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="region_schemes_div" style="width:100%; height:400px;"></div>

    <?php
    // Calculate the total number of schemes
    $totalQuery = "SELECT COUNT(*) as grand_total FROM schemes as s
               INNER JOIN districts as d ON(d.district_id = s.district_id) 
               WHERE d.is_district = 1";
    $totalSchemes = $this->db->query($totalQuery)->row()->grand_total;
    ?>

    <script>
        Highcharts.chart('region_schemes_div', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Regional-level Scheme Summary'
            },
            subtitle: {
                text: 'Total Schemes: <?php echo $totalSchemes; ?>'
            },
            xAxis: {
                categories: [
                    <?php
                    $query = "SELECT d.region, COUNT(*) as total FROM schemes as s
                          INNER JOIN districts as d ON(d.district_id = s.district_id)
                          AND d.is_district = 1
                          GROUP BY d.region ORDER BY total DESC";
                    $regions = $this->db->query($query)->result();
                    foreach ($regions as $region) { ?> '<?php echo $region->region; ?>',
                    <?php } ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                },
                stackLabels: {
                    enabled: true, // Show the total stacked value on top
                    style: {
                        fontWeight: 'bold',
                        color: '#000000',
                        textOutline: 'none'
                    },
                    verticalAlign: 'right',
                    y: 10
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'normal',
                            color: '#000000',
                        },
                        formatter: function() {
                            // Only show the data label if the value is greater than 0
                            if (this.y > 0) {
                                return this.y;
                            }
                            return null; // Hide data label if the value is 0
                        }
                    }
                }
            },
            series: [
                <?php
                $schemes = array(
                    //"Not-Approved",
                    //"Disputed",
                    //"Par-Completed",
                    //"Registered",
                    //"Initiated",
                    "Ongoing",
                    "ICR-I",
                    "ICR-II",
                    //"Final",
                    "Completed"
                );
                foreach ($schemes as $scheme_status) { ?> {
                        name: '<?php
                                if ($scheme_status == "Ongoing") {
                                    echo "ICR-0";
                                } else {
                                    echo $scheme_status;
                                } ?>',
                        data: [
                            <?php foreach ($regions as $region) {
                                $query = "SELECT COUNT(*) as total FROM schemes as s
                                      INNER JOIN districts as d ON(d.district_id = s.district_id) 
                                      WHERE d.region = '" . $region->region . "'
                                      AND s.scheme_status IN('" . $scheme_status . "')";
                                $scheme = $this->db->query($query)->row();
                                $s_status = $scheme && $scheme->total ? $scheme->total : 0;
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