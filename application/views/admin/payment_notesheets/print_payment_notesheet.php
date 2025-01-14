<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        FRC-<?php echo $payment_notesheet->district_name; ?>-<?php echo $payment_notesheet->payment_notesheet_code . "-" . time(); ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.0/dist/bootstrap-table.min.css">

    <style>
        body {
            background: rgb(204, 204, 204);

            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;

        }



        element.style {
            color: black;
            font-weight: bold;
        }


        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }

        /* Styles go here */
        @media screen {


            page[size="A4"] {
                width: 26cm;
                /* height: 29.7cm; */
                height: auto;
                padding: 5px;
            }


            page[size="A4"][layout="landscape"] {
                width: 29.7cm;
                height: 21cm;
            }

            page[size="A3"] {
                width: 29.7cm;
                height: 42cm;
            }

            page[size="A3"][layout="landscape"] {
                width: 42cm;
                height: 29.7cm;
            }

            page[size="A5"] {
                width: 14.8cm;
                height: 21cm;
            }

            page[size="A5"][layout="landscape"] {
                width: 21cm;
                height: 14.8cm;
            }

        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
                color: black;

            }



        }




        /* Styles go here */
        @media screen {
            .print-page-header {
                height: auto;
                display: none;
            }
        }




        @media screen {
            .page-footer {
                height: 25px;
                display: none;
            }
        }



        @media print {
            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                content: counter(page) " of " counter(pages);
                /* for demo */
            }

            .page-footer-space {
                height: 80px;

            }
        }

        @media screen {
            .page-footer {
                position: relative;

                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                display: block;
                /* for demo */
            }

            .page-footer-space {
                height: 80px;
                display: none;
            }
        }

        @media print {
            .print-page-header {
                position: fixed;
                top: 0mm;
                width: 100%;
                background: yellow;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 90px;
            }
        }

        @media screen {
            .print-page-header {
                position: relative;
                top: 0mm;
                width: 100%;
                display: block;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 0px;
                display: none;
            }
        }




        .page {
            page-break-after: always;
        }



        @page {
            margin-top: 5mm;
        }

        @media print {
            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            button {
                display: none;
            }

            body {
                margin: 0;
                background-color: white !important;
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: none !important;

            }
        }
    </style>
    <style>
        .table_small>thead>tr>th,
        .table_small>tbody>tr>th,
        .table_small>tfoot>tr>th,
        .table_small>thead>tr>td,
        .table_small>tbody>tr>td,
        .table_small>tfoot>tr>td {
            padding: 2px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-size: 12px !important;
            color: black;
            margin: 0px !important;
            border-color: black;
        }
    </style>
</head>

