<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?php echo $scheme->code; ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/cloud-admin.css"
        media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/themes/default.css"
        media="screen,print" id="skin-switcher" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/responsive.css"
        media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/custom.css"
        media="screen,print" />


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
                height: 50px;
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

        <div class="print-page-header" style="background-color: rgb(229, 228, 226) !important;">
            <table style="width:100%">
                <tr>

                    <td style="vertical-align: top; text-align:center; ">
                        <strong><?php echo $system_global_settings[0]->system_title ?> </strong><br />
                        <?php echo $system_global_settings[0]->system_sub_title ?>

                    </td>

                </tr>

            </table>
        </div>


        <div style="padding-left: 40px; padding-right: 40px; padding-top:0px !important;" contenteditable="true">
            <table class="table table-bordered" id="schemes">
                <thead>
                    <tr>
                        <th>Financial Year</th>
                        <th>Component Category</th>
                        <th>District</th>
                        <th>Tehsil</th>
                        <th>Uc</th>
                        <th>Villege</th>
                        <th>Na</th>
                        <th>Pk</th>
                        <th>Scheme Code</th>
                        <th>Scheme Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Beneficiaries</th>
                        <th>Male Beneficiaries</th>
                        <th>Female Beneficiaries</th>
                        <th>Registration Date</th>
                        <th>Top Date</th>
                        <th>Survey Date</th>
                        <th>Design Date</th>
                        <th>Feasibility Date</th>
                        <th>Work Order Date</th>
                        <th>Scheme Initiation Date</th>
                        <th>Estimated Cost</th>
                        <th>Estimated Cost Date</th>
                        <th>Approved Cost</th>
                        <th>Approval Date</th>
                        <th>Revised Cost</th>
                        <th>Revised Cost Date</th>
                        <th>Sanctioned Cost</th>
                        <th>Technical Sanction Date</th>
                        <th>Completion Date</th>
                        <th>Scheme Status</th>
                        <th>Remarks</th>
                        <th>Verified By Tpv</th>
                        <th>Verification By Tpv Date</th>
                        <th>Funding Source</th>
                        <th>Water Source</th>
                        <th>Cca</th>
                        <th>Acca</th>
                        <th>Gca</th>
                        <th>Pre Water Losses</th>
                        <th>Pre Additional</th>
                        <th>Post Water Losses</th>
                        <th>Saving Water Losses</th>
                        <th>Total Lenght</th>
                        <th>Lining Length</th>
                        <th>Lwh</th>
                        <th>Length</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th>Type Of Lining</th>
                        <th>Nacca Pannel</th>
                        <th>Culvert</th>
                        <th>Risers Pipe</th>
                        <th>Risers Pond</th>
                        <th>Design Discharge</th>
                        <th>Others</th>
                        <th>Scheme Note</th>
                        <th>Phy Completion</th>
                        <th>Phy Completion Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $scheme->financial_year; ?></td>
                        <td><?php echo $scheme->component_category; ?></td>
                        <td><?php echo $scheme->district_name; ?></td>
                        <td><?php echo $scheme->tehsil; ?></td>
                        <td><?php echo $scheme->uc; ?></td>
                        <td><?php echo $scheme->villege; ?></td>
                        <td><?php echo $scheme->na; ?></td>
                        <td><?php echo $scheme->pk; ?></td>
                        <td><?php echo $scheme->scheme_code; ?></td>
                        <td><?php echo $scheme->scheme_name; ?></td>
                        <td><?php echo $scheme->latitude; ?></td>
                        <td><?php echo $scheme->longitude; ?></td>
                        <td><?php echo $scheme->beneficiaries; ?></td>
                        <td><?php echo $scheme->male_beneficiaries; ?></td>
                        <td><?php echo $scheme->female_beneficiaries; ?></td>
                        <td><?php echo $scheme->registration_date; ?></td>
                        <td><?php echo $scheme->top_date; ?></td>
                        <td><?php echo $scheme->survey_date; ?></td>
                        <td><?php echo $scheme->design_date; ?></td>
                        <td><?php echo $scheme->feasibility_date; ?></td>
                        <td><?php echo $scheme->work_order_date; ?></td>
                        <td><?php echo $scheme->scheme_initiation_date; ?></td>
                        <td><?php echo $scheme->estimated_cost; ?></td>
                        <td><?php echo $scheme->estimated_cost_date; ?></td>
                        <td><?php echo $scheme->approved_cost; ?></td>
                        <td><?php echo $scheme->approval_date; ?></td>
                        <td><?php echo $scheme->revised_cost; ?></td>
                        <td><?php echo $scheme->revised_cost_date; ?></td>
                        <td><?php echo $scheme->sanctioned_cost; ?></td>
                        <td><?php echo $scheme->technical_sanction_date; ?></td>
                        <td><?php echo $scheme->completion_date; ?></td>
                        <td><?php echo $scheme->scheme_status; ?></td>
                        <td><?php echo $scheme->remarks; ?></td>
                        <td><?php echo $scheme->verified_by_tpv; ?></td>
                        <td><?php echo $scheme->verification_by_tpv_date; ?></td>
                        <td><?php echo $scheme->funding_source; ?></td>
                        <td><?php echo $scheme->water_source; ?></td>
                        <td><?php echo $scheme->cca; ?></td>
                        <td><?php echo $scheme->acca; ?></td>
                        <td><?php echo $scheme->gca; ?></td>
                        <td><?php echo $scheme->pre_water_losses; ?></td>
                        <td><?php echo $scheme->pre_additional; ?></td>
                        <td><?php echo $scheme->post_water_losses; ?></td>
                        <td><?php echo $scheme->saving_water_losses; ?></td>
                        <td><?php echo $scheme->total_lenght; ?></td>
                        <td><?php echo $scheme->lining_length; ?></td>
                        <td><?php echo $scheme->lwh; ?></td>
                        <td><?php echo $scheme->length; ?></td>
                        <td><?php echo $scheme->width; ?></td>
                        <td><?php echo $scheme->height; ?></td>
                        <td><?php echo $scheme->type_of_lining; ?></td>
                        <td><?php echo $scheme->nacca_pannel; ?></td>
                        <td><?php echo $scheme->culvert; ?></td>
                        <td><?php echo $scheme->risers_pipe; ?></td>
                        <td><?php echo $scheme->risers_pond; ?></td>
                        <td><?php echo $scheme->design_discharge; ?></td>
                        <td><?php echo $scheme->others; ?></td>
                        <td><?php echo $scheme->scheme_note; ?></td>
                        <td><?php echo $scheme->phy_completion; ?></td>
                        <td><?php echo $scheme->phy_completion_date; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>




        <div class="page-footer"
            style="background-color: rgb(229, 228, 226) !important; border:1px solid rgb(229, 228, 226); text-align:center">

            <small>
                <strong><?php echo $system_global_settings[0]->address ?></strong>

                <br />
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