<div class="table-responsive">

    <table class="table table_small  table-bordered" id="db_table">
        <thead>
            <tr>
                <th></th>
                <?php
                $fy_id = $this->input->post('fy_ids');
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
                foreach ($component_categories as $component_category) { ?>
                    <th style="text-wrap: nowrap; text-align:bottom; writing-mode: tb-rl;
        transform: rotate(-180deg);" colspan="2"><?php echo $component_category->category; ?></th>
                <?php } ?>



            </tr>
            <tr>
                <td></td>
                <?php
                foreach ($component_categories as $component_category) { ?>
                    <th style="text-wrap: nowrap; ">Targets</th>
                    <th style="text-wrap: nowrap; ">Achievements</th>
                <?php } ?>
            </tr>
            <tr>
                <th>AWP</th>
                <?php foreach ($component_categories as $component_category) { ?>
                    <?php
                    $query = "SELECT SUM(anual_target) as  anual_target
                                                      FROM annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? ";
                    $category_target = $this->db->query($query, array($fy_id))->row();
                    //echo $category_target;
                    ?>
                    <td><?php echo ($category_target != NULL) ? $category_target->anual_target : '0'  ?></td>
                    <?php
                    $query = "SELECT COUNT(scheme_id) as total 
                                                      FROM schemes 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? ";
                    $schemes = $this->db->query($query, array($fy_id))->row();
                    //echo $category_target;
                    ?>
                    <td><?php echo ($schemes) ? $schemes->total : '0'  ?></td>
                <?php } ?>

            </tr>
            <tr>
                <th>D-AWP</th>
                <?php foreach ($component_categories as $component_category) { ?>
                    <?php
                    $query = "SELECT SUM(anual_target) as  anual_target
                                                      FROM district_annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? ";
                    $category_target = $this->db->query($query, array($fy_id))->row();
                    //echo $category_target;
                    ?>
                    <td><?php echo ($category_target) ? $category_target->anual_target : '0'  ?></td>
                    <?php
                    $query = "SELECT COUNT(scheme_id) as total 
                                                      FROM schemes 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? ";
                    $schemes = $this->db->query($query, array($fy_id))->row();
                    //echo $category_target;
                    ?>
                    <td><?php echo ($schemes) ? $schemes->total : '0'  ?></td>
                <?php } ?>

            </tr>
            <?php

            $query = "SELECT * FROM districts";
            $districts = $this->db->query($query)->result();
            foreach ($districts as $district) { ?>
                <tr>
                    <th><?php echo $district->district_name; ?></th>
                    <?php foreach ($component_categories as $component_category) { ?>
                        <?php
                        $query = "SELECT SUM(anual_target) as anual_target
                                                      FROM district_annual_work_plans 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? 
                                                      AND district_id = '" . $district->district_id . "'";
                        $district_category_target = $this->db->query($query, array($fy_id))->row();
                        //echo $category_target;
                        ?>
                        <td class="district_tagerts"><?php echo ($district_category_target->anual_target) ? $district_category_target->anual_target : ''  ?></td>
                        <?php
                        $query = "SELECT COUNT(scheme_id) as total 
                                                      FROM schemes 
                                                      WHERE component_category_id = '" . $component_category->component_category_id . "'
                                                      AND financial_year_id IN ? 
                                                      AND district_id = '" . $district->district_id . "'";
                        $schemes = $this->db->query($query, array($fy_id))->row();
                        //echo $category_target;
                        ?>
                        <td class="district_scheme_total"><?php echo ($schemes->total) ? $schemes->total : ''  ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </thead>
    </table>
</div>
<style>
    th:first-child,
    td:first-child {
        position: -webkit-sticky;
        /* For Safari */
        position: sticky;
        left: 0;
        background: #fff;
        /* Ensure the background matches the table's background */
        z-index: 1;
        /* Ensures the sticky column is above other columns */
        text-wrap: nowrap;
        text-align: left !important;
    }
</style>

<script>
    // Function to apply heatmap color based on value
    function applyHeatmap(className, maxColor) {
        // Function to convert a value to a color between white and maxColor
        function valueToColor(value, min, max) {
            if (value === 0 || isNaN(value)) {
                return 'rgb(255, 255, 255)'; // White color for 0 or non-numeric values
            }
            const ratio = (value - min) / (max - min);
            const [rMax, gMax, bMax] = maxColor.match(/\w\w/g).map(hex => parseInt(hex, 16));
            const r = Math.round(255 + ratio * (rMax - 255)); // Interpolating between 255 and rMax
            const g = Math.round(255 + ratio * (gMax - 255)); // Interpolating between 255 and gMax
            const b = Math.round(255 + ratio * (bMax - 255)); // Interpolating between 255 and bMax
            return `rgb(${r}, ${g}, ${b})`;
        }

        // Get all table cells with the specified class name
        const cells = document.querySelectorAll(`td.${className}`);

        // Extract numeric values from the cells
        const values = Array.from(cells).map(cell => parseFloat(cell.textContent.trim()) || 0);

        // Determine the minimum and maximum values, excluding 0 and non-numeric values
        const nonZeroValues = values.filter(value => !isNaN(value) && value !== 0);
        const min = Math.min(...nonZeroValues);
        const max = Math.max(...nonZeroValues);

        // Apply the heatmap effect to each cell
        cells.forEach(cell => {
            const value = parseFloat(cell.textContent.trim()) || 0;
            const color = valueToColor(value, min, max);
            cell.style.backgroundColor = color;
        });
    }

    // Example usage
    applyHeatmap('district_scheme_total', '#82B018');
    applyHeatmap('district_tagerts', '#B0184B');
</script>