<body>
    <page size='A4'>



        <div>
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;">

                        <img style="width: 100px;" src="<?php echo site_url("assets/logo.jpeg") ?>" />
                    </td>
                    <td>
                        <h4 style="text-align: center; font-size:14px">DIRECTORATE GENERAL ON FARM WATERMANAGEMENT</h4>
                        <p style="text-align: center; font-size:10px">
                            (Wing of Agri. Department) Govt. of Khyber Pakhtunkhwa<br />
                            19-Jamrud Road, ATI Campus Peshawar<br />
                            (Ph: 091-9224307-8, Fax: 091-9224370, Email: kpiaipofwm@gmail.com)
                        </p>

                    </td>
                    <td>
                        <?php
                        // Example content for the QR code
                        $qrcodeContent = "Code:" . htmlspecialchars($payment_notesheet->payment_notesheet_code) .
                            "\nDistrict: " . htmlspecialchars($payment_notesheet->district_name);

                        // Fetch user data
                        $query = "SELECT `roles`.`role_title`, `users`.`user_title`  
                        FROM `roles`, `users` 
                        WHERE `roles`.`role_id` = `users`.`role_id`
                        AND `users`.`user_id`='" . $this->session->userdata("userId") . "'";
                        $user_data = $this->db->query($query)->row();

                        // Append user information to the QR code content
                        if ($user_data) {
                            $qrcodeContent .= "\nPrinted by: " . htmlspecialchars($user_data->user_title) . " (" . htmlspecialchars($user_data->role_title) . ") " . date("d M, Y h:i:s A");
                        }

                        // Append link
                        //$qrcodeContent .= "\nLink: " . htmlspecialchars(site_url("print_payment_notesheet/" . $payment_notesheet->id));

                        // URL encode the QR code content
                        $qrcodeEncoded = urlencode($qrcodeContent);

                        // Generate the QR code URL using the QR server API
                        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=" . $qrcodeEncoded;
                        ?>
                        <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code: <?php echo $payment_notesheet->payment_notesheet_code ?>">


                    </td>

                </tr>

            </table>
            <hr />
            <table style="width: 100%;">
                <tr>
                    <td style="width:40%">
                        <strong style="font-size: 12px; width:200px; text-align:left">
                            Code: <?php echo htmlspecialchars($payment_notesheet->payment_notesheet_code); ?> /
                            Tracking ID: <?php echo htmlspecialchars($payment_notesheet->puc_tracking_id); ?> /
                            District: <?php echo htmlspecialchars($payment_notesheet->district_name); ?>
                        </strong>
                    </td>
                    <td style="text-align: left;"><strong>PAYMENT MODULE</strong></td>
                    <td style="width:20%; text-align:right">
                        <strong style="font-size: 12px;">
                            Dated: <?php echo date("d M, Y", strtotime($payment_notesheet->puc_date)); ?>
                        </strong>
                    </td>
                </tr>
            </table>


            </p>

            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo nl2br($payment_notesheet->puc_title); ?></p>
            <br />
            <table class="table table-bordered table_small">
                <thead style="margin-top: 30px;">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Scheme ID</th>
                        <th rowspan="2">Scheme's Name</th>
                        <th rowspan="2">Title of Account</th>
                        <th rowspan="2">Cat:</th>
                        <th rowspan="2">TS/FCR (PKRs.)</th>
                        <th colspan="6" style="text-align: center;">Payment History (PKRs.)</th>
                        <th rowspan="2">Balance (PKRs.)</th>
                        <th rowspan="2">Installment Type</th>
                        <th colspan="4" style="text-align: center;">Request for Payment (PKRs.)</th>

                    </tr>
                    <tr>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>1st & 2nd</th>
                        <th>Other</th>
                        <th>Final</th>
                        <th>Total</th>
                        <th>Gross</th>
                        <th>WHIT</th>
                        <th>WHST</th>
                        <th>Net</th>

                    </tr>
                </thead>
                <tbody>




                    <?php

                    $query = "
                            SELECT 
                                cc.component_category_id,
                                cc.category,
                                cc.category_detail
                            FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'  
                                GROUP BY cc.component_category_id  
                                ";
                    $catrgories = $this->db->query($query)->result();
                    $count = 1;
                    foreach ($catrgories as $catrgory) { ?>


                        <?php
                        $query = "
                            SELECT 
                                s.scheme_id,
                                s.scheme_code,
                                s.scheme_name,
                                e.payee_name,
                                fy.financial_year,
                                cc.category,
                                wua.bank_account_title,
                                pns.id as pns_id,
                                pns.payment_amount,
                                pns.whit,
                                pns.whst,
                                pns.net_pay,
                                pns.payment_type,
                                s.lining_length,
                                SUM(e.gross_pay) as `total_paid`,
                                COUNT(e.expense_id) as `payment_count`,
                                (s.sanctioned_cost) as `sctionned_cost`,
                                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                SUM(CASE WHEN e.installment = 'final' THEN e.gross_pay END) AS `final`,
                                SUM(CASE WHEN e.installment IS NULL THEN e.gross_pay END) AS `other`,
                                GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`
                            FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                INNER JOIN financial_years as fy ON(fy.financial_year_id = s.financial_year_id)
                                LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'
                                AND s.component_category_id ='" . $catrgory->component_category_id . "'
                            GROUP BY 
                                s.scheme_id, s.scheme_name
                            ORDER BY id ASC    
                                ";
                        $schemes = $this->db->query($query)->result();

                        if (!empty($schemes)) { ?>
                            <?php

                            foreach ($schemes as $scheme) { ?>
                                <tr>

                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $scheme->scheme_code; ?></td>
                                    <td><?php echo $scheme->scheme_name; ?></td>
                                    <td><?php
                                        if ($scheme->payee_name) {
                                            echo $scheme->payee_name;
                                        } else {
                                            echo $scheme->bank_account_title;
                                        }
                                        ?></td>
                                    <td><?php echo $scheme->category; ?></td>
                                    <td><?php echo number_format($scheme->{'sctionned_cost'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'1st'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'2nd'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'1st_2nd'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'other'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'final'}, 0); ?></td>
                                    <td><?php
                                        $total_paid = ($scheme->total_paid + $scheme->payment_amount);
                                        echo number_format($total_paid, 0); ?></td>

                                    <td><?php
                                        $remaining = ($scheme->sctionned_cost - $total_paid);
                                        echo number_format($remaining, 0);
                                        ?></td>
                                    <td> <?php echo $scheme->payment_type; ?></td>
                                    <td> <?php echo number_format($scheme->{'payment_amount'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'whit'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'whst'}, 0); ?></td>
                                    <td><?php echo number_format($scheme->{'net_pay'}, 0); ?></td>


                                </tr>
                            <?php } ?>

                            <tr>
                                <?php
                                $query = "
                                SELECT
                                SUM(pns.payment_amount) as payment_amount,
                                SUM(pns.whit) as whit,
                                SUM(pns.whst) as whst,
                                SUM(pns.net_pay) as net_pay, 
                                SUM(e.gross_pay) as `total_paid`,
                                COUNT(e.expense_id) as `payment_count`,
                                SUM(s.sanctioned_cost) as `sctionned_cost`,
                                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                SUM(CASE WHEN e.installment = 'final' THEN e.gross_pay END) AS `final`,
                                SUM(CASE WHEN e.installment IS NULL THEN e.gross_pay END) AS `other`
                                FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                INNER JOIN financial_years as fy ON(fy.financial_year_id = s.financial_year_id)
                                LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'
                                AND s.component_category_id ='" . $catrgory->component_category_id . "'   
                                ";
                                $schemes_sub_total = $this->db->query($query)->row();
                                ?>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Sub Total</th>
                                <th></th>
                                <th><?php echo number_format($schemes_sub_total->{'sctionned_cost'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'1st'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'2nd'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'1st_2nd'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'other'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'final'}, 0); ?></th>
                                <th><?php
                                    $total_paid = ($schemes_sub_total->total_paid + $schemes_sub_total->payment_amount);
                                    echo number_format($total_paid, 0); ?></th>

                                <th><?php
                                    $remaining = ($schemes_sub_total->sctionned_cost - $total_paid);
                                    echo number_format($remaining, 0);
                                    ?></th>
                                <th></th>
                                <th> <?php echo number_format($schemes_sub_total->{'payment_amount'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'whit'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'whst'}, 0); ?></th>
                                <th><?php echo number_format($schemes_sub_total->{'net_pay'}, 0); ?></th>


                            </tr>
                        <?php } ?>


                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                        $query = "
                                SELECT
                                SUM(pns.payment_amount) as payment_amount,
                                SUM(pns.whit) as whit,
                                SUM(pns.whst) as whst,
                                SUM(pns.net_pay) as net_pay, 
                                SUM(e.gross_pay) as `total_paid`,
                                COUNT(e.expense_id) as `payment_count`,
                                SUM(s.sanctioned_cost) as `sctionned_cost`,
                                SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
                                SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
                                SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
                                SUM(CASE WHEN e.installment = 'final' THEN e.gross_pay END) AS `final`,
                                SUM(CASE WHEN e.installment IS NULL THEN e.gross_pay END) AS `other`
                                FROM 
                                schemes s
                                INNER JOIN component_categories as cc ON cc.component_category_id = s.component_category_id
                                INNER JOIN payment_notesheet_schemes as pns ON(pns.scheme_id = s.scheme_id)
                                INNER JOIN financial_years as fy ON(fy.financial_year_id = s.financial_year_id)
                                LEFT JOIN expenses e ON s.scheme_id = e.scheme_id
                                INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                                WHERE pns.payment_notesheet_id = '" . $payment_notesheet_id . "'  
                                ";
                        $schemes_sub_total = $this->db->query($query)->row();
                        ?>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th></th>
                        <th><?php echo number_format($schemes_sub_total->{'sctionned_cost'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'1st'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'2nd'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'1st_2nd'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'other'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'final'}, 0); ?></th>
                        <th><?php
                            $total_paid = ($schemes_sub_total->total_paid + $schemes_sub_total->payment_amount);
                            echo number_format($total_paid, 0); ?></th>

                        <th><?php
                            $remaining = ($schemes_sub_total->sctionned_cost - $total_paid);
                            echo number_format($remaining, 0);
                            ?></th>
                        <th></th>
                        <th><?php echo number_format($schemes_sub_total->{'payment_amount'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'whit'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'whst'}, 0); ?></th>
                        <th><?php echo number_format($schemes_sub_total->{'net_pay'}, 0); ?></th>


                    </tr>
                </tfoot>
            </table>
            <br />
            <p><?php echo nl2br($payment_notesheet->puc_detail); ?></p>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <p><br />
                            2. This is system generated note sheet submitted for further processing of payment please. <br />
                        </p>
                    </td>
                    <td style=" text-align: center; width:100px; vertical-align: bottom" ;>
                        <strong>
                            ________________<br />
                            Financial Analyst-KPIAIP
                        </strong>
                    </td>
                </tr>

            </table>

        </div>







        </div>
    </page>
</body>



</html>