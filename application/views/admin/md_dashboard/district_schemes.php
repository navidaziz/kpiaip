<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="district_schemes_div" style="width:100%; height:400px;"></div>


    <?php
    // Calculate the total number of schemes for district-level summary
    $totalDistrictQuery = "SELECT COUNT(*) as grand_total FROM schemes as s
                       INNER JOIN districts as d ON(d.district_id = s.district_id) 
                       WHERE d.is_district = 1";
    $totalDistrictSchemes = $this->db->query($totalDistrictQuery)->row()->grand_total;
    ?>

    <script>
        Highcharts.chart('district_schemes_div', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'District-level Scheme Summary:',
                align: 'center'
            },
            subtitle: {
                text: 'Total Schemes: <?php echo $totalDistrictSchemes; ?>'
            },
            xAxis: {
                categories: [
                    <?php
                    $query = "SELECT d.district_name, d.district_id, COUNT(*) as total FROM schemes as s
                          INNER JOIN districts as d ON(d.district_id = s.district_id)
                          AND d.is_district = 1
                          GROUP BY d.district_name ORDER BY total DESC";
                    $districts = $this->db->query($query)->result();
                    foreach ($districts as $district) { ?> '<?php echo $district->district_name; ?>',
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
                        color: '#000000', // Change text color if needed
                        textOutline: 'none'
                    },
                    verticalAlign: 'top', // Position stack label at the top of the column
                    y: -10 // Adjust vertical positioning if needed
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true, // Enable data labels to show the stacked value
                        style: {
                            fontWeight: 'normal',
                            color: '#000000', // Change text color if needed
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
                    // "Not-Approved",
                    // "Disputed",
                    // "Par-Completed",
                    // "Registered",
                    // "Initiated",
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
                            <?php foreach ($districts as $district) {
                                $query = "SELECT COUNT(*) as total FROM schemes as s 
                                  WHERE s.district_id = '" . $district->district_id . "'
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