<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="schemes_category_total_div" style="width:100%; height:400px;"></div>

    <?php
    // Calculate the total number of schemes
    $totalQuery = "SELECT COUNT(*) as grand_total FROM schemes as s
               INNER JOIN districts as d ON(d.district_id = s.district_id) 
               WHERE d.is_district = 1";
    $totalSchemes = $this->db->query($totalQuery)->row()->grand_total;
    ?>

    <script>
        Highcharts.chart('schemes_category_total_div', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Scheme Status Distribution by Category',
                align: 'left'
            },
            subtitle: {
                text: 'Overview of Schemes Across Different Statuses (Not-Approved, Disputed, Registered, etc.)',
                align: 'left'
            },
            plotOptions: {
                column: {
                    depth: 25,
                    stacking: 'normal' // This enables stacking of columns
                }
            },
            xAxis: {
                type: 'category',
                labels: {
                    skew3d: true,
                    style: {
                        fontSize: '16px'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Schemes',
                    margin: 20
                },
                stackLabels: {
                    enabled: true, // Show total on top of each stack
                    style: {
                        fontWeight: 'bold',
                        color: '#000000',
                        textOutline: 'none'
                    }
                }
            },
            tooltip: {
                valueSuffix: ' Total Schemes',
            },
            series: [
                <?php
                $schemes = array(
                    //"Not-Approved",
                    "Disputed",
                    //"Par-Completed",
                    //"Registered",
                    //"Initiated",
                    "Ongoing",
                    "ICR-I",
                    "ICR-II",
                    //"Final",
                    "Completed"
                );
                foreach ($schemes as $scheme_status) {
                ?> {
                        name: '<?php
                                if ($scheme_status == "Ongoing") {
                                    echo "ICR-0";
                                } else {
                                    echo $scheme_status;
                                }
                                ?>',
                        data: [
                            <?php
                            $query = "SELECT cc.category, cc.category_detail, COUNT(s.scheme_id) as total FROM component_categories as cc 
                        INNER JOIN schemes as s ON( s.component_category_id = cc.component_category_id)
                        WHERE cc.component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)
                        AND s.scheme_status IN('" . $scheme_status . "')
                        GROUP BY cc.component_category_id ORDER BY cc.component_category_id ASC";
                            $component_categories = $this->db->query($query)->result();
                            foreach ($component_categories as $cc) { ?>['<?php echo $cc->category ?>', <?php echo $cc->total ?>], <?php } ?>
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