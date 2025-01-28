<div class="alert alert-success" id="messenger">
    <?php
    $query = "SELECT 
            `sft_schemes`.`category` AS `category`,
            `sft_schemes`.`category_detail` AS `category_detail`,
            COUNT(0) AS `total`,
            SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
            SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
            SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
            SUM(`sft_schemes`.`1st`) AS `first`,
            SUM(`sft_schemes`.`2nd`) AS `second`,
            SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
            SUM(`sft_schemes`.`other`) AS `other`,
            SUM(`sft_schemes`.`final`) AS `final` 
            FROM `sft_schemes` 
            WHERE `sft_schemes`.`scheme_status` IN ('Completed') 
            GROUP BY `sft_schemes`.`category`";
    $ongoing_schemes = $this->db->query($query)->result();
    ?>
    <h4>Complete Schemes</h4>
    <hr />
    <table class="table table-bordered table_s mall" style="color: black !important;">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total No. of Schemes</th>
                <th>ICR-I (Paid)</th>
                <th>ICR-II (Paid)</th>
                <th>ICR-I&II (Paid)</th>
                <th>OTHER (Paid)</th>
                <th>FCR (Paid)</th>
                <th>TOTAL (Paid)</th>
        </thead>
        <tbody>
            <?php foreach ($ongoing_schemes as $scheme) { ?>
                <tr>
                    <th><?php echo $scheme->category; ?> ( <?php echo $scheme->category_detail; ?> )</th>
                    <td><?php echo $scheme->total; ?></td>
                    <td><?php echo number_format($scheme->first); ?></td>
                    <td><?php echo number_format($scheme->second) ?></td>
                    <td><?php echo number_format($scheme->first_second); ?></td>
                    <td><?php echo number_format($scheme->other); ?></td>
                    <td><?php echo number_format($scheme->final); ?></td>
                    <td><?php echo number_format($scheme->total_paid); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <?php
            $query = "SELECT 
                    COUNT(0) AS `total`,
                    SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                    SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                    SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`,
                    SUM(`sft_schemes`.`1st`) AS `first`,
                    SUM(`sft_schemes`.`2nd`) AS `second`,
                    SUM(`sft_schemes`.`1st_2nd`) AS `first_second`,
                    SUM(`sft_schemes`.`other`) AS `other`,
                    SUM(`sft_schemes`.`final`) AS `final` 
                    FROM `sft_schemes` 
                    WHERE `sft_schemes`.`scheme_status` IN ('Completed')";
            $scheme = $this->db->query($query)->row();
            ?>
            <tr>
                <th>Total</th>
                <th><?php echo $scheme->total; ?></th>
                <th><?php echo number_format($scheme->first); ?></th>
                <th><?php echo number_format($scheme->second) ?></th>
                <th><?php echo number_format($scheme->first_second); ?></th>
                <th><?php echo number_format($scheme->other); ?></th>
                <th><?php echo number_format($scheme->final); ?></th>
                <th><?php echo number_format($scheme->total_paid); ?></th>
            </tr>
        </tfoot>
    </table>


</div>