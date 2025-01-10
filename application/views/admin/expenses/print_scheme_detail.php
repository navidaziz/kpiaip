<?php

$query = "SELECT s.*, d.district_name, d.region,
        fy.financial_year, 
        cc.category, 
        cc.category_detail, 
        sc.sub_component_name, 
        sc.sub_component_detail,
        c.component_name, 
        c.component_detail, 
        wua.wua_name, 
        wua.wua_registration_no 
        FROM schemes as s
        INNER JOIN districts AS d ON(d.district_id = s.district_id)
        INNER JOIN financial_years AS fy ON(fy.financial_year_id = s.financial_year_id)
        INNER JOIN component_categories AS cc ON(cc.component_category_id = s.component_category_id)
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
        INNER JOIN components as c ON(c.component_id = sc.component_id)
        INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
        WHERE scheme_id = $scheme_id";
//$scheme = $this->scheme_model->get_scheme($scheme_id)[0];
$scheme = $this->db->query($query)->row();

$water_user_association = $this->water_user_association_model->get_water_user_association($scheme->water_user_association_id)[0];
//$this->data["title"] = $scheme->scheme_name . " (" . $scheme->scheme_code . ")";
//$this->data["description"] = $this->data["water_user_association"]->wua_registration_no . " - " . $this->data["water_user_association"]->wua_name;

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        SC: <?php echo $scheme->scheme_code; ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">


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



        page[size="A4"] {
            width: 21cm;
            /* height: 29.7cm; */
            height: auto;
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

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
                color: black;

            }



        }


        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 4px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-size: 12px !important;
            color: black;
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
            margin: 20mm
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
</head>

