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
                            <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
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
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <div style="text-align: center;">
                        <h5><?php echo $title; ?></h5>
                    </div>
                    <table class="table table-bordered table_small">
                        <thead style="margin-top: 30px;">
                            <tr>



                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Scheme ID</th>
                                <th>Scheme's Name</th>
                                <th>Status</th>
                                <th>District</th>
                                <th>Approval Date</th>
                                <th>Cat:</th>
                                <th>Sanctioned Cost</th>

                                <th>Balance (PKRs.)</th>
                                <th>1st</th>
                                <th>2nd</th>
                                <th>1st & 2nd</th>
                                <th>Other</th>
                                <th>Final</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>




                            <?php

                            $count = 1;
                            $gtotal = [
                                'sanctioned_cost' => 0,
                                '1st' => 0,
                                '2nd' => 0,
                                '1st_2nd' => 0,
                                'other' => 0,
                                'final' => 0,
                                'total_paid' => 0,
                                'remaining' => 0,
                                'payment_amount' => 0,
                                'whit' => 0,
                                'whst' => 0,
                                'st_duty' => 0,
                                'rdp' => 0,
                                'kpra' => 0,
                                'gur_ret' => 0,
                                'misc_deduction' => 0,
                                'net_pay' => 0,
                            ];

                            $query = "
                                SELECT 
                                s.scheme_id,
                                s.scheme_code,
                                s.scheme_name,
                                s.scheme_status,
                                d.district_name,
                                s.approval_date,
                                e.payee_name,
                                fy.financial_year,
                                cc.category,
                                s.lining_length,
                                SUM(e.gross_pay) as `total_paid`,
                                COUNT(e.expense_id) as `payment_count`,
                                (s.sanctioned_cost) as `sanctioned_cost`,
                                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                SUM(CASE WHEN e.installment = 'Final' THEN e.gross_pay END) AS `final`,
                                SUM(CASE WHEN e.installment NOT IN ('1st','2nd', '1st_2nd', 'Final') THEN e.gross_pay END) AS `other`,
                                GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`
                                        FROM 
                                            schemes s
                                            INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                            INNER JOIN financial_years as fy ON(fy.financial_year_id = s.financial_year_id)
                                            LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                            INNER JOIN districts as d ON d.district_id = s.district_id
                                             GROUP BY 
                                            s.scheme_id, s.scheme_name
                                        ORDER BY s.approval_date DESC
                                        LIMIT 10     
                                ";
                            $schemes = $this->db->query($query)->result();
                            ?>
                            <?php

                            foreach ($schemes as $scheme) { ?>
                                <tr>

                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $scheme->scheme_code; ?></td>
                                    <td><?php echo $scheme->scheme_name; ?></td>
                                    <td><?php echo $scheme->scheme_status; ?></td>
                                    <td><?php echo $scheme->district_name; ?></td>
                                    <td><?php echo $scheme->approval_date; ?></td>
                                    <td><?php echo $scheme->category; ?></td>
                                    <td><?php echo number_format($scheme->{'sanctioned_cost'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'1st'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'2nd'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'1st_2nd'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'other'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'final'}, 0); ?></td>
                                    <td><?php
                                        $total_paid = ($scheme->total_paid);
                                        if ($scheme->payment_count) {
                                            echo number_format($total_paid, 0);
                                        } else {
                                            echo "0";
                                        } ?></td>

                                    <td><?php
                                        $remaining = ($scheme->sanctioned_cost - $total_paid);
                                        if ($remaining > 1) {
                                            echo number_format($remaining, 0);
                                        } else {
                                            echo "0.00";
                                        }
                                        ?></td>
                                </tr>
                            <?php
                                $gtotal['sanctioned_cost'] += $scheme->sanctioned_cost;
                                $gtotal['1st'] += $scheme->{'1st'};
                                $gtotal['2nd'] += $scheme->{'2nd'};
                                $gtotal['1st_2nd'] += $scheme->{'1st_2nd'};
                                $gtotal['other'] += $scheme->{'other'};
                                $gtotal['final'] += $scheme->{'final'};
                                if ($scheme->payment_count) {
                                    $gtotal['total_paid'] += $total_paid;
                                }

                                $gtotal['remaining'] += $remaining;
                            } ?>


                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th></th>
                                <th><?php echo number_format($gtotal['sanctioned_cost'], 0); ?></th>
                                <th><?php echo number_format($gtotal['1st'], 0); ?></th>
                                <th><?php echo number_format($gtotal['2nd'], 0); ?></th>
                                <th><?php echo number_format($gtotal['1st_2nd'], 0); ?></th>
                                <th><?php echo number_format($gtotal['other'], 0); ?></th>
                                <th><?php echo number_format($gtotal['final'], 0); ?></th>
                                <th><?php echo number_format($gtotal['total_paid'], 0); ?></th>
                                <th><?php echo number_format($gtotal['remaining'], 0); ?></th>





                            </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

<script>
    title = '<?php echo $title . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#taxes').DataTable({
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
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $title; ?>'

                }
            ]
        });
    });
</script>