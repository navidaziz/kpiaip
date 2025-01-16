<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Cheque Design</title>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheque Printing</title>
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;

        }

        /* Cheque container */
        .cheque-container {
            width: 7.2in;
            /* Set width to 6 inches */
            height: 2.75in;
            /* Set height to 2.75 inches */
            background-color: #fff;
            border: 2px solid #000;
            padding: 15px;
            border-radius: 8px;
            background-image: url("<?php echo site_url('assets/cheque.jpg'); ?>");
        }

        /* Header styles */
        .cheque-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .bank-info {
            font-size: 14px;
            font-weight: bold;
        }

        .bank-name {
            display: block;
        }

        .branch-name {
            font-size: 12px;
            margin-top: 5px;
        }

        .cheque-details {
            text-align: right;
            font-size: 12px;
        }

        .cheque-no,
        .issue-date {
            display: block;
        }

        /* Body styles */
        .cheque-body {
            margin-bottom: 10px;
        }

        .payee-details,
        .amount,
        .amount-in-words,
        .signature-section {
            margin-bottom: 5px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input {
            width: 100%;
            padding: 3px;
            font-size: 12px;
            margin-top: 5px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
        }

        .signature,
        .bank-stamp {
            width: 48%;
        }

        .signature-input,
        .stamp-input {
            width: 100%;
        }

        /* Footer styles */
        .cheque-footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
            color: #555;
        }

        .footer-note {
            font-style: italic;
        }

        /* Print-specific styles */
        @media print {
            body {
                padding: 0;
            }

            .cheque-container {
                border: none;
                box-shadow: none;
                margin: 0;
            }

            /* Set page size for printing */
            @page {
                size: 6in 2.75in;
                margin: 0;
            }

            /* Hide everything else when printing */
            body * {
                visibility: hidden;
            }

            .cheque-container,
            .cheque-container * {
                visibility: visible;
            }
        }
    </style>


</head>

<body>
    <div class="cheque-container">
        <div class="cheque-header">
            <div class="bank-info">

            </div>
            <div class="cheque-details" style="position: absolute; margin-left:490px; margin-top:26px ">
                <h4 class="issue-date" style="letter-spacing: 11px; font-size:16px">16012025</h4>
            </div>
        </div>

        <div class="cheque-body">
            <div class="payee-details">

                <h4 style="margin-top: 75px; margin-left:50px">Payee Name</h4>
            </div>

            <div class="amount" style="position: absolute; margin-left:500px">
                <h4>10,000,000</h4>
            </div>

            <div class="amount-in-words" style="position: absolute; margin-left:50px;   width:380px; height:50px; line-height:23px">

                <h4>Ten Million only </h4>
            </div>


        </div>


    </div>
</body>

</html>