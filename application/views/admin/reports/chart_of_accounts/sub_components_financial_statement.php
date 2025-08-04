<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 4px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px !important;
        color: black;
        margin: 0px !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        /* border: 1px solid black !important; */
    }

    .table_s_small>thead>tr>th,
    .table_s_small>tbody>tr>th,
    .table_s_small>tfoot>tr>th,
    .table_s_small>thead>tr>td,
    .table_s_small>tbody>tr>td,
    .table_s_small>tfoot>tr>td {
        padding: 1px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 9px !important;
        color: black;
        margin: 0px !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->

            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a
                                href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                        </li>
                        <li>
                            <i class="fa fa-file"></i>
                            <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
                        </li>
                        <li><?php echo $title; ?></li>
                    </ul>
                    <div class="clearfix">
                        <h4 class="content-title pull-left" style="font-size: 20px;"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>


            </div>


        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div style="background-color: white; padding:5px">
            <div class="table-responsive">
                <table class="table table_small  table-bordered" id="report">
                    <thead>

                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <th><?php echo $financial_year->financial_year;  ?></th>
                                <th></th>
                            <?php } ?>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td>Receipts</td>
                                <td>Payments</td>
                            <?php } ?>
                        </tr>

                        <tr>
                            <td></td>
                            <th colspan="2">Receipts (Payments) Controlled by Project</th>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2">External Assistance</th>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td>
                                    <?php
                                    $query = "SELECT rs_total as d_released_rs, `date` FROM `donor_funds_released` 
                                        WHERE financial_year_id = '" . $financial_year->financial_year_id . "'";
                                    $doner_releases = $this->db->query($query)->result();
                                    foreach ($doner_releases as $d_releases) {
                                        echo number_format($d_releases->d_released_rs, 2) . ' <small class="pull-right">' . date('M,y', strtotime($d_releases->date)) . "</small> <br />";
                                    }
                                    ?>

                                </td>
                                <td>-</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2" style="text-align: right;">Total Receipts</th>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(rs_total) as d_released_rs FROM `donor_funds_released` 
                                        WHERE financial_year_id = '" . $financial_year->financial_year_id . "'";
                                    $doner_released = $this->db->query($query)->row();
                                    echo number_format($doner_released->d_released_rs, 2); ?></th>
                                <td>-</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2">Payments by Third Parties</strong></th>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <?php
                        $count = 1;
                        foreach ($components as $component) { ?>
                            <tr>
                                <th><?php echo $count++; ?></th>
                                <th colspan="2"><?php echo $component->component_name; ?>.

                                    <small> <?php echo $component->component_detail; ?></small>
                                </th>
                                <td style="display: none;"></td>
                                <?php foreach ($financial_years as $financial_year) { ?>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $count2 = 1;
                            if (@$component->sub_components) {
                                foreach ($component->sub_components as $sub_component) {
                            ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" style="padding-left:20px;">
                                            <strong><?php echo $sub_component->sub_component_name; ?></strong>
                                            <small> <?php echo $sub_component->sub_component_detail; ?></small>
                                        </td>
                                        <td style="display: none;"></td>
                                        <?php foreach ($sub_component->financial_years as $fy => $total_expense) { ?>
                                            <td>-</td>
                                            <td><?php echo number_format($total_expense, 2); ?></td>
                                        <?php } ?>

                                    </tr>
                            <?php }
                            } ?>

                            <tr>
                                <th></th>
                                <th colspan="2" style="text-align: right;">Sub Total</th>
                                <td style="display: none;"></td>
                                <?php foreach ($component->financial_years as $fy => $total_expense) { ?>
                                    <th>-</th>
                                    <th><?php echo number_format($total_expense, 2); ?></th>
                                <?php } ?>

                            </tr>

                        <?php } ?>
                        <tr>
                            <td style="height: 15px;"></td>
                            <td colspan="2"></td>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td></td>
                                <th></th>

                            <?php } ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2" style="text-align: right;">Total Payments</th>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td>-</td>
                                <th>
                                    <?php
                                    $query = "SELECT SUM(net_pay) as total_payment FROM `expenses` 
                                        WHERE financial_year_id = '" . $financial_year->financial_year_id . "'";
                                    $expense = $this->db->query($query)->row();
                                    echo number_format($expense->total_payment, 2); ?></th>

                            <?php } ?>
                        </tr>
                        <tr>
                            <td style="height: 15px;"></td>
                            <td colspan="2"></td>
                            <td style="display: none;"></td>
                            <?php foreach ($financial_years as $financial_year) { ?>
                                <td></td>
                                <th></th>

                            <?php } ?>
                        </tr>

                        <?php
                        $query = "SELECT * FROM `financial_years`";
                        $financial_years = $this->db->query($query)->result();

                        $previous_closing_balance = 0; // Initialize the closing balance of the previous year to 0

                        // Arrays to hold the results
                        $years = [];
                        $increases = [];
                        $opening_balances = [];
                        $closing_balances = [];

                        foreach ($financial_years as $financial_year) {
                            // Get the total receipts for the current financial year
                            $query = "SELECT SUM(rs_total) as r_total FROM `donor_funds_released`
                            WHERE financial_year_id = '" . $financial_year->financial_year_id . "'";
                            $receipts = $this->db->query($query)->row()->r_total;

                            // Get the total expenses for the current financial year
                            $query = "SELECT SUM(net_pay) as e_total FROM `expenses`
                            WHERE financial_year_id = '" . $financial_year->financial_year_id . "'";
                            $expenses = $this->db->query($query)->row()->e_total;

                            // Calculate the increase (decrease) in cash
                            $increase_decrease = $receipts - $expenses;

                            // Calculate the closing balance for the current year
                            $closing_balance = $previous_closing_balance + $increase_decrease;

                            // Store the results in the arrays
                            $years[] = $financial_year->financial_year;
                            $increases[] = $increase_decrease;
                            $opening_balances[] = $previous_closing_balance;
                            $closing_balances[] = $closing_balance;

                            // Update the previous closing balance for the next iteration
                            $previous_closing_balance = $closing_balance;
                        }
                        ?>


                        <tr>
                            <td></td>
                            <th colspan="2" style="text-align: right;">Increase (Decrease) in Cash</td>
                            <td style="display: none;"></td>
                            <?php foreach ($increases as $increase) { ?>
                                <th colspan="2"><?php echo number_format($increase, 2); ?></th>
                                <td style="display: none;"></td>
                            <?php }  ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2" style="text-align: right;">Cash at Beginning of Year</td>
                            <td style="display: none;"></td>
                            <?php foreach ($opening_balances as $opening_balance) { ?>
                                <th colspan="2"><?php echo number_format($opening_balance, 2); ?></th>
                                <td style="display: none;"></td>
                            <?php }  ?>
                        </tr>
                        <tr>
                            <td></td>
                            <th colspan="2" style="text-align: right;">Cash at End of Year</td>
                            <td style="display: none;"></td>
                            <?php foreach ($closing_balances as $closing_balance) { ?>
                                <th colspan="2"><?php echo number_format($closing_balance, 2); ?></th>
                                <td style="display: none;"></td>
                            <?php }  ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
<!-- /MESSENGER -->
</div>


<?php $table_title = 'Upto date(' . date('d M, Y H:m:s') . ')'; ?>
<script>
    title = 'Khyber Pakhtunkhwa Irrigated Agriculture Improvement Project (KP-IAIP)\nStatement of Receipts and Payments';
    $(document).ready(function() {
        $('#report').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": false,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>