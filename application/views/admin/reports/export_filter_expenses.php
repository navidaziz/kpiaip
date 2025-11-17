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
                                <th>Financial Year</th>
                                <th>Regions</th>
                                <th>Districts</th>
                                <th>Components</th>
                                <th>Sub Components</th>
                                <th>Components Categories</th>
                                <th>Purpose</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Filter</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $query = "SELECT fy.financial_year, e.financial_year_id  FROM expenses as e 
                                                    INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
                                                    GROUP BY fy.financial_year_id";
                                    $fys = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="financial_year_ids[]" id="financial_year_ids" multiple="multiple">
                                        <?php foreach ($fys as $fy) { ?>
                                            <option value="<?php echo $fy->financial_year_id; ?>"><?php echo $fy->financial_year; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
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
                                    $query = "SELECT 
                                                        c.component_id, 
                                                        c.component_name FROM expenses as e 
                                                        INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                                                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                                                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                                                        GROUP BY  c.component_name";
                                    $components = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="component_ids[]" id="component_ids" multiple="multiple">
                                        <?php foreach ($components as $component) { ?>
                                            <option value="<?php echo $component->component_id; ?>"><?php echo $component->component_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#component_ids').on('change', function() {
                                                let selectedComponents = $(this).val(); // Get selected component(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "expenses/get_sub_components_by_component"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        components: selectedComponents
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected sub-component IDs
                                                        let selectedSubComponents = $('#sub_component_ids').val() || [];

                                                        // Clear existing options
                                                        $('#sub_component_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected sub-components
                                                        let subComponentOptions = [];
                                                        $.each(data, function(key, sub_component) {
                                                            if (!selectedSubComponents.includes(sub_component.sub_component_id.toString())) {
                                                                subComponentOptions.push(new Option(sub_component.sub_component_name, sub_component.sub_component_id, false, false));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#sub_component_ids').append(subComponentOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching sub-components. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

                                </td>

                                <td>
                                    <?php
                                    $query = "SELECT 
                                                        sc.sub_component_id, 
                                                        sc.sub_component_name, 
                                                        cc.category, 
                                                        e.component_category_id FROM expenses as e 
                                                        INNER JOIN component_categories as cc ON(cc.component_category_id = e.component_category_id)
                                                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                                                        GROUP BY  sc.sub_component_name";
                                    $sub_components = $this->db->query($query)->result();
                                    ?>
                                    <select class="form-control" name="sub_component_ids[]" id="sub_component_ids" multiple="multiple">
                                        <?php foreach ($sub_components as $sub_component) { ?>
                                            <option value="<?php echo $sub_component->sub_component_id; ?>"><?php echo $sub_component->sub_component_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#sub_component_ids').on('change', function() {
                                                let selectedSubComponents = $(this).val(); // Get selected sub-component(s)

                                                $.ajax({
                                                    url: '<?php echo site_url(ADMIN_DIR . "expenses/get_component_categories_by_sub_component"); ?>',
                                                    type: 'POST',
                                                    data: {
                                                        sub_components: selectedSubComponents
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        // Get already selected component category IDs
                                                        let selectedComponentCategories = $('#component_category_ids').val() || [];

                                                        // Clear existing options in the component category dropdown
                                                        $('#component_category_ids').empty().trigger('change');

                                                        // Populate dropdown while excluding already selected component categories
                                                        let componentCategoryOptions = [];
                                                        $.each(data, function(key, component_category) {
                                                            if (!selectedComponentCategories.includes(component_category.component_category_id.toString())) {
                                                                componentCategoryOptions.push(new Option(
                                                                    component_category.category,
                                                                    component_category.component_category_id,
                                                                    false,
                                                                    false
                                                                ));
                                                            }
                                                        });

                                                        // Add new options and trigger Select2 update
                                                        $('#component_category_ids').append(componentCategoryOptions).trigger('change');
                                                    },
                                                    error: function() {
                                                        alert('Error fetching component categories. Please try again.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

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
                                    url: '<?php echo site_url(ADMIN_DIR . "expenses/filter_expenses") ?>', // Replace with your server-side filtering URL
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
                                                pageLength: 100,
                                                lengthMenu: [
                                                    [100, 500, 1000, 2000, -1],
                                                    [100, 500, 1000, 2000, "All"]
                                                ],
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
                                                        data: 'financial_year',
                                                        title: 'Financial Year'
                                                    },
                                                    {
                                                        data: 'region',
                                                        title: 'Region'
                                                    },
                                                    {
                                                        data: 'district_name',
                                                        title: 'District'
                                                    },
                                                    {
                                                        data: 'cheque',
                                                        title: 'Cheque'
                                                    },
                                                    {
                                                        data: 'date',
                                                        title: 'Date'
                                                    },
                                                    {
                                                        data: 'wua_registration_no',
                                                        title: 'WUA REG. No.'
                                                    },
                                                    {
                                                        data: 'scheme_code',
                                                        title: 'Scheme Code'
                                                    },
                                                    {
                                                        data: 'scheme_name',
                                                        title: 'Scheme Name'
                                                    },
                                                    {
                                                        data: 'payee_name',
                                                        title: 'Payee Name'
                                                    },
                                                    {
                                                        data: 'component_name',
                                                        title: 'Component'
                                                    },
                                                    {
                                                        data: 'sub_component_name',
                                                        title: 'Sub-Component'
                                                    },
                                                    {
                                                        data: 'category',
                                                        title: 'Category'
                                                    },
                                                    {
                                                        data: 'sanctioned_cost',
                                                        title: 'Section Cost'
                                                    },
                                                    {
                                                        data: 'gross_pay',
                                                        title: 'Gross Paid'
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
                                                        title: 'St.Duty'
                                                    },
                                                    {
                                                        data: 'rdp_tax',
                                                        title: 'RDP'
                                                    },

                                                    {
                                                        data: 'gur_ret',
                                                        title: 'GUR.RET.'
                                                    },
                                                    {
                                                        data: 'misc_deduction',
                                                        title: 'Misc.Dedu.'
                                                    },
                                                    {
                                                        data: 'net_pay',
                                                        title: 'Net Paid'
                                                    },
                                                    {
                                                        data: 'taxable',
                                                        title: 'Taxable'
                                                    },
                                                    {
                                                        data: 'installment',
                                                        title: 'Installment'
                                                    },
                                                    {
                                                        data: 'paid_percentage',
                                                        title: 'Status'
                                                    },
                                                    {
                                                        data: 'purpose',
                                                        title: 'Purpose of Expense'
                                                    },
                                                    {
                                                        data: 'remarks',
                                                        title: 'Remarks'
                                                    },
                                                    {
                                                        data: 'reconcilation',
                                                        title: 'Reconcilation'
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
                                <th>Financial Year</th>
                                <th>Region</th>
                                <th>District</th>
                                <th>Cheque</th>
                                <th>Date</th>
                                <th>WUA REG. No.</th>
                                <th>Scheme Code</th>
                                <th>Scheme Name</th>
                                <th>Payee Name</th>
                                <th>Component</th>
                                <th>Sub-Component</th>
                                <th>Category</th>
                                <th>Section Cost</th>
                                <th>Gross Paid</th>
                                <th>WHIT</th>
                                <th>WHST</th>
                                <th>KPRA</th>
                                <th>St.Duty</th>
                                <th>RDP</th>
                                <th>GUR.RET.</th>
                                <th>Misc.Dedu.</th>
                                <th>Net Paid</th>
                                <th>Taxable</th>
                                <th>Installment</th>
                                <th>Status</th>
                                <th>Purpose of Expense</th>
                                <th>Remarks</th>
                                <th>Reconcilation</th>
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