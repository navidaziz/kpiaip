<?php
$start_time = microtime(true);

$query = "SELECT SUM(net_pay) as total FROM expenses";
$expenses = $this->db->query($query)->row();

$query = "SELECT SUM(total_cost) as total FROM `annual_work_plans`";
$awp_budget = $this->db->query($query)->row();

$query = "SELECT SUM(rs_total) as total FROM `budget_released`";
$budget_released = $this->db->query($query)->row();

$query = "SELECT SUM(rs_total) as total FROM `donor_funds_released`";
$world_bank = $this->db->query($query)->row();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="BU_summary"></div>

    <script>
        Highcharts.chart('BU_summary', {
            colors: ['#FFD700', '#C0C0C0', '#CD7F32', '#BC8F8F'],
            chart: {
                type: 'column',
                inverted: true,
                polar: true
            },
            title: {
                text: 'Over All Budget Utilization Analysis',
                align: 'left',
                style: {
                    fontSize: '15px' // Set the font size of data labels
                }
            },
            subtitle: {
                text: 'FY: 2019-20 to <?php echo $f_year[0]; ?>',
                align: 'left',
                style: {
                    fontSize: '13px' // Set the font size of data labels
                }
            },
            tooltip: {
                outside: true
            },
            pane: {
                size: '85%',
                innerSize: '20%',
                endAngle: 270
            },
            xAxis: {
                tickInterval: 1,
                labels: {
                    align: 'right',
                    useHTML: true,
                    allowOverlap: true,
                    step: 1,
                    y: 3,
                    // style: {
                    //     fontSize: '13px'
                    // }
                },
                lineWidth: 0,
                gridLineWidth: 0,
                categories: ['']
            },
            yAxis: {
                lineWidth: 1,
                tickInterval: 1000,
                reversedStacks: false,
                endOnTick: true,
                showLastLabel: true,
                gridLineWidth: 0,
                labels: {
                    formatter: function() {
                        return this.value + 'M';
                    }
                },
            },
            plotOptions: {
                column: {
                    //stacking: 'normal',
                    borderWidth: 0,
                    pointPadding: 0,
                    groupPadding: 0.15,
                    borderRadius: '50%'
                }
            },
            series: [{
                    name: 'World Bank',
                    data: [<?php echo $world_bank->total; ?>]
                },
                {
                    name: 'Budget Released',
                    data: [<?php echo $budget_released->total; ?>]
                },
                {
                    name: 'Workplan Budget',
                    data: [<?php echo $awp_budget->total; ?>]
                },
                {
                    name: 'Expenses',
                    data: [<?php echo $expenses->total; ?>]
                }

            ]
        });
    </script>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>World Bank</td>
                <td>Budget Released</td>
                <td>Workplan Budget</td>
                <td>Expenses</td>

            </tr>
            <tr>
                <td><?php echo number_format(max($world_bank->total, 0)); ?></td>
                <td><?php echo number_format(max($budget_released->total, 0)); ?></td>
                <!-- <td><?php echo number_format(max($awp_budget->total, 0)); ?></td> -->
                <td><?php echo number_format(max($expenses->total, 0)); ?></td>
            </tr>
            <tr>
                <td><?php echo number_format(max($world_bank->total - $expenses->total, 0)); ?></td>
                <td><?php echo number_format(max($budget_released->total - $expenses->total, 0)); ?></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <?php
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    ?>
    <small style="font-size:9px !important">Execution Time: <?php echo $execution_time; ?> seconds</small>
</div>