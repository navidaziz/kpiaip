<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

// Initializing cumulative values
$expense_cumulative = 0;
$world_bank_cumulative = 0;
$budget_released_cumulative = 0;

foreach ($fys as $fy) {
    // Fetch expenses
    $expense_query = "SELECT SUM(net_pay) as total FROM expenses WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $expense_result = $this->db->query($expense_query)->row();
    if (isset($expense_result->total)) {
        $fy->expense = $expense_result->total;
    } else {
        $fy->expense = 0;
    }
    $expense_cumulative += $fy->expense;
    $fy->cumulative_expense = $expense_cumulative;

    // Fetch World Bank funding (assuming you have data for this)
    $world_bank_query = "SELECT SUM(rs_total) as total FROM donor_funds_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $world_bank_result = $this->db->query($world_bank_query)->row();
    if (isset($world_bank_result->total)) {
        $fy->world_bank = $world_bank_result->total;
    } else {
        $fy->world_bank = 0;
    }
    $world_bank_cumulative += $fy->world_bank;
    $fy->world_bank_cumulative = $world_bank_cumulative;

    // Fetch Budget Released (assuming you have data for this)
    $budget_released_query = "SELECT SUM(rs_total) as total FROM budget_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $budget_released_result = $this->db->query($budget_released_query)->row();
    if (isset($budget_released_result->total)) {
        $fy->budget_released = $budget_released_result->total;
    } else {
        $fy->budget_released = 0;
    }
    $budget_released_cumulative += $fy->budget_released;
    $fy->budget_released_cumulative = $budget_released_cumulative;
}
?>

