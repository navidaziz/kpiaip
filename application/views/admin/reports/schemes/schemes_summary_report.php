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
        <div class="alert alert-danger" id="messenger">
            <?php
            $query = "SELECT 
            `sft_schemes`.`category` AS `category`,
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
            WHERE `sft_schemes`.`scheme_status` IN ('Final', 'ICR-I', 'ICR-II', 'Ongoing') 
            GROUP BY `sft_schemes`.`category`";
            $ongoing_schemes = $this->db->query($query)->result();
            ?>
            <h4>Ongoing Schemes (Ongoing, ICR-I, ICR-II, ICRI&II, Final)</h4>
            <hr />
            <table class="table table-bordered table_s mall" style="color: black !important;">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total No. of Schemes</th>
                        <th>SC/FCR</th>
                        <th>ICR-I (Paid)</th>
                        <th>ICR-II (Paid)</th>
                        <th>ICR-I&II (Paid)</th>
                        <th>OTHER (Paid)</th>
                        <th>FCR (Paid)</th>
                        <th>TOTAL (Paid)</th>
                        <th>TOTAL PAYABLE</th>
                </thead>
                <tbody>
                    <?php foreach ($ongoing_schemes as $scheme) { ?>
                        <tr>
                            <th><?php echo $scheme->category; ?></th>
                            <td><?php echo $scheme->total; ?></td>
                            <td><?php echo number_format($scheme->sactioned_cost); ?></td>
                            <td><?php echo number_format($scheme->first); ?></td>
                            <td><?php echo number_format($scheme->second) ?></td>
                            <td><?php echo number_format($scheme->first_second); ?></td>
                            <td><?php echo number_format($scheme->other); ?></td>
                            <td><?php echo number_format($scheme->final); ?></td>
                            <td><?php echo number_format($scheme->total_paid); ?></td>
                            <td><?php echo number_format($scheme->balance); ?></td>
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
                    WHERE `sft_schemes`.`scheme_status` IN ('Final', 'ICR-I', 'ICR-II', 'Ongoing')";
                    $scheme = $this->db->query($query)->row();
                    ?>
                    <tr>
                        <th>Total</th>
                        <td><?php echo $scheme->total; ?></td>
                        <td><?php echo number_format($scheme->sactioned_cost); ?></td>
                        <td><?php echo number_format($scheme->first); ?></td>
                        <td><?php echo number_format($scheme->second) ?></td>
                        <td><?php echo number_format($scheme->first_second); ?></td>
                        <td><?php echo number_format($scheme->other); ?></td>
                        <td><?php echo number_format($scheme->final); ?></td>
                        <td><?php echo number_format($scheme->total_paid); ?></td>
                        <td><?php echo number_format($scheme->balance); ?></td>
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-success" id="messenger">

        </div>
    </div>

</div>

<script>
    title = '<?php echo $description . ' ' . date('d-m-Y m:h:s'); ?>';
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
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
                // {
                //     extend: 'pdfHtml5',
                //     title: title,
                //     pageSize: 'A4',
                //     //orientation: 'landscape',
                //     messageTop: '<?php echo $title; ?>'

                // }
            ]
        });
    });
</script>