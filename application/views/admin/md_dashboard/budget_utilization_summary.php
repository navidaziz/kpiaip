<?php
$start_time = microtime(true);

// Sample financial year IDs
$fy_ids = $this->input->post('fy_ids');
//$fy_ids = array("4");
// Fetch financial years from the database
$query = "SELECT * FROM financial_years WHERE financial_year_id IN ? ORDER BY financial_year_id DESC";
$financial_years = $this->db->query($query, array($fy_ids))->result_array();
$f_year = array();
foreach ($financial_years as $financial_year) {
    $f_year[] = $financial_year['financial_year'];
}

// Prepare financial year labels
$f_year_labels = array();
$total_expenses = array();
$total_budget = array();
$budget_released = array();
$worldbank_released = array();
//$f_year = array();


//$f_year[] = $financial_year['financial_year'];
//$f_year_labels[] = "'" . $financial_year['financial_year'] . "'";

$query = "SELECT SUM(net_pay) as total
    FROM expenses
    WHERE  expenses.financial_year_id IN ?";
$expenses = $this->db->query($query, array($fy_ids))->row_array();

if ($expenses) {
    $total_expenses[] = ($expenses['total'] / 1000000);
    //$cat[$category['category']]['color'] = '#FE2371';
} else {
    $total_expenses[] = 0.00;
}

$query = "SELECT SUM(total_cost) as total_cost FROM `annual_work_plans`
                  WHERE financial_year_id IN ?";
$fy_budget = $this->db->query($query, array($fy_ids))->row_array();
if ($fy_budget) {
    $total_budget[] = ($fy_budget['total_cost'] / 1000000);
} else {
    $total_budget[] = 0.00;
}

$query = "SELECT SUM(rs_total) as br_total FROM `budget_released`
                  WHERE financial_year_id IN ?";
$budgetReleased = $this->db->query($query, array($fy_ids))->row_array();
if ($budgetReleased) {
    $budget_released[] = ($budgetReleased['br_total'] / 1000000);
} else {
    $budget_released[] = 0.00;
}

$query = "SELECT SUM(rs_total) as wb_total FROM `donor_funds_released`
                  WHERE financial_year_id IN ?";
$worldbankReleased = $this->db->query($query, array($fy_ids))->row_array();
if ($worldbankReleased) {
    $worldbank_released[] = ($worldbankReleased['wb_total'] / 1000000);
} else {
    $worldbank_released[] = 0.00;
}


$end_time = microtime(true);
$execution_time = $end_time - $start_time;
?>

<div class="jumbotron" style="padding: 2px;">
    <div id="BU_summary" style="height:400px"></div>

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
                text: 'Comparison of World Bank and Budget Releases, Expenses, and Total Budget for FY: <?php echo implode(", ", $f_year) ?>',
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
                    name: 'World Bank Released',
                    data: [<?php echo implode(', ', $worldbank_released); ?>]
                },
                {
                    name: 'Budget Released',
                    data: [<?php echo implode(', ', $budget_released); ?>]
                },
                {
                    name: 'Annual Budget',
                    data: [<?php echo implode(', ', $total_budget); ?>]
                },
                {
                    name: 'Expenses',
                    data: [<?php echo implode(', ', $total_expenses); ?>]
                }

            ]
        });
    </script>

    <small style="font-size:9px !important">Execution Time: <?php echo $execution_time; ?> seconds</small>
</div>