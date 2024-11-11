<style>
    #container {
        min-width: 310px;
        max-width: 800px;
        height: 400px;
        margin: 0 auto;
    }

    .buttons {
        min-width: 310px;
        text-align: center;
        margin: 1rem 0;
        font-size: 0;
    }

    .buttons button {
        cursor: pointer;
        border: 1px solid silver;
        border-right-width: 0;
        background-color: #f8f8f8;
        font-size: 1rem;
        padding: 0.5rem;
        transition-duration: 0.3s;
        margin: 0;
    }

    .buttons button:first-child {
        border-top-left-radius: 0.3em;
        border-bottom-left-radius: 0.3em;
    }

    .buttons button:last-child {
        border-top-right-radius: 0.3em;
        border-bottom-right-radius: 0.3em;
        border-right-width: 1px;
    }

    .buttons button:hover {
        color: white;
        background-color: rgb(158 159 163);
        outline: none;
    }

    .buttons button.active {
        background-color: #0051b4;
        color: white;
    }
</style>

<?php $start_time = microtime(true); ?>
<div class="jumbotron" style="padding: 9px;">

    <div class="table-responsive">
        <div class='buttons'>
            <button id='2000'>
                2000
            </button>
            <button id='2004'>
                2004
            </button>
            <button id='2008'>
                2008
            </button>
            <button id='2012'>
                2012
            </button>
            <button id='2016'>
                2016
            </button>
            <button id='2020' class='active'>
                2020
            </button>
        </div>
        <div id="container"></div>
        <script>
            const dataPrev = {
                <?php $query = "SELECT * FROM financial_years";
                $financial_years = $this->db->query($query)->result();
                foreach ($financial_years as $financial_year) { ?>
                    <?php echo substr($financial_year->financial_year, 0, 4); ?>: [
                        <?php $query = "SELECT * FROM `component_categories` LIMIT 5";
                        $categories = $this->db->query($query)->result();
                        foreach ($categories as $category) { ?>
                            <?php $query = "SELECT * FROM `annual_work_plans`
                                      WHERE component_category_id = '" . $category->component_category_id . "'
                                      AND financial_year_id = '" . $financial_year->financial_year_id . "'";
                            $awp_target = $this->db->query($query)->row();
                            $target = 0;
                            if ($awp_target) {
                                $target =  $awp_target->anual_target;
                            } ?>['<?php echo $category->category; ?>', <?php echo $target; ?>],
                        <?php   } ?>
                    ],
                <?php  } ?>

            };

            const data = {
                <?php $query = "SELECT * FROM financial_years";
                $financial_years = $this->db->query($query)->result();
                foreach ($financial_years as $financial_year) { ?>
                    <?php echo substr($financial_year->financial_year, 0, 4); ?>: [
                        <?php $query = "SELECT * FROM `component_categories` LIMIT 5";
                        $categories = $this->db->query($query)->result();
                        foreach ($categories as $category) { ?>
                            <?php $query = "SELECT * FROM `annual_work_plans`
                                      WHERE component_category_id = '" . $category->component_category_id . "'
                                      AND financial_year_id = '" . $financial_year->financial_year_id . "'";
                            $awp_target = $this->db->query($query)->row();
                            $target = 0;
                            if ($awp_target) {
                                $target =  $awp_target->anual_target;
                            } ?>['<?php echo $category->category; ?>', <?php echo $target; ?>],
                        <?php   } ?>
                    ],
                <?php  } ?>

            };

            const countries = {
                kr: {
                    name: 'South Korea',
                    color: '#FE2371'
                },
                jp: {
                    name: 'Japan',
                    color: '#544FC5'
                },
                au: {
                    name: 'Australia',
                    color: '#2CAFFE'
                },
                de: {
                    name: 'Germany',
                    color: '#FE6A35'
                },
                ru: {
                    name: 'Russia',
                    color: '#6B8ABC'
                },
                cn: {
                    name: 'China',
                    color: '#1C74BD'
                },
                gb: {
                    name: 'Great Britain',
                    color: '#00A6A6'
                },
                us: {
                    name: 'United States',
                    color: '#D568FB'
                }
            };

            // Add upper case country code
            for (const [key, value] of Object.entries(countries)) {
                value.ucCode = key.toUpperCase();
            }


            const getData = data => data.map(point => ({
                name: point[0],
                y: point[1],
                color: countries[point[0]].color
            }));

            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                // Custom option for templates
                countries,
                title: {
                    text: 'Summer Olympics 2020 - Top 5 countries by Gold medals',
                    align: 'left'
                },
                subtitle: {
                    text: 'Comparing to results from Summer Olympics 2016 - Source: <a ' +
                        'href="https://olympics.com/en/olympic-games/tokyo-2020/medals"' +
                        'target="_blank">Olympics</a>',
                    align: 'left'
                },
                plotOptions: {
                    series: {
                        grouping: false,
                        borderWidth: 0
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    shared: true,
                    headerFormat: '<span style="font-size: 15px">' +
                        '{series.chart.options.countries.(point.key).name}' +
                        '</span><br/>',
                    pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
                        '{series.name}: <b>{point.y} medals</b><br/>'
                },
                xAxis: {
                    type: 'category',
                    accessibility: {
                        description: 'Countries'
                    },
                    max: 4,
                    labels: {
                        useHTML: true,
                        animate: true,
                        format: '{chart.options.countries.(value).ucCode}<br>' +
                            '<span class="f32">' +
                            '<span style="display:inline-block;height:32px;vertical-align:text-top;" ' +
                            'class="flag {value}"></span></span>',
                        style: {
                            textAlign: 'center'
                        }
                    }
                },
                yAxis: [{
                    title: {
                        text: 'Gold medals'
                    },
                    showFirstLabel: false
                }],
                series: [{
                    color: 'rgba(158, 159, 163, 0.5)',
                    pointPlacement: -0.2,
                    linkedTo: 'main',
                    data: dataPrev[2020].slice(),
                    name: '2016'
                }, {
                    name: '2020',
                    id: 'main',
                    dataSorting: {
                        enabled: true,
                        matchByName: true
                    },
                    dataLabels: [{
                        enabled: true,
                        inside: true,
                        style: {
                            fontSize: '16px'
                        }
                    }],
                    data: getData(data[2020]).slice()
                }],
                exporting: {
                    allowHTML: true
                }
            });

            const locations = [{
                city: 'Tokyo',
                year: 2020
            }, {
                city: 'Rio',
                year: 2016
            }, {
                city: 'London',
                year: 2012
            }, {
                city: 'Beijing',
                year: 2008
            }, {
                city: 'Athens',
                year: 2004
            }, {
                city: 'Sydney',
                year: 2000
            }];

            locations.forEach(location => {
                const btn = document.getElementById(location.year);

                btn.addEventListener('click', () => {

                    document.querySelectorAll('.buttons button.active')
                        .forEach(active => {
                            active.className = '';
                        });
                    btn.className = 'active';

                    chart.update({
                        title: {
                            text: 'Summer Olympics ' + location.year +
                                ' - Top 5 countries by Gold medals'
                        },
                        subtitle: {
                            text: 'Comparing to results from Summer Olympics ' +
                                (location.year - 4) + ' - Source: <a href="https://olympics.com/en/olympic-games/' +
                                (location.city.toLowerCase()) + '-' + (location.year) + '/medals" target="_blank">Olympics</a>'
                        },
                        series: [{
                            name: location.year - 4,
                            data: dataPrev[location.year].slice()
                        }, {
                            name: location.year,
                            data: getData(data[location.year]).slice()
                        }]
                    }, true, false, {
                        duration: 800
                    });
                });
            });
        </script>

    </div>
</div>
<?php
$end_time = microtime(true); // Record the end time in seconds with microseconds
$execution_time = $end_time - $start_time; // Calculate the execution time
echo "<small>Execution Time: " . $execution_time . " seconds </small>";
?>