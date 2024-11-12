<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>
<div class="jumbotron" style="padding: 2px;">
    <div id="completed_scheme_avg_div" style="width:100%; height:400px;"></div>

    <script>
        // Define custom series type for displaying low/med/high values using
        // boxplot as a base
        Highcharts.seriesType('lowmedhigh', 'boxplot', {
            keys: ['low', 'median', 'high'],
            tooltip: {
                pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
                    '{series.name}: ' +
                    'Low <b>{point.low} NOK</b> - Median <b>{point.median} NOK</b> - ' +
                    'High <b>{point.high} NOK</b><br/>'
            }
        }, {
            // Change point shape to a line with three crossing lines for
            // low/median/high
            // Stroke width is hardcoded to 1 for simplicity
            drawPoints: function() {
                const series = this;
                this.points.forEach(function(point) {
                    let graphic = point.graphic;
                    const verb = graphic ? 'animate' : 'attr',
                        shapeArgs = point.shapeArgs,
                        width = shapeArgs.width,
                        left = Math.floor(shapeArgs.x) + 0.5,
                        right = left + width,
                        crispX = left + Math.round(width / 2) + 0.5,
                        highPlot = Math.floor(point.highPlot) + 0.5,
                        medianPlot = Math.floor(point.medianPlot) + 0.5,
                        // Sneakily draw low marker even if 0
                        lowPlot = Math.floor(point.lowPlot) +
                        0.5 - (point.low === 0 ? 1 : 0);

                    if (point.isNull) {
                        return;
                    }

                    if (!graphic) {
                        point.graphic = graphic = series.chart.renderer
                            .path('point')
                            .add(series.group);
                    }

                    graphic.attr({
                        stroke: point.color || series.color,
                        'stroke-width': 1
                    });

                    graphic[verb]({
                        d: [
                            'M', left, highPlot,
                            'H', right,
                            'M', left, medianPlot,
                            'H', right,
                            'M', left, lowPlot,
                            'H', right,
                            'M', crispX, highPlot,
                            'V', lowPlot
                        ]
                    });
                });
            }
        });

        // Create chart
        const chart = Highcharts.chart('completed_scheme_avg_div', {
            chart: {
                type: 'lowmedhigh'
            },
            title: {
                text: 'Monthly earnings, by level of education in Norway',
                align: 'left'
            },
            subtitle: {
                text: 'Source: ' +
                    '<a href="https://www.ssb.no/en/statbank/table/11420/" target="_blank">SSB</a>',
                align: 'left'
            },
            accessibility: {
                point: {
                    descriptionFormat: '{#unless isNull}{category}, low {low}, ' +
                        'median {median}, high {high}{/unless}'
                },
                series: {
                    descriptionFormat: '{series.name}, series {seriesNumber} of ' +
                        '{chart.series.length} with {series.points.length} data points.'
                },
                typeDescription: 'Low, median, high. Each data point has a low, ' +
                    'median and high value, depicted vertically as small ticks.' //
                // Describe the chart type to screen reader users, since this is
                // not a traditional boxplot chart
            },
            xAxis: [{
                accessibility: {
                    description: 'Year'
                },
                crosshair: true,
                <?php
                $query = "SELECT * FROM financial_years";
                $fys = $this->db->query($query)->result();
                ?>categories: [<?php foreach ($fys as $fy) { ?> '<?php echo $fy->financial_year; ?>', <?php } ?>]
            }],
            yAxis: {
                title: {
                    text: 'Monthly earnings (NOK)'
                },
                min: 0
            },
            tooltip: {
                shared: true,
                stickOnContact: true
            },
            plotOptions: {
                series: {
                    stickyTracking: true,
                    whiskerWidth: 5
                }
            },
            series: [
                <?php
                $query = "SELECT * FROM component_categories 
                WHERE component_category_id IN(1,2,3,4,5,6,7,8,9,10,11,12)";
                $categories = $this->db->query($query)->result();
                foreach ($categories as $category) { ?> {
                        name: '<?php echo $category->category; ?>',
                        data: [
                            <?php foreach ($fys as $fy) {
                                $query = "SELECT MIN(s.paid) as min,
                                AVG(s.paid) as avg,
                                MAX(s.paid) as max
                                FROM scheme_lists as s 
                                WHERE s.component_category_id = '" . $category->component_category_id . "'
                                AND s.financial_year = '" . $fy->financial_year_id . "'
                                AND scheme_status = 'Completed'";
                                $cat_schemes = $this->db->query($query)->row();
                            ?>[<?php echo $cat_schemes->min; ?>, <?php echo $cat_schemes->avg; ?>, <?php echo $cat_schemes->max; ?>],
                            <?php } ?>
                        ]
                    },
                <?php } ?>
            ]

        });


        // Remove click events on container to avoid having "clickable" announced by AT
        // These events are needed for custom click events, drag to zoom, and navigator
        // support.
        chart.container.onmousedown = null;
        chart.container.onclick = null;
    </script>



    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>