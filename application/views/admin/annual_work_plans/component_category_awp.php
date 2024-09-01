<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/index"); ?>">Component Dashboard</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>



            </div>


        </div>
    </div>
</div>

<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-list"></i> <?php echo $title; ?></h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table_small table-bordered" id="db_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Session</th>
                                <th style="text-align: center;">Unit</th>
                                <th style="text-align: center;">Targets</th>
                                <th style="text-align: center;">Material Cost</th>
                                <th style="text-align: center;">Labor Cost</th>
                                <th style="text-align: center;">Farmer Share</th>
                                <th style="text-align: center;">Total Cost</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM financial_years";
                            $count = 1;
                            $f_years = $this->db->query($query)->result();
                            foreach ($f_years as $f_year) {
                                $query = "SELECT * FROM annual_work_plans 
                                        WHERE financial_year_id='" . $f_year->financial_year_id . "'
                                        AND component_category_id = " . $component_category->component_category_id . "";
                                $awp = $this->db->query($query)->row();
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <th><?php echo $f_year->financial_year; ?></th>

                                <td>Unit</td>

                                <td style="text-align: center;"><?php if ($awp) echo round($awp->anual_target, 2); ?>
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo round($awp->material_cost, 2); ?>
                                    <!-- Rs.<br />
                                    <strong><?php if ($awp) echo round($awp->material_cost/1000000, 2); ?> mm.</strong> -->
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo round($awp->labor_cost,2); ?>
                                    <!-- Rs.<br />
                                    <strong><?php if ($awp) echo round($awp->labor_cost/1000000,2); ?> mm.</strong> -->
                                </td>
                                <td style="text-align: center;">
                                    <strong>
                                        <?php 
                                    if($awp and $awp->total_cost){
                                    echo round(($awp->labor_cost/$awp->total_cost)*100,2)."%";
                             } ?></strong>
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo $awp->total_cost; ?>
                                    <!-- Rs.<br />
                                    <strong><?php if ($awp) echo round($awp->total_cost/1000000,2); ?> mm.</strong> -->
                                </td>


                                <td style="text-align: center;">
                                    <?php if ($awp) { ?>
                                    <button
                                        onclick="awp_form(<?php echo $awp->annual_work_plan_id; ?>,<?php echo $f_year->financial_year_id; ?>)"
                                        class="btn btn-success btn-sm">Update Cost</button>
                                    <a class="btn btn-danger btn-sm"
                                        href="<?php echo site_url(ADMIN_DIR . 'annual_work_plans/district_annual_work_plan/' . $awp->annual_work_plan_id); ?>">
                                        District AWP</a>
                                    <?php } else { ?>
                                    <button onclick="awp_form(0,<?php echo $f_year->financial_year_id; ?>)"
                                        class="btn btn-primary btn-sm">Add Cost</button>
                                    <?php } ?>
                                </td>
                            </tr>



                            <?php } ?>
                            <?php     
                            $query = "SELECT SUM(anual_target) as anual_target,
                            SUM(material_cost) as material_cost,
                            SUM(labor_cost) as labor_cost,
                            SUM(total_cost) as total_cost
                             FROM annual_work_plans
                             WHERE component_category_id = " . $component_category->component_category_id . "";
                                $awp = $this->db->query($query)->row();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <th></th>
                                <td></td>
                                <td style="text-align: center;"><?php if ($awp) echo round($awp->anual_target, 2); ?>
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo round($awp->material_cost, 2); ?>
                                    <!-- Rs.<br />
                                    <strong> <?php if ($awp) echo round($awp->material_cost/1000000, 2); ?> mm.
                                    </strong> -->
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo round($awp->labor_cost,2); ?>
                                    <!-- Rs.<br />
                                    <strong><?php if ($awp) echo round($awp->labor_cost/1000000,2); ?> mm.</strong> -->
                                </td>
                                <td style="text-align: center;">
                                </td>
                                <td style="text-align: center;"><?php if ($awp) echo $awp->total_cost; ?>
                                    <!-- Rs.<br />
                                    <strong><?php if ($awp) echo round($awp->total_cost/1000000,2); ?> mm.<strong> -->
                                </td>



                                <td style="text-align: center;">

                                </td>
                            </tr>
                        </tfoot>


                    </table>


                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<script>
function awp_form(annual_work_plan_id, financial_year_id) {
    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'annual_work_plans/awp_form'); ?>",
            data: {
                annual_work_plan_id: annual_work_plan_id,
                financial_year_id: financial_year_id,
                project_id: '<?php echo $component_category->project_id; ?>',
                component_id: '<?php echo $component_category->component_id; ?>',
                sub_component_id: '<?php echo $component_category->sub_component_id; ?>',
                component_category_id: '<?php echo $component_category->component_category_id; ?>',
            },
        })
        .done(function(respose) {
            console.log(respose);
            $('#modal').modal();
            if (annual_work_plan_id == '0') {
                $('#modal_title').html('Add Annual Work Plan Details');
            } else {
                $('#modal_title').html('Update Annual Work Plan Details');
            }
            $('#modal_body').html(respose);
        });
}
</script>