<div class="jumbotron" style="padding: 2px;">
    <div id="cumulative"></div>
    <script>
        Highcharts.chart('cumulative', {
            title: {
                text: 'Financial Data - Trends and Yearly Analysis',
                align: 'left'
            },

            subtitle: {
                text: 'Comparison of Cumulative and Yearly Totals for Expenses, World Bank Funds, and Budget Released',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: 'Amount (in millions)'
                }
            },

            xAxis: {
                categories: [<?php foreach ($fys as $fy) {
                                    echo "'" . $fy->financial_year . "',";
                                } ?>]
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    marker: {
                        enabled: true
                    }
                }
            },

            series: [
                // Cumulative Data Series
                {
                    name: 'Cumulative Expense',
                    type: 'spline',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->cumulative_expense / 1000000 . ",";
                            } ?>],
                    color: '#00E272'
                },
                {
                    name: 'Cumulative World Bank',
                    type: 'spline',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->world_bank_cumulative / 1000000 . ",";
                            } ?>],
                    color: '#FA4B41'
                },

                // Yearly Data Series
                {
                    name: 'Yearly World Bank',
                    type: 'column',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->world_bank / 1000000 . ",";
                            } ?>],
                    color: '#FA4B41'
                },
                {
                    name: 'Yearly Expense',
                    type: 'column',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->expense / 1000000 . ",";
                            } ?>],
                    color: '#00E272'
                },
                // Pie Chart for total distribution of Expenses for the latest year (example)
                {
                    name: 'Expense for Purpose',
                    type: 'pie',
                    data: [
                        <?php
                        $query = "SELECT purpose, SUM(net_pay) as total FROM expenses GROUP BY purpose ORDER BY total DESC;";
                        $expense_purposes = $this->db->query($query)->result_array();
                        foreach ($expense_purposes as $e_purpose) { ?> {
                                name: '<?php echo $e_purpose['purpose'] ?>',
                                y: <?php echo ($e_purpose['total']) ?>
                            },
                        <?php } ?>
                    ],
                    size: '20%', // Adjust the size as needed
                    center: ['10%', '30%'], // Position the pie chart on the left
                    showInLegend: true
                },
                {
                    name: 'World Bank Balance',
                    type: 'line',
                    data: [<?php foreach ($fys as $fy) {
                                echo ($world_bank_cumulative - $expense_cumulative) / 1000000 . ","; // Adjust this according to your balance data
                            } ?>],
                    color: '#FF0000', // Choose any color for the balance line
                    dashStyle: 'ShortDash', // Make the line dashed for distinction
                    lineWidth: 1, // Make the line thinner (default is 2)
                    marker: {
                        enabled: false // Disable markers for all points initially
                    },
                    dataLabels: {
                        enabled: true, // Enable data labels
                        color: '#000', // Set the text color for the labels
                        style: {
                            fontSize: '10px', // Adjust font size
                            fontWeight: 'bold' // Font weight of the label
                        },
                        formatter: function() {
                            // Only show the data label for the last point
                            if (this.point.index === this.series.data.length - 1) {
                                return this.y; // Show the y-value (balance) for the last point
                            }
                            return null; // Hide data labels for all other points
                        },
                        y: -10 // Adjust the vertical position of the data label
                    },
                    tooltip: {
                        valueSuffix: ' millions' // Add units for clarity
                    },
                    states: {
                        hover: {
                            enabled: false // Disable hover effect on the line
                        }
                    },
                    // Enabling marker only for the last point
                    point: {
                        events: {
                            mouseOver: function() {
                                // Enable marker for the hovered point
                                this.series.update({
                                    marker: {
                                        enabled: true
                                    }
                                });
                            },
                            mouseOut: function() {
                                // Disable markers when the hover effect is removed
                                this.series.update({
                                    marker: {
                                        enabled: false
                                    }
                                });
                            }
                        }
                    },
                    plotOptions: {
                        line: {
                            marker: {
                                enabled: function() {
                                    // Only show the marker for the last point
                                    return this.index === this.series.data.length - 1;
                                }
                            }
                        }
                    }
                },

                {
                    name: 'Budget Balance',
                    type: 'line',
                    data: [<?php foreach ($fys as $fy) {
                                echo (($budget_released_cumulative - $expense_cumulative) / 1000000) . ","; // Adjust this according to your balance data
                            } ?>],
                    color: '#FFA500', // Choose any color for the balance line
                    dashStyle: 'ShortDash', // Make the line dashed for distinction
                    lineWidth: 2, // Make the line thinner (default is 2)
                    marker: {
                        enabled: true,
                        symbol: 'dash', // You can change the symbol (e.g., 'circle', 'square', 'diamond', etc.)
                        radius: 3 // Adjust the marker size if needed
                    },
                    dataLabels: {
                        enabled: true, // Enable data labels
                        color: '#000', // Set the text color for the labels
                        style: {
                            fontSize: '10px', // Adjust font size
                            fontWeight: 'bold' // Font weight of the label
                        },
                        formatter: function() {
                            // Only show the data label for the last point
                            if (this.point.index === this.series.data.length - 1) {
                                return this.y; // Show the y-value (balance) for the last point
                            }
                            return null; // Hide data labels for all other points
                        },
                        y: -10 // Adjust the vertical position of the data label
                    },
                    tooltip: {
                        valueSuffix: ' millions' // Add units for clarity
                    }
                },


            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>


    <div style="background-color: white; margin-top:10px">
        <div class="table-responsive">
            <table>
                <tr>
                    <td>
                        <table class="table table-bordered table_small">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <th><?php echo $fy->financial_year; ?></th>
                                    <?php } ?>
                                    <!-- <th>Current Account Balance</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- World Bank Receipts -->
                                <tr style="background-color: #FF645A;">
                                    <th rowspan="3">World Bank</th>
                                    <th>Receipts</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->world_bank, 2); ?></td>
                                    <?php } ?>
                                    <!-- <th rowspan="3" style="vertical-align: middle; font-size:12px">
                                    <?php echo number_format($world_bank_cumulative - $expense_cumulative, 2); ?>
                                </th> -->
                                </tr>
                                <tr style="background-color: #FF645A;">
                                    <th>Cumulative</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->world_bank_cumulative, 2); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr style="background-color: #FF645A;">
                                    <th>Yearly Balance</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->world_bank_cumulative - $fy->cumulative_expense, 2); ?></td>
                                    <?php } ?>

                                </tr>

                                <!-- Finance Budget Receipts -->
                                <tr style="background-color: #FFA500;">
                                    <th rowspan="3">Finance Budget</th>
                                    <th>Receipts</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->budget_released, 2); ?></td>
                                    <?php } ?>
                                    <!-- <th rowspan="3" style="vertical-align: middle; font-size:12px">
                                    <?php echo number_format($budget_released_cumulative - $expense_cumulative, 2); ?>
                                </th> -->
                                </tr>
                                <tr style="background-color: #FFA500;">
                                    <th>Cumulative</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->budget_released_cumulative, 2); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr style="background-color: #FFA500;">
                                    <th>Yearly Balance</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->budget_released_cumulative - $fy->cumulative_expense, 2); ?></td>
                                    <?php } ?>
                                </tr>

                                <!-- Expenses -->
                                <tr style="background-color: #16FA8B;">
                                    <th rowspan="2">Expenses</th>
                                    <th>Yearly Expense</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->expense, 2); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr style="background-color: #16FA8B;">
                                    <th>Cumulative Expenses</th>
                                    <?php foreach ($fys as $fy) { ?>
                                        <td><?php echo number_format($fy->cumulative_expense, 2); ?></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>

                        <table class="table table-bordered table_small">
                            <tr>
                                <th>Expense Purpose</th>
                                <td>Total</td>
                                <td>%</td>
                            </tr>
                            <?php foreach ($expense_purposes as $e_purpose) { ?>
                                <tr>
                                    <th><?php echo $e_purpose['purpose'] ?> </th>
                                    <td> <?php echo number_format($e_purpose['total'], 2) ?></td>
                                    <td> <?php echo number_format(($e_purpose['total'] * 100) / $expense_cumulative, 2) ?> %</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>