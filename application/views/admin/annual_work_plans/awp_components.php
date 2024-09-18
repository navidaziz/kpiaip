<div class="table-responsive">
    <?php
    $query = "SELECT * FROM financial_years";
    $f_years = $this->db->query($query)->result();
    ?>
    <table class="table table_small table-bordered" id="db_table">
        <thead>
            <tr>
                <th></th>
                <th></th>

                <?php
                foreach ($f_years as $f_year) {
                ?>
                <th></th>
                <th></th>
                <th></th>
                <!-- <th></th> -->
                <th></th>
                <?php } ?>
                <th></th>
                <th></th>
                <th></th>
                <!-- <th></th> -->
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th></th>

                <?php
                foreach ($f_years as $f_year) {
                ?>
                <th colspan="4" style="text-align: center;"><?php echo $f_year->financial_year; ?></th>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <!-- <th style="display: none;"></th> -->
                <th style="display: none;"></th>
                <?php } ?>
                <th colspan="4">Total</th>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <!-- <th style="display: none;"></th> -->
                <th style="display: none;"></th>

            </tr>

            <tr>
                <th>#</th>

                <th>Components</th>

                <?php
                foreach ($f_years as $f_year) {
                ?>
                <th style="text-align: center; ">Targets</th>
                <th style="text-align: center;">Material Cost</th>
                <th style="text-align: center;">Labor Cost</th>
                <!-- <th style="text-align: center;">Farmer Share</th> -->
                <th style="text-align: center;">Total Cost</th>
                <?php } ?>
                <th style="text-align: center; ">Targets</th>
                <th style="text-align: center;">Material Cost</th>
                <th style="text-align: center;">Labor Cost</th>
                <!-- <th style="text-align: center;">Farmer Share</th> -->
                <th style="text-align: center;">Total Cost</th>

            </tr>

            <?php
            $query = "SELECT *
                    FROM components  as c
                    WHERE c.status IN (0,1) 
                    ORDER BY c.component_id ASC";
            $components = $this->db->query($query)->result();

            $count = 1;
            foreach ($components as $component) : ?>

            <tr>

                <td><?php echo $count++; ?></td>
                <th>
                    <?php echo $component->component_name; ?>
                </th>


                <?php
                    $query = "SELECT * FROM financial_years";
                    $f_years = $this->db->query($query)->result();
                    $total_cost=0;
                    foreach ($f_years as $f_year) {
                        $query = "SELECT SUM(anual_target) as anual_target,
                        SUM(material_cost) as material_cost,
                        SUM(labor_cost) as labor_cost,
                        SUM(farmer_share) as farmer_share,
                        SUM(total_cost) as total_cost
                        FROM annual_work_plans 
                                        WHERE financial_year_id='" . $f_year->financial_year_id . "'
                                        AND component_id = " . $component->component_id . "";
                        $awp = $this->db->query($query)->row();
                    ?>
                <td style="text-align: center;"><?php if ($awp) echo $awp->anual_target; ?></td>
                <td style="text-align: center;">
                    <?php if ($awp){ if($awp->material_cost){ echo round($awp->material_cost,2); }} ?>
                </td>
                <td style="text-align: center;">
                    <?php if ($awp){ if($awp->labor_cost){ echo round($awp->labor_cost,2); }} ?>
                </td>
                <td style="text-align: center;">
                    <?php if ($awp){ if($awp->total_cost){ 
                        echo round($awp->total_cost,2); 
                    $total_cost+=$awp->total_cost;}
                    }
                         ?>
                </td>

                <?php }
                    $query = "SELECT SUM(anual_target) as anual_target,
                                                        SUM(material_cost) as material_cost,
                                                        SUM(labor_cost) as labor_cost,
                                                        SUM(farmer_share) as farmer_share,
                                                        SUM(total_cost) as total_cost
                                                        FROM annual_work_plans 
                                                    WHERE component_id = " . $component->component_id . "";
                    $awp = $this->db->query($query)->row();
                    ?>
                <td style="text-align: center;"><?php if ($awp) echo $awp->anual_target; ?></td>
                <td style="text-align: center;">
                    <?php if ($awp){ if($awp->material_cost){ echo round($awp->material_cost,2); }} ?>
                </td>
                <td style="text-align: center;">
                    <?php if ($awp){ if($awp->labor_cost){ echo round($awp->labor_cost,2); }} ?>
                </td>
                <td style="text-align: center;">
                    <?php 
                   
                    if ($awp){ if($awp->total_cost){ 
                        if(round($total_cost)!=round($awp->total_cost)){ echo '<span style="color:red">Error</span>'; }
                        echo round($awp->total_cost,2); }} ?>
                </td>
            </tr>
            <?php endforeach; ?>


        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>