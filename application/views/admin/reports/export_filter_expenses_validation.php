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
        font-size: 13px !important;
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
        font-size: 12px !important;
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
                                <th>Regions</th>
                                <th>Districts</th>
                                <th>CoA</th>
                                <th>Purpose</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Cheque No:</th>
                                <th>Filter</th>
                            </tr>
                            <tr>

                                <td>
                                    <?php
                                    $query = "SELECT d.region FROM expenses as e 
                                                    INNER JOIN districts as d ON(d.district_id = e.district_id)
                                                    GROUP BY d.region";
                                    $regions = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="regions[]" id="regions" multiple="multiple">
                                        <?php foreach ($regions as $region) { ?>
                                            <option value="<?php echo $region->region; ?>"><?php echo $region->region; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#regions').on('change', function() {
                                                let selectedRegion = $(this).val(); // Get selected region(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "expenses/get_district_by_region"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        region: selectedRegion
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected district IDs
                                                        let selectedDistricts = $('#district_ids').val() || [];

                                                        // Clear existing options
                                                        $('#district_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected districts
                                                        let districtOptions = [];
                                                        $.each(data, function(key, district) {
                                                            if (!selectedDistricts.includes(district.district_id.toString())) {
                                                                districtOptions.push(new Option(district.district_name, district.district_id, false, false));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#district_ids').append(districtOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching districts. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT d.district_name, e.district_id FROM expenses as e 
                                                    INNER JOIN districts as d ON(d.district_id = e.district_id)
                                                    GROUP BY d.district_name";
                                    $districts = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="district_ids[]" id="district_ids" multiple="multiple">
                                        <?php foreach ($districts as $district) { ?>
                                            <option value="<?php echo $district->district_id; ?>"><?php echo $district->district_name; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT cc.category, e.component_category_id FROM expenses as e 
                                                        INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                                                        GROUP BY cc.category";
                                    $categories = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="component_category_ids[]" id="component_category_ids" multiple="multiple">
                                        <?php foreach ($categories as $categorie) { ?>
                                            <option value="<?php echo $categorie->component_category_id; ?>"><?php echo $categorie->category; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php
                                    $query = "SELECT e.purpose FROM expenses as e 
                                                    GROUP BY e.purpose";
                                    $purposes = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="purposes[]" id="purposes" multiple="multiple">
                                        <?php foreach ($purposes as $purpose) { ?>
                                            <option value="<?php echo $purpose->purpose; ?>"><?php echo $purpose->purpose; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td><input class="form-control" type="date" name="start_date" id="start_date" /></td>
                                <td><input class="form-control" type="date" name="end_date" id="end_date" /></td>
                                <td><input class="form-control" type="text" name="cheque_no" id="cheque_no" /></td>
                                <td><button class="btn btn-danger" type="submit">Process</button></td>
                            </tr>
                        </table>
                        <div id="filter_expenses"></div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            // Initialize Select2 for all select dropdowns
                            $('#financial_year_ids, #regions, #district_ids, #component_ids, #sub_component_ids, #component_category_ids, #purposes').select2();

                            // Handle the form submission with AJAX
                            $('#filterForm').on('submit', function(event) {
                                event.preventDefault(); // Prevent the default form submission

                                // Serialize form data
                                var formData = $(this).serialize();

                                // Send the data via AJAX
                                $.ajax({
                                    url: '<?php echo site_url(ADMIN_DIR . "reports/filter_expenses_validation") ?>', // Replace with your server-side filtering URL
                                    method: 'POST', // or POST depending on your requirement
                                    data: formData,
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        if (response.success) {
                                            // Assuming response.data is the array of data to be displayed in the table
                                            var tableData = response.data;

                                            // Initialize DataTable with the fetched data
                                            $('#expensesTable').DataTable({
                                                destroy: true,
                                                dom: 'Blfrtip', // Added 'l' to include the length menu
                                                lengthChange: true, // Ensures the 'Show entries' dropdown is enabled
                                                ordering: true,
                                                searching: true,
                                                buttons: [{
                                                        extend: 'print',
                                                        title: "Custom Financial Report (Date: <?php echo date('d-m-Y h:m:s') ?>)",
                                                    },
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: "Custom Financial Report (Date: <?php echo date('d-m-Y h:m:s') ?>)",
                                                    }
                                                ],
                                                data: tableData,
                                                columns: [{
                                                        data: 'district_name',
                                                        title: 'District'
                                                    },
                                                    {
                                                        data: 'scheme_code',
                                                        title: 'Code'
                                                    },
                                                    {
                                                        data: 'scheme_name',
                                                        title: 'Scheme\'s Name'
                                                    },
                                                    {
                                                        data: 'payee_name',
                                                        title: 'Payee\'s Name'
                                                    },
                                                    {
                                                        data: 'category',
                                                        title: 'CoA'
                                                    },
                                                    {
                                                        data: 'cheque',
                                                        title: 'Cheque No:'
                                                    },
                                                    {
                                                        data: 'date',
                                                        title: 'Date'
                                                    },

                                                    {
                                                        data: 'gross_pay',
                                                        title: 'Gross'
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
                                                        title: 'KPRA'
                                                    },
                                                    {
                                                        data: 'st_duty_tax',
                                                        title: 'St. Duty'
                                                    },
                                                    {
                                                        data: 'rdp_tax',
                                                        title: 'RDP'
                                                    },

                                                    {
                                                        data: 'gur_ret',
                                                        title: 'Per'
                                                    },
                                                    {
                                                        data: 'misc_deduction',
                                                        title: 'Misc.'
                                                    },
                                                    {
                                                        data: 'net_pay',
                                                        title: 'Net Rs.'
                                                    },
                                                    {
                                                        data: 'installment',
                                                        title: 'Status'
                                                    },
                                                    {
                                                        data: 'purpose',
                                                        title: 'Purpose of Expense'
                                                    }
                                                ]
                                            });

                                        } else {
                                            alert('No data found');
                                        }
                                    },
                                    error: function(error) {
                                        // Handle any errors here
                                        console.error('Error fetching data:', error);
                                    }
                                });
                            });
                        });
                    </script>

                    <!-- Your DataTable HTML Table -->
                    <table id="expensesTable" class="table table-striped table-bordered table_s_small" style="width:100%">
                        <thead>
                            <tr>
                                <th>District</th>

                                <th>Scheme Code</th>
                                <th>Scheme's Name</th>
                                <th>Payee's Name</th>
                                <th>CoA</th>
                                <th>Cheque</th>
                                <th>Date</th>
                                <th>Gross Paid</th>
                                <th>WHIT</th>
                                <th>WHST</th>
                                <th>KPRA</th>
                                <th>St.Duty</th>
                                <th>RDP</th>
                                <th>GUR.RET.</th>
                                <th>Misc.Dedu.</th>
                                <th>Net Paid</th>
                                <th>Installment</th>
                                <th>Purpose of Expense</th>
                            </tr>
                        </thead>
                    </table>


                    <script>
                        //  $(document).ready(function() {
                        //      // Initialize Select2 for all select dropdowns
                        //      $('#financial_year_ids, #regions, #district_ids, #component_ids, #sub_component_ids, #component_category_ids, #purposes').select2();

                        //      // Handle the form submission with AJAX
                        //      $('#filterForm').on('submit', function(event) {
                        //          event.preventDefault(); // Prevent the default form submission

                        //          // Serialize form data
                        //          var formData = $(this).serialize();

                        //          // Send the data via AJAX
                        //          $.ajax({
                        //              url: '<?php echo site_url(ADMIN_DIR . "expenses/filter_expenses") ?>', // Replace with your server-side filtering URL
                        //              method: 'POST', // or POST depending on your requirement
                        //              data: formData,
                        //              success: function(response) {
                        //                  //alert(response);
                        //                  // Handle the successful response here
                        //                  // $('#filter_expenses').html(response);
                        //                  // You can update the page with the filtered data, for example:
                        //                  // $('#resultContainer').html(response.data);





                        //              },
                        //              error: function(error) {
                        //                  // Handle any errors here
                        //                  console.error('Error fetching data:', error);
                        //              }
                        //          });
                        //      });
                        //  });
                    </script>




                </div>
            </div>
        </div>
    </div>


</div>