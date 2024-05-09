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
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/index"); ?>">Component Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view_component_category/" . $annual_work_plan->component_category_id); ?>"><?php echo $component_category->category; ?></a>
                </li>
                <li>
                    <?php echo $title; ?>
                </li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h4>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-6">
                    <table class="table table_small table-bordered" id="db_table">
                        <thead>

                            <tr>
                                <th>Session</th>
                                <th style="text-align: center;">Unit</th>
                                <th style="text-align: center;">Targets</th>
                                <th style="text-align: center;">Material Cost</th>
                                <th style="text-align: center;">Labor Cost</th>
                                <th style="text-align: center;">Farmer Share</th>
                                <th style="text-align: center;">Total Cost</th>
                            </tr>
                            <?php
                            $query = "SELECT * FROM financial_years WHERE financial_year_id = '" . $annual_work_plan->financial_year_id . "'";
                            $count = 1;
                            $f_years = $this->db->query($query)->result();
                            foreach ($f_years as $f_year) {
                                $query = "SELECT * FROM annual_work_plans 
                                        WHERE financial_year_id='" . $f_year->financial_year_id . "'
                                        AND component_category_id = " . $component_category->component_category_id . "";
                                $d_awp = $this->db->query($query)->row();
                            ?>
                                <tr>
                                    <th><?php echo $f_year->financial_year; ?></th>
                                    <td>Unit</td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->anual_target; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->material_cost; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->labor_cost; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->farmer_share; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->total_cost; ?></td>

                                </tr>



                            <?php } ?>

                        </thead>
                    </table>
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
                            <?php
                            $query = "SELECT district_annual_work_plans.*, districts.district_name FROM district_annual_work_plans 
                            INNER JOIN districts ON(districts.district_id = district_annual_work_plans.district_id)
                                        WHERE annual_work_plan_id='" . $annual_work_plan->annual_work_plan_id . "'
                                        AND financial_year_id='" . $annual_work_plan->financial_year_id . "'
                                        AND component_category_id = " . $annual_work_plan->component_category_id . "";
                            $d_awps = $this->db->query($query)->result();
                            foreach ($d_awps as $d_awp) {
                            ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <th><?php echo $d_awp->district_name; ?></th>
                                    <td>Unit</td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->anual_target; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->material_cost; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->labor_cost; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->farmer_share; ?></td>
                                    <td style="text-align: center;"><?php if ($d_awp) echo $d_awp->total_cost; ?></td>



                                    <td style="text-align: center;">
                                        <?php if ($d_awp) { ?>
                                            <button onclick="district_awp_form(<?php echo $d_awp->district_annual_work_plan_id; ?>,<?php echo $d_awp->annual_work_plan_id; ?>)" class="btn btn-success btn-sm">Update Cost</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>


                        </thead>
                    </table>


                    <div style="text-align: center;">
                        <button onclick="district_awp_form(0,<?php echo $annual_work_plan->annual_work_plan_id; ?>)" class="btn btn-primary btn-sm">Add District AWP</button>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>

<script>
    function district_awp_form(district_annual_work_plan_id, annual_work_plan_id) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'annual_work_plans/district_awp_form'); ?>",
                data: {
                    district_annual_work_plan_id: district_annual_work_plan_id,
                    annual_work_plan_id: annual_work_plan_id
                },
            })
            .done(function(respose) {
                console.log(respose);
                $('#modal').modal();
                if (district_annual_work_plan_id == '0') {
                    $('#modal_title').html('Add District Annual Work Plan Details');
                } else {
                    $('#modal_title').html('Update District Annual Work Plan Details');
                }
                $('#modal_body').html(respose);
            });
    }
</script>