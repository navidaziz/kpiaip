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

<style>
    .table_small>thead>tr>th,
    .table_small>tbody>tr>th,
    .table_small>tfoot>tr>th,
    .table_small>thead>tr>td,
    .table_small>tbody>tr>td,
    .table_small>tfoot>tr>td {
        padding: 3px;
        line-height: 1;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-size: 12px;
        color: black;
        margin: 0px !important;
    }

    .tax_paid {
        color: green !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax_unpaid {
        color: red !important;
        font-size: 9px !important;
        text-align: right !important;
        /* background-color: #f4f4f4; */
    }

    .tax {
        /* background-color: #f4f4f4; */
    }
</style>
<style>
    .dashboard-box {
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 5px;
        margin: 10px 0;
        transition: transform 0.2s;
    }

    .dashboard-box:hover {
        transform: scale(1.05);
    }

    .dashboard-box h3 {
        margin: 0;
        font-size: 10px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-box p {
        font-size: 14px;
        color: #777;
    }

    .dashboard-box .count {
        font-size: 15px;
        font-weight: bold;
        color: #2c3e50;
    }

    @media print {

        /* Hide the download button when printing */
        .no-print,
        button,
        a,
        .sidebar,
        .page-header,
        .navbar {
            display: none !important;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb" style="margin-bottom: 10px;">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
            </li>
            <!-- <li>
                <i class="fa fa-file"></i>
                <a href="<?php echo site_url(ADMIN_DIR . 'reports'); ?>">Reports List</a>
            </li> -->
            <li><?php echo $title; ?></li>
        </ul>

    </div>
</div>

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
                    WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')";
$ongoing = $this->db->query($query)->row();
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
$completed = $this->db->query($query)->row();
?>
<div class="row">
    <div class="col-sm-12">
        <div id="contentToDownload">
            <div class="row">
                <div class="col-md-2">
                    <div style="margin-top: 5px; text-align: center;">
                        <img style="width: 118px" src="<?php echo site_url("assets/logo.jpeg") ?>" />
                        <h5><?php echo $title; ?></h5>
                        <!-- <div class="description"><?php echo $description; ?></div> -->
                    </div>


                </div>

                <div class="col-md-10">
                    <div class="alert alert-warning" id="messenger">
                        <h4>Sanctioned Schemes</h4>
                        <h6>Since Inception</h6>
                        <hr />
                        <h3 style="font-weight: bolder; color:black"> Total <?php echo number_format($ongoing->total + $completed->total); ?><br />
                            <small> Schemes So far</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger" id="messenger">
                        <h4 style="font-weight: bolder;"><i class="fa fa-spinner" aria-hidden="true"></i> Ongoing Schemes </h4>
                        <hr />
                        <table class="table table-bordered table-striped" style="color: black !important;">

                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Schemes</th>
                                    <th colspan="3">Amount (Rs. in Million)</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th style="text-align:center">Sanctioned</th>
                                    <th style="text-align:center">Paid</th>
                                    <th style="text-align:center">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NULL
                                        AND component_id = 1";
                                    $component_a = $this->db->query($query)->row();

                                    ?>
                                    <th>A: WCs (Nos)</th>
                                    <td><?php echo number_format($component_a->total); ?></td>
                                    <td><?php echo tomillions($component_a->sactioned_cost); ?></td>
                                    <td><?php echo tomillions($component_a->total_paid); ?></td>
                                    <td><?php echo tomillions($component_a->balance); ?></td>
                                </tr>

                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NULL
                                        AND component_id = 2
                                        AND sub_component_id = 6";
                                    $component_b = $this->db->query($query)->row();

                                    ?>
                                    <th>B1: HEIS (Acers)</th>
                                    <td><?php //echo $component_b->total; 
                                        ?></td>
                                    <td><?php echo tomillions($component_b->sactioned_cost); ?></td>
                                    <td><?php echo tomillions($component_b->total_paid); ?></td>
                                    <td><?php echo tomillions($component_b->balance); ?></td>
                                </tr>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NULL
                                        AND component_id = 2
                                        AND sub_component_id = 7";
                                    $component_b2 = $this->db->query($query)->row();

                                    ?>
                                    <th>B2: WST (Nos)</th>
                                    <td><?php echo number_format($component_b2->total); ?></td>
                                    <td><?php echo tomillions($component_b2->sactioned_cost); ?></td>
                                    <td><?php echo tomillions($component_b2->total_paid); ?></td>
                                    <td><?php echo tomillions($component_b2->balance); ?></td>
                                </tr>

                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NULL
                                        AND component_id = 2
                                        AND sub_component_id = 8";
                                    $component_b3 = $this->db->query($query)->row();

                                    ?>
                                    <th>B3: Laser (Nos)</th>
                                    <td><?php echo number_format($component_b3->total); ?></td>
                                    <td><?php echo tomillions($component_b3->sactioned_cost); ?></td>
                                    <td><?php echo tomillions($component_b3->total_paid); ?></td>
                                    <td><?php echo tomillions($component_b3->balance); ?></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NULL
                                        AND component_id IN(1,2)";
                                    $component = $this->db->query($query)->row();

                                    ?>
                                    <th colspan="2" style="text-align: right;">Total</th>
                                    <!-- <th><?php echo number_format($component->total - $component_b2->total - $component_b3->total); ?></th> -->
                                    <th><?php echo tomillions($component->sactioned_cost); ?></th>
                                    <th><?php echo tomillions($component->total_paid); ?></th>
                                    <th><?php echo tomillions($component->balance); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="alert alert-success" id="messenger">
                        <h4 style="font-weight: bolder;"><i class="fa fa-check" aria-hidden="true"></i> Completed Schemes</h4>
                        <hr />
                        <table class="table table-bordered table-striped" style="color: black !important;">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Schemes</th>
                                    <th colspan="3">Amount (Rs. in Million)</th>
                                </tr>


                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th style="text-align:center">Verified</th>
                                    <th style="text-align:center">Paid</th>
                                    <th style="text-align:center">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NOT NULL
                                        AND component_id = 1";
                                    $component_a_phy_completed = $this->db->query($query)->row();
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Completed')
                                        AND component_id = 1";
                                    $component_a_completed = $this->db->query($query)->row();


                                    ?>
                                    <th>A: WCs (Nos)</th>
                                    <td> <?php
                                            $total_completed = $component_a_phy_completed->total + $component_a_completed->total;
                                            echo number_format($total_completed); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $total_verified = $component_a_phy_completed->balance + $component_a_completed->total_paid;
                                        echo toMillions($total_verified); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $otal_paid = $component_a_phy_completed->total_paid + $component_a_completed->total_paid;
                                        echo toMillions($otal_paid);
                                        ?>
                                        </small>

                                    </td>
                                    <td>
                                        <?php $total_balance = $component_a_phy_completed->balance;
                                        echo toMillions($total_balance);
                                        ?>


                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NOT NULL
                                        AND component_id = 2
                                        AND sub_component_id IN(6)
                                        ";
                                    $component_b_phy_completed = $this->db->query($query)->row();
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Completed')
                                         AND component_id = 2
                                        AND sub_component_id IN(6)";
                                    $component_b_completed = $this->db->query($query)->row();


                                    ?>
                                    <th>B1: HEIS (Acers)</th>
                                    <td> <?php
                                            $b1_completed_total = $total_completed = $component_b_phy_completed->total + $component_b_completed->total;
                                            // echo number_format($total_completed);
                                            echo "359";
                                            ?>

                                    </td>
                                    <td>
                                        <?php
                                        $total_verified = $component_b_phy_completed->balance + $component_b_completed->total_paid;
                                        echo toMillions($total_verified); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $otal_paid = $component_b_phy_completed->total_paid + $component_b_completed->total_paid;
                                        echo toMillions($otal_paid);
                                        ?>
                                        </small>

                                    </td>
                                    <td>
                                        <?php $total_balance = $component_b_phy_completed->balance;
                                        echo toMillions($total_balance);
                                        ?>


                                    </td>
                                </tr>

                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NOT NULL
                                        AND component_id = 2
                                        AND sub_component_id IN(7)
                                        ";
                                    $component_b2_phy_completed = $this->db->query($query)->row();
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Completed')
                                         AND component_id = 2
                                        AND sub_component_id IN(7)";
                                    $component_b2_completed = $this->db->query($query)->row();


                                    ?>
                                    <th>B2: WST (Nos)</th>
                                    <td> <?php
                                            $total_completed = $component_b2_phy_completed->total + $component_b2_completed->total;
                                            echo number_format($total_completed);
                                            ?>

                                    </td>
                                    <td>
                                        <?php
                                        $total_verified = $component_b2_phy_completed->balance + $component_b2_completed->total_paid;
                                        echo toMillions($total_verified); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $otal_paid = $component_b2_phy_completed->total_paid + $component_b2_completed->total_paid;
                                        echo toMillions($otal_paid);
                                        ?>
                                        </small>

                                    </td>
                                    <td>
                                        <?php $total_balance = $component_b2_phy_completed->balance;
                                        echo toMillions($total_balance);
                                        ?>


                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NOT NULL
                                        AND component_id = 2
                                        AND sub_component_id IN(8)
                                        ";
                                    $component_b3_phy_completed = $this->db->query($query)->row();
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Completed')
                                         AND component_id = 2
                                        AND sub_component_id IN(8)";
                                    $component_b3_completed = $this->db->query($query)->row();


                                    ?>
                                    <th>B3: Laser (Nos)</th>
                                    <td> <?php
                                            //$b3_completed_total =  $total_completed = $component_b3_phy_completed->total + $component_b3_completed->total;
                                            //echo number_format($total_completed);
                                            echo "178";
                                            ?>

                                    </td>
                                    <td>
                                        <?php
                                        $total_verified = $component_b3_phy_completed->balance + $component_b3_completed->total_paid;
                                        echo toMillions($total_verified); ?>

                                    </td>
                                    <td>
                                        <?php
                                        $otal_paid = $component_b3_phy_completed->total_paid + $component_b3_completed->total_paid;
                                        echo toMillions($otal_paid);
                                        ?>
                                        </small>

                                    </td>
                                    <td>
                                        <?php $total_balance =  $component_b3_phy_completed->balance;
                                        echo toMillions($total_balance);
                                        ?>


                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Sanctioned', 'ICR-I', 'ICR-II', 'Initiated')
                                        AND `sft_schemes`.phy_completion IS NOT NULL
                                        AND component_id IN(1,2)";
                                    $component_phy_completed = $this->db->query($query)->row();
                                    $query = "SELECT 
                                        COUNT(0) AS `total`,
                                        SUM(`sft_schemes`.`total_paid`) AS `total_paid`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) AS `sactioned_cost`,
                                        SUM(`sft_schemes`.`sanctioned_cost`) - SUM(`sft_schemes`.`total_paid`) AS `balance`
                                        FROM `sft_schemes` 
                                        WHERE `sft_schemes`.`scheme_status` IN ('Completed')
                                         AND component_id IN(1,2)";
                                    $component_completed = $this->db->query($query)->row();


                                    ?>
                                    <th colspan="2" style="text-align: right;">Total
                                        <?php
                                        // $total_completed = $component_phy_completed->total + $component_completed->total;
                                        //echo number_format($total_completed - $b1_completed_total -  $b3_completed_total);
                                        ?>
                                    </th>
                                    <th>
                                        <?php
                                        $total_verified = $component_phy_completed->balance + $component_completed->total_paid;
                                        echo toMillions($total_verified); ?>

                                    </th>
                                    <th>
                                        <?php
                                        $otal_paid = $component_phy_completed->total_paid + $component_completed->total_paid;
                                        echo toMillions($otal_paid);
                                        ?>
                                        </small>

                                        </td>
                                    <th>
                                        <?php $total_balance =  $component_phy_completed->balance;
                                        echo toMillions($total_balance);
                                        ?>


                                    </th>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>



            </div>
        </div>
    </div>
</div>