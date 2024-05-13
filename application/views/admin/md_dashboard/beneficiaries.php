<?php
$start_time = microtime(true);
?>
<?php
$fy_ids = $this->input->post('fy_ids');
//$fy_ids = array("1", "2", "3", "4");
$query = "SELECT SUM(beneficiaries) as total_beneficiaries,
                        SUM(male_beneficiaries) as male_beneficiaries,
                        SUM(female_beneficiaries) as female_beneficiaries
                        FROM `schemes`
                         WHERE  schemes.financial_year_id IN ? 
                         AND scheme_status IN('Ongoing','Disputed','Completed');";
$beneficiaries = $this->db->query($query, array($fy_ids))->row_array();
?>
<div class="jumbotron" style="padding: 2px;">
    <div id="BeneFiciaries" style="height:400px"></div>

    <script>
        // Build the chart
        Highcharts.chart('BeneFiciaries', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Beneficiaries Total (<?php echo $beneficiaries['total_beneficiaries'] ?>)',
                align: 'left',
                style: {
                    fontSize: '12px' // Set the font size of data labels
                }
            },
            subtitle: {
                text: 'Males: <?php echo $beneficiaries['male_beneficiaries'] ?>,  Females: <?php echo $beneficiaries['female_beneficiaries'] ?>',
                align: 'left',
                style: {
                    fontSize: '10px' // Set the font size of data labels
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

                data: [{
                        name: 'Males',
                        y: <?php echo $beneficiaries['male_beneficiaries'] ? $beneficiaries['male_beneficiaries'] : 0;  ?>
                    },
                    {
                        name: 'Females',
                        y: <?php echo $beneficiaries['female_beneficiaries'] ? $beneficiaries['female_beneficiaries'] : 0;  ?>
                    },
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