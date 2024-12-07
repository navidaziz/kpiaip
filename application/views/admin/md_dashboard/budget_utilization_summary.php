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
                text: 'Financial Overview and Performance Summary',
                align: 'left',
                style: {
                    fontSize: '15px' // Set the font size of data labels
                }
            },
            subtitle: {
                text: 'A Comparative Report on Receipts, Expenses, and Remaining Balances',
                align: 'left',
                style: {
                    fontSize: '10px' // Set the font size of data labels
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
                tickInterval: 3000,
                reversedStacks: false,
                endOnTick: true,
                showLastLabel: true,
                gridLineWidth: 0,
                labels: {
                    formatter: function() {
                        return this.value + ' million';
                    },
                    style: {
                        fontSize: '8px' // Adjust font size as needed
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
                    data: [<?php echo $world_bank->total / 1000000; ?>],
                    color: '#FF645A'
                },
                {
                    name: 'Budget',
                    data: [<?php echo $budget_released->total / 1000000; ?>],
                    color: '#FFA500'
                },

                {
                    name: 'Expenses',
                    data: [<?php echo $expenses->total / 1000000; ?>],
                    color: '#19F98B'
                }

            ]
        });
    </script>

    <?php
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    ?>
    <div style="background-color: white; margin-top:10px">
        <table class="table  table_medium2 table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th style="background-color: #FF645A;">Disbursement From (WB)</th>
                    <th style="background-color: #FFBE18;">Releases in RFA</th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <th>Receipts</th>
                    <td style="background-color: #FF645A; text-align:right"><?php echo number_format(max($world_bank->total/1000000, 0)); ?> (m)</td>
                    <td style="background-color: #FFBE18;"><?php echo number_format(max($budget_released->total/1000000, 0)); ?> (m)</td>
                </tr>
                <tr>
                    <th style="background-color: #19F98B"></th>
                    <th style="background-color: #19F98B;">Expenses</th>
                    <td  style="text-align: center; background-color: #19F98B"><?php echo number_format(max($expenses->total/1000000, 0)); ?> (m)</td>
                </tr>
                <tr>
                    <th>Balance</th>
                    <td style="background-color: #FF645A; text-align:right"><?php echo number_format(max(($world_bank->total - $expenses->total)/1000000, 0)); ?> (m)</td>
                    <td style="background-color: #FFBE18; text-align:center"><?php echo number_format(max(($budget_released->total - $expenses->total)/1000000, 0)); ?> (m)</td>
                </tr>

            </tbody>
        </table>
    </div>
    <small style="font-size:9px !important">Execution Time: <?php echo $execution_time; ?> seconds</small>
</div>