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
                <th></th>
                <th></th>
                <?php
                foreach ($f_years as $f_year) {
                ?>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                <?php } ?>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <?php
                foreach ($f_years as $f_year) {
                ?>
                    <th colspan="5" style="text-align: center;"><?php echo $f_year->financial_year; ?></th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                <?php } ?>
                <th colspan="5">Total</th>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <th>Action</th>
            </tr>

            <tr>
                <th>#</th>

                <th>Components</th>
                <th>Sub Compoments</th>
                <th>Component Categories</th>
                <?php
                foreach ($f_years as $f_year) {
                ?>
                    <th style="text-align: center; ">Targets</th>
                    <th style="text-align: center;">Material Cost</th>
                    <th style="text-align: center;">Labor Cost</th>
                    <th style="text-align: center;">Farmer Share</th>
                    <th style="text-align: center;">Total Cost</th>
                <?php } ?>
                <th style="text-align: center; ">Targets</th>
                <th style="text-align: center;">Material Cost</th>
                <th style="text-align: center;">Labor Cost</th>
                <th style="text-align: center;">Farmer Share</th>
                <th style="text-align: center;">Total Cost</th>
                <th>View</th>
            </tr>

            <?php
            $query = "SELECT 
                                                cs.component_category_id,
                                                cs.category,
                                                cs.category_detail,
                                                c.component_name,
                                                sc.sub_component_name
                                                FROM component_categories  as cs
                                                INNER JOIN components as c ON(c.component_id = cs.component_id)
                                                INNER JOIN sub_components as sc ON(sc.sub_component_id = cs.sub_component_id)
                                                WHERE cs.status IN (0,1) 
                                                ORDER BY c.component_id ASC, sc.sub_component_id ASC";
            $component_categories = $this->db->query($query)->result();

            $count = 1;
            foreach ($component_categories as $component_category) : ?>

                <tr>

                    <td><?php echo $count++; ?></td>
                    <th>
                        <?php echo $component_category->component_name; ?>
                    </th>
                    <th>
                        <?php echo $component_category->sub_component_name; ?>
                    </th>
                    <th>
                        <?php echo $component_category->category; ?>:
                    </th>

                    <?php
                    $query = "SELECT * FROM financial_years";
                    $f_years = $this->db->query($query)->result();
                    foreach ($f_years as $f_year) {
                        $query = "SELECT * FROM annual_work_plans 
                                        WHERE financial_year_id='" . $f_year->financial_year_id . "'
                                        AND component_category_id = " . $component_category->component_category_id . "";
                        $awp = $this->db->query($query)->row();
                    ?>
                        <td style="text-align: center;"><?php if ($awp) echo $awp->anual_target; ?></td>
                        <td style="text-align: center;"><?php if ($awp) echo $awp->material_cost; ?></td>
                        <td style="text-align: center;"><?php if ($awp) echo $awp->labor_cost; ?></td>
                        <td style="text-align: center;"><?php if ($awp) echo $awp->farmer_share; ?></td>
                        <td style="text-align: center;"><?php if ($awp) echo $awp->total_cost; ?></td>

                    <?php }
                    $query = "SELECT SUM(anual_target) as anual_target,
                                                        SUM(material_cost) as material_cost,
                                                        SUM(labor_cost) as labor_cost,
                                                        SUM(farmer_share) as farmer_share,
                                                        SUM(total_cost) as total_cost
                                                        FROM annual_work_plans 
                                                    WHERE component_category_id = " . $component_category->component_category_id . "";
                    $awp = $this->db->query($query)->row();
                    ?>
                    <td style="text-align: center;"><?php if ($awp) echo $awp->anual_target; ?></td>
                    <td style="text-align: center;"><?php if ($awp) echo $awp->material_cost; ?></td>
                    <td style="text-align: center;"><?php if ($awp) echo $awp->labor_cost; ?></td>
                    <td style="text-align: center;"><?php if ($awp) echo $awp->farmer_share; ?></td>
                    <td style="text-align: center;"><?php if ($awp) echo $awp->total_cost; ?></td>




                    <td style="text-align: center;">
                        <a style="cursor: pointer;" class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "annual_work_plans/view_component_category/" . $component_category->component_category_id); ?>"><i class="fa fa-eye"></i> </a>

                    </td>
                </tr>
            <?php endforeach; ?>


        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>