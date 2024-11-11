<?php
$start_time = microtime(true);
?>

<div class="jumbotron" style="padding: 2px;">
    <div id="expensePurpose" style="height:400px"></div>

    <script>
        // Build the chart
        Highcharts.chart('expensePurpose', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Breakdown of expenditure categories',
                align: 'left',
                style: {
                    fontSize: '12px' // Set the font size of data labels
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<span style="font-size: 1.2em"><b>{point.name}</b></span><br>' +
                            '<span style="opacity: 0.6">{point.percentage:.1f} %</span>',
                        connectorColor: 'rgba(128,128,128,0.5)'
                    }
                }
            },
            series: [{
                name: 'Share',
                data: [<?php
                        $fy_ids = $this->input->post('fy_ids');
                        //$fy_ids = array("1", "2", "3", "4");
                        $query = "SELECT purpose, SUM(net_pay) as total  
                         FROM expenses
                         WHERE  expenses.financial_year_id IN ?
                         Group by purpose;
                         ";
                        $expense_purposes = $this->db->query($query, array($fy_ids))->result_array();
                        foreach ($expense_purposes as $e_purpose) { ?> {
                            name: '<?php echo $e_purpose['purpose'] ?>',
                            y: <?php echo ($e_purpose['total']) ?>
                        },
                    <?php } ?>
                ]
            }]
        });
    </script>
    <?php
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    ?>
    <small style="font-size:9px !important">Execution Time: <?php echo $execution_time; ?> seconds</small>
</div>