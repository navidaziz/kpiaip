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




<!-- Include jQuery and Select2 CSS/JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Include DataTables JS (ensure it's after jQuery) -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- buttons -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">

                    <form id="filterForm">
                        <table class="table table-striped table_small">
                            <tr>
                                <th></th>
                                <th>Date Filter By</th>
                                <th>Value</th>
                                <th>Filter</th>
                                <th>Fetch Overall Data</th>
                            </tr>
                            <tr>

                                <td><a target="_blank" class="btn btn-success" href="<?php echo site_url(ADMIN_DIR . 'reports/export_venders_taxes') ?>">Export Overall Data</a></td>

                                <td>
                                    <select class="form-control" name="filter_by" id="filter_by">
                                        <option value="tracking_id">Tracking ID</option>
                                        <option value="voucher_id">Voucher ID</option>
                                        <option value="scheme_id">Scheme ID</option>
                                </td>
                                <td><input class="form-control" type="text" name="filter_value" id="filter_value" /></td>
                                <td><button class="btn btn-danger submitBtn" type="submit" name="filter_data" value="filter_data">Filter Date</button></td>
                                <td><button class="btn btn-warning submitBtn" type="submit" name="fetch_overall_data" value="fetch_overall_data">Fetch Data</button></td>
                            </tr>
                        </table>
                        <div id="filte r_expenses"></div>
                    </form>



                    <table id="schemesTable" class="table table-bordered table-striped table_small" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Office/ Setup</th>
                                <th>Tracking ID</th>
                                <th>Voucher ID</th>
                                <th>Scheme's Code</th>
                                <th>Scheme's Name</th>
                                <th>Payee's Name</th>
                                <th>Category</th>
                                <th>Vendor ID</th>
                                <th>Vendor Type</th>
                                <th>TaxPayer NTN</th>
                                <th>TaxPayer CNIC</th>

                                <th>TaxPayer City</th>
                                <th>TaxPayer Address</th>
                                <th>TaxPayer Status</th>
                                <th>TaxPayer Business Name</th>
                                <th>Focal Person</th>
                                <th>Contact No</th>
                                <th>Industery</th>
                                <th>Business Category</th>
                                <th>Nature of Business</th>
                                <th>Registration No</th>
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th>Nature of Payment</th>
                                <th>Payment Section Code</th>
                                <th>Invoice Gross Total</th>
                                <th>ST Charged</th>
                                <th>SST Charged</th>
                                <th>WHT</th>
                                <th>WHST</th>
                                <th>Stamp Duty Tax</th>
                                <th>KPRA Tax</th>
                                <th>RDP Tax</th>
                                <th>Misc Deduction</th>
                            </tr>
                        </thead>


                        <tbody></tbody>
                    </table>

                    <script>
                        $(document).ready(function() {

                            let clickedButtonName = '';

                            $('.submitBtn').on('click', function() {
                                clickedButtonName = $(this).attr('name');
                            });

                            // Initialize Select2
                            //$('#component_ids, #sub_component_ids, #component_category_ids, #purposes').select2();

                            // Handle form submission
                            $('#filterForm').on('submit', function(event) {
                                event.preventDefault();

                                var formData = $(this).serialize();

                                var formData = $(this).serialize();
                                console.log('Button clicked:', clickedButtonName);

                                if (clickedButtonName === 'filter_data') {
                                    const filterBy = $('#filter_by').val().trim();
                                    const filterValue = $('#filter_value').val().trim();

                                    if (!filterBy || !filterValue) {
                                        alert('Please select a filter option and provide a value.');
                                        return; // Stop form submission
                                    }
                                } else if (clickedButtonName === 'fetch_overall_data') {
                                    // Handle fetch logic
                                }

                                $.ajax({
                                    url: '<?php echo site_url(ADMIN_DIR . "reports/vender_taxes_filter_list"); ?>',
                                    method: 'POST',
                                    data: formData,
                                    success: function(response) {
                                        //alert(response);
                                        response = JSON.parse(response);

                                        if (response.success) {
                                            if ($.fn.DataTable.isDataTable('#schemesTable')) {
                                                $('#schemesTable').DataTable().clear().destroy();
                                            }

                                            $('#schemesTable').DataTable({
                                                data: response.data,
                                                columns: [{
                                                        data: null,
                                                        title: 'S/No',
                                                        render: function(data, type, row, meta) {
                                                            return meta.row + 1;
                                                        },
                                                        orderable: false
                                                    }, {
                                                        data: 'district_name',
                                                        title: 'Office/  Setup'
                                                    },
                                                    {
                                                        data: 'tracking_id'
                                                    },
                                                    {
                                                        data: 'voucher_id'
                                                    },

                                                    {
                                                        data: 'scheme_code',
                                                        title: 'Scheme\'s Code'
                                                    },
                                                    {
                                                        data: 'scheme_name',
                                                        title: 'Scheme\'s Name'
                                                    },
                                                    {
                                                        data: 'TaxPayer_Name',
                                                        title: 'Payee\'s Name'
                                                    },
                                                    {
                                                        data: 'category'
                                                    },
                                                    {
                                                        data: 'vendor_id'
                                                    },
                                                    {
                                                        data: 'Vendor_Type'
                                                    },
                                                    {
                                                        data: 'TaxPayer_NTN'
                                                    },
                                                    {
                                                        data: 'TaxPayer_CNIC'
                                                    },

                                                    {
                                                        data: 'TaxPayer_City'
                                                    },
                                                    {
                                                        data: 'TaxPayer_Address'
                                                    },
                                                    {
                                                        data: 'TaxPayer_Status'
                                                    },
                                                    {
                                                        data: 'TaxPayer_Business_Name'
                                                    },
                                                    {
                                                        data: 'Focal_Person'
                                                    },
                                                    {
                                                        data: 'Contact_No'
                                                    },
                                                    {
                                                        data: 'industery'
                                                    },
                                                    {
                                                        data: 'business_category'
                                                    },
                                                    {
                                                        data: 'nature_of_business'
                                                    },
                                                    {
                                                        data: 'registration_no'
                                                    },


                                                    {
                                                        data: 'nature_of_payment',
                                                        title: 'Nature of Payment'
                                                    },
                                                    {
                                                        data: 'payment_section_code',
                                                        title: 'Payment of SC'
                                                    },
                                                    {
                                                        data: 'invoice_id',
                                                        title: 'Inv. Ref.'
                                                    },
                                                    {
                                                        data: 'invoice_date',
                                                        title: 'Inv_Date'
                                                    },
                                                    {
                                                        data: 'invoice_gross_total',
                                                        title: 'Invoice_Rs'
                                                    },
                                                    {
                                                        data: 'st_charged',
                                                        title: 'ST Charged'
                                                    },
                                                    {
                                                        data: 'sst_charged',
                                                        title: 'SST Charged'
                                                    },
                                                    {
                                                        data: 'whit_tax',
                                                        title: 'WHIT'
                                                    },
                                                    {
                                                        data: 'whst_tax',
                                                        title: 'WHST'
                                                    },
                                                    {
                                                        data: 'kpra_tax',
                                                        title: 'KPRA (WH)'
                                                    },
                                                    {
                                                        data: 'st_duty_tax',
                                                        title: 'St. Duty'
                                                    },

                                                    {
                                                        data: 'rdp_tax',
                                                        title: 'RPD'
                                                    },
                                                    {
                                                        data: 'misc_deduction',
                                                        title: 'MISC'
                                                    }
                                                ],

                                                dom: 'Blfrtip',
                                                pageLength: -1,
                                                buttons: [{
                                                        extend: 'print',
                                                        title: "Custom Schemes Report (Date: <?php echo date('d-m-Y h:i:s'); ?>)"
                                                    },
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: "Custom Schemes Report (Date: <?php echo date('d-m-Y h:i:s'); ?>)"
                                                    }
                                                ]
                                            });
                                        } else {
                                            alert('No data found');
                                        }
                                    },
                                    error: function(xhr) {
                                        console.error('Error:', xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>


</div>