<body>
    <page size='A4'>



        <div style="padding-left: 40px; padding-right: 40px; padding-top:0px !important;">
            <table style="width:100%">
                <tr>

                    <td style="vertical-align: top; text-align:left; ">
                        <h3><?php echo $system_global_settings[0]->system_title ?> </h3>
                        <p><?php echo $system_global_settings[0]->system_sub_title ?></p>

                    </td>
                    <td>
                        <h3 style="margin: 2px; padding:2px">Scheme Code: <strong><?php echo $scheme->scheme_code; ?></strong> </h3>
                        <h5 style="margin: 2px; padding:2px">Scheme Status: <strong><?php echo $scheme->scheme_status; ?></strong></h5>
                        <h5 style="margin: 2px; padding:2px">Financial Year: <strong><?php echo $scheme->financial_year; ?></strong></h5>

                    </td>

                </tr>

            </table>
            <hr />
            <table style="width: 100%;">
                <tr>

                    <td>
                        <h3>Scheme Name: <strong><?php echo $scheme->scheme_name ?></strong> </h3>
                        <p>
                            Component: <strong><?php echo $scheme->component_name; ?></strong> <small>(<?php echo $scheme->component_detail; ?>)</small><br />
                            Sub Component: <strong><?php echo $scheme->sub_component_name; ?></strong> <small>(<?php echo $scheme->sub_component_detail; ?>)</small><br />
                            Category: <strong><?php echo $scheme->category; ?></strong> <small>(<?php echo $scheme->category_detail; ?>)</small><br />

                        </p>
                    </td>

                    <td style="vertical-align: middle;">
                        <p style="font-size: 13px;">
                            District: <strong><?php echo $scheme->district_name; ?> </strong><br />
                            Tehsil: <strong><?php echo $scheme->tehsil; ?></strong><br />
                            UC: <strong><?php echo $scheme->uc; ?></strong><br />
                            Village: <strong><?php echo $scheme->villege; ?></strong><br />
                            NA-<strong><?php echo $scheme->na; ?></strong> , PK-<strong><?php echo $scheme->pk; ?></strong><br />
                            Coordinates: <br /><strong><?php echo $scheme->latitude; ?>, <?php echo $scheme->longitude; ?></strong>
                        </p>
                    </td>
                </tr>
            </table>

            <div class="table-responsive">
                <strong>Water User Association</strong>
                <table class="table table-bordered" style="width: 100%;">
                    <tbody>
                        <tr>
                            <th>WUA Name</th>
                            <th>WUA Reg. No.</th>
                            <th>Account Title</th>
                            <th>Account No</th>
                            <th>Branch Code</th>
                        </tr>
                        <tr>
                            <td><?php echo $water_user_association->wua_name; ?></td>
                            <td><?php echo $water_user_association->wua_registration_no; ?></td>
                            <td>
                                <?php echo $water_user_association->bank_account_title; ?>
                            </td>
                            <td>
                                <?php echo $water_user_association->bank_account_number; ?>
                            </td>
                            <td>
                                <?php echo $water_user_association->bank_branch_code; ?>
                            </td>
                        </tr>




                    </tbody>
                </table>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <strong>WUA Chairman </strong>
                            <table class="table table-bordered table_small" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><strong>Chairman Name</strong></th>
                                        <th><strong>Father Name</strong></th>
                                        <th><strong>Gender</strong></th>
                                        <th><strong>CNIC</strong></th>
                                        <th><strong>Contact</strong></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $water_user_association->cm_name; ?></td>
                                        <td><?php echo $water_user_association->cm_father_name; ?></td>
                                        <td><?php echo $water_user_association->cm_gender; ?></td>
                                        <td><?php echo $water_user_association->cm_cnic; ?></td>
                                        <td><?php echo $water_user_association->cm_contact_no; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <strong>Scheme Beneficiaries </strong>
                            <table class="table table-bordered table_small" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><strong>Male</strong></th>
                                        <th><strong>Female</strong></th>
                                        <th><strong>Total</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $scheme->male_beneficiaries; ?></td>
                                        <td><?php echo $scheme->female_beneficiaries; ?></td>
                                        <td><?php echo $scheme->beneficiaries; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                </table>
            </div>



            <table style="width: 100%;">
                <tr>
                    <td style="vertical-align: top;">
                        <strong>Dates info</strong>
                        <table class="table table-bordered" id="dates_info">

                            <tbody>
                                <tr>
                                    <td><strong>Registration Date</strong></td>
                                    <td><?php echo $scheme->registration_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Top Date</strong></td>
                                    <td><?php echo $scheme->top_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Survey Date</strong></td>
                                    <td><?php echo $scheme->survey_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Design Date</strong></td>
                                    <td><?php echo $scheme->design_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Feasibility Date</strong></td>
                                    <td><?php echo $scheme->feasibility_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Work Order Date</strong></td>
                                    <td><?php echo $scheme->work_order_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Scheme Initiation Date</strong></td>
                                    <td><?php echo $scheme->scheme_initiation_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Verified By TPV</strong></td>
                                    <td><?php echo $scheme->verified_by_tpv; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>TPV Date</strong></td>
                                    <td><?php echo $scheme->verification_by_tpv_date; ?></td>
                                </tr>


                            </tbody>
                        </table>




                    </td>
                    <td style="vertical-align: top;">
                        <strong>Technical Info</strong>
                        <table class="table table-bordered" id="dates_info">
                            <tr>
                                <td><strong>Water Source</strong></td>
                                <td><?php echo $scheme->water_source; ?></td>
                            </tr>
                            <tr>
                                <td><strong>CCA</td>
                                <td><?php echo $scheme->cca; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>ACCA</td>
                                <td><?php echo $scheme->acca; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>GCA</td>
                                <td><?php echo $scheme->gca; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Pre Water Losses</strong></td>
                                <td><?php echo $scheme->pre_water_losses; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Pre Additional</strong></td>
                                <td><?php echo $scheme->pre_additional; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Post Water Losses</strong></td>
                                <td><?php echo $scheme->post_water_losses; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Saving Water Losses</strong></td>
                                <td><?php echo $scheme->saving_water_losses; ?></td>
                            </tr>

                            <tr>
                                <td><strong>Total Length</strong></td>
                                <td><?php echo $scheme->total_lenght; ?></td>
                            </tr>

                        </table>

                    </td>
                    <td style="vertical-align: top;">
                        <strong></strong>
                        <table class="table table-bordered" id="dates_info">

                            <tr>
                                <td><strong>Total Length</strong></td>
                                <td><?php echo $scheme->total_lenght; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Lining Length</strong></td>
                                <td><?php echo $scheme->lining_length; ?></td>
                            </tr>
                            <tr>
                                <td><strong>LWH</strong></td>
                                <td><?php echo $scheme->lwh; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Length</strong></td>
                                <td><?php echo $scheme->length; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Width</strong></td>
                                <td><?php echo $scheme->width; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Height</strong></td>
                                <td><?php echo $scheme->height; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Type of Lining</strong></td>
                                <td><?php echo $scheme->type_of_lining; ?></td>
                            </tr>
                            <tr>
                                <td><strong>NACCA Panel</strong></td>
                                <td><?php echo $scheme->nacca_pannel; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Culvert</strong></td>
                                <td><?php echo $scheme->culvert; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Risers Pipe</strong></td>
                                <td><?php echo $scheme->risers_pipe; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Risers Pond</strong></td>
                                <td><?php echo $scheme->risers_pond; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Design Discharge</strong></td>
                                <td><?php echo $scheme->design_discharge; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Others</strong></td>
                                <td><?php echo $scheme->others; ?></td>
                            </tr>
                        </table>

                    </td>
                    <td style="vertical-align: top;">
                        <strong>Costs info</strong>
                        <table class="table table-bordered" id="costs_info">

                            <tbody>
                                <tr>
                                    <td><strong>Estimated Cost</strong></td>
                                    <td><?php echo $scheme->estimated_cost; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Estimated Cost Date</strong></td>
                                    <td><?php echo $scheme->estimated_cost_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Approved Cost</strong></td>
                                    <td><?php echo $scheme->approved_cost; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Approval Date</strong></td>
                                    <td><?php echo $scheme->approval_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Revised Cost</strong></td>
                                    <td><?php echo $scheme->revised_cost; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Revised Cost Date</strong></td>
                                    <td><?php echo $scheme->revised_cost_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Sanctioned Cost</strong></td>
                                    <td><?php echo $scheme->sanctioned_cost; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Technical Sanction Date</strong></td>
                                    <td><?php echo $scheme->technical_sanction_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Physical Completion</strong></td>
                                    <td><?php echo $scheme->phy_completion; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Physical Completion Date</strong></td>
                                    <td><?php echo $scheme->phy_completion_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Completion Date</strong></td>
                                    <td><?php echo $scheme->completion_date; ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </td>

                </tr>
            </table>

            <strong>Payments</strong>
            <table class="table table-bordered table_small" id="db_table">
                <thead>

                    <th>#</th>
                    <th>Head</th>
                    <th>Voucher No.</th>
                    <th>Cheque</th>
                    <th>Date</th>
                    <th>Payee Name</th>
                    <th>Gross Paid</th>
                    <th>Deduction</th>
                    <th>Net Paid</th>
                    <th>Installment</th>
                    <th>Payment %</th>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT e.*,fy.financial_year, d.district_name, d.region  FROM expenses as e 
                            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                            INNER JOIN districts as d ON(d.district_id = e.district_id)
                            WHERE scheme_id = $scheme->scheme_id";
                    $expenses = $this->db->query($query)->result();

                    $count = 1;
                    foreach ($expenses as $expense) : ?>

                        <tr>

                            <td><?php echo $count++; ?></td>

                            <?php
                            if ($expense->component_category_id > 0) {
                                $query = "SELECT cc.`category`, cc.category_detail 
                                                        FROM `component_categories` as cc 
                                                        WHERE cc.component_category_id=$expense->component_category_id";
                                $c_category = $this->db->query($query)->row();
                            ?>
                                <td><?php echo $c_category->category; ?>
                                </td>
                            <?php } else { ?>
                                <td></td>

                            <?php } ?>

                            <td><?php echo $expense->voucher_number; ?></td>
                            <td><?php echo $expense->cheque; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                            <td><small><i><?php echo $expense->payee_name; ?></i></small></td>
                            <td><?php echo number_format($expense->gross_pay); ?></td>
                            <td><?php echo number_format($expense->whit_tax + $expense->whst_tax + $expense->st_duty_tax + $expense->rdp_tax + $expense->kpra_tax + $expense->gur_ret + $expense->misc_deduction); ?></td>

                            <td><?php echo number_format($expense->net_pay); ?></td>
                            <th><?php echo $expense->installment; ?></th>
                            <th>
                                <?php if ($scheme->sanctioned_cost) echo round(($expense->net_pay * 100) / $scheme->sanctioned_cost, 2) . " %"   ?>
                            </th>


                        </tr>
                    <?php endforeach; ?>


                </tbody>
                <tfoot>
                    <?php
                    $query = "SELECT SUM(e.gross_pay) as gross_pay,
                        SUM(e.whit_tax) as whit_tax,
                        SUM(e.whst_tax) as whst_tax,
                        SUM(e.st_duty_tax) as st_duty_tax,
                        SUM(e.rdp_tax) as rdp_tax,
                        SUM(e.rdp_tax) as kpra_tax,
                        SUM(e.gur_ret) as gur_ret,
                        SUM(e.misc_deduction) as misc_deduction,
                        SUM(e.net_pay) as net_pay
                          FROM expenses as e 
                        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                        INNER JOIN districts as d ON(d.district_id = e.district_id)
                        WHERE scheme_id = $scheme->scheme_id";
                    $expense_summary = $this->db->query($query)->row();
                    ?>



                </tfoot>
            </table>


            <p style="text-align: center;"><strong>Financial Summary</strong></p>
            <table class="table table-bordered table-striped " style="width: 100%; font-size: 15px;">
                <tr>
                    <th>Total Sanctioned Cost</th>
                    <th>Gross Paid</th>
                    <th>Payment (Percentage)</th>
                    <th>Remaining</th>
                </tr>
                <tr>
                    <th><?php if ($scheme->sanctioned_cost) echo number_format($scheme->sanctioned_cost);
                        else "notmentioned" ?></th>
                    <th><?php if ($expense_summary->gross_pay) echo number_format($expense_summary->gross_pay);
                        else echo "0.00" ?></th>
                    <th><?php if ($scheme->sanctioned_cost > 0) echo round((($expense_summary->gross_pay * 100) / $scheme->sanctioned_cost), 2) . " %"; ?>
                    </th>
                    <th><?php echo number_format($scheme->sanctioned_cost - $expense_summary->gross_pay); ?>
                    </th>
                </tr>

            </table>


        </div>




        <div class="page-footer"
            style="background-color: rgb(229, 228, 226) !important; border:1px solid rgb(229, 228, 226); text-align:center">

            <small>

                Print @ <?php echo date("d M, Y h:m:s A"); ?>
                by
                <?php
                $query = "SELECT
                `roles`.`role_title`,
                `users`.`user_title`  
                FROM `roles`,
                `users` 
                WHERE `roles`.`role_id` = `users`.`role_id`
                AND `users`.`user_id`='" . $this->session->userdata("userId") . "'";
                $user_data = $this->db->query($query)->row();
                ?>
                <?php echo $user_data->user_title; ?> (<?php echo $user_data->role_title; ?>)
            </small>


        </div>
    </page>
</body>



</html>