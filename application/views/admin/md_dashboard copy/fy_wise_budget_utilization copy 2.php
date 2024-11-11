<?php
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
    $fy->expense = $expense_result->total ?? 0;
    $expense_cumulative += $fy->expense;
    $fy->cumulative_expense = $expense_cumulative;

    // Fetch World Bank funding (assuming you have data for this)
    $world_bank_query = "SELECT SUM(rs_total) as total FROM donor_funds_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $world_bank_result = $this->db->query($world_bank_query)->row();
    $fy->world_bank = $world_bank_result->total ?? 0;
    $world_bank_cumulative += $fy->world_bank;
    $fy->world_bank_cumulative = $world_bank_cumulative;

    // Fetch Budget Released (assuming you have data for this)
    $budget_released_query = "SELECT SUM(rs_total) as total FROM budget_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $budget_released_result = $this->db->query($budget_released_query)->row();
    $fy->budget_released = $budget_released_result->total ?? 0;
    $budget_released_cumulative += $fy->budget_released;
    $fy->budget_released_cumulative = $budget_released_cumulative;
}
?>

<!-- Highcharts bar chart for cumulative data -->
<div id="cumulative" style="width:100%; height:400px;"></div>
<script>
    Highcharts.chart('cumulative', {
        title: {
            text: 'Financial Data - Cumulative and Yearly Totals',
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
                type: 'line',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->cumulative_expense / 1000000 . ",";
                        } ?>],
                color: '#CD7F31'
            },
            {
                name: 'Cumulative World Bank',
                type: 'line',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->world_bank_cumulative / 1000000 . ",";
                        } ?>],
                color: '#FFD601'
            },
            {
                name: 'Cumulative Budget Released',
                type: 'line',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->budget_released_cumulative / 1000000 . ",";
                        } ?>],
                color: '#F2F2F2'
            },

            // Yearly Data Series
            {
                name: 'Yearly World Bank',
                type: 'column',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->world_bank / 1000000 . ",";
                        } ?>],
                color: '#FFD601'
            },
            {
                name: 'Yearly Budget Released',
                type: 'column',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->budget_released / 1000000 . ",";
                        } ?>],
                color: '#F2F2F2'
            },
            {
                name: 'Yearly Expense',
                type: 'column',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->expense / 1000000 . ",";
                        } ?>],
                color: '#CD7F31'
            },
            // Pie Chart for total distribution of Expenses for the latest year (example)
            {
                name: 'Expense for Purpose',
                type: 'pie',
                data: [
                    <?php
                    $query = "SELECT purpose, SUM(net_pay) as total FROM expenses GROUP BY purpose;";
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
            // Add the Balance Line
            {
                name: 'Balance Line',
                type: 'line',
                data: [<?php foreach ($fys as $fy) {
                            echo ($fy->world_bank_cumulative - $fy->cumulative_expense) / 1000000 . ","; // Adjust this according to your balance data
                        } ?>],
                color: '#00FF00', // Choose any color for the balance line
                dashStyle: 'ShortDash', // Make the line dashed for distinction
                marker: {
                    enabled: true,
                    symbol: 'circle'
                },
                tooltip: {
                    valueSuffix: ' millions' // Add units for clarity
                }
            },
            // Add the Balance Line
            {
                name: 'Balance Line',
                type: 'line',
                data: [<?php foreach ($fys as $fy) {
                            echo $fy->budget_released / 1000000 . ","; // Adjust this according to your balance data
                        } ?>],
                color: '#000000', // Choose any color for the balance line
                dashStyle: 'ShortDash', // Make the line dashed for distinction
                marker: {
                    enabled: true,
                    symbol: 'circle'
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