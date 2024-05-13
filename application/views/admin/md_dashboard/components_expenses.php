<?php
$start_time = microtime(true);
?>
<div class="jumbotron" style="padding: 2px;">
    <?php
    $fy_id = $this->input->post('fy_ids');
    $query = "SELECT * FROM financial_years WHERE financial_year_id IN ?";
    $financial_years = $this->db->query($query, array($fy_id))->result_array();
    $f_year = array();
    foreach ($financial_years as $financial_year) {
        $f_year[] = $financial_year['financial_year'];
    } ?>

    <?php

    $ongoing = [];
    $not_approved = [];
    $initiated = [];
    $disputed = [];
    $completed = [];
    $total = [];

    $fy_awp_budget = [];



    $query = "SELECT c.component_name as category, c.component_id FROM `component_categories` 
    INNER JOIN components as c ON(c.component_id = `component_categories`.component_id)
    GROUP BY  c.component_id";
    $categories = $this->db->query($query)->result_array();

    foreach ($categories as $category) {
        $query = "SELECT SUM(total_cost) as total_cost FROM `annual_work_plans`
                  WHERE component_id = ? AND financial_year_id IN ?";
        $awp_budget = $this->db->query($query, array($category['component_id'], $fy_id))->row_array();

        $awp_budget = $awp_budget ?  ($awp_budget['total_cost'] / 1000000) : 0;
        $fy_awp_budget[] = [$category['category'], $awp_budget];

        $query = "SELECT SUM(net_pay) as total
            FROM expenses  
            INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
            INNER JOIN components as c ON(c.component_id = `cc`.component_id)
            WHERE c.component_id = ? AND expenses.financial_year_id IN ?";
        $expenses = $this->db->query($query, array($category['component_id'], $fy_id))->row_array();

        if ($expenses) {
            $total_expenses[] = [$category['category'], ($expenses['total'] / 1000000)];
            //$cat[$category['category']]['color'] = '#FE2371';
        } else {
            $total_expenses[] = [$category['category'], 0.00];
        }
    }

    ?>


    <div id="componentsExpenses" style="height: 300px;"></div>

    <script>
        var fy_awp_budget = <?php echo json_encode($fy_awp_budget); ?>;
        var total_expenses = <?php echo json_encode($total_expenses); ?>;

        // Add upper case country code
        for ([key, value] of Object.entries(fy_awp_budget)) {
            value.ucCode = key.toUpperCase();
        }

        getData = data => data.map(point => ({
            name: point[0],
            y: point[1],
            //color: fy_awp_budget[point[0]].color
        }));

        chart = Highcharts.chart('componentsExpenses', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Budget vs Expense For FY: <?php echo implode(", ", $f_year) ?>',
                align: 'left',
                style: {
                    fontSize: '12px' // Set the font size of data labels
                }
            },
            subtitle: {
                text: 'Comparing Budget and Expense across Components',
                align: 'left',
                style: {
                    fontSize: '10px' // Set the font size of data labels
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '7px' // Set the font size of data labels
                        },


                    },
                    grouping: false
                }
            },
            legend: {
                enabled: true,
                itemStyle: {
                    fontSize: '9px'
                }

            },
            tooltip: {
                shared: true,
                headerFormat: '<span style="font-size: 15px">{point.key}</span><br/>',
                pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y} million (Rs)</b><br/>'
            },
            xAxis: {
                type: 'category',
                accessibility: {
                    description: 'Budget and Expense'
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Expense Vs Budget'
                },
                labels: {
                    formatter: function() {
                        return this.value + 'M';
                    }
                },
                showFirstLabel: true
            },
            series: [{
                    name: 'FY Budget',
                    color: 'rgba(158, 159, 163, 0.5)',
                    data: fy_awp_budget.slice(),
                    pointPlacement: -0.2,
                    linkedTo: 'main',
                    //type: 'line',
                    //pointWidth: 20
                    dataLabels: {
                        enabled: true,
                        align: 'center', // Align data labels to center
                        verticalAlign: 'bottom', // Position data labels above the column
                        inside: false
                    }
                },
                {
                    name: 'Total Expenses',
                    // color: 'rgba(158, 159, 140, 9)',
                    color: '#2371FE',
                    id: 'main',
                    data: getData(total_expenses).slice(),
                    //type: 'spline', // Stack "Achived" series,
                    stack: 'schemes',
                    dataLabels: {
                        enabled: true,
                        align: 'center', // Align data labels to center
                        verticalAlign: 'bottom', // Position data labels above the column
                        inside: false
                    }
                }
            ],
            exporting: {
                allowHTML: true
            }
        });
    </script>

    <?php
    $end_time = microtime(true); // Record the end time in seconds with microseconds

    $execution_time = $end_time - $start_time; // Calculate the execution time

    echo "<small style='font-size:9px !important'>Execution Time: " . $execution_time . " seconds </small>";
    ?>
</div>