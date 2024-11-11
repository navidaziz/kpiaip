<?php
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();
$expense_cumulative = 0;
$world_bank_cumulative = 0;
$budget_released_cumulative = 0;
foreach ($fys as $fy) {
    //expense query ..................
    $query = "SELECT SUM(net_pay) as total FROM expenses WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $expenses = $this->db->query($query)->row();
    if ($expenses->total > 0) {
        $fy->expense =  $expenses->total;
    } else {
        $fy->expense = 0;
    }
    $expense_cumulative += $fy->expense;
    $fy->cumulative_expense = $expense_cumulative;
    //expense query end here ......................

    //worldbank query ..................
    $query = "SELECT SUM(rs_total) as total FROM donor_funds_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $world_bank = $this->db->query($query)->row();
    if ($world_bank->total > 0) {
        $fy->world_bank =  $world_bank->total;
    } else {
        $fy->world_bank = 0;
    }
    $world_bank_cumulative += $fy->world_bank;
    $fy->world_bank_cumulative = $world_bank_cumulative;
    //worldbank query end here ......................

    //budget query ..................
    $query = "SELECT SUM(rs_total) as total FROM budget_released WHERE DATE(`date`) BETWEEN '" . $fy->start_date . "' AND '" . $fy->end_date . "'";
    $budget_released = $this->db->query($query)->row();
    if ($budget_released->total > 0) {
        $fy->budget_released =  $budget_released->total;
    } else {
        $fy->budget_released = 0;
    }
    $budget_released_cumulative += $fy->budget_released;
    $fy->budget_released_cumulative = $budget_released_cumulative;
    //budget query end here ......................
}
?>
<table class="table table-bordered table_small">
    <tr>
        <th></th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo $fy->financial_year; ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Expenses</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->expense, 2); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Cumulative Expenses</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->cumulative_expense, 2); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>World Bank</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->world_bank, 2); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Cumulative World Bank</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->world_bank_cumulative, 2); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Budget Released</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->budget_released, 2); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Cumulative World Bank</th>
        <?php foreach ($fys as $fy) { ?>
            <th><?php echo number_format($fy->budget_released_cumulative, 2); ?></th>
        <?php } ?>
    </tr>
</table>
<div class="jumbotron" style="padding: 2px;">

    <div id="cumulative"></div>
    <script>
        Highcharts.chart('cumulative', {

            title: {
                text: 'U.S Solar Employment Growth',
                align: 'left'
            },

            subtitle: {
                text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Range: 2010 to 2022'
                }
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
                    pointStart: 2010
                }
            },

            series: [{
                    name: 'Expense',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->cumulative_expense / 1000000 . ",";
                            } ?>]
                },
                {
                    name: 'World Bank',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->world_bank_cumulative / 1000000 . ",";
                            } ?>]
                },
                {
                    name: 'Budget Released',
                    data: [<?php foreach ($fys as $fy) {
                                echo $fy->budget_released_cumulative / 1000000 . ",";
                            } ?>]
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

</div>
